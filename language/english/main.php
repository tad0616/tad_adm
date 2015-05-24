<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2012-11-26
// $Id:$
// ------------------------------------------------------------------------- //

//Must be added to the module language
//define("_TAD_NEED_TADTOOLS"," 需要 tadtools 模組，可至<a href='http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50' target='_blank'>Tad教材網</a>下載。");
define("_TAD_NEED_TADTOOLS","need TadTools modules, available at <a href='http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50' target='_blank'>Tad textbooks Network </a>to download");

define('_MD_TADADM_SET', 'set');
define('_MD_TADADM_NAME', 'Webmaster Tools');
define('_MD_TADADM_PASSWD', 'rescue Password');
define('_MD_TADADM_INPUT_PASSWD', '[Step 2] input rescue password:');
define('_MD_TADADM_INPUT_PASSWD_DESC', "[a]<a href='index.php?op=send_passwd'>first step Click here to send relief to the administrator password for the mailbox </a>");
define('_MD_TADADM_MAIL_CONTENT', "Rescue password is: <span style='color:red;'>%s</span><p>Please connect to: <a href='' . XOOPS_URL . '/modules/tad_adm'>' . XOOPS_URL . '/modules/tad_adm</a> inputs</p><p>If this is not what you requested, which means that someone（from: %s）for Guizhan evil intentions, we recommend that you rename file ' . XOOPS_ROOT_PATH . '/modules/tad_adm/index.php (eg: xxx.php), in order to avoid indiscriminate use by others </p>");
define('_MD_TADADM_MAIL_PASSWD_OK', 'password has been sent to the rescue %s');
define('_MD_TADADM_MAIL_PASSWD_FAIL', 'rescue the password sent to %s failed!');
define('_MD_TADADM_LOGIN', 'login');
define('_MD_TADADM_FILES_COUNT', ' (%s files)');
define('_MD_TADADM_BRACKETS', ' (%s)');
define('_MD_TADADM_UNABLE_DEBUG', 'close %s debug');
define('_MD_TADADM_ENABLE_DEBUG', 'opne %s debug');
define('_MD_TADADM_CANT_CONNECT', 'can not connect');
define('_MD_TADADM_NO_GROUP', 'non-group');
define('_MD_TADADM_GUEST', 'Guest');
define('_MD_TADADM_SOME_GROUP', 'unknown group');
define('_MD_TADADM_GROUP_COUNTEER', '%s number %s users');
define('_MD_TADADM_MEM_AMOUNT', 'Registered users');
define('_MD_TADADM_AVAILABLE_MEM_AMOUNT', 'normal number of members');
define('_MD_TADADM_PEOPLE', 'people');
define('_MD_TADADM_UNAVAILABLE_MEM_AMOUNT', 'The number is not enabled');
define('_MD_TADADM_NEVER_LOGIN', 'never logged the number');
define('_MD_TADADM_SYSTEM_INFO', 'System Information');
define('_MD_TADADM_VERSION', 'Version');
define('_MD_TADADM_LANGUAGE', 'language');
define('_MD_TADADM_CONNECT', 'connection status');
define('_MD_TADADM_AVAILABLE_SPACE', 'free disk space');
define('_MD_TADADM_DEFAULT_THEME', 'revert to the default setting');
define('_MD_TADADM_DEFAULT_THEME_DESC', '%s theme will revert to default setting');
define('_MD_TADADM_AID', 'Help');
define('_MD_TADADM_CLEAR_CACHE', 'Clear XOOPS Cache');
define('_MD_TADADM_CLEAR_SESSION', 'clear the session table');
define('_MD_TADADM_ENABLE_WEB', 'start site');
define('_MD_TADADM_UNABLE_WEB', 'close the site');
define('_MD_TADADM_WEB_FUNCTION', 'zoom away');
define('_MD_TADADM_RESET_ADMIN_PASSWD', 'reset the administrator password');
define('_MD_TADADM_RESET_MEM_PASSWD', 'someone reset password');
define('_MD_TADADM_UNABLE_ALL_BLOCKS', 'close all the blocks (of %s)');
define('_MD_TADADM_UNABLE_ALL_MODS', 'close all modules (in addition to the system and webmaster toolbox modules of %s)');
define('_MD_TADADM_ENABLE_ALL_BLOCKS', 'Restore all blocks (of %s)');
define('_MD_TADADM_ENABLE_ALL_MODS', 'Restore all modules (in addition to the system and webmaster toolbox modules of %s)');
define('_MD_TADADM_ADMIN', 'back to the Home');
define('_MD_TADADM_PREFERENCES', 'Preferences');
define('_MD_TADADM_MODULES', 'Module Administration');
define('_MD_TADADM_LINKS', 'Useful Links');
define('_MD_TADADM_LINK_TO', 'Connect to');
define('_MD_TADADM_LOGIN_PAGE', 'Login screen');
define('_MD_TADADM_DB', 'Database Management');
define('_MD_TADADM_LOGOUT', 'Logout');
define('_MD_TADADM_USER_ID', 'Username');
define('_MD_TADADM_USER_PASS', 'Password');
define('_MD_TADADM_USER_S_ID', 'User ID:');
define('_MD_TADADM_USER_S_PASS', 'Password:');
define('_MD_TADADM_FORGOT', 'I forgot Admin password');
