<?php

use XoopsModules\Tad_adm\Update;

function xoops_module_update_tad_adm()
{
    global $xoopsDB;

    if (Update::chk_uid()) {
        Update::go_update_uid();
    }

    return true;
}
