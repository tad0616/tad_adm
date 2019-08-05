<?php
xoops_loadLanguage('admin_common', 'tadtools');
//phpini.php
define('_MA_TADADM_PHPINI_ITEM', 'Set Item');
define('_MA_TADADM_PHPINI_ITEM_VAL', 'Settings');
define('_MA_TADADM_PHPINI_ADV', 'Recommended value');
define('_MA_TADADM_PHPINI_ITEM_DESC', 'Related Description');

//main.php
define('_MA_TADADM_1', '<i class="icon-ok"></i>');
define('_MA_TADADM_0', '');
define('_MA_TADADM_MOD_UPDATE_MODULE', 'Upgrade now to');
define('_MA_TADADM_MOD_INSTALL_MODULE', 'Install now');
define('_MA_TADADM_MOD_UPDATE_THEME', 'Upgrade set to');
define('_MA_TADADM_MOD_INSTALL_THEME', 'Install the set');
define('_MA_TADADM_MOD_LATEST', 'Already the latest');
define('_MA_TADADM_NO_MODS', 'No modules');
define('_MA_TADADM_MOD_NAME', 'module name');
define('_MA_TADADM_MOD_VERSION', 'current version');
define('_MA_TADADM_MOD_NEW_VERSION', 'Latest version');
define('_MA_TADADM_MOD_LAST_UPDATE', 'Last upgrade');
define('_MA_TADADM_MOD_NEW_LAST_UPDATE', 'release date');
define('_MA_TADADM_MOD_DIRNAME', 'directory name');
define('_MA_TADADM_MOD_UNINSTALL', 'Not installed');
define('_MA_TADADM_MOD_UPDATE_DESC', 'New Description');
define('_MA_TADADM_MOD_ABOUT_MOD', 'Module Introduction');
define('_MA_TADADM_LOGIN', 'Login');
define('_MA_TADADM_SSH', 'SSH login');
define('_MA_TADADM_SSH_HOST', 'Please enter SSH login host');
define('_MA_TADADM_SSH_ID', 'Please enter SSH login account');
define('_MA_TADADM_SSH_PASS', 'Please enter SSH login password');
define('_MA_TADADM_FTP', 'FTP login');
define('_MA_TADADM_FTP_HOST', 'Please enter FTP login host');
define('_MA_TADADM_FTP_ID', 'Please enter an FTP login account');
define('_MA_TADADM_FTP_PASS', 'Please enter the FTP login password');
define('_MA_TADADM_DL_FAIL', '"%s" failed to download!');
define('_MA_TADADM_MV_FAIL', '"%s" failed to move to modules!');
define('_MA_TADADM_SSH_LOGIN_FAIL', '"%s" failed to log in to "%s" via SSH!');
define('_MA_TADADM_FTP_LOGIN_FAIL', '"%s" failed to log in to "%s" via FTP!');
define('_MA_TADADM_FTP_FAIL', 'FTP connection failed! (The server may not have FTP service or FTP service is not started)');
define('_MA_TADADM_KIND', 'Category');
define('_MA_TADADM_MODULE', 'Module');
define('_MA_TADADM_THEME', 'Settings');
define('_MA_TADADM_FIX', 'Supplement');
define('_MA_TADADM_THEME_UPDATE_OK', 'Set upgrade is complete!');
define('_MA_TADADM_THEME_INSTALL_OK', '"%s" set is installed! Go to "<a href="' . XOOPS_URL . '/modules/system/admin.php?fct=preferences&op=show&confcat_id=1">Preferences</ a>"Set it as a preset scene, or apply it to the foreground scene block.');
define('_MA_TADADM_FTP_NOTE', 'FTP only works with new modules. Because of the permission relationship, FTP mode cannot overwrite the original folder, so it is not applicable to upgrade modules.');

