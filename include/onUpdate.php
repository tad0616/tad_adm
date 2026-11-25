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
    if (Update::chk_engine_innodb()) {
        Update::go_update_engine_innodb();
    }
    if (Update::chk_result_column()) {
        Update::go_update_result_column();
    }
    if (Update::chk_result_uid_index()) {
        Update::go_update_result_uid_index();
    }

    return true;
}
