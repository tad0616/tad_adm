<?php

namespace XoopsModules\Tad_adm {
    const DIRECTORY_SEPARATOR = '/';

    function fileperms($path)
    {
        return $GLOBALS['testModes'][$path];
    }

    function chmod($path, $mode)
    {
        $GLOBALS['chmodCalls'][] = [$path, $mode];
        return $path !== $GLOBALS['failedPath'];
    }
}

namespace {
    use XoopsModules\Tad_adm\UpgradeManifest;

    require dirname(__DIR__) . '/class/UpgradeManifest.php';

    function checkChmodPhp($condition, string $message): void
    {
        if (!$condition) {
            throw new \RuntimeException($message);
        }
    }

    $base = str_replace('\\', '/', sys_get_temp_dir()) . '/tad_adm_chmod_' . bin2hex(random_bytes(8));
    mkdir($base);
    $same = $base . '/same';
    $different = $base . '/different';
    $unknown = $base . '/unknown';
    $failed = $base . '/failed';
    foreach ([$same, $different, $unknown, $failed] as $path) {
        file_put_contents($path, '');
    }
    $GLOBALS['testModes'] = [
        $base => 0040755,
        $same => 0100755,
        $different => 0100644,
        $unknown => false,
        $failed => 0100644,
    ];
    $GLOBALS['failedPath'] = $failed;
    $GLOBALS['chmodCalls'] = [];
    try {
        $report = UpgradeManifest::run_php([[
            'n' => 1, 'op' => 'chmod', 'optional' => false, 'path' => $base,
            'file' => 0755, 'dir' => 0755, 'recursive' => true,
        ]]);
        $called = array_column($GLOBALS['chmodCalls'], 0);
        sort($called);
        $expected = [$different, $failed, $unknown];
        sort($expected);
        checkChmodPhp($called === $expected, 'Matching modes were changed or required chmod was skipped');
        checkChmodPhp(!$report['errors'] && $report['warnings'] === [[1, 'chmod', 1, $failed]], 'chmod failure was not reported');
    } finally {
        foreach ([$same, $different, $unknown, $failed] as $path) {
            unlink($path);
        }
        rmdir($base);
    }
    echo "PHP chmod matching, unknown mode and failure tests passed.\n";
}
