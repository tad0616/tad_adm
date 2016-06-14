<?php
include_once XOOPS_ROOT_PATH . "/modules/tadtools/language/{$xoopsConfig['language']}/modinfo_common.php";
define('_MI_TADADM_NAME', '站長工具箱');
define('_MI_TADADM_AUTHOR', '站長工具箱');
define('_MI_TADADM_CREDITS', 'Michael Beck');
define('_MI_TADADM_DESC', '此模組提供一些站長用的工具');
define('_MI_TADADM_ADMENU1', '模組隨選');
define('_MI_TADADM_ADMENU3', '清理垃圾帳戶');
define('_MI_TADADM_ADMENU2', '主機環境');
define('_MI_TADADM_BNAME1', '新的垃圾帳戶');
define('_MI_TADADM_BDESC1', '新的垃圾帳戶區塊');
define('_MI_TADADM_LIST_AMOUNT', '每頁顯示的帳號數');
define('_MI_TADADM_LIST_AMOUNT_DESC', '越多檢查速度會越久');
define('_MI_TADADM_LOGIN', '緊急登入密碼');
define('_MI_TADADM_LOGIN_DESC', '已改為自動產生密碼，此處無需設定，任何設定均無效。');
define('_MI_TADADM_MODULE_ID_TEMP', '模組編號暫存區');
define('_MI_TADADM_MODULE_ID_TEMP_DESC', '提供前端界面紀錄目前有啟動的模組編號，請勿做任何修改');
define('_MI_TADADM_BLOCK_ID_TEMP', '區塊編號暫存區');
define('_MI_TADADM_BLOCK_ID_TEMP_DESC', '提供前端界面紀錄目前有啟動的區塊編號，請勿做任何修改');
define('_MI_TADADM_SSH_PORT', '設定 SSH 的連線 port');
define('_MI_TADADM_SSH_PORT_DESC', '請根據網站主機使用的SSH port來設定');

define('_MI_TADADM_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADADM_HELP_HEADER', __DIR__ . '/help/helpheader.html');
define('_MI_TADADM_BACK_2_ADMIN', '管理');

//help
define('_MI_TADADM_HELP_OVERVIEW', '概要');
