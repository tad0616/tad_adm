<?php
include_once XOOPS_ROOT_PATH . "/modules/tadtools/language/{$xoopsConfig['language']}/modinfo_common.php";

define('_MI_TADADM_NAME', 'Webmaster Tools');
define('_MI_TADADM_AUTHOR', 'Tad');
define('_MI_TADADM_CREDITS', 'Tad');
define('_MI_TADADM_DESC', 'This module provides several Webmasters tools');
define('_MI_TADADM_ADMENU1', 'Module on-demand');
define('_MI_TADADM_ADMENU3', 'Spam Account');
define('_MI_TADADM_ADMENU2', 'Host Environment');
define('_MI_TADADM_BNAME1', 'New Spam Accounts');
define('_MI_TADADM_BDESC1', 'Block new Spam accounts');
define('_MI_TADADM_LIST_AMOUNT', 'Number of Accounts displayed per page');
define('_MI_TADADM_LIST_AMOUNT_DESC', 'Check the speed, the more the longer');
define('_MI_TADADM_LOGIN', 'Emergency login password');
define('_MI_TADADM_LOGIN_DESC', 'Auto-generated password has been changed, without setting here, any settings are invalid.');
define('_MI_TADADM_MODULE_ID_TEMP', 'Module ID staging area');
define('_MI_TADADM_MODULE_ID_TEMP_DESC', 'There are currently providing front-end interface to start a record number of modules, do not make any changes.');
define('_MI_TADADM_BLOCK_ID_TEMP', 'Block number staging area');
define('_MI_TADADM_BLOCK_ID_TEMP_DESC', 'Front-end interface to provide a record of the current block number has started, do not make any changes.');

define('_MI_TADADM_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_TADADM_HELP_HEADER', __DIR__ . '/help/helpheader.html');
define('_MI_TADADM_BACK_2_ADMIN', 'Back to Administration of ');

//help
define('_MI_TADADM_HELP_OVERVIEW', 'Overview');
