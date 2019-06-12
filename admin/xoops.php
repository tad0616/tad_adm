<?php

use XoopsModules\Tad_adm\OnlineUpgrade;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_adm_adm_xoops.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';
require __DIR__ . '/adm_function.php';

/*-----------function區--------------*/

//安裝套件
function to_up($file_link = '', $act = 'patch', $xoops_sn = '')
{
    global $xoopsTpl, $xoopsModuleConfig;

    if (empty($file_link)) {
        header("location:{$_SERVER['PHP_SELF']}");
        exit;
    }

    $is_writable = is_writable(XOOPS_ROOT_PATH);

    //若是可以寫入
    if ($is_writable) {
        next_to_up($file_link, $xoops_sn, $act);
    } else {
        $xoopsTpl->assign('action', 'xoops.php');
        $xoopsTpl->assign('now_op', 'login_form');
        $xoopsTpl->assign('dirname', '');
        $xoopsTpl->assign('act', $act);
        $xoopsTpl->assign('xoops_sn', $xoops_sn);
        $xoopsTpl->assign('file_link', $file_link);
        $tad_adm_ssh_host = empty($_SESSION['tad_adm_ssh_host']) ? $_SERVER['SERVER_ADDR'] : $_SESSION['tad_adm_ssh_host'];
        $xoopsTpl->assign('tad_adm_ssh_host', $tad_adm_ssh_host);
        $xoopsTpl->assign('tad_adm_ssh_id', $_SESSION['tad_adm_ssh_id']);
        $xoopsTpl->assign('tad_adm_ssh_passwd', $_SESSION['tad_adm_ssh_passwd']);
    }
}

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$xoops_sn = system_CleanVars($_REQUEST, 'xoops_sn', 0, 'int');
$file_link = system_CleanVars($_REQUEST, 'file_link', '', 'string');
$dirname = system_CleanVars($_REQUEST, 'dirname', '', 'string');
$act = system_CleanVars($_REQUEST, 'act', '', 'string');
$kind_dir = system_CleanVars($_REQUEST, 'kind_dir', '', 'string');
$ssh_id = system_CleanVars($_REQUEST, 'ssh_id', '', 'string');
$ssh_passwd = system_CleanVars($_REQUEST, 'ssh_passwd', '', 'string');
$ssh_host = system_CleanVars($_REQUEST, 'ssh_host', '', 'string');
$kind = system_CleanVars($_REQUEST, 'kind', '', 'string');
$mid = system_CleanVars($_REQUEST, 'mid', 0, 'int');
$val = system_CleanVars($_REQUEST, 'val', 0, 'int');
$theme = system_CleanVars($_REQUEST, 'theme', '', 'string');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    case 'ssh_login':
        ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link, $dirname, $act, $update_sn, $xoops_sn);
        break;
    case 'patch_xoops':
        to_up($file_link, 'patch', $xoops_sn);
        break;
    case 'upgrade_xoops':
        to_up($file_link, 'upgrade', $xoops_sn);
        break;
    default:
        OnlineUpgrade::list_xoops();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tad_adm/css/module.css');
require_once __DIR__ . '/footer.php';
