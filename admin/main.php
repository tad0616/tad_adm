<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_adm_adm_main.tpl";
include_once "header.php";
include_once "../function.php";
require "adm_function.php";

/*-----------function區--------------*/

if (file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/FooTable.php")) {
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/FooTable.php";

    $FooTable = new FooTable();
    $FooTable->render();
}

if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php")) {
    redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
}
include_once XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php";
$fancybox = new fancybox('.modulesadmin', '640', '480');
$fancybox->render(true);

$fancybox2 = new fancybox('.readme', '640', '480');
$fancybox2->render(false);

function active_module($mid)
{
    global $xoopsDB;
    $sql = "UPDATE " . $xoopsDB->prefix("modules") . " SET isactive='1' WHERE `mid`='{$mid}'";
    $xoopsDB->queryF($sql) or web_error($sql);
}

function get_theme_color($dirname)
{
    global $xoopsConfig;
    include XOOPS_ROOT_PATH . "/themes/{$dirname}/config.php";
    return array($theme_color, $theme_kind);
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op         = system_CleanVars($_REQUEST, 'op', '', 'string');
$update_sn  = system_CleanVars($_REQUEST, 'update_sn', 0, 'int');
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

    case "ssh_login":
        ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link, $dirname, $act, $update_sn);
        break;

    case "install_module":
        to_do($file_link, $dirname, "install_module", $update_sn);
        break;

    case "update_module":
        to_do($file_link, $dirname, "update_module", $update_sn);
        break;

    case "install_theme":
        to_do($file_link, $dirname, "install_theme", $update_sn);
        break;

    case "update_theme":
        to_do($file_link, $dirname, "update_theme", $update_sn);
        break;

    case "delete_theme":
        to_do('', $dirname, "delete_theme");
        break;

    case "install_adm_tpl":
        to_do($file_link, $dirname, "install_adm_tpl", $update_sn);
        break;

    case "update_adm_tpl":
        to_do($file_link, $dirname, "update_adm_tpl", $update_sn);
        break;

    case "install_block":
        do_block('install', $update_sn);
        header("location: main.php#admTab6");
        exit;

    case "update_block":
        do_block('update', $update_sn);
        header("location: main.php#admTab6");
        exit;

    case "active":
        active_module($mid);
        header("location: main.php");
        exit;

    case "update_allowed":
        update_allowed($theme, $val);
        header("location: main.php#admTab4");
        exit;

    default:
        list_modules();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/bootstrap3/css/bootstrap.css');
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/xoops_adm3.css');
include_once 'footer.php';
