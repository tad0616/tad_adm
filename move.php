<?php
use Xmf\Request;
use XoopsModules\Tadtools\SyntaxHighlighter;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tad_adm\Mysqldump as IMysqldump;
use XoopsModules\Tad_adm\OnlineUpgrade;

require_once dirname(dirname(__DIR__)) . '/mainfile.php';
// require_once XOOPS_ROOT_PATH . '/header.php';

$isWin = 'WIN' === mb_strtoupper(mb_substr(PHP_OS, 0, 3)) ? true : false;
$inSchoolWeb = is_link(XOOPS_ROOT_PATH . '/mainfile.php') ? true : false;
xoops_loadLanguage('main', 'tadtools');

require_once __DIR__ . '/function.php';

$_SESSION['tad_adm_isAdmin'] = ($xoopsUser) ? $xoopsUser->isAdmin(1) : false;
// $_SESSION['tad_adm_isAdmin'] = 1; //不須密碼模式，危險，沒事勿用。

$on = '<img src="images/icons/yes.png" alt="on" style="margin-right: 4px;">';
$off = '<img src="images/icons/no.png" alt="off" style="margin-right: 4px;">';
$add = '<img src="images/icons/add.png" alt="add" style="margin-right: 4px;">';
$up = '<img src="images/icons/up.png" alt="up" style="margin-right: 4px;">';
$down = '<img src="images/icons/down.png" alt="down" style="margin-right: 4px;">';

$system_mods = ['system', 'profile', 'pm', 'protector'];
$system_theme = ['default', 'suico', 'zetagenesis'];
$bad_mods = [
    'fred_honorboard' => ['tad_honor', 66],
    'fred_place' => ['jill_booking', 71],
    'eguide' => ['tad_form', 9],
    'fred_repair' => ['tad_repair', 4],
    'fred_marquee' => ['yaoh_light', 20],
    'mytabs' => ['tadnews', 2],
    'newbb' => ['tad_discuss', 8],
    'xforum' => ['tad_discuss', 8],
    'tad_cbox' => ['tad_discuss', 8],
];

$source_mod = OnlineUpgrade::get_tad_json_info('all.json');

$xoops_patch = OnlineUpgrade::get_tad_json_info('xoops.json');
// Utility::dd($xoops_patch);
$max_xoops_version = 0;
$latest_xoops_version = '';
foreach ($xoops_patch as $x) {
    if ($x['xoops_type'] == 'upgrade') {
        $xoops_version = OnlineUpgrade::get_version('xoops', $x['xoops_version']);
        if ($xoops_version > $max_xoops_version) {
            $max_xoops_version = $xoops_version;
            $latest_xoops_version = $x['xoops_version'];
        }
    }
}

$op = Request::getString('op');
$new_url = Request::getString('new_url');
if (!empty($new_url)) {
    $_SESSION['new_url'] = $new_url;
}
$dir = Request::getString('dir');
$schoolweb_id = Request::getString('schoolweb_id');

switch ($op) {
    case 'export_sql':
        export_sql($new_url);
        break;

    case 'save_schoolweb_id':
        if ($schoolweb_id) {
            $_SESSION['schoolweb_id'] = $schoolweb_id;
        }
        header("location:{$_SERVER['PHP_SELF']}");
        exit;

    default:
        move_step();
        break;
}

