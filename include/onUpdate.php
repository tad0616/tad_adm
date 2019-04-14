<?php

use XoopsModules\Tad_adm\Utility;

function xoops_module_update_tad_adm(&$module, $old_version)
{
    global $xoopsDB;

    if (Utility::chk_uid()) {
        Utility::go_update_uid();
    }

    return true;
}
