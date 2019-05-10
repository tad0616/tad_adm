<?php

use XoopsModules\Tad_adm\Update;

if (!class_exists('XoopsModules\Tad_adm\Update')) {
    include dirname(__DIR__) . '/preloads/autoloader.php';
}

function xoops_module_update_tad_adm()
{
    global $xoopsDB;

    if (Update::chk_uid()) {
        Update::go_update_uid();
    }

    return true;
}
