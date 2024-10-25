<?php
use Xmf\Request;
use XoopsModules\Tad_adm\OnlineUpgrade;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_adm_adm_xoops.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
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

}

/*-----------秀出結果區--------------*/
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/
