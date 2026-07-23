<?php

use Xmf\Request;
// 此檔案有重要用途，請勿刪除或變更

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

if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
    header('HTTP/1.0 403 Forbidden');
    echo "{$_SERVER['REMOTE_ADDR']} Access denied";
    exit;
}

// 檢查 Referer 是否在允許的列表中
$op      = Request::getString('op');
$dirname = Request::getString('dirname');
$mode    = Request::getString('mode');

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
        $ver = str_replace('XOOPS ', '', XOOPS_VERSION);
        $v = explode('.', $ver);
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
