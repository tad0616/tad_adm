<?php
//判斷是否對該模組有管理權限
if (!isset($sys_adm)) {
    $sys_adm = isset($xoopsUser) && \is_object($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TADADM_INDEX] = 'index.php';
$interface_icon[_MD_TADADM_INDEX] = "fa-sliders";
