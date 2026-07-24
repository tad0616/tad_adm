<?php

use Xmf\Request;
// 此檔案有重要用途，請勿刪除或變更

defined('TN_MANAGER_SHARED_SECRET') || define('TN_MANAGER_SHARED_SECRET', 'tn-module-manager-20260724');

require_once dirname(dirname(__DIR__)) . '/mainfile.php';

$allowed_ips = [
    '120.115.2.88',
    '120.115.2.89',
    '120.115.2.84',
    '120.115.2.85',
    '2001:288:7201:2::88',
    '2001:288:7201:2::89',
    '2001:288:7201:2::84',
    '2001:288:7201:2::85',
];

$remote_addr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
if (!in_array($remote_addr, $allowed_ips, true)) {
    header('HTTP/1.0 403 Forbidden');
    echo "{$remote_addr} Access denied";
    exit;
}

$request_method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
if ($request_method !== 'POST') {
    header('HTTP/1.0 405 Method Not Allowed');
    echo 'Method Not Allowed';
    exit;
}

$token = isset($_POST['token']) ? trim($_POST['token']) : '';
if (!hash_equals(TN_MANAGER_SHARED_SECRET, $token)) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Invalid token';
    exit;
}

$op      = isset($_POST['op']) ? trim($_POST['op']) : '';
$dirname = isset($_POST['dirname']) ? trim($_POST['dirname']) : '';
$mode    = isset($_POST['mode']) ? trim($_POST['mode']) : '';

$allowed_ops = ['tn_module_update'];
if (!in_array($op, $allowed_ops, true)) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Invalid operation';
    exit;
}

if (!preg_match('/^[a-z0-9_]+$/', $dirname)) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Invalid dirname';
    exit;
}

$module_path = XOOPS_ROOT_PATH . "/modules/{$dirname}";
if (!is_dir($module_path) || !file_exists($module_path . '/xoops_version.php')) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Invalid module';
    exit;
}

xoops_loadLanguage('admin', 'system');
xoops_loadLanguage('admin/modulesadmin', 'system');

switch ($op) {
    //升級模組
    case 'tn_module_update':
        $msg = tn_module_update($dirname);
        die("{$dirname} 升級結果：{$msg}");
}

function tn_module_update($dirname)
{
    require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
    require_once XOOPS_ROOT_PATH . '/class/template.php';
    require_once XOOPS_ROOT_PATH . '/modules/system/admin/modulesadmin/modulesadmin.php';

    global $xoopsConfig;

    // 確保 XOOPS 版本號存在，這會影響一些模組的 xoops_version.php 判斷
    if (!isset($_SESSION['xoops_version'])) {
        include_once XOOPS_ROOT_PATH . '/include/version.php';
        $ver                       = str_replace('XOOPS ', '', XOOPS_VERSION);
        $v                         = explode('.', $ver);
        $_SESSION['xoops_version'] = (int) $v[0] * 10000 + (int) $v[1] * 100 + (int) $v[2];
    }

    // 在執行升級前，先載入該模組的語言檔，以免 xoops_version.php 中的常數無法解析
    if (file_exists(XOOPS_ROOT_PATH . "/modules/{$dirname}/language/{$xoopsConfig['language']}/modinfo.php")) {
        include_once XOOPS_ROOT_PATH . "/modules/{$dirname}/language/{$xoopsConfig['language']}/modinfo.php";
    } elseif (file_exists(XOOPS_ROOT_PATH . "/modules/{$dirname}/language/english/modinfo.php")) {
        include_once XOOPS_ROOT_PATH . "/modules/{$dirname}/language/english/modinfo.php";
    }

    // 執行系統內建的模組升級函數
    $msg = xoops_module_update($dirname);

    // 升級後的清理與啟動步驟，參考 modules\system\admin\modulesadmin\main.php
    xoops_setActiveModules();
    xoops_module_delayed_clean_cache();

    // 清除控制面板快取
    xoops_load('cpanel', 'system');
    if (class_exists('XoopsSystemCpanel')) {
        XoopsSystemCpanel::flush();
    }

    return $msg;
}
