<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tad_adm\OnlineUpgrade;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_adm_adm_main.tpl';
require_once __DIR__ . '/header.php';
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}
require_once dirname(__DIR__) . '/function.php';
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
$op = Request::getString('op');
$update_sn = Request::getInt('update_sn');
$module_sn = Request::getInt('module_sn');
$xoops_sn = Request::getInt('xoops_sn');
$file_link = Request::getString('file_link');
$dirname = Request::getString('dirname');
$act = Request::getString('act');
$kind_dir = Request::getString('kind_dir');
$ssh_id = Request::getString('ssh_id');
$ssh_passwd = Request::getString('ssh_passwd');
$ssh_host = Request::getString('ssh_host');
$kind = Request::getString('kind');
$mid = Request::getInt('mid');
$val = Request::getInt('val');
$theme = Request::getString('theme');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    case 'ssh_login':
        OnlineUpgrade::ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link, $dirname, $act, $update_sn, $xoops_sn);
        break;
    case 'install_module':
        OnlineUpgrade::to_do($file_link, $dirname, 'install_module', $update_sn);
        break;
    case 'upgrade_module':
        OnlineUpgrade::to_do($file_link, $dirname, 'upgrade_module', $update_sn);
        break;
    case 'install_theme':
        OnlineUpgrade::to_do($file_link, $dirname, 'install_theme', $update_sn);
        break;
    case 'upgrade_theme':
        OnlineUpgrade::to_do($file_link, $dirname, 'upgrade_theme', $update_sn);
        break;
    case 'delete_theme':
        OnlineUpgrade::to_do('', $dirname, 'delete_theme');
        break;
    case 'install_adm_tpl':
        OnlineUpgrade::to_do($file_link, $dirname, 'install_adm_tpl', $update_sn);
        break;
    case 'upgrade_adm_tpl':
        OnlineUpgrade::to_do($file_link, $dirname, 'upgrade_adm_tpl', $update_sn);
        break;
    case 'install_other':
        OnlineUpgrade::do_other($file_link, $update_sn, $module_sn);
        header('location: main.php');
        exit;
    case 'upgrade_other':
        OnlineUpgrade::do_other($file_link, $update_sn, $module_sn);
        header('location: main.php');
        exit;
    case 'install_block':
        OnlineUpgrade::do_block('install', $update_sn);
        header('location: main.php');
        exit;
    case 'upgrade_block':
        OnlineUpgrade::do_block('update', $update_sn);
        header('location: main.php');
        exit;
    case 'active':
        active_module($mid);
        header('location: main.php');
        exit;

    case 'update_allowed':
        OnlineUpgrade::update_allowed($theme, $val);
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
