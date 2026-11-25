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
$sys_adm = isset($xoopsUser) && \is_object($xoopsUser) ? $xoopsUser->isAdmin(1) : false;
if (!$sys_adm) {
    exit;
}
require_once dirname(__DIR__) . '/function.php';

/*-----------執行動作判斷區----------*/
$op         = Request::getString('op');
$update_sn  = Request::getInt('update_sn');
$module_sn  = Request::getInt('module_sn');
$xoops_sn   = Request::getInt('xoops_sn');
$file_link  = Request::getString('file_link');
$dirname    = Request::getString('dirname');
$act        = Request::getString('act');
$kind_dir   = Request::getString('kind_dir');
$ssh_id     = Request::getString('ssh_id', '', 'POST');
$ssh_passwd = Request::getString('ssh_passwd', '', 'POST');
$ssh_host   = Request::getString('ssh_host', '', 'POST');
$kind       = Request::getString('kind');
$mid        = Request::getInt('mid');
$val        = Request::getInt('val');
$theme      = Request::getString('theme');

$require_post_csrf = static function (string $redirectUrl = 'main.php'): void {
    if ('POST' !== strtoupper($_SERVER['REQUEST_METHOD'] ?? '')) {
        redirect_header($redirectUrl, 3, _NOPERM);
        exit;
    }
    if (!isset($GLOBALS['xoopsSecurity']) || !is_object($GLOBALS['xoopsSecurity']) || !$GLOBALS['xoopsSecurity']->check()) {
        $err = isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) ? implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()) : _NOPERM;
        redirect_header($redirectUrl, 3, $err);
        exit;
    }
};

switch ($op) {

    case 'ssh_login':
        $require_post_csrf('main.php?tad_adm_tpl=clean');
        OnlineUpgrade::ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link, $dirname, $act, $update_sn, $xoops_sn, $module_sn);
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
        $require_post_csrf('main.php?tad_adm_tpl=clean');
        OnlineUpgrade::to_do('', $dirname, 'delete_theme');
        break;
    case 'install_adm_tpl':
        OnlineUpgrade::to_do($file_link, $dirname, 'install_adm_tpl', $update_sn);
        break;
    case 'upgrade_adm_tpl':
        OnlineUpgrade::to_do($file_link, $dirname, 'upgrade_adm_tpl', $update_sn);
        break;
    case 'install_other':
        if (OnlineUpgrade::do_other($file_link, $update_sn, $module_sn, 'install_other')) {
            header('location: main.php');
            exit;
        }
        break;
    case 'upgrade_other':
        if (OnlineUpgrade::do_other($file_link, $update_sn, $module_sn, 'upgrade_other')) {
            header('location: main.php');
            exit;
        }
        break;
    case 'install_block':
        OnlineUpgrade::do_block('install', $update_sn);
        header('location: main.php');
        exit;
    case 'upgrade_block':
        OnlineUpgrade::do_block('update', $update_sn);
        header('location: main.php');
        exit;
    case 'active':
        $require_post_csrf('main.php');
        active_module($mid);
        header('location: main.php');
        exit;

    case 'update_allowed':
        $require_post_csrf('main.php');
        OnlineUpgrade::update_allowed($theme, $val);
        header('location: main.php');
        exit;

    default:
        OnlineUpgrade::list_modules();
        break;

}

/*-----------秀出結果區--------------*/
$token      = isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) ? $GLOBALS['xoopsSecurity']->createToken() : '';
$token_html = isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) ? $GLOBALS['xoopsSecurity']->getTokenHTML() : '';
$xoopsTpl->assign('token', $token);
$xoopsTpl->assign('token_html', $token_html);
$xoopsTpl->assign('source', $xoopsModuleConfig['source']);
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/

function active_module($mid)
{
    global $xoopsDB;

    $sql = 'UPDATE `' . $xoopsDB->prefix('modules') . '` SET `isactive`=? WHERE `mid`=?';
    Utility::query($sql, 'si', [1, $mid]) or Utility::web_error($sql, __FILE__, __LINE__);

}

function get_theme_color($dirname)
{
    $theme_color = '';
    $theme_kind  = '';

    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $dirname)) {
        return [$theme_color, $theme_kind];
    }

    $configFile = XOOPS_ROOT_PATH . "/themes/{$dirname}/config.php";

    if (is_file($configFile)) {
        require $configFile;
    }

    return [$theme_color, $theme_kind];
}
