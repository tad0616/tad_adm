<?php

use XoopsModules\Tad_adm\UpgradeRequest;
use XoopsModules\Tad_adm\UpgradeProgress;

require dirname(__DIR__) . '/class/UpgradeRequest.php';
require dirname(__DIR__) . '/class/UpgradeProgress.php';

function checkUpgradeDebug($condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

$xoopsConfig = ['debug_mode' => 3];
$xoopsLogger = (object) ['activated' => true];
$xoopsTpl = (object) ['debugging' => true, 'debugging_ctrl' => 'URL'];
$reporting = error_reporting();
UpgradeRequest::afterBootstrap();
checkUpgradeDebug($xoopsConfig['debug_mode'] === 0 && !$xoopsLogger->activated, 'XOOPS debug was not disabled for the request');
checkUpgradeDebug(!$xoopsTpl->debugging && $xoopsTpl->debugging_ctrl === 'NONE', 'Smarty debugging was not disabled');
checkUpgradeDebug(error_reporting() === $reporting && ini_get('log_errors'), 'Error reporting or logging was disabled');

$base = sys_get_temp_dir() . '/tad_adm_debug_' . bin2hex(random_bytes(8));
$module = $base . '/modules/tad_adm';
mkdir($module . '/admin', 0755, true);
mkdir($module . '/class', 0755, true);
mkdir($module . '/preloads', 0755, true);
copy(dirname(__DIR__) . '/admin/upgrade_progress.php', $module . '/admin/upgrade_progress.php');
copy(dirname(__DIR__) . '/class/UpgradeRequest.php', $module . '/class/UpgradeRequest.php');
copy(dirname(__DIR__) . '/class/UpgradeProgress.php', $module . '/class/UpgradeProgress.php');
file_put_contents($module . '/preloads/autoloader.php', "<?php require_once __DIR__ . '/../class/UpgradeProgress.php';");
file_put_contents($base . '/mainfile.php', <<<'PHP'
<?php
ini_set('session.save_path', getenv('TEST_SESSION_DIR'));
session_id(getenv('TEST_SESSION_ID'));
session_start();
$_GET['token'] = getenv('TEST_TOKEN');
$xoopsConfig = ['debug_mode' => (int) getenv('TEST_DEBUG_MODE')];
$xoopsLogger = new class {
    public $activated = true;
    public function render($output) { return $output . ($this->activated ? '<debug>' : ''); }
};
ob_start([$xoopsLogger, 'render']);
$xoopsUser = new class {
    public function isAdmin() { return getenv('TEST_ADMIN') === 'yes'; }
};
if (getenv('TEST_NOISE') === 'yes') {
    echo '<unexpected bootstrap output>';
}
if (getenv('TEST_NOISE') === 'exit') {
    exit;
}
PHP
);
file_put_contents($base . '/runner.php', <<<'PHP'
<?php
ob_start(static function ($output) {
    file_put_contents(getenv('TEST_STATUS_FILE'), (string) (http_response_code() ?: 200));
    return $output;
});
require __DIR__ . '/modules/tad_adm/admin/upgrade_progress.php';
PHP
);
$statusFile = $base . '/status';
$sessionId = bin2hex(random_bytes(16));
$token = bin2hex(random_bytes(16));
$progressFile = UpgradeProgress::path($token, $sessionId);
file_put_contents($progressFile, json_encode(['message' => 'Copying to: /target']));
putenv("TEST_SESSION_ID=$sessionId");
putenv("TEST_TOKEN=$token");
putenv("TEST_SESSION_DIR=$base");
try {
    foreach ([[1, 'yes', 'no', 200], [2, 'yes', 'no', 200], [3, 'yes', 'no', 200], [1, 'no', 'no', 403], [1, 'yes', 'yes', 500], [1, 'yes', 'exit', 500]] as [$mode, $admin, $noise, $expected]) {
        putenv("TEST_DEBUG_MODE=$mode");
        putenv("TEST_ADMIN=$admin");
        putenv("TEST_NOISE=$noise");
        putenv("TEST_STATUS_FILE=$statusFile");
        $process = proc_open([PHP_BINARY, $base . '/runner.php'], [1 => ['pipe', 'w'], 2 => ['pipe', 'w']], $pipes);
        checkUpgradeDebug(is_resource($process), 'Could not start progress endpoint test');
        $output = stream_get_contents($pipes[1]);
        $errors = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        checkUpgradeDebug(proc_close($process) === 0, 'Progress endpoint failed: ' . $errors);
        checkUpgradeDebug((int) file_get_contents($statusFile) === $expected, "Wrong progress HTTP status for debug mode $mode, admin $admin, noise $noise");
        $data = json_decode($output);
        checkUpgradeDebug(is_object($data) && json_last_error() === JSON_ERROR_NONE, 'Progress response was not clean JSON');
        checkUpgradeDebug($expected !== 200 || (isset($data->max_execution_time) && is_int($data->max_execution_time) && $data->max_execution_time >= 0), 'PHP execution time limit was not reported');
        checkUpgradeDebug($expected !== 200 || ($data->message ?? '') === 'Copying to: /target', 'Progress message was lost');
        checkUpgradeDebug($expected !== 500 || ($data->error ?? '') === 'progress_unavailable', 'Unexpected output was not reported as an error');
    }
} finally {
    if (is_file($progressFile)) {
        unlink($progressFile);
    }
    foreach ([$module . '/admin/upgrade_progress.php', $module . '/class/UpgradeRequest.php', $module . '/class/UpgradeProgress.php', $module . '/preloads/autoloader.php', $base . '/mainfile.php', $base . '/runner.php', $base . '/sess_' . $sessionId, $statusFile] as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    foreach ([$module . '/admin', $module . '/class', $module . '/preloads', $module, $base . '/modules', $base] as $dir) {
        rmdir($dir);
    }
}

echo "Upgrade debug suppression and progress JSON tests passed.\n";
