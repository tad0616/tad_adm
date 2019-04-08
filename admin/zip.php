<?php
include_once "../../../mainfile.php";
$isWin = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? true : false;
$date  = date("YmdHi");

$bak_filename     = XOOPS_ROOT_PATH . "/uploads/user_bak_{$date}.zip";
$bak_filename_url = XOOPS_URL . "/uploads/user_bak_{$date}.zip";
if (file_exists($bak_filename)) {
    unlink($bak_filename);
}

$dir = XOOPS_ROOT_PATH . "/uploads/";

foreach ($_POST['dirs'] as $dirname) {
    $DirFileArr[] = $isWin ? iconv("UTF-8", "Big5", $dirname) : $dirname;
}
foreach ($_POST['files'] as $firename) {
    $DirFileArr[] = $isWin ? iconv("UTF-8", "Big5", $firename) : $firename;
}

$AllDirFile = implode(" ", $DirFileArr);

$msg = shell_exec("zip -r -j {$bak_filename} {$AllDirFile}");

if (file_exists($bak_filename)) {
    header("location: {$bak_filename_url}");
    exit;
} else {
    include_once '../class/pclzip.lib.php';
    $zipfile = new PclZip($bak_filename);
    $v_list  = $zipfile->create($DirFileArr, PCLZIP_OPT_REMOVE_PATH, $dir);

    if ($v_list == 0) {
        die("Error : " . $zipfile->errorInfo(true));
    } else {
        header("location: {$bak_filename_url}");
        exit;
    }
}

exit;


