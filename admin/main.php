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

switch ($op) {
    /*---判斷動作請貼在下方---*/

    case "ssh_login":
        ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link, $dirname, $act, $update_sn, $kind);
        break;

    case "install":
        install_module($file_link, $dirname, "install", $update_sn, $kind);
        break;

    case "update":
        install_module($file_link, $dirname, "update", $update_sn, $kind);
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
