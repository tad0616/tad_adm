<?php

use XoopsModules\Tad_adm\UpgradeManifest;
use XoopsModules\Tad_adm\UpgradeProgress;

require dirname(__DIR__) . '/class/UpgradeProgress.php';
require dirname(__DIR__) . '/class/UpgradeManifest.php';

function checkProgress($condition, string $message): void
{
    if (!$condition) {
        throw new RuntimeException($message);
    }
}

$token = bin2hex(random_bytes(16));
session_id(bin2hex(random_bytes(16)));
session_start();
$sessionId = session_id();
$path = UpgradeProgress::path($token, $sessionId);
checkProgress(null !== $path, 'Valid token rejected');
checkProgress(null === UpgradeProgress::path('../invalid', $sessionId), 'Invalid token accepted');
checkProgress($path !== UpgradeProgress::path($token, $sessionId . 'other'), 'Sessions share progress files');
UpgradeProgress::start($token);
checkProgress(session_status() !== PHP_SESSION_ACTIVE, 'Session remains locked during upgrade');
UpgradeProgress::update('Downloading: package.zip');
checkProgress(UpgradeProgress::read($path)['message'] === 'Downloading: package.zip', 'Download status not recorded');
UpgradeProgress::update('Copying to: /site/modules');
checkProgress(UpgradeProgress::read($path)['message'] === 'Copying to: /site/modules', 'Copy destination not recorded');
checkProgress(UpgradeProgress::resumeSession(), 'Session could not be restored');
checkProgress(session_status() === PHP_SESSION_ACTIVE, 'Session not active before redirect');
$_SESSION['redirect_message'] = 'Upgrade ready';
session_write_close();
session_start();
checkProgress($_SESSION['redirect_message'] === 'Upgrade ready', 'Redirect message was not persisted');
session_write_close();

$steps = [
    ['n' => 1, 'op' => 'mkdir', 'optional' => false, 'path' => sys_get_temp_dir()],
    ['n' => 2, 'op' => 'copy', 'optional' => false, 'kind' => 'file', 'from' => __FILE__, 'to' => __FILE__ . '/target'],
];
$seen = [];
$report = UpgradeManifest::run_php($steps, static function (array $step) use (&$seen): void {
    $seen[] = $step['n'];
});
checkProgress($seen === [1, 2], 'PHP step callbacks not delivered');
checkProgress(!empty($report['errors']), 'Copy failure not reported');
$shell = UpgradeManifest::to_shell($steps, true);
checkProgress(strpos($shell, "printf 'TAD_ADM_PROGRESS %d\\n' 1") !== false, 'SSH step 1 marker missing');
checkProgress(strpos($shell, "printf 'TAD_ADM_PROGRESS %d\\n' 2") !== false, 'SSH copy marker missing');
checkProgress(strpos(UpgradeManifest::to_shell($steps), 'TAD_ADM_PROGRESS') === false, 'Default scripts unexpectedly include progress');

echo "Progress isolation, session release and PHP/SSH step callbacks passed.\n";
