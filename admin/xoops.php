<?php
/*-----------引入檔案區--------------*/
$GLOBALS['xoopsOption']['template_main'] = 'tad_adm_adm_xoops.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';
require __DIR__ . '/adm_function.php';

/*-----------function區--------------*/

if (file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/FooTable.php')) {
    require_once XOOPS_ROOT_PATH . '/modules/tadtools/FooTable.php';

    $FooTable = new FooTable();
    $FooTable->render();
}

if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/fancybox.php')) {
    redirect_header('index.php', 3, _TAD_NEED_TADTOOLS);
}
require_once XOOPS_ROOT_PATH . '/modules/tadtools/fancybox.php';
$fancybox = new fancybox('.modulesadmin', '640', '480');
$fancybox->render(true);

$fancybox2 = new fancybox('.readme', '640', '480');
$fancybox2->render(false);

//列出所有XOOPS升級資訊
function list_xoops($mode = 'tpl')
{
    global $xoopsDB, $xoopsModuleConfig, $xoopsTpl, $xoopsConfig;
    //取得更新訊息
    $xoops_patch = get_tad_json_info('xoops.json');

    // die(var_dump($mod));
    // $xoops_patch[1]["xoops_sn"]          = "6";
    // $xoops_patch[1]["xoops_title"]       = "BootStrap4升級";
    // $xoops_patch[1]["xoops_version"]     = "2.59";
    // $xoops_patch[1]["xoops_status"]      = "Release";
    // $xoops_patch[1]["xoops_type"]        = "patch";
    // $xoops_patch[1]["php_min_version"]   = "5.37";
    // $xoops_patch[1]["php_max_version"]   = "0";
    // $xoops_patch[1]["xoops_min_version"] = "2.59";
    // $xoops_patch[1]["xoops_install"]     = "Patch檔無法單獨安裝，僅供升級使用。";
    // $xoops_patch[1]["xoops_update"]      = "請完整備份檔案及資料庫內容。";
    // $xoops_patch[1]["xoops_date"]  = 1546316860;
    // $xoops_patch[1]["xoops_count"] = "0";
    // $xoops_patch[1]["file_link"]   = "https://campus-xoops.tn.edu.tw/uploads/tad_modules/file/bs4_upgrade.zip";

    //抓出現有XOOPS版本
    $my_xoops_version = sprintf('%0-4s',
                                str_replace('.', '',
                                            trim(str_replace('XOOPS', '', XOOPS_VERSION)))) / 1000;
    $currentVer = mb_substr(XOOPS_VERSION, 6);
    $my_php_version = (float) phpversion();

    //後台部份
    $all_patch = $all_upgrade = [];
    foreach ($xoops_patch as $k => $xoops) {
        $xoops_version = (float) $xoops['xoops_version'];
        $xoops_min_version = (float) $xoops['xoops_min_version'];
        $php_min_version = (float) $xoops['php_min_version'];
        $php_max_version = (float) $xoops['php_max_version'];

        if (!empty($xoops['php_min_version']) and $my_php_version < $php_min_version) {
            $xoops_patch[$k]['status'] = "PHP版本低於{$xoops_patch[$k]['php_min_version']}無法升級";
        } elseif (!empty($xoops['php_max_version']) and $my_php_version > $php_max_version) {
            $xoops_patch[$k]['status'] = "PHP版本高於{$xoops_patch[$k]['php_max_version']}無法升級";
        } elseif (!empty($xoops['xoops_min_version']) and $my_xoops_version < $xoops_min_version) {
            $xoops_patch[$k]['status'] = "XOOPS版本低於{$xoops_patch[$k]['xoops_min_version']}無法升級";
        } elseif (!empty($xoops['xoops_version']) and $my_xoops_version >= $xoops_version) {
            $xoops_patch[$k]['status'] = "XOOPS版本已經高於{$xoops_patch[$k]['xoops_version']}無需升級";
        } elseif (file_exists(XOOPS_ROOT_PATH . "/uploads/xoops_sn_{$xoops['xoops_sn']}.txt")) {
            $xoops_patch[$k]['status'] = '此補丁已安裝';
        } else {
            $xoops_patch[$k]['status'] = 'OK';
        }

        if ('patch' === $xoops['xoops_type']) {
            $all_patch[$k] = $xoops_patch[$k];
        } else {
            $all_upgrade[$k] = $xoops_patch[$k];
        }
    }
    // die(var_export($xoops_patch));
    if ('return' === $mode) {
        return ['xoops_patch' => $all_patch, 'xoops_upgrade' => $all_upgrade];
    }
    $xoopsTpl->assign('xoops_patch', $all_patch);
    $xoopsTpl->assign('xoops_upgrade', $all_upgrade);

    if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/easy_responsive_tabs.php')) {
        redirect_header('index.php', 3, _TAD_NEED_TADTOOLS);
    }
    require_once XOOPS_ROOT_PATH . '/modules/tadtools/easy_responsive_tabs.php';
    $responsive_tabs = new easy_responsive_tabs('#admTab');
    $responsive_tabs->rander();

    if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/sweet_alert.php')) {
        redirect_header('index.php', 3, _TAD_NEED_TADTOOLS);
    }
    require_once XOOPS_ROOT_PATH . '/modules/tadtools/sweet_alert.php';
    $sweet_alert = new sweet_alert();
    $sweet_alert->render('delete_theme', 'main.php?op=delete_theme&dirname=', 'theme');

    if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/fancybox.php')) {
        redirect_header('index.php', 3, _TAD_NEED_TADTOOLS);
    }
    require_once XOOPS_ROOT_PATH . '/modules/tadtools/fancybox.php';
    $fancybox = new fancybox('.fancybox');
    $fancybox->render(false);
}

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
        list_xoops();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tad_adm/css/module.css');
require_once __DIR__ . '/footer.php';
