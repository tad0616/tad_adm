<?php
use Xmf\Request;
require_once __DIR__ . '/header.php';

require_once dirname(dirname(dirname(__DIR__))) . '/mainfile.php';
$isWin = 'WIN' === mb_strtoupper(mb_substr(PHP_OS, 0, 3)) ? true : false;
$date = date('YmdHi');

$bak_filename = XOOPS_ROOT_PATH . "/uploads/user_bak_{$date}.zip";
$bak_filename_url = XOOPS_URL . "/uploads/user_bak_{$date}.zip";
if (file_exists($bak_filename)) {
    unlink($bak_filename);
}

$dir = XOOPS_ROOT_PATH . '/uploads/';
$dirs = Request::getArray('dirs');
$files = Request::getArray('files');

foreach ($dirs as $dirname) {
    $DirFileArr[] = $isWin ? iconv('UTF-8', 'Big5', $dirname) : $dirname;
}
foreach ($files as $firename) {
    $DirFileArr[] = $isWin ? iconv('UTF-8', 'Big5', $firename) : $firename;
}

$AllDirFile = implode(' ', $DirFileArr);

$msg = shell_exec("zip -r -j {$bak_filename} {$AllDirFile}");

if (file_exists($bak_filename)) {
    header("location: {$bak_filename_url}");
    exit;
}
require_once dirname(__DIR__) . '/class/pclzip.lib.php';
$zipfile = new \XoopsModules\Tad_adm\PclZip($bak_filename);
$v_list = $zipfile->create($DirFileArr, PCLZIP_OPT_REMOVE_PATH, $dir);

if (0 == $v_list) {
    die('Error : ' . $zipfile->errorInfo(true));
}
header("location: {$bak_filename_url}");
exit;
