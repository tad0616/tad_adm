<?php

use XoopsModules\Tad_adm\OnlineUpgrade;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_adm_adm_xoops.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------function區--------------*/


/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op         = system_CleanVars($_REQUEST, 'op', '', 'string');
$xoops_sn   = system_CleanVars($_REQUEST, 'xoops_sn', 0, 'int');
$file_link  = system_CleanVars($_REQUEST, 'file_link', '', 'string');
$dirname    = system_CleanVars($_REQUEST, 'dirname', '', 'string');
$act        = system_CleanVars($_REQUEST, 'act', '', 'string');
$kind_dir   = system_CleanVars($_REQUEST, 'kind_dir', '', 'string');
$ssh_id     = system_CleanVars($_REQUEST, 'ssh_id', '', 'string');
$ssh_passwd = system_CleanVars($_REQUEST, 'ssh_passwd', '', 'string');
$ssh_host   = system_CleanVars($_REQUEST, 'ssh_host', '', 'string');
$kind       = system_CleanVars($_REQUEST, 'kind', '', 'string');
$mid        = system_CleanVars($_REQUEST, 'mid', 0, 'int');
$val        = system_CleanVars($_REQUEST, 'val', 0, 'int');
$theme      = system_CleanVars($_REQUEST, 'theme', '', 'string');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    case 'ssh_login':
        OnlineUpgrade::ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link, $dirname, $act, $update_sn, $xoops_sn);
        break;
    case 'patch_xoops':
        OnlineUpgrade::to_up($file_link, 'patch', $xoops_sn);
        break;
    case 'upgrade_xoops':
        OnlineUpgrade::to_up($file_link, 'upgrade', $xoops_sn);
        break;
    default:
        OnlineUpgrade::list_xoops();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tad_adm/css/module.css');
require_once __DIR__ . '/footer.php';
