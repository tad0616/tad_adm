<?php

namespace XoopsModules\Tad_adm;

/*
Update Class Definition

You may not change or alter any portion of this comment or credits of
supporting developers from this source code or any supporting source code
which is considered copyrighted (c) material of the original comment or credit
authors.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       Mamba <mambax7@gmail.com>
 */

/**
 * Class Update
 */
class Update
{
    //修正uid欄位
    public static function chk_uid()
    {
        global $xoopsDB;
        $sql    = "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND table_name = '" . $xoopsDB->prefix('tad_adm') . "' AND COLUMN_NAME = 'uid'";
        $result = $xoopsDB->query($sql);
        if (!$result) {
            return false;
        }
        $row = $xoopsDB->fetchRow($result);
        if (!is_array($row) || !isset($row[0])) {
            return false;
        }
        if ('smallint' === $row[0]) {
            return true;
        }

        return false;
    }

    //執行升級
    public static function go_update_uid()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('tad_adm') . '` CHANGE `uid` `uid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0';
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, $xoopsDB->error());

        return true;
    }

    // 檢查 tad_adm 是否尚未轉為 InnoDB
    public static function chk_engine_innodb()
    {
        global $xoopsDB;
        $table  = $xoopsDB->prefix('tad_adm');
        $sql    = "SELECT ENGINE FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '" . $xoopsDB->escape($table) . "'";
        $result = $xoopsDB->query($sql);
        if (!$result) {
            return false;
        }
        $row = $xoopsDB->fetchRow($result);
        if (!is_array($row) || !isset($row[0])) {
            return false;
        }

        return 'InnoDB' !== $row[0];
    }

    // 轉換 tad_adm 為 InnoDB
    public static function go_update_engine_innodb()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('tad_adm') . '` ENGINE=InnoDB';
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, $xoopsDB->error());

        return true;
    }

    // 檢查 result 欄位是否尚未改為數值型別
    public static function chk_result_column()
    {
        global $xoopsDB;
        $table  = $xoopsDB->prefix('tad_adm');
        $sql    = "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '" . $xoopsDB->escape($table) . "' AND COLUMN_NAME = 'result'";
        $result = $xoopsDB->query($sql);
        if (!$result) {
            return false;
        }
        $row = $xoopsDB->fetchRow($result);
        if (!is_array($row) || !isset($row[0])) {
            return false;
        }

        return !in_array(strtolower((string) $row[0]), ['smallint', 'int', 'mediumint', 'tinyint', 'bigint'], true);
    }

    // 將 result 欄位正規化為非負整數並調整為 SMALLINT UNSIGNED，補齊各欄預設值
    public static function go_update_result_column()
    {
        global $xoopsDB;
        $table = $xoopsDB->prefix('tad_adm');
        // 先清理非數字舊資料避免轉型失敗
        $sql_clean = "UPDATE `{$table}` SET `result` = '0' WHERE `result` = '' OR `result` NOT REGEXP '^[0-9]+$'";
        $xoopsDB->queryF($sql_clean);

        $sql_cap = "UPDATE `{$table}` SET `result` = '65535' WHERE CAST(`result` AS UNSIGNED) > 65535";
        $xoopsDB->queryF($sql_cap);

        $sql = "ALTER TABLE `{$table}`
            MODIFY `email` varchar(255) NOT NULL DEFAULT '' COMMENT 'email',
            MODIFY `result` smallint(5) unsigned NOT NULL DEFAULT 0 COMMENT '檢查結果',
            MODIFY `chk_date` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT '檢查日'";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, $xoopsDB->error());

        return true;
    }

    // 檢查 idx_result_uid 複合索引是否存在
    public static function chk_result_uid_index()
    {
        global $xoopsDB;
        $table  = $xoopsDB->prefix('tad_adm');
        $sql    = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '" . $xoopsDB->escape($table) . "' AND INDEX_NAME = 'idx_result_uid'";
        $result = $xoopsDB->query($sql);
        if (!$result) {
            return false;
        }
        $row = $xoopsDB->fetchRow($result);

        return !is_array($row) || (int) ($row[0] ?? 0) === 0;
    }

    // 新增 (result, uid) 複合索引
    public static function go_update_result_uid_index()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('tad_adm') . '` ADD KEY `idx_result_uid` (`result`, `uid`)';
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, $xoopsDB->error());

        return true;
    }

}