//spam.php
define('_MA_TADADM_NEVERLOGIN', 'Not logged in');
define('_MA_TADADM_CKECKOK', 'Check in or check no data');
define('_MA_TADADM_WORKTIME', 'Execution time: %s seconds');
define('_MA_TADADM_AUTO_CHECK', 'Automatic inventory mode');
define('_MA_TADADM_AUTO_CHECK_DESC', '(Use once, the first time to check all accounts. This feature will automatically check all accounts and automatically change pages. Since there are 20 restrictions on page breaks, if the account number exceeds %s, The final screen may become blank due to a forced interrupt. At this point, the mouse should click on the address bar and press Enter to continue checking until the check is completed.)');
define('_MA_TADADM_AUTO_CHECK_DESC1', 'Check will connect to <a href="http://www.stopforumspam.com" target="_blank">http://www.stopforumspam.com</a> to check the account number Whether Email is a registered junk account, so the first time will be slower.');
define('_MA_TADADM_AUTO_CHECK_DESC2', 'The result will be stored in the database after checking, so the second time browsing the account will be faster.');
define('_MA_TADADM_AUTO_CHECK_DESC3', '<span style="color:red">Red means this is a registered "junk account"</span>; <span style="color:#CC6600">orange represents "from Signature file to judge 80% is a junk account"</span>; <span style="color: #505050">black representative should be a general account</span>, <span style="color:blue">blue is there The account number of the article has been posted</span>');
define('_MA_TADADM_AUTO_CHECK_DESC4', '<a href="spam.php?op=all&mode=force">Forcible review!</a> The emails that were checked before will be noted as checked, so it will not be checked again at stopforumspam Whether Email is spam to speed up the inspection. However, some emails are listed as spam by stopforumspam afterwards, so every time, you can use this function to check whether Email is listed as spam.');
define('_MA_TADADM_AUTO_CHECK_DESC5', '<a href="spam.php?op=spam">List only as spam list</a> (After performing "forced re-examination", you can use this feature to view and find out Which spam is deleted and deleted.)');
define('_MA_TADADM_UNAME', 'Account');
define('_MA_TADADM_COUNT', 'Publishing number');
define('_MA_TADADM_EMAIL', 'Mailbox');
define('_MA_TADADM_SPAM', 'Junk');
define('_MA_TADADM_REGIST', 'Registry Day');
define('_MA_TADADM_LASTLOGIN', 'Unsigned Day');
define('_MA_TADADM_SIGN', 'Signature');
define('_MA_TADADM_DONT_DEL_ROOT', 'Cannot delete administrator');
define('_MA_TADADM_DEL_FAIL', 'Delete user failed!');
define('_MA_TADADM_DEL_OK', 'Delete completed!');
define('_MA_TADADM_NEXT_PAGE', 'Switch to next page');
define('_MA_TADADM_TOTAL', 'Total %s pen data');
define('_MA_TADADM_NEVERSTART_DAY', 'List not started, and registered more than %s days');
define('_MA_TADADM_NEVERLOGIN_DAY', 'List never logged in, and register more than %s days');
define('_MA_TADADM_BY_EMAIL', 'List the end of the email (domain) is %s');

define('_MA_TADADM_SELECT_ALL', 'Select all');
define('_MA_TADADM_MOD_FUNCTION', 'Admin');
define('_MA_TADADM_MOD_BLOCK', 'Block');
define('_MA_TADADM_MOD_ADMIN', 'Module backend');

define('_MA_TADADM_MODULES_UPDATING', 'Upgrade');
define('_MA_TADADM_MODULES_INSTALLING', 'Install');
define('_MA_TADADM_MODULES_PHP_INI_PATH', 'Important Settings');
define('_MA_TADADM_FREE_SPACE', 'hard disk free space:');
define('_MA_TADADM_DOWNLOAD_ZIP', 'Start compressing backup');

define('_MA_TADADM_CHMOD_FAILED', '<ul><li>Unable to set %s read and write permissions to %s, the file directory owner is %s:%s, and the attribute is %s.</li></ Ul>');

define('_MA_TADADM_ADMTPL', 'Background');
define('_MA_TADADM_MOD_UPDATE_ADMTPL', 'Upgrade Backend');
define('_MA_TADADM_MOD_INSTALL_ADMTPL', 'Install background');
define('_MA_TADADM_ADM_TPL_LATEST', 'Already the latest');
define('_MA_TADADM_ADM_TPL_INSTALL_OK', 'Background scene %s installed successfully! And has been replaced automatically.');
define('_MA_TADADM_ADM_TPL_UPDATE_OK', 'Background set upgrade succeeded!');

define('_MA_TADADM_MOD_CLOSED', 'Module closed');
define('_MA_TADADM_CLEAN', 'Clear selected custom templates');
define('_MA_TADADM_CLEANED', 'There is no custom old template at present');

define('_MA_TADADM_MOD_PREF', 'Preferences');
define('_MA_TADADM_CAN_UPDATE_TO', 'Upgrade to');
define('_MA_TADADM_ENABLE_MOD', 'Enable Module');
define('_MA_TADADM_UNABLE_INSTALL_MODS', 'Unable to install module');
