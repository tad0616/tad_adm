<?php
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tad_adm\OnlineUpgrade;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_adm_adm_main.tpl';
require_once __DIR__ . '/header.php';
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}
require_once dirname(__DIR__) . '/function.php';
require __DIR__ . '/adm_function.php';
/*-----------function區--------------*/

function active_module($mid)
{
    global $xoopsDB;
    $sql = 'UPDATE ' . $xoopsDB->prefix('modules') . " SET isactive='1' WHERE `mid`='{$mid}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

function get_theme_color($dirname)
{
    global $xoopsConfig;
    require XOOPS_ROOT_PATH . "/themes/{$dirname}/config.php";

    return [$theme_color, $theme_kind];
}

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$update_sn = system_CleanVars($_REQUEST, 'update_sn', 0, 'int');
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
    case 'install_module':
        to_do($file_link, $dirname, 'install_module', $update_sn);
        break;
    case 'upgrade_module':
        to_do($file_link, $dirname, 'upgrade_module', $update_sn);
        break;
    case 'install_theme':
        to_do($file_link, $dirname, 'install_theme', $update_sn);
        break;
    case 'upgrade_theme':
        to_do($file_link, $dirname, 'upgrade_theme', $update_sn);
        break;
    case 'delete_theme':
        to_do('', $dirname, 'delete_theme');
        break;
    case 'install_adm_tpl':
        to_do($file_link, $dirname, 'install_adm_tpl', $update_sn);
        break;
    case 'upgrade_adm_tpl':
        to_do($file_link, $dirname, 'upgrade_adm_tpl', $update_sn);
        break;
    case 'install_block':
        do_block('install', $update_sn);
        header('location: main.php');
        exit;

    case 'upgrade_block':
        do_block('update', $update_sn);
        header('location: main.php');
        exit;

    case 'active':
        active_module($mid);
        header('location: main.php');
        exit;

    case 'update_allowed':
        update_allowed($theme, $val);
        header('location: main.php');
        exit;

    default:
        OnlineUpgrade::list_modules();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tad_adm/css/module.css');
require_once __DIR__ . '/footer.php';
