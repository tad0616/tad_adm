<?php

namespace XoopsModules\Tad_adm;

class UpgradeRequest
{
    public static function beforeBootstrap(): void
    {
        ini_set('display_errors', '0');
        ini_set('display_startup_errors', '0');
        ini_set('log_errors', '1');
    }

    public static function afterBootstrap(): void
    {
        global $xoopsConfig, $xoopsLogger, $xoopsTpl;

        self::beforeBootstrap();
        if (isset($xoopsConfig) && is_array($xoopsConfig)) {
            $xoopsConfig['debug_mode'] = 0;
        }
        if (isset($xoopsLogger) && is_object($xoopsLogger)) {
            $xoopsLogger->activated = false;
        }
        if (isset($xoopsTpl) && is_object($xoopsTpl)) {
            $xoopsTpl->debugging = false;
            $xoopsTpl->debugging_ctrl = 'NONE';
        }
    }
}
