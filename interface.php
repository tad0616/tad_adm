<?php
//判斷是否對該模組有管理權限
if (!isset($_SESSION['sys_adm'])) {
    $_SESSION['sys_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADADM_INDEX] = 'index.php';
$interface_icon[_MD_TADADM_INDEX] = "fa-chevron-right";
