<?php

require dirname(__DIR__, 3) . '/mainfile.php';
require dirname(__DIR__) . '/preloads/autoloader.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
if (!isset($xoopsUser) || !is_object($xoopsUser) || !$xoopsUser->isAdmin()) {
    http_response_code(403);
    echo '{}';
    exit;
}

$token = isset($_GET['token']) && is_string($_GET['token']) ? $_GET['token'] : '';
$path = \XoopsModules\Tad_adm\UpgradeProgress::path($token, session_id());
if (session_status() === PHP_SESSION_ACTIVE) {
    session_write_close();
}
echo json_encode($path ? (\XoopsModules\Tad_adm\UpgradeProgress::read($path) ?? new \stdClass()) : new \stdClass(), JSON_INVALID_UTF8_SUBSTITUTE);
