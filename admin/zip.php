<?php
require_once '../../../mainfile.php';
$isWin = 'WIN' === mb_strtoupper(mb_substr(PHP_OS, 0, 3)) ? true : false;
$date = date('YmdHi');

$bak_filename = XOOPS_ROOT_PATH . "/uploads/user_bak_{$date}.zip";
$bak_filename_url = XOOPS_URL . "/uploads/user_bak_{$date}.zip";
if (file_exists($bak_filename)) {
    unlink($bak_filename);
}

$dir = XOOPS_ROOT_PATH . '/uploads/';

foreach ($_POST['dirs'] as $dirname) {
    $DirFileArr[] = $isWin ? iconv('UTF-8', 'Big5', $dirname) : $dirname;
}
foreach ($_POST['files'] as $firename) {
    $DirFileArr[] = $isWin ? iconv('UTF-8', 'Big5', $firename) : $firename;
}

$AllDirFile = implode(' ', $DirFileArr);

$msg = shell_exec("zip -r -j {$bak_filename} {$AllDirFile}");

if (file_exists($bak_filename)) {
    header("location: {$bak_filename_url}");
    exit;
}
    require_once '../class/pclzip.lib.php';
    $zipfile = new PclZip($bak_filename);
    $v_list = $zipfile->create($DirFileArr, PCLZIP_OPT_REMOVE_PATH, $dir);

    if (0 == $v_list) {
        die('Error : ' . $zipfile->errorInfo(true));
    }
        header("location: {$bak_filename_url}");
        exit;

exit;