function move_step()
{
    global $latest_xoops_version, $max_xoops_version, $inSchoolWeb;
    $id = '帳號';
    if (mb_strpos($_SERVER['SERVER_NAME'], '.tn.edu.tw')) {
        $str = str_replace('.tn.edu.tw', '', $_SERVER['SERVER_NAME']);
        $s = explode('.', $str);
        $id = $s[1] ? "{$s[1]}_{$s[0]}" : $s[0];
        if (isset($_SESSION['schoolweb_id'])) {
            $_SESSION['schoolweb_id'] = $id;
        }
    }

    $description = "<li>本程式會自動偵測環境，並提出升級至 XOOPS $latest_xoops_version 的建議及步驟。</li>
    <li>請盡量使用網域名稱，以得到正確建議。</li>";

    if ($inSchoolWeb) {
        $description = '<li>您的網站已經是放在台南市教育局集中式網站中，版本永遠是最新的，所以，以下資訊僅供參考，無需使用。</li>';
    }

    $content = '
    <link href="https://schoolweb.tn.edu.tw/uploads/fonts/woff2.css" rel="stylesheet">
    <style>
    h1{
        padding:6px 0px;
        text-align:left;
        font-family: HanWangMingBlack, jf-openhuninn, Mamelon;
        background: -webkit-linear-gradient(#346cdb, #000000);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    h2{
        padding:6px 0px;
        text-align:left;
        font-family: HanWangMingBlack, jf-openhuninn, Mamelon;
        background: -webkit-linear-gradient(#5F951F, #007FA0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    h3{
        padding:6px 18px;
        font-family: jf-openhuninn, Mamelon;
    }

    li{
        font-size: 1.1em;
        padding:6px;
        font-family: 微軟正黑體;
    }

    code{
        font-size: 1.1em;
    }

    .important{
        color: #0f7762;
    }
    .danger{
        color: #d854a1;
    }
    .alert, .well{
        margin: 16px auto;
    }
    </style>
    <div class="page-header">
        <h1>XOOPS 網站升級、搬移指南</h1>
    </div>
    <ol>
    ' . $description . '
    </ol>
    <div class="page-header">
        <h2>升級本站的 XOOPS 至最新版本</h2>
    </div>';

    if ($_SESSION['tad_adm_isAdmin']) {
        $content .= '
        <ol>
            <li>' . modules_version() . '</li>
            <li>' . xoops_version() . '</li>
        </ol>';

        $content .= '
            <div class="page-header">
                <h2>備份</h2>
            </div>

            <h3 id="backup_sql">一、備份本站的資料庫資料</h3>
            <ol>
                <li>請先到<a href="' . XOOPS_URL . '/modules/system/admin.php?fct=modulesadmin" target="_blank">後台模組管理頁面</a>，將不需要的模組移除掉。</li>
                <li>建議在 <code>C:</code> 底下建立 <code>move</code> 資料夾，用來放置一些備份檔案</li>
                ' . download_sql() . '
            </ol>

            <h3 id="backup_files">二、備份本站的實體檔案</h3>
            <ol>
                <li>' . download_files() . '</li>
            </ol>

            <div class="page-header">
                <h2>還原</h2>
            </div>

            <h3>一、還原本站的資料庫資料</h3>
            <ol>
                ' . import_sql() . '
            </ol>

            <h3>二、還原本站的實體檔案</h3>
            <ol>
                ' . upload_files() . '
            </ol>

            <div class="page-header">
                <h2>搬移</h2>
            </div>

            <h3>一、上傳檔案到新主機</h3>
            <ol>
                ' . upload_modules() . '
            </ol>
            <h3>二、匯入資料庫到新主機</h3>
            <ol>
                ' . upload_sql() . '
                <li>至此，就大功告成囉！</li>
            </ol>';
    } else {
        $content .= '<div class="alert alert-danger">登入後始可使用自動檢測功能</div>';
        $content .= login_form();
    }

    $SyntaxHighlighter = new SyntaxHighlighter();
    $SyntaxHighlighterCode = $SyntaxHighlighter->render();
    echo Utility::html5($content, false, true, 4, true, 'container', 'XOOPS升級、備份、搬移指南', $SyntaxHighlighterCode);
}

function modules_version()
{
    global $latest_xoops_version, $max_xoops_version, $xoopsDB, $source_mod, $on, $off, $add, $up, $down;

    //抓出現有模組
    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('modules') . ' ORDER BY hasmain DESC, weight';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $need_update = false;
    $i = 0;
    $mod_msg = '';
    //模組部份
    $all_install_modules = [];
    while (false !== ($data = $xoopsDB->fetchArray($result))) {
        foreach ($data as $k => $v) {
            $$k = $v;
        }
        if (!isset($source_mod[$dirname])) {
            continue;
        }
        if ('module' === $source_mod[$dirname]['module']['kind']) {
            $version = (int) $version;
            $old_version = round($version / 100, 2);
            $new_version = $source_mod[$dirname]['module']['new_version'] * 100;
            $new_version = (int) $new_version;

            $last_update = filemtime(XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php");
            $new_last_update = $source_mod[$dirname]['module']['new_last_update'];

            $tad_adm = 'tad_adm' === $dirname ? '<span class="important">（站長工具箱務必第一個升級，否則其他模組無法升級）</span>' : '';

            if (($new_version > $version) or ($new_last_update > $last_update)) {
                $link = !empty($source_mod[$dirname]['module']['update_sn']) ? "<a href='" . XOOPS_URL . "/modules/tad_adm/admin/main.php?op=update_module&dirname={$dirname}&file_link={$source_mod[$dirname]['module']['file_link']}&update_sn={$source_mod[$dirname]['module']['update_sn']}&tad_adm_tpl=clean' target='_blank'>需先升級至最新的 {$source_mod[$dirname]['module']['new_version']}</a>" : "需先升級至最新的 {$source_mod[$dirname]['module']['new_version']}";

                $mod_msg .= "<li class='danger'>{$dirname} ($old_version) 模組{$link}{$tad_adm}</li>";
                $need_update = true;
                $i++;
            }
            // $mod_msg .= "<li>{$dirname} 模組已是最新</li>";
        }
    }

    $msg = ($need_update) ? "{$off}<a href='admin/main.php' target='_blank'>請點此至後台站長工具箱進行以下 {$i} 個模組升級</a><span class='important'>若升級過程中，遇到站長工具箱畫面變空白，<a href='" . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op=update&module=tad_adm' target='_blank'>請點此升級 tad_adm 即可</a>。</span>：<ol>{$mod_msg}</ol>" : "{$on}本站使用的模組均是最新版，模組版本部份沒問題了！";

    return $msg;
}

function xoops_version()
{
    global $latest_xoops_version, $max_xoops_version, $on, $off, $add, $up, $down, $isWin;

    $XOOPS_ROOT_PATH = XOOPS_ROOT_PATH;
    $XOOPS_VAR_PATH = XOOPS_VAR_PATH;
    $XOOPS_PATH = XOOPS_PATH;

    $now_xoops_version = OnlineUpgrade::get_version('xoops', XOOPS_VERSION);

    if ($now_xoops_version < $max_xoops_version) {
        $pic = $off;
        $msg2 = "新主機的 XOOPS 版本為 {$latest_xoops_version}，故請將本站也升級到 {$latest_xoops_version}";

        if ($isWin) {
            $ftp = '';
            $ftp2 = '覆蓋新檔案：';
        } else {
            $ftp = "<li>安裝<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FileZilla</a>，並啟動之，連線至本網站 <code>{$_SERVER['SERVER_NAME']}</code>，FileZilla 左邊切換至<code>C:\\move\\XoopsCore25-{$latest_xoops_version}_for_upgrade</code>，右邊按照以下指示切換。</li>";
            $ftp2 = "依序將底下目錄上傳<span class='important'>（左、右邊是指 FileZilla 的左右視窗）</span>：";
        }

        $htdocs_path = pathinfo(XOOPS_ROOT_PATH);
        $htdocs_dcspath = $htdocs_path['dirname'];
        if ('htdocs' !== $htdocs_path['basename']) {
            $htdocs = $isWin ? "先將 <code>C:\\move\\XoopsCore25-{$latest_xoops_version}_for_upgrade\\</code> 下的 <code>htdocs</code> 改名為 <code>{$htdocs_path['basename']}</code>，然後複製並覆蓋 <code>" . $XOOPS_ROOT_PATH . '</code> 即可。' : "先將左邊的 <code>htdocs</code> 改名為 <code>{$htdocs_path['basename']}</code>，右邊切換到 <code>{$htdocs_dcspath}</code>，然後上傳 <code>{$htdocs_path['basename']}</code> 覆蓋 <code>" . $XOOPS_ROOT_PATH . '</code>。';
        } else {
            $htdocs = $isWin ? "複製 <code>C:\\move\\XoopsCore25-{$latest_xoops_version}_for_upgrade\\{$htdocs_path['dirname']}</code> 並覆蓋 <code>" . $XOOPS_ROOT_PATH . '</code> 即可。' : "右邊切換到 <code>{$htdocs_dcspath}</code>，然後將左邊的 <code>htdocs</code> 上傳覆蓋<code>" . $XOOPS_ROOT_PATH . '</code> 即可。';
        }

        $xoops_data_path = pathinfo(XOOPS_VAR_PATH);
        $xoops_data_dcspath = $xoops_data_path['dirname'];
        if ('xoops_data' === $xoops_data_path['basename']) {
            $xoops_data = $isWin ? '複製 <code>C:\\move\\XoopsCore25-{$latest_xoops_version}_for_upgrade\\xoops_data</code> 並覆蓋 <code>' . $XOOPS_VAR_PATH . '</code> 即可。' : "右邊切換到 <code>{$xoops_data_dcspath}</code>，然後將左邊的 <code>xoops_data</code> 上傳覆蓋 <code>" . $XOOPS_VAR_PATH . '</code> 即可。';
        } else {
            $xoops_data = $isWin ? "先將 <code>C:\\move\\XoopsCore25-{$latest_xoops_version}_for_upgrade\\</code> 下的 <code>xoops_data</code> 改名為 <code>{$xoops_data_path['basename']}</code>，然後複製並覆蓋 <code>" . $XOOPS_VAR_PATH . '</code>即可。' : "先將左邊的 <code>xoops_data</code> 改名為 <code>{$xoops_data_path['basename']}</code>，右邊切換到 <code>{$xoops_data_dcspath}</code>，然後上傳 <code>{$xoops_data_path['basename']}</code> 覆蓋 <code>" . $XOOPS_VAR_PATH . '</code>。';
        }

        $xoops_lib_path = pathinfo(XOOPS_PATH);
        $xoops_lib_dcspath = $xoops_lib_path['dirname'];
        if ('xoops_lib' === $xoops_lib_path['basename']) {
            $xoops_lib = $isWin ? '複製 <code>C:\\move\\XoopsCore25-{$latest_xoops_version}_for_upgrade\\xoops_lib</code> 並覆蓋 <code>' . $XOOPS_PATH . '</code> 即可。' : "右邊切換到 <code>{$xoops_lib_dcspath}</code>，然後將左邊的 <code>xoops_lib</code> 上傳覆蓋 <code>" . $XOOPS_PATH . '</code> 即可。';
        } else {
            $xoops_lib = $isWin ? "先將 <code>C:\\move\\XoopsCore25-{$latest_xoops_version}_for_upgrade\\</code> 下的 <code>xoops_lib</code> 改名為 <code>{$xoops_data_path['basename']}</code>，然後複製並覆蓋 <code>" . $XOOPS_PATH . '</code>即可。' : "先將左邊的 <code>xoops_lib</code> 改名為 <code>{$xoops_lib_path['basename']}</code>，右邊切換到 <code>{$xoops_lib_dcspath}</code>，然後上傳 <code>{$xoops_lib_path['basename']}</code> 覆蓋 <code>" . $XOOPS_PATH . '</code>。';
        }

        $www = str_replace('xoops_lib', '', XOOPS_PATH);

        $legacy = '';
        if (is_dir(XOOPS_ROOT_PATH . '/modules/system/themes/legacy')) {
            $legacy = '<li>先將 <code>' . $XOOPS_ROOT_PATH . '/modules/system/themes/legacy</code> 目錄刪除，否則升級完後台會變空白</li>';
        }

        $mainfile_mode = get_mod(XOOPS_ROOT_PATH . '/mainfile.php');

        $mainfile_mode_txt = $isWin ? '請取消唯讀' : "權限設為 777 可寫入狀態（目前為 {$mainfile_mode}）。";

        $mainfile_w = '777' == $mainfile_mode ? '' : '<li>將 <code>' . $XOOPS_ROOT_PATH . "/mainfile.php</code> {$mainfile_mode_txt}</li>";

        $secure_mode = get_mod(XOOPS_VAR_PATH . '/data/secure.php');
        $secure_mode_txt = $isWin ? '請取消唯讀' : "權限設為 777 可寫入狀態（目前為 {$secure_mode}）。";

        $secure_w = '777' == $secure_mode ? '' : '<li>將 <code>' . $XOOPS_VAR_PATH . "/data/secure.php</code> {$secure_mode_txt}</li>";

        $xoops_data_mode = get_mod(XOOPS_VAR_PATH);

        $xoops_data_w = '777' == $xoops_data_mode ? '' : '<li>將 <code>' . $XOOPS_VAR_PATH . "</code>（含底下所有目錄及檔案）權限均設為 777 可寫入狀態（目前為 {$xoops_data_mode}）。</li>";

        if (version_compare(phpversion(), '5.3.7', '<')) {
            $php_version = "{$off}本主機的 PHP 版本為 " . phpversion() . "，低於 5.3.7，所以，升級為 XOOPS $latest_xoops_version 後部份功能會有問題（例如：選單會消失、密碼會變空白）。<ul><li>如果您的目的是升級而非搬移，建議您就別升級了，升級完是無法正常使用的。</li><li>如果您是要搬到新主機的，那可以繼續進行，因為升級的目的只在於產生正確的資料表結構，所以，即使升級後，本站運作不正常也沒關係（盡量別登出又登入），只要本頁面能正常運作即可，到時搬到新主機便會一切正常。</li></ul>";
        } else {
            $php_version = "{$on}本主機的 PHP 版本為 " . phpversion() . "，高於 5.3.7，所以可以升級為 XOOPS $latest_xoops_version 沒問題。";
        }

        $msg3 = "
        <div class='well card card-body bg-light' id='upgrade_step'>
        <ol>
            <li>$php_version</li>

            <li>{$add}請建立 <code>C:\\move\\</code>，作為備份檔案暫存區。</li>

            <li>{$down}下載 <a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=146&cat_sn=16'>XOOPS $latest_xoops_version 正體中文版 2017-08-03（升級用） </a>，並儲存到 <code>C:\\move\\</code></li>

            <li>{$add}滑鼠移到 <code>C:\\move\\XoopsCore25-{$latest_xoops_version}_tw_for_upgrade_20170803.zip</code> 上方按右鍵，點擊「解壓縮至此」（以7-zip為例，總之，可以解壓縮即可）</li>

            $ftp
            $legacy
            $mainfile_w
            $xoops_data_w
            $secure_w
            <li>$ftp2
                <ul>
                    <li>{$up}{$htdocs}</li>
                    <li>{$up}{$xoops_data}</li>
                    <li>{$up}{$xoops_lib}</li>
                </ul>
            </li>

            <li>請點擊 <a href='" . XOOPS_URL . "/upgrade/' target='_blank'>" . XOOPS_URL . "/upgrade/</a> 升級程式，按照畫面指示進行資料庫升級。</li>
            <li>升級完畢後請點擊：<a href='" . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin' target='_blank'>模組管理界面</a>，若是發現內容區一片空白，請登入為管理員後，執行：<a href='" . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op=update&module=system' target='_blank'>System模組升級</a>。</li>
        </ol>
        </div>";
    } else {
        $pic = $on;
        $msg2 = '已是最新，所以，無需再升級！';
        $msg3 = '';
    }
    $msg4 = '';
    $msg = "{$pic}您目前網站版本為：<span class='important'>" . XOOPS_VERSION . "</span>，{$msg2}{$msg3}";

    return $msg;
}

function upload_modules()
{
    global $latest_xoops_version, $max_xoops_version, $source_mod, $on, $off, $add, $up, $down, $xoopsDB, $system_mods;

    $new_url = $_SESSION['new_url'] ? $_SESSION['new_url'] : 'http://新主機的網址';

    $msg = "<li>確定已經完成「<a href='#backup_files'>備份本站的實體檔案</a>」</li>
    <li>開啟 <code>C:\\move\\" . basename(XOOPS_ROOT_PATH) . "\\mainfile.php</code>，我們必須修改其網址及路徑設定才行。
        <ol>
            <li>若是有看到「//自動取得網址」，表示是用輕鬆架版的 <code>mainfile.php</code>，如此會自動偵測，無須修改。</li>
            <li>若無該字樣，請修改底下幾個設定<span class='danger'>（目錄最後不要有 /）</span>，修改後存檔：
                <div class='alert alert-warning'>
                    define('XOOPS_ROOT_PATH', '新主機的網頁目錄'); <br>
                    define('XOOPS_PATH', '新主機的 <code>xoops_lib</code> 目錄'); <br>
                    define('XOOPS_VAR_PATH', '新主機的 <code>xoops_data</code> 目錄');<br>
                    define('XOOPS_URL', '{$new_url}');
                </div>
                以下假設新主機的網頁目錄位置在「<code>/var/www/html</code>」請自行依照實際狀況修改。如：
                <pre class='brush:php;gutter:false;'>
                    define('XOOPS_ROOT_PATH', '/var/www/html');
                    define('XOOPS_PATH', '/var/www/xoops_lib');
                    define('XOOPS_VAR_PATH', '/var/www/xoops_data');
                    define('XOOPS_URL', '{$new_url}');
                </pre>
            </li>
        </ol>
    </li>

    <li>開啟 <code>C:\\move\\xoops_data\\data\\secure.php</code>，這是資料庫設定檔，要修改成新主機的資料庫資料，修改後請存檔：
        <pre class='brush:php;gutter:false;'>
            define('XOOPS_DB_USER', '新主機的資料庫帳號');
            define('XOOPS_DB_PASS', '新主機的資料庫密碼');
            define('XOOPS_DB_NAME', '新主機的資料庫名稱');
        </pre>
    </li>

    <li>接著用FTP軟體（如：<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FileZilla</a>）登入到新主機，將 FileZilla 左邊切換至 <code>C:\\move\\</code>，右邊切換至新主機的網頁目錄下，例如：/var/www/ 下。</li>
    <li>{$up}將左邊的 <span class='danger'>C:\\move\\" . basename(XOOPS_ROOT_PATH) . "</span>下的所有目錄檔案，上傳到新主機的網頁目錄下</li>
    <li>{$up}將左邊的 <span class='danger'>C:\\move\\</span> 中的 <span class='danger'>" . basename(XOOPS_VAR_PATH) . "</span> 及 <span class='danger'>" . basename(XOOPS_PATH) . "</span>，上傳到新主機，和網頁目錄放在同一層。</li>
    <li>若新主機是 Linux、FreeBSD 環境，記得進行權限設定，將 <code>xoops_data</code>、<code>網頁目錄/uploads</code> 設為 777
        <div class='alert alert-success'>
            chmod -R 777 xoops_data<br>
            chmod -R 777 網頁目錄/uploads<br>
        </div>
        如：
        <pre class='brush:bash;gutter:false;'>
            chmod -R 777 /var/www/html/uploads
            chmod -R 777 /var/www/xoops_data
        </pre>
    </li>";

    return $msg;
}

function download_files()
{
    global $latest_xoops_version, $max_xoops_version, $source_mod, $on, $off, $add, $up, $down, $isWin;

    $XOOPS_ROOT_PATH = XOOPS_ROOT_PATH;

    $public_html_size = format_size(GetDirectorySize(XOOPS_ROOT_PATH));
    $xoops_data_size = format_size(GetDirectorySize(XOOPS_VAR_PATH));
    $xoops_lib_size = format_size(GetDirectorySize(XOOPS_PATH));

    $filezilla = '';
    $filezilla = $isWin ? '' : "<div class='alert alert-info'>請先用FTP軟體（如：<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FileZilla</a>）登入本網站 <code>" . $_SERVER['SERVER_NAME'] . '</code>，左邊切換至<code>C:\\move\\</code>，右邊切換到 <code>' . dirname(XOOPS_ROOT_PATH) . "/</code>，將 <span class='danger'>" . basename(XOOPS_ROOT_PATH) . "</span>、<span class='danger'>" . basename(XOOPS_VAR_PATH) . "</span>、<span class='danger'>" . basename(XOOPS_PATH) . "</span> 三個資料夾下載到左邊的 <code>C:\\move\\</code> 底下即可。</div>";

    $mod_msg = "<li class='important'>{$down}" . XOOPS_ROOT_PATH . "（約 {$public_html_size}）</li>
    <li class='important'>{$down}" . XOOPS_VAR_PATH . "（約 {$xoops_data_size}）</li>
    <li class='important'>{$down}" . XOOPS_PATH . "（約 {$xoops_lib_size}）</li>";

    $msg = "底下是XOOPS實體檔案，請自行用FTP軟體下載到 <code>C:\\move\\</code> 底下：<ul>{$mod_msg}{$filezilla}</ul>";

    return $msg;
}

function upload_files()
{
    global $latest_xoops_version, $max_xoops_version, $source_mod, $on, $off, $add, $up, $down;

    $msg = "<li>請先用FTP軟體（如：<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FileZilla</a>）登入本網站 <code>" . $_SERVER['SERVER_NAME'] . "</code>，將 FileZilla 左邊切換至 <code>C:\\move\\</code>，右邊切換至 <code>" . dirname(XOOPS_ROOT_PATH) . "/</code></li>
    <li>{$up}將左邊的 <span class='danger'>" . basename(XOOPS_ROOT_PATH) . "</span>、<span class='danger'>" . basename(XOOPS_VAR_PATH) . "</span>、<span class='danger'>" . basename(XOOPS_PATH) . "</span> 三個資料夾上傳到 <code>" . dirname(XOOPS_ROOT_PATH) . "/</code> 下覆寫原本目錄、檔案即可。</li>";

    return $msg;
}

function download_sql()
{
    global $latest_xoops_version, $max_xoops_version, $xoopsDB, $source_mod, $on, $off, $add, $up, $down;

    $sql = "SELECT
    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2)
    FROM information_schema.TABLES
    WHERE table_schema='" . XOOPS_DB_NAME . "'";

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($dbsize) = $xoopsDB->fetchRow($result);

    $tn_note = '';
    $new_url = $_SESSION['new_url'] ? $_SESSION['new_url'] : ' http://新主機的網址 ';
    $value = $_SESSION['new_url'] ? $_SESSION['new_url'] : '';

    $msg = '
    <li>若只是單純要做本站的資料庫備份，請按 <a href="' . $_SERVER['PHP_SELF'] . '?op=export_sql" class="btn btn-success"><img src="images/icons/down.png" alt="down" style="width:16px; margin-right: 4px;">下載 SQL 檔（約 ' . $dbsize . ' MB）</a> 即可。</li>
    <li>若是要搬移到新主機的，我們必須將資料庫中的本站網址替換成<span class="important">' . $new_url . '</span>（如此一些連結或圖片才能正常顯示），故請在下方填入新主機的網址<span class="danger">（網址最後不要有 /）</span>。' . $tn_note . '<p>
    <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="sizing-addon1">請輸入新主機的網址：</span>
            </div>
            <input type="text" name="new_url" class="form-control" value="' . $value . '">
            <span class="input-group-btn">
            <input type="hidden" name="op" value="export_sql">
            <button class="btn btn-primary" type="submit"><img src="images/icons/down.png" alt="down" style="width:16px; margin-right: 4px;">下載 SQL 檔（約 ' . $dbsize . ' MB）</button>
            </span>
        </div>
    </form></p>

    <div class="alert alert-warning">
        若是無法成功下載 mysql.sql，那麼，只能手動處理（底下就是上述程式自動處理的部份）：
        <ol>
            <li>請手動連至<a href="' . XOOPS_URL . '/modules/tad_adm/pma.php?username=' . XOOPS_DB_USER . '&db=' . XOOPS_DB_NAME . '&dump=" target="_blank">資料庫的匯出程式</a>，選擇「儲存」，並按「匯出」即可，存成 <code>C:\\move\\mysql.sql</code></li>
            <li>開啟文字編輯器，開啟 <code>C:\\move\\mysql.sql</code>，並執行取代功能（一般是 <kbd>Ctrl</kbd>+<kbd>H</kbd>）。</li>
            <li>搜尋 <code>' . XOOPS_URL . '</code>，取代成<span class="important">' . $new_url . '</span></li>
            ' . $replace . '
            <li>儲存</li>
    </div></li>';

    return $msg;
}

function export_sql($new_url = '')
{
    if (!$_SESSION['tad_adm_isAdmin']) {
        redirect_header($_SERVER['PHP_SELF'], 3, '不具備管理身份');
    }

    if ($new_url) {
        if ('/' === mb_substr($new_url, -1)) {
            $new_url = mb_substr($new_url, 0, -1);
        }
    }

    set_time_limit(0);
    ignore_user_abort(true);

    $randname = date('YmdHis') . '-' . md5(Utility::randStr(8));
    $filename = XOOPS_ROOT_PATH . "/uploads/tad_adm/mysql-{$randname}.sql";
    $filename_url = XOOPS_URL . "/uploads/tad_adm/mysql-{$randname}.sql";
    if (file_exists($filename)) {
        unlink($filename);
    }

    try {
        $dump = new IMysqldump('mysql:host=' . XOOPS_DB_HOST . ';dbname=' . XOOPS_DB_NAME, XOOPS_DB_USER, XOOPS_DB_PASS, ['add-drop-table' => true, 'skip-triggers' => true, 'skip-comments' => true]);
        $dump->start($filename);
    } catch (\Exception $e) {
        echo 'mysqldump-php error: ' . $e->getMessage();
    }

    $new_content = file_get_contents($filename_url);

    if ($new_url) {
        $new_content = str_replace(XOOPS_URL, $new_url, $new_content);
    }

    header('Content-type: text/sql');
    header("Content-Disposition: attachment; filename=mysql-{$randname}.sql");
    echo $new_content;
    unlink($filename);
    exit;
}

function import_sql()
{
    global $latest_xoops_version, $max_xoops_version, $source_mod, $on, $off, $add, $up, $down;

    $msg = "<li>請登入本站的資料庫管理（<a href='" . XOOPS_URL . "/modules/tad_adm/pma.php' target='_blank'>" . XOOPS_URL . "/modules/tad_adm/pma.php</a>），執行「匯入」。</li>
    <li>{$up}點擊 <kbd>瀏覽</kbd> 按鈕，並選取<code>C:\\move\\mysql.sql</code>，再按 <kbd>執行</kbd> 以匯入資料庫內容即可。</li>";
    return $msg;
}

function upload_sql()
{
    global $latest_xoops_version, $max_xoops_version, $source_mod, $on, $off, $add, $up, $down;

    $new_url = $_SESSION['new_url'] ? $_SESSION['new_url'] : 'http://新主機的網址';
    $pma_url = $_SESSION['new_url'] ? "<a href='{$new_url}/modules/tad_adm/pma.php' target='_blank'>{$new_url}/modules/tad_adm/pma.php</a>" : 'http://新主機的網址/modules/tad_adm/pma.php';

    $msg = "
    <li>確定已經完成「<a href='#backup_sql'>備份本站的資料庫資料</a>」的第 4 點，取得修改過網址後的 <code>mysql-xxxx.sql</code> 檔</li>
    <li>最後，請登入新主機的資料庫管理（如：{$pma_url}），執行「匯入」</li>
    <li>{$up}點擊 <kbd>瀏覽</kbd> 按鈕，並選取 <code>C:\\move\\mysql-xxxx.sql</code>，再按 <kbd>執行</kbd> 以匯入到資料庫中即可。</li>";

    return $msg;
}

function login_form()
{
    $form = '
    <div class="card">
        <div class="card-header text-white bg-primary">' . _MD_TADADM_LOGIN . '</div>
        <div class="card-body">

            <form action="' . XOOPS_URL . '/user.php" method="post" role="form">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-md-right" for="uname">' . _MD_TADADM_USER_S_ID . '</label>
                    <div class="col-sm-9">
                        <input type="text" name="uname"  id="uname" placeholder="' . _MD_TADADM_USER_ID . '"  class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-md-right" for="pass">' . _MD_TADADM_USER_S_PASS . '</label>
                    <div class="col-sm-9">
                        <input type="password" name="pass"  id="pass" placeholder="' . _MD_TADADM_USER_S_PASS . '"  class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-md-right">
                    </label>
                    <div class="col-sm-9">
                        <input type="hidden" name="op" value="login">
                        <input type="hidden" name="xoops_redirect" value="' . $_SERVER['PHP_SELF'] . '">
                        <button type="submit" class="btn btn-primary">' . _MD_TADADM_LOGIN . '</button>
                    </div>
                </div>
            </form>
        </div>
    </div>';

    return $form;
}

function get_mod($dir)
{
    $stat = stat($dir);
    $mode = mb_substr(decoct($stat[mode]), -3);

    return $mode;
}
