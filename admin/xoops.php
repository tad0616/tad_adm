<?php
use Xmf\Request;
use XoopsModules\Tad_adm\OnlineUpgrade;
use XoopsModules\Tad_adm\UpgradeRequest;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_adm_adm_xoops.tpl';
$xoopsOption['pagetype'] = 'admin';
require_once dirname(__DIR__) . '/class/UpgradeRequest.php';
UpgradeRequest::beforeBootstrap();
require_once dirname(__DIR__, 3) . '/mainfile.php';
UpgradeRequest::afterBootstrap();
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$update_sn = Request::getInt('update_sn');
$xoops_sn = Request::getInt('xoops_sn');
$file_link = Request::getString('file_link');
$dirname = Request::getString('dirname');
$act = Request::getString('act');
$kind_dir = Request::getString('kind_dir');
$ssh_id = Request::getString('ssh_id', '', 'POST');
$ssh_passwd = Request::getString('ssh_passwd', '', 'POST');
$ssh_host = Request::getString('ssh_host', '', 'POST');
$kind = Request::getString('kind');
$mid = Request::getInt('mid');
$val = Request::getInt('val');
$theme = Request::getString('theme');

switch ($op) {

    case 'ssh_login':
        if ('POST' !== strtoupper($_SERVER['REQUEST_METHOD'] ?? '') || !isset($GLOBALS['xoopsSecurity']) || !is_object($GLOBALS['xoopsSecurity']) || !$GLOBALS['xoopsSecurity']->check()) {
            $err = isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) ? implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()) : _NOPERM;
            redirect_header('xoops.php?tad_adm_tpl=clean', 3, $err);
            exit;
        }
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

}

/*-----------秀出結果區--------------*/
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/
