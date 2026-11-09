<?php

use XoopsModules\Tad_adm\UpgradeRequest;

require_once dirname(__DIR__) . '/class/UpgradeRequest.php';
UpgradeRequest::beforeBootstrap();
$progressResponse = null;
$unexpectedOutput = false;
ob_start(static function ($output) use (&$progressResponse, &$unexpectedOutput) {
    if ($unexpectedOutput || trim($output) !== '' || null === $progressResponse) {
        error_log('[tad_adm] Upgrade progress response failed or contained unexpected output');
        if (!headers_sent()) {
            http_response_code(500);
            if (!ini_get('zlib.output_compression')) {
                header_remove('Content-Encoding');
                header_remove('Content-Length');
            }
        }
        return '{"error":"progress_unavailable"}';
    }
    return $progressResponse;
});
$progressBufferLevel = ob_get_level();
require dirname(__DIR__, 3) . '/mainfile.php';
UpgradeRequest::afterBootstrap();
require dirname(__DIR__) . '/preloads/autoloader.php';

while (ob_get_level() > $progressBufferLevel) {
    $bufferedOutput = ob_get_clean();
    if (false === $bufferedOutput) {
        error_log('[tad_adm] Unable to close upgrade progress output buffer');
        $unexpectedOutput = true;
        break;
    }
    if (trim($bufferedOutput) !== '') {
        $unexpectedOutput = true;
    }
}

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
if (!isset($xoopsUser) || !is_object($xoopsUser) || !$xoopsUser->isAdmin()) {
    http_response_code(403);
    $progressResponse = '{}';
    exit;
}

$token = isset($_GET['token']) && is_string($_GET['token']) ? $_GET['token'] : '';
$path = \XoopsModules\Tad_adm\UpgradeProgress::path($token, session_id());
if (session_status() === PHP_SESSION_ACTIVE) {
    session_write_close();
}
$progressData = $path ? (\XoopsModules\Tad_adm\UpgradeProgress::read($path) ?? []) : [];
$maxExecutionTime = ini_get('max_execution_time');
if (false !== $maxExecutionTime) {
    $progressData['max_execution_time'] = (int) $maxExecutionTime;
}
$progressResponse = json_encode($progressData, JSON_INVALID_UTF8_SUBSTITUTE);
if (false === $progressResponse) {
    error_log('[tad_adm] Unable to encode upgrade progress response');
    http_response_code(500);
    $progressResponse = '{"error":"progress_unavailable"}';
}
