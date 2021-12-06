<?php
use Xmf\Request;
// 此檔案為南市資訊中心用來替所有網站進行模組自動升級用檔案，請勿刪除或變更

require __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'tad_adm_xc_manager.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

function xc_module_update($dirname)
{
    require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
    require_once XOOPS_ROOT_PATH . '/modules/system/admin/modulesadmin/modulesadmin.php';
    xoops_module_update($dirname);
}

$op = Request::getString('op');
$tx_sn = Request::getInt('tx_sn');
$dirname = Request::getString('dirname');
$mode = Request::getString('mode');

switch ($op) {
    //升級模組
    case 'xc_module_update':
        xc_module_update($dirname);
        echo "{$dirname} 升級完成";
}

require_once XOOPS_ROOT_PATH . '/footer.php';
