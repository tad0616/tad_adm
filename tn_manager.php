<?php
// 此檔案為南市資訊中心用來替所有網站進行模組自動更新用檔案，請勿刪除或變更

require __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'tad_adm_tn_manager.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

function tn_module_update($dirname)
{
    require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
    require_once XOOPS_ROOT_PATH . '/modules/system/admin/modulesadmin/modulesadmin.php';
    xoops_module_update($dirname);
}

require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$tx_sn = system_CleanVars($_REQUEST, 'tx_sn', '', 'int');
$dirname = system_CleanVars($_REQUEST, 'dirname', '', 'string');
$mode = system_CleanVars($_REQUEST, 'mode', '', 'string');

switch ($op) {
    //更新模組
    case 'tn_module_update':
        tn_module_update($dirname);
        echo "{$dirname} 更新完成";
}

require_once XOOPS_ROOT_PATH . '/footer.php';
