<?php
$adminmenu = [];
$icon_dir  = substr(XOOPS_VERSION, 6, 3) == '2.6' ? "" : "images/";

$i                      = 1;
$adminmenu[$i]['title'] = _MI_TAD_ADMIN_HOME;
$adminmenu[$i]['link']  = 'admin/index.php';
$adminmenu[$i]['desc']  = _MI_TAD_ADMIN_HOME_DESC;
$adminmenu[$i]['icon']  = 'images/admin/home.png';

$i++;
$adminmenu[$i]['title'] = _MI_TADADM_ADMENU1;
$adminmenu[$i]['link']  = "admin/main.php";
$adminmenu[$i]['desc']  = _MI_TADADM_ADMENU1;
$adminmenu[$i]['icon']  = "images/admin/update.png";
$i++;
$adminmenu[$i]['title'] = _MI_TADADM_XOOPS_UPGRADE;
$adminmenu[$i]['link']  = "admin/xoops.php";
$adminmenu[$i]['desc']  = _MI_TADADM_XOOPS_UPGRADE;
$adminmenu[$i]['icon']  = "images/admin/upload.png";

$i++;
$adminmenu[$i]['title'] = _MI_TADADM_ADMENU3;
$adminmenu[$i]['link']  = "admin/spam.php";
$adminmenu[$i]['desc']  = _MI_TADADM_ADMENU3;
$adminmenu[$i]['icon']  = "images/admin/spam.png";

$i++;
$adminmenu[$i]['title'] = _MI_TADADM_ADMENU2;
$adminmenu[$i]['link']  = "admin/phpini.php";
$adminmenu[$i]['desc']  = _MI_TADADM_ADMENU2;
$adminmenu[$i]['icon']  = "images/admin/php.png";

$i++;
$adminmenu[$i]['title'] = _MI_TADADM_ADMENU4;
$adminmenu[$i]['link']  = "admin/backup.php";
$adminmenu[$i]['desc']  = _MI_TADADM_ADMENU4;
$adminmenu[$i]['icon']  = "images/admin/backup.png";

$i++;
$adminmenu[$i]['title'] = _MI_TADADM_ADMENU5;
$adminmenu[$i]['link']  = "admin/clean.php";
$adminmenu[$i]['desc']  = _MI_TADADM_ADMENU5;
$adminmenu[$i]['icon']  = "images/admin/clean.png";

$i++;
$adminmenu[$i]['title'] = _MI_TAD_ADMIN_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['desc']  = _MI_TAD_ADMIN_ABOUT_DESC;
$adminmenu[$i]['icon']  = 'images/admin/about.png';
