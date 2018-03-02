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

function active_module($mid)
{
    global $xoopsDB;
    $sql = "UPDATE " . $xoopsDB->prefix("modules") . " SET isactive='1' WHERE `mid`='{$mid}'";
    $xoopsDB->queryF($sql) or web_error($sql);
}

function update_allowed($theme, $val)
{
    global $xoopsConfig, $xoopsDB;

    if ($val) {
        list($bootstrap_color, $theme_kind) = get_theme_color($theme);
        $xoopsConfig['theme_set_allowed'][] = $theme;
        $theme_set_allowed                  = serialize($xoopsConfig['theme_set_allowed']);

        $sql = "update " . $xoopsDB->prefix("config") . " set conf_value='{$theme_set_allowed}' where conf_name='theme_set_allowed'";
        $xoopsDB->queryF($sql) or web_error($sql);

        $sql = "INSERT INTO `" . $xoopsDB->prefix("tadtools_setup") . "` (`tt_theme` , `tt_use_bootstrap`,`tt_bootstrap_color`, `tt_theme_kind`) values('{$theme}', '0', '$bootstrap_color' , '$theme_kind') ON DUPLICATE KEY UPDATE `tt_use_bootstrap` = '0', `tt_bootstrap_color`='$bootstrap_color', `tt_theme_kind`='$theme_kind'";

        $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'], 3, $xoopsDB->error());

    } else {
        $array             = array_diff($xoopsConfig['theme_set_allowed'], [$theme]);
        $theme_set_allowed = serialize($array);

        $sql = "update " . $xoopsDB->prefix("config") . " set conf_value='{$theme_set_allowed}' where conf_name='theme_set_allowed'";
        $xoopsDB->queryF($sql) or web_error($sql);

        $sql = "delete from `" . $xoopsDB->prefix("tadtools_setup") . "` where `tt_theme`='$theme'";
        $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'], 3, $xoopsDB->error());

    }

}

function del_theme($theme)
{
    global $xoopsConfig, $xoopsDB, $xoopsTpl;
    $theme_path  = XOOPS_ROOT_PATH . "/themes/{$theme}/";
    $is_writable = is_writable($theme_path);

    if ($is_writable) {
        if (delete_directory($theme_path)) {
            update_allowed($theme, 0);
        }

        header("location: main.php#admTab4");
        exit;
    } else {
        $xoopsTpl->assign('now_op', 'login_form');
        $xoopsTpl->assign('dirname', $theme);
        $xoopsTpl->assign('act', 'delete_theme');
        $xoopsTpl->assign('kind', 'theme');
        $tad_adm_ssh_host = empty($_SESSION['tad_adm_ssh_host']) ? $_SERVER['SERVER_ADDR'] : $_SESSION['tad_adm_ssh_host'];
        $xoopsTpl->assign('tad_adm_ssh_host', $tad_adm_ssh_host);
        $xoopsTpl->assign('tad_adm_ssh_id', $_SESSION['tad_adm_ssh_id']);
        $xoopsTpl->assign('tad_adm_ssh_passwd', $_SESSION['tad_adm_ssh_passwd']);
    }

}

function get_theme_color($dirname)
{
    global $xoopsConfig;
    include XOOPS_ROOT_PATH . "/themes/{$dirname}/config.php";
    return array($theme_color, $theme_kind);
}

function delete_directory($dirname)
{
    if (is_dir($dirname)) {
        $dir_handle = opendir($dirname);
    }

    if (!$dir_handle) {
        return false;
    }

    while ($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname . "/" . $file)) {
                unlink($dirname . "/" . $file);
            } else {
                delete_directory($dirname . '/' . $file);
            }
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    return true;
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
        to_do('install', $file_link, $dirname, "install_module", $update_sn);
        break;

    case "install_theme":
        to_do('install', $file_link, $dirname, "install_theme", $update_sn);
        break;

    case "install_adm_tpl":
        to_do('install', $file_link, $dirname, "install_adm_tpl", $update_sn);
        break;

    case "update_module":
        to_do('update', $file_link, $dirname, "update_module", $update_sn);
        break;

    case "update_theme":
        to_do('update', $file_link, $dirname, "update_theme", $update_sn);
        break;

    case "update_adm_tpl":
        to_do('update', $file_link, $dirname, "update_adm_tpl", $update_sn);
        break;

    case "active":
        active_module($mid);
        header("location: main.php");
        exit;

    case "update_allowed":
        update_allowed($theme, $val);
        header("location: main.php#admTab4");
        exit;

    case "del_theme":
        del_theme($theme);
        break;

    default:
        list_modules();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/bootstrap3/css/bootstrap.css');
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/xoops_adm3.css');
include_once 'footer.php';
