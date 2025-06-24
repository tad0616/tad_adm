<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;
// 此檔案為南市資訊中心用來替所有網站進行模組自動升級用檔案，請勿刪除或變更

// require __DIR__ . '/header.php';
// $xoopsOption['template_main'] = 'tad_adm_tn_manager.tpl';
// require_once XOOPS_ROOT_PATH . '/header.php';
require_once dirname(dirname(__DIR__)) . '/mainfile.php';
// $allowed_referers = [
//     'https://schoolweb.tn.edu.tw/modules/tn_xoops/admin/main.php',
//     'https://schoolweb2.tn.edu.tw/modules/tn_xoops/admin/main.php',
//     'https://schoolweb3.tn.edu.tw/modules/tn_xoops/admin/main.php',
//     'https://schoolweb4.tn.edu.tw/modules/tn_xoops/admin/main.php',
// ];

// if (in_array($_SERVER['HTTP_REFERER'] ?? '', $allowed_referers, true)) {
$op      = Request::getString('op');
$tx_sn   = Request::getInt('tx_sn');
$dirname = Request::getString('dirname');
$mode    = Request::getString('mode');

xoops_loadLanguage('admin', 'system');
xoops_loadLanguage('admin/modulesadmin', 'system');

switch ($op) {
    //升級模組
    case 'tn_module_update':
        $msg = tn_module_update($dirname);
        die("{$dirname} 升級完成");

        //反安裝模組
//     case 'tn_module_uninstall':
//         $msg = tn_module_uninstall($dirname);
//         die("{$dirname} 反安裝完成");
// }
}
// require_once XOOPS_ROOT_PATH . '/footer.php';

function tn_module_update($dirname)
{
    require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
    require_once XOOPS_ROOT_PATH . '/class/template.php';
    require_once XOOPS_ROOT_PATH . '/modules/system/admin/modulesadmin/modulesadmin.php';

    $msg = xoops_module_update($dirname);
    return $msg;
}

// function tn_module_uninstall($dirname)
// {
//     require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
//     require_once XOOPS_ROOT_PATH . '/class/template.php';
//     require_once XOOPS_ROOT_PATH . '/modules/system/admin/modulesadmin/modulesadmin.php';
//     $msg = xoops_module_uninstall($dirname);
//     return $msg;
// }
