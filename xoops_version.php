<?php
$modversion = [];
global $xoopsConfig;

//---模組基本資訊---//
$modversion['name'] = _MI_TADADM_NAME;
$modversion['version'] = $_SESSION['xoops_version'] >= 20511 ? '3.0.0-Stable' : '3.0';
// $modversion['version'] = '2.93';
$modversion['description'] = _MI_TADADM_DESC;
$modversion['author'] = _MI_TADADM_AUTHOR;
$modversion['credits'] = _MI_TADADM_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = "images/logo_{$xoopsConfig['language']}.png";
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2024-11-18';
$modversion['module_website_url'] = 'https://tad0616.net/';
$modversion['module_website_name'] = _MI_TAD_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net/';
$modversion['author_website_name'] = _MI_TAD_WEB;
$modversion['min_php'] = 5.4;
$modversion['min_xoops'] = '2.5.10';

//---paypal資訊---//
$modversion['paypal'] = [
    'business' => 'tad0616@gmail.com',
    'item_name' => 'Donation : ' . _MI_TAD_WEB,
    'amount' => 0,
    'currency_code' => 'USD',
];

//---模組資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = ['tad_adm'];

//---後台使用系統選單---//
$modversion['system_menu'] = 1;

//---後台管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---前台主選單設定---//
$modversion['hasMain'] = 1;
// $modversion['sub'] = [['name' => '申請狀態', 'url' => 'status.php']];

//---模組自動功能---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---偏好設定---//
$modversion['config'] = [
    [
        'name' => 'list_amount',
        'title' => '_MI_TADADM_LIST_AMOUNT',
        'description' => '_MI_TADADM_LIST_AMOUNT_DESC',
        'formtype' => 'textbox',
        'valuetype' => 'int',
        'default' => '10',
    ],
    [
        'name' => 'login',
        'title' => '_MI_TADADM_LOGIN',
        'description' => '_MI_TADADM_LOGIN_DESC',
        'formtype' => 'textbox',
        'valuetype' => 'text',
        'default' => '',
    ],
    [
        'name' => 'module_id_temp',
        'title' => '_MI_TADADM_MODULE_ID_TEMP',
        'description' => '_MI_TADADM_MODULE_ID_TEMP_DESC',
        'formtype' => 'textarea',
        'valuetype' => 'text',
        'default' => '',
    ],
    [
        'name' => 'block_id_temp',
        'title' => '_MI_TADADM_BLOCK_ID_TEMP',
        'description' => '_MI_TADADM_BLOCK_ID_TEMP_DESC',
        'formtype' => 'textarea',
        'valuetype' => 'text',
        'default' => '',
    ],
    [
        'name' => 'ssh_port',
        'title' => '_MI_TADADM_SSH_PORT',
        'description' => '_MI_TADADM_SSH_PORT_DESC',
        'formtype' => 'textbox',
        'valuetype' => 'int',
        'default' => '22',
    ],
    [
        'name' => 'source',
        'title' => '_MI_TADADM_SOURCE',
        'description' => '_MI_TADADM_SOURCE_DESC',
        'formtype' => 'textbox',
        'valuetype' => 'text',
        'default' => 'https://campus-xoops.tn.edu.tw',
    ],
];

//---搜尋---//
$modversion['hasSearch'] = 0;
//$modversion['search']['file'] = "include/search.php";
//$modversion['search']['func'] = "搜尋函數名稱";

//---區塊設定---//
$modversion['blocks'] = [
    [
        'file' => 'tad_adm_new.php',
        'name' => _MI_TADADM_BNAME1,
        'description' => _MI_TADADM_BDESC1,
        'show_func' => 'tad_adm_new',
        'template' => 'tad_adm_new.tpl',
        'edit_func' => 'tad_adm_new_edit',
        'options' => '10',
    ],
];

//---樣板設定---//
$modversion['templates'] = [
    ['file' => 'tad_adm_adm_main.tpl', 'description' => 'tad_adm_adm_main.tpl'],
    ['file' => 'tad_adm_adm_spam.tpl', 'description' => 'tad_adm_adm_spam.tpl'],
    ['file' => 'tad_adm_adm_phpini.tpl', 'description' => 'tad_adm_adm_phpini.tpl'],
    ['file' => 'tad_adm_adm_backup.tpl', 'description' => 'tad_adm_adm_backup.tpl'],
    ['file' => 'tad_adm_adm_clean.tpl', 'description' => 'tad_adm_adm_clean.tpl'],
    ['file' => 'tad_adm_tn_manager.tpl', 'description' => 'tad_adm_tn_manager.tpl'],
    ['file' => 'tad_adm_adm_xoops.tpl', 'description' => 'tad_adm_adm_xoops.tpl'],
];
