<?php

namespace XoopsModules\Tad_adm {
    function chmod($path, $mode)
    {
        $GLOBALS['chmodPaths'][] = str_replace('\\', '/', $path);
        return \chmod($path, $mode);
    }
}

namespace {
    use XoopsModules\Tad_adm\UpgradeManifest;

    require dirname(__DIR__) . '/class/UpgradeManifest.php';

    function verifyExclude($condition, string $message): void
    {
        if (!$condition) {
            throw new \RuntimeException($message);
        }
    }

    $base = str_replace('\\', '/', sys_get_temp_dir()) . '/tad_adm_exclude_' . bin2hex(random_bytes(8));
    mkdir($base . '/site/uploads/nested', 0755, true);
    mkdir($base . '/site/other', 0755, true);
    file_put_contents($base . '/site/uploads/nested/file', 'excluded');
    file_put_contents($base . '/site/other/file', 'included');
    $manifest = $base . '/manifest.json';
    $ctx = ['ROOT' => $base . '/site', 'VAR' => $base . '/var', 'LIB' => $base . '/lib',
        'WORK' => $base . '/site/work', 'NEW_FILE' => $base . '/site/package.zip'];
    $step = ['op' => 'chmod_except', 'path' => '{ROOT}', 'mode' => '0755', 'recursive' => true,
        'exclude' => ['{ROOT}/uploads']];
    try {
        file_put_contents($manifest, json_encode(['version' => 1, 'steps' => [$step]]));
        $steps = UpgradeManifest::load($manifest, $ctx);
        verifyExclude(UpgradeManifest::is_soft($steps[0]), 'chmod_except must retain chmod warning behavior');
        $GLOBALS['chmodPaths'] = [];
        $report = UpgradeManifest::run_php($steps);
        verifyExclude(!$report['errors'] && !$report['warnings'], 'PHP chmod failed');
        verifyExclude(in_array($base . '/site/other/file', $GLOBALS['chmodPaths'], true), 'Non-excluded file was skipped');
        foreach ($GLOBALS['chmodPaths'] as $path) {
            verifyExclude($path !== $base . '/site/uploads' && strpos($path, $base . '/site/uploads/') !== 0, 'Excluded tree was chmodded');
        }
        if (DIRECTORY_SEPARATOR !== '\\') {
            $GLOBALS['chmodPaths'] = [];
            $report = UpgradeManifest::run_php($steps);
            verifyExclude(!$GLOBALS['chmodPaths'] && !$report['warnings'], 'Matching modes were needlessly changed');
            chmod($base . '/site/other/file', 0644);
            $GLOBALS['chmodPaths'] = [];
            $report = UpgradeManifest::run_php($steps);
            verifyExclude($GLOBALS['chmodPaths'] === [$base . '/site/other/file'] && !$report['warnings'], 'Changed mode was not repaired');
            verifyExclude((fileperms($base . '/site/other/file') & 07777) === 0755, 'File mode was not restored');
        }
        foreach ([
            ['exclude' => [$base . '/outside']],
            ['exclude' => []],
            ['exclude' => ['{ROOT}/../outside']],
            ['exclude' => ['{ROOT}/./uploads']],
            ['recursive' => false],
        ] as $invalid) {
            file_put_contents($manifest, json_encode(['version' => 1, 'steps' => [array_merge($step, $invalid)]]));
            try {
                UpgradeManifest::load($manifest, $ctx);
                throw new \LogicException('Invalid exclusion was accepted');
            } catch (\RuntimeException $expected) {
            }
            foreach (['{ROOT}', '{ROOT}/uploads'] as $excluded) {
                $inside = array_merge($step, ['path' => '{ROOT}/uploads/nested', 'exclude' => [$excluded]]);
                file_put_contents($manifest, json_encode(['version' => 1, 'steps' => [$inside]]));
                $insideSteps = UpgradeManifest::load($manifest, $ctx);
                $GLOBALS['chmodPaths'] = [];
                UpgradeManifest::run_php($insideSteps);
                verifyExclude(!$GLOBALS['chmodPaths'], 'Excluded target was chmodded by PHP');
                verifyExclude(strpos(UpgradeManifest::to_shell($insideSteps), ":\n") !== false || strpos(UpgradeManifest::to_shell($insideSteps), ': ||') !== false, 'Excluded target was not skipped by SSH');
            }
        }
    } finally {
        unlink($manifest);
        unlink($base . '/site/uploads/nested/file');
        unlink($base . '/site/other/file');
        rmdir($base . '/site/uploads/nested');
        rmdir($base . '/site/uploads');
        rmdir($base . '/site/other');
        rmdir($base . '/site');
        rmdir($base);
    }
    echo "PHP chmod exclusion and validation tests passed.\n";
}
