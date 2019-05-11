<?php
require_once dirname(dirname(__DIR__)) . '/mainfile.php';

$isTN = false !== mb_strpos(XOOPS_URL, '.tn.edu.tw') ? true : false;
$isDCS = false !== mb_strpos(XOOPS_ROOT_PATH, 'DWASFiles') ? true : false;
$isWin = 'WIN' === mb_strtoupper(mb_substr(PHP_OS, 0, 3)) ? true : false;
$isSchoolWeb = (false !== mb_strpos(XOOPS_URL, 'schoolweb.tn.edu.tw') or false !== mb_strpos(XOOPS_URL, '120.115.2.88')) ? true : false;

require_once XOOPS_ROOT_PATH . "/modules/tadtools/language/{$xoopsConfig['language']}/main.php";
require_once __DIR__ . '/function.php';
require_once __DIR__ . '/admin/adm_function.php';

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

$source_mod = get_tad_json_info('all.json');

require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$new_url = system_CleanVars($_REQUEST, 'new_url', '', 'string');
$dir = system_CleanVars($_REQUEST, 'dir', '', 'string');
$schoolweb_id = system_CleanVars($_REQUEST, 'schoolweb_id', '', 'string');

switch ($op) {
    case 'export_sql':
        export_sql($new_url);
        break;
    case 'download_zip':
        download_zip($dir);
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
    global $isDCS, $isTN, $isSchoolWeb;
    $id = '帳號';
    if (mb_strpos($_SERVER['SERVER_NAME'], '.tn.edu.tw')) {
        $str = str_replace('.tn.edu.tw', '', $_SERVER['SERVER_NAME']);
        $s = explode('.', $str);
        $id = $s[1] ? "{$s[1]}_{$s[0]}" : $s[0];
        if (isset($_SESSION['schoolweb_id'])) {
            $_SESSION['schoolweb_id'] = $id;
        }
    }

    $description = $isTN ? '<li>此工具是針對<a href="https://schoolweb.tn.edu.tw/index.php" target="_blank">台南市政府教育局校園集中式網站</a>而製作的，協助台南市學校從原本的網站搬移至該主機。</li>
    <li>由於集中式網站的XOOPS及所有模組都是最新版，因此，要搬過去之前，必須先將自身網站也升級到最新版，始能無痛搬移。</li>
    <li>請先到<a href="https://schoolweb.tn.edu.tw/index.php" target="_blank">台南市政府教育局校園集中式網站</a>申請一個網站（已申請過就直接填即可），並填入該新網站的帳號名稱（~符號後面的名字，如：<span class="important">' . $id . '</span>）：<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="sizing-addon1">http://schoolweb.tn.edu.tw/~</span>
        </div>
        <input type="text" name="schoolweb_id" class="form-control" placeholder="如：' . $id . '" value="' . $_SESSION['schoolweb_id'] . '">
        <span class="input-group-btn">
        <input type="hidden" name="op" value="save_schoolweb_id">
        <button class="btn btn-primary" type="submit">儲存</button>
        </span>
    </div>
    </form></li>
    ' . $dcs_note . '' : '<li>本程式會自動偵測環境，並提出升級至 XOOPS 2.5.9 的建議及步驟。</li>
    <li>請盡量使用網域名稱，以得到正確建議。</li>';

    if ($isSchoolWeb) {
        $description = '<li>您的網站已經是放在台南市教育局集中式網站中，版本永遠是最新的，所以，以下資訊僅供參考，無需使用。</li>';
    }

    $dcs_note = $isDCS ? "<li class='danger'>您的網站目前是放在台南是的DCS飛番雲上，DCS有嚴重的快取延遲問題（例如程式已經更新，但網站卻仍顯示舊的），故若有任何不正常情況發生（尤其在升級更新時），請登入 <a href='https://cloud.dcs.tn.edu.tw' target='_blank'>https://cloud.dcs.tn.edu.tw</a>，並隨時進行「重啟網站」。</li>" : '';

    $content = '
    <style>

    li{
        font-size:14pt;
        padding:6px;
        font-family: 微軟正黑體;
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
        <h1>網站升級、搬移指南</h1>
    </div>
    <ol>
    ' . $description . '
    </ol>
    <div class="page-header">
        <h2>升級網站至最新版本</h2>
    </div>';

    if ($_SESSION['tad_adm_isAdmin']) {
        $content .= '
        <ol>
            <li>' . modules_version() . '</li>
            <li>' . xoops_version() . '</li>
        </ol>';

        if ($isTN) {
            $content .= '
            <div class="page-header">
                <h2>下載必要的檔案</h2>
            </div>
            <ol>
                <li>若暫存目錄 <code>C:\\move</code> 不存在，請先建立之，並在底下建立 <code>modules</code> 及 <code>themes</code> 兩個資料夾。</li>
                <li>請先到<a href="' . XOOPS_URL . '/modules/system/admin.php?fct=modulesadmin" target="_blank">後台模組管理頁面</a>，將不需要的模組移除掉。</li>
                <li>' . download_modules() . '</li>
                <li>' . download_themes() . '</li>
                <li>' . download_uploads() . '</li>
                <li>' . download_sql() . '</li>
            </ol>
            <div class="page-header">
                <h2>開始搬移網站</h2>
            </div>
            <ol>
                <li>' . upload_modules() . '</li>
                <li>' . upload_themes() . '</li>
                <li>' . upload_uploads() . '</li>
                <li>' . upload_sql() . '</li>
                <li>至此，就大功告成囉！</li>
            </ol>';
        } else {
            $content .= '
            <div class="page-header">
                <h2>備份網站資料</h2>
            </div>
            <ol>
                <li>請先到<a href="' . XOOPS_URL . '/modules/system/admin.php?fct=modulesadmin" target="_blank">後台模組管理頁面</a>，將不需要的模組移除掉。</li>
                <li>' . download_sql() . '</li>
            </ol>
            <div class="page-header">
                <h2>開始搬移網站</h2>
            </div>
            <ol>
                <li>' . upload_modules() . '</li>
                <li>' . upload_sql() . '</li>
                <li>至此，就大功告成囉！</li>
            </ol>';
        }
    } else {
        $content .= '<div class="alert alert-danger">登入後始可使用自動檢測功能</div>';
        $content .= login_form();
    }

    // echo html5($content, false, true, 3, true, 'container-fluid');
    echo html5($content, false, true, 4);
}

function modules_version()
{
    global $xoopsDB, $source_mod, $on, $off, $add, $up, $down;

    //抓出現有模組
    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('modules') . ' ORDER BY hasmain DESC, weight';
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
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

    $msg = ($need_update) ? "{$off}<a href='admin/main.php' target='_blank'>請點此至後台站長工具箱進行以下 {$i} 個模組升級</a><span class='important'>若更新過程中，遇到站長工具箱畫面變空白，<a href='" . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op=update&module=tad_adm' target='_blank'>請點此更新 tad_adm 即可</a>。</span>：<ol>{$mod_msg}</ol>" : "{$on}本站使用的模組均是最新版，模組版本部份沒問題了！";

    return $msg;
}

function get_ftp_path($path)
{
    global $isDCS;
    if ($isDCS) {
        $d = explode('/site/', $path);
        $new_path = "/site/{$d[1]}";
    } else {
        $new_path = $path;
    }

    return $new_path;
}

function xoops_version()
{
    global $on, $off, $add, $up, $down, $isWin, $isDCS;

    $XOOPS_ROOT_PATH = get_ftp_path(XOOPS_ROOT_PATH);
    $XOOPS_VAR_PATH = get_ftp_path(XOOPS_VAR_PATH);
    $XOOPS_PATH = get_ftp_path(XOOPS_PATH);

    if (XOOPS_VERSION !== 'XOOPS 2.5.9') {
        $pic = $off;
        $msg2 = '新主機的 XOOPS 版本為 2.5.9，故請將本站也升級到 2.5.9';

        if ($isDCS) {
            $ftp = "<li>安裝<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FileZilla</a>，並啟動之，連線至本網站 <code>ftp.dcs.tn.edu.tw</code>，FileZilla 左邊切換至<code>C:\\move\\XoopsCore25-2.5.9_for_upgrade</code>，右邊按照以下指示切換。</li>";
            $ftp2 = "依序將底下目錄上傳<span class='important'>（左、右邊是指 FileZilla 的左右視窗）</span>：";
        } elseif ($isWin) {
            $ftp = '';
            $ftp2 = '覆蓋新檔案：';
        } else {
            $ftp = "<li>安裝<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FileZilla</a>，並啟動之，連線至本網站 <code>" . $_SERVER['SERVER_NAME'] . '</code>，FileZilla 左邊切換至<code>C:\\move\\XoopsCore25-2.5.9_for_upgrade</code>，右邊按照以下指示切換。</li>';
            $ftp2 = "依序將底下目錄上傳<span class='important'>（左、右邊是指 FileZilla 的左右視窗）</span>：";
        }

        $htdocs_path = pathinfo(XOOPS_ROOT_PATH);
        $htdocs_dcspath = get_ftp_path($htdocs_path['dirname']);
        if ('htdocs' !== $htdocs_path['basename']) {
            $htdocs = ($isWin and !$isDCS) ? "先將 <code>C:\\move\\XoopsCore25-2.5.9_for_upgrade\\</code> 下的 <code>htdocs</code> 改名為 <code>{$htdocs_path['basename']}</code>，然後複製並覆蓋 <code>" . $XOOPS_ROOT_PATH . '</code> 即可。' : "先將左邊的 <code>htdocs</code> 改名為 <code>{$htdocs_path['basename']}</code>，右邊切換到 <code>{$htdocs_dcspath}</code>，然後上傳 <code>{$htdocs_path['basename']}</code> 覆蓋 <code>" . $XOOPS_ROOT_PATH . '</code>。';
        } else {
            $htdocs = ($isWin and !$isDCS) ? "複製 <code>C:\\move\\XoopsCore25-2.5.9_for_upgrade\\{$htdocs_path['dirname']}</code> 並覆蓋 <code>" . $XOOPS_ROOT_PATH . '</code> 即可。' : "右邊切換到 <code>{$htdocs_dcspath}</code>，然後將左邊的 <code>htdocs</code> 上傳覆蓋<code>" . $XOOPS_ROOT_PATH . '</code> 即可。';
        }

        $xoops_data_path = pathinfo(XOOPS_VAR_PATH);
        $xoops_data_dcspath = get_ftp_path($xoops_data_path['dirname']);
        if ('xoops_data' === $xoops_data_path['basename']) {
            $xoops_data = ($isWin and !$isDCS) ? '複製 <code>C:\\move\\XoopsCore25-2.5.9_for_upgrade\\xoops_data</code> 並覆蓋 <code>' . $XOOPS_VAR_PATH . '</code> 即可。' : "右邊切換到 <code>{$xoops_data_dcspath}</code>，然後將左邊的 <code>xoops_data</code> 上傳覆蓋 <code>" . $XOOPS_VAR_PATH . '</code> 即可。';
        } else {
            $xoops_data = ($isWin and !$isDCS) ? "先將 <code>C:\\move\\XoopsCore25-2.5.9_for_upgrade\\</code> 下的 <code>xoops_data</code> 改名為 <code>{$xoops_data_path['basename']}</code>，然後複製並覆蓋 <code>" . $XOOPS_VAR_PATH . '</code>即可。' : "先將左邊的 <code>xoops_data</code> 改名為 <code>{$xoops_data_path['basename']}</code>，右邊切換到 <code>{$xoops_data_dcspath}</code>，然後上傳 <code>{$xoops_data_path['basename']}</code> 覆蓋 <code>" . $XOOPS_VAR_PATH . '</code>。';
        }

        $xoops_lib_path = pathinfo(XOOPS_PATH);
        $xoops_lib_dcspath = get_ftp_path($xoops_lib_path['dirname']);
        if ('xoops_lib' === $xoops_lib_path['basename']) {
            $xoops_lib = ($isWin and !$isDCS) ? '複製 <code>C:\\move\\XoopsCore25-2.5.9_for_upgrade\\xoops_lib</code> 並覆蓋 <code>' . $XOOPS_PATH . '</code> 即可。' : "右邊切換到 <code>{$xoops_lib_dcspath}</code>，然後將左邊的 <code>xoops_lib</code> 上傳覆蓋 <code>" . $XOOPS_PATH . '</code> 即可。';
        } else {
            $xoops_lib = ($isWin and !$isDCS) ? "先將 <code>C:\\move\\XoopsCore25-2.5.9_for_upgrade\\</code> 下的 <code>xoops_lib</code> 改名為 <code>{$xoops_data_path['basename']}</code>，然後複製並覆蓋 <code>" . $XOOPS_PATH . '</code>即可。' : "先將左邊的 <code>xoops_lib</code> 改名為 <code>{$xoops_lib_path['basename']}</code>，右邊切換到 <code>{$xoops_lib_dcspath}</code>，然後上傳 <code>{$xoops_lib_path['basename']}</code> 覆蓋 <code>" . $XOOPS_PATH . '</code>。';
        }

        $www = str_replace('xoops_lib', '', XOOPS_PATH);

        $legacy = '';
        if (is_dir(XOOPS_ROOT_PATH . '/modules/system/themes/legacy')) {
            $legacy = '<li>先將 <code>' . $XOOPS_ROOT_PATH . '/modules/system/themes/legacy</code> 目錄刪除，否則升級完後台會變空白</li>';
        }

        $mainfile_mode = get_mod(XOOPS_ROOT_PATH . '/mainfile.php');
        if ($isDCS) {
            $mainfile_mode_txt = '取消唯讀（若無法取消唯讀，可先將 mainfile.php 下載，然後把 DCS 上的 mainfile.php 改名為 mainfile.bak.php，接著再把剛下載的 mainfile.php 上傳即可）';
        } else {
            $mainfile_mode_txt = ($isWin and !$isDCS) ? '請取消唯讀' : "權限設為 777 可寫入狀態（目前為 {$mainfile_mode}）。";
        }

        $mainfile_w = '777' == $mainfile_mode ? '' : '<li>將 <code>' . $XOOPS_ROOT_PATH . "/mainfile.php</code> {$mainfile_mode_txt}</li>";

        $secure_mode = get_mod(XOOPS_VAR_PATH . '/data/secure.php');
        $secure_mode_txt = ($isWin and !$isDCS) ? '請取消唯讀' : "權限設為 777 可寫入狀態（目前為 {$secure_mode}）。";
        if ($isDCS) {
            $secure_w = '';
        } else {
            $secure_w = '777' == $secure_mode ? '' : '<li>將 <code>' . $XOOPS_VAR_PATH . "/data/secure.php</code> {$secure_mode_txt}</li>";
        }

        $xoops_data_mode = get_mod(XOOPS_VAR_PATH);
        if ($isDCS) {
            $xoops_data_w = '';
        } else {
            $xoops_data_w = '777' == $xoops_data_mode ? '' : '<li>將 <code>' . $XOOPS_VAR_PATH . "</code>（含底下所有目錄及檔案）權限均設為 777 可寫入狀態（目前為 {$xoops_data_mode}）。</li>";
        }

        if (version_compare(phpversion(), '5.3.7', '<')) {
            $php_version = "{$off}本主機的 PHP 版本為 " . phpversion() . '，低於 5.3.7，所以，升級為 XOOPS 2.5.9 後部份功能會有問題（例如：選單會消失、密碼會變空白）。<ul><li>如果您的目的是升級而非搬移，建議您就別升級了，升級完是無法正常使用的。</li><li>如果您是要搬到新主機的，那可以繼續進行，因為升級的目的只在於產生正確的資料表結構，所以，即使升級後，本站運作不正常也沒關係（盡量別登出又登入），只要本頁面能正常運作即可，到時搬到新主機便會一切正常。</li></ul>';
        } else {
            $php_version = "{$on}本主機的 PHP 版本為 " . phpversion() . '，高於 5.3.7，所以可以升級為 XOOPS 2.5.9 沒問題。';
        }

        $msg3 = "
        <div class='well card card-body bg-light' id='upgrade_step'>
        <ol>
            <li>$php_version</li>

            <li>{$add}請建立 <code>C:\\move\\</code>，作為備份檔案暫存區。</li>

            <li>{$down}下載 <a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=146&cat_sn=16'>XOOPS 2.5.9 正體中文版 2017-08-03（升級用） </a>，並儲存到 <code>C:\\move\\</code></li>

            <li>{$add}滑鼠移到 <code>C:\\move\\XoopsCore25-2.5.9_tw_for_upgrade_20170803.zip</code> 上方按右鍵，點擊「解壓縮至此」（以7-zip為例，總之，可以解壓縮即可）</li>

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

function download_modules()
{
    global $source_mod, $on, $off, $add, $up, $down, $xoopsDB, $system_mods, $bad_mods, $isTN;

    $mypath = XOOPS_ROOT_PATH . '/modules/';
    $d = opendir($mypath);
    $mod_msg = '';
    $need_down = [];
    $download = false;

    $db_mod = [];
    $sql = 'SELECT `dirname` FROM `' . $xoopsDB->prefix('modules') . '`';
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
    while (list($dirname) = $xoopsDB->fetchRow($result)) {
        $db_mod[] = $dirname;
    }

    while (false !== ($file = readdir($d))) {
        if ('.' !== $file && '..' !== $file) {
            $typepath = $mypath . $file;
            if (!in_array($file, $db_mod)) {
                continue;
            }
            if ('dir' === filetype($typepath)) {
                if ((!isset($source_mod[$file]) and !in_array($file, $system_mods)) or isset($bad_mods[$file])) {
                    $dir_size = format_size(GetDirectorySize($typepath));
                    if (isset($bad_mods[$file])) {
                        $class = 'danger';
                        $pic = $off;
                        $note = "有資安問題或 PHP7 不支援的模組，建議<a href='" . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin' target='_blank'>移除</a>，並改用 <a href='https://campus-xoops.tn.edu.tw/modules/tad_modules/index.php?module_sn={$bad_mods[$file][1]}' target='_blank'>{$bad_mods[$file][0]}</a> 取代之";
                    } else {
                        $class = 'important';
                        $pic = $down;
                        $note = '下載完成後，按右鍵「解壓縮至此」解壓之';
                    }
                    $mod_msg .= "<li class='$class'><a href='{$_SERVER['PHP_SELF']}?op=download_zip&dir={$typepath}'>{$pic}{$typepath}</a>（約 {$dir_size}）{$note}</li>";
                    $download = true;
                    $_SESSION['zip_del']["{$file}.zip"] = "{$file}.zip";
                }
            }
        }
    }

    $msg .= ($download) ? "底下是貴站有用到的模組，但在集中式主機並不提供，故需自行下載到 <code>C:\\move\\modules\\</code> ：<ul>{$mod_msg}</ul>" : "{$on}貴站所需模組，集中式主機上均有，故無須自行下載。";

    return $msg;
}

function upload_modules()
{
    global $source_mod, $on, $off, $add, $up, $down, $xoopsDB, $system_mods, $isTN;
    if ($isTN) {
        $mypath = XOOPS_ROOT_PATH . '/modules/';
        $d = opendir($mypath);
        $mod_msg = '';
        $need_up = [];
        $db_mod = [];
        $sql = 'SELECT `dirname` FROM `' . $xoopsDB->prefix('modules') . '`';
        $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
        while (list($dirname) = $xoopsDB->fetchRow($result)) {
            $db_mod[] = $dirname;
        }
        while (false !== ($file = readdir($d))) {
            if ('.' !== $file && '..' !== $file) {
                $typepath = $mypath . $file;

                if (!in_array($file, $db_mod)) {
                    continue;
                }
                if ('dir' === filetype($typepath)) {
                    if (!isset($source_mod[$file]) and !in_array($file, $system_mods)) {
                        $need_up[] = "<span class='danger'>$file</span>";
                    }
                }
            }
        }

        $need_up_mods = implode('、', $need_up);

        $msg = ($need_up_mods) ? "{$up}請將 <code>C:\\move\\modules\\</code> 裡面的 {$need_up_mods} 模組資料夾上傳到新主機的 <code>/public_html/modules/</code> 底下即可。" : "{$on}貴站所需模組，集中式主機上均有，故無須自行下載。";
    } else {
        $msg = '將 <code>' . XOOPS_ROOT_PATH . '</code> 下的所有檔案及目錄均上傳至新網站的網頁目錄</li>
        <li>將 <code>' . XOOPS_VAR_PATH . '</code> 下的所有檔案及目錄均上傳至新網站的 <code>xoops_data</code> 目錄下</li>
        <li>將 <code>' . XOOPS_PATH . "</code> 下的所有檔案及目錄均上傳至新網站的 <code>xoops_lib</code> 目錄下</li>
        <li>開啟新主機的 mainfile.php，修改其網址及路徑。</li>
        <li>若是有看到「//自動取得網址」，表示是用輕鬆架版的mainfile.php，如此便無須修改。</li>
        <li>若無該字樣，請修改底下幾個設定，修改後存檔：<div class='well'>
        define('XOOPS_ROOT_PATH', '新網站的網頁目錄'); <br>
        define('XOOPS_PATH', '新網站的 <code>xoops_lib</code> 目錄'); <br>
        define('XOOPS_VAR_PATH', '新網站的 <code>xoops_data</code> 目錄');
        define('XOOPS_URL', 'http://新網站網址');
        </div>";
    }

    return $msg;
}

function download_themes()
{
    global $source_mod, $xoopsConfig, $on, $off, $add, $up, $down, $system_theme;

    $mypath = XOOPS_ROOT_PATH . '/themes/';

    $d = opendir($mypath);
    $mod_msg = '';
    $need_down = [];
    $download = false;
    while (false !== ($file = readdir($d))) {
        if ('.' !== $file && '..' !== $file) {
            $typepath = $mypath . $file;

            if ('dir' === filetype($typepath)) {
                if (!isset($source_mod[$file]) and in_array($file, $xoopsConfig['theme_set_allowed']) and !in_array($file, $system_theme)) {
                    $dir_size = format_size(GetDirectorySize($typepath));
                    $need = ($xoopsConfig['theme_set'] == $file) ? '，主佈景，務必下載' : '，非主要佈景，不下載也沒關係';
                    $mod_msg .= "<li class='important'><a href='{$_SERVER['PHP_SELF']}?op=download_zip&dir={$typepath}'>{$down}{$typepath}</a>（約 {$dir_size}{$need}）</li>";
                    $download = true;
                    $_SESSION['zip_del']["{$file}.zip"] = "{$file}.zip";
                }
            }
        }
    }

    $msg = ($download) ? "底下是貴站有用到的佈景，但在集中式主機並不提供，故請自行下載到 <code>C:\\move\\themes\\</code> 並解壓：<ul>{$mod_msg}</ul>" : "{$on}貴站所需的佈景，集中式主機上均有，故無須自行下載。";

    return $msg;
}

function upload_themes()
{
    global $source_mod, $xoopsConfig, $on, $off, $add, $up, $down, $isWin, $system_theme, $isDCS;

    $mypath = XOOPS_ROOT_PATH . '/themes/';

    $d = opendir($mypath);
    $mod_msg = '';
    $need_up = [];
    while (false !== ($file = readdir($d))) {
        if ('.' !== $file && '..' !== $file) {
            $typepath = $mypath . $file;

            if ('dir' === filetype($typepath)) {
                if (!isset($source_mod[$file]) and in_array($file, $xoopsConfig['theme_set_allowed']) and !in_array($file, $system_theme)) {
                    $need_up[] = "<span class='danger'>$file</span>";
                }
            }
        }
    }

    $need_up_mods = implode('、', $need_up);

    $msg = ($need_up_mods) ? "{$up} <code>C:\\move\\modules\\</code> 裡面的 {$need_up_mods} 這幾個佈景資料夾上傳到新主機的 <code>/public_html/themes/</code> 底下即可。" : "{$on}貴站所需的佈景，集中式主機上均有，故無須自行上傳。";

    return $msg;
}

function download_uploads()
{
    global $source_mod, $on, $off, $add, $up, $down, $isWin, $isDCS;

    del_tmp_zip();

    $XOOPS_ROOT_PATH = get_ftp_path(XOOPS_ROOT_PATH);

    $mypath = XOOPS_ROOT_PATH . '/uploads/';
    $size = GetDirectorySize($mypath);
    $dir_size = format_size($size);
    $filezilla = $over100 = '';
    if ($size > 104857600) {
        if ($isDCS) {
            $over100 = "，檔案超過 100M，建議用<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FTP軟體</a>下載";

            $filezilla = "<div class='alert alert-info'>請先用FTP軟體（如：<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FileZilla</a>）登入本網站 <code>ftp.dcs.tn.edu.tw</code>，左邊切換至<code>C:\\move\\</code>，右邊切換到 <code>" . $XOOPS_ROOT_PATH . "/</code>，並只要將 <span class='danger'>uploads</span> 整個資料夾下載到 <code>C:\\move\\</code> 底下即可。</div>";
            $path = "{$down}{$mypath}";
        } else {
            $over100 = $isWin ? '，檔案超過 100M，如果您可以在本機上操作，那先不用下載' : "，檔案超過 100M，建議用<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FTP軟體</a>下載";

            $filezilla = $isWin ? '' : "<div class='alert alert-info'>請先用FTP軟體（如：<a href='https://campus-xoops.tn.edu.tw/modules/tad_uploader/index.php?op=dlfile&cfsn=33&cat_sn=22'>FileZilla</a>）登入本網站 <code>" . $_SERVER['SERVER_NAME'] . '</code>，左邊切換至<code>C:\\move\\</code>，右邊切換到 <code>' . $XOOPS_ROOT_PATH . "/</code>，並只要將 <span class='danger'>uploads</span> 整個資料夾下載到 <code>C:\\move\\</code> 底下即可。</div>";
            $path = "{$down}{$mypath}";
        }
    } else {
        $path = "<a href='{$_SERVER['PHP_SELF']}?op=download_zip&dir={$mypath}'>{$down}{$mypath}</a>";
    }
    $mod_msg = "<li class='important'>{$path}（約 {$dir_size}{$over100}）</li>";
    $msg = "底下是貴站使用者所上傳的各式實體檔案、圖片、資料，故也需要搬到新主機，請自行下載到 <code>C:\\move\\</code> 並解壓：<ul>{$mod_msg}{$filezilla}</ul>";

    return $msg;
}

function upload_uploads()
{
    global $source_mod, $on, $off, $add, $up, $down;
    del_tmp_zip();
    $mypath = XOOPS_ROOT_PATH . '/uploads/';
    $dir_size = format_size(GetDirectorySize($mypath));
    $msg = "{$up}將 FileZilla 左邊切換至 <code>C:\\move\\</code>，右邊切換至 <code>/public_html/</code>，將左邊的 <code>uploads</code> （共約 {$dir_size}）上傳到 <code>/public_html/</code> 下覆寫原本的 <code>uploads</code> 即可。<div class='alert alert-danger'>請記得將 uploads（含底下所有目錄及檔案）的寫入權限都設為 777</div>";

    return $msg;
}

function download_sql()
{
    global $xoopsDB, $source_mod, $on, $off, $add, $up, $down, $isTN;

    $sql = "SELECT
    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2)
    FROM information_schema.TABLES
    WHERE table_schema='" . XOOPS_DB_NAME . "'";

    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
    list($dbsize) = $xoopsDB->fetchRow($result);

    if ($isTN) {
        $id = $_SESSION['schoolweb_id'];
        if (!isset($_SESSION['schoolweb_id']) and mb_strpos($_SERVER['SERVER_NAME'], '.tn.edu.tw')) {
            $str = str_replace('.tn.edu.tw', '', $_SERVER['SERVER_NAME']);
            $s = explode('.', $str);
            $id = $s[1] ? "{$s[1]}_{$s[0]}" : $s[0];
        } else {
            list($schooldomain, $subdomain) = explode('_', $_SESSION['schoolweb_id']);
        }

        $replace = XOOPS_DB_PREFIX === 'xx' ? '' : '<li>搜尋 <code>`' . XOOPS_DB_PREFIX . '_</code>，取代成 <code>`xx_</code></li>';

        $tn_note = '<ul><li>若新站和舊站網址一樣，或者新站和舊站網址不一樣，但已經有去設定 Web DNS 設定新站網址，那麼請填：「<span class="important">http://' . $subdomain . '.' . $schooldomain . '.tn.edu.tw</span>」。</li><li>若新舊站網只不同，且還未去 Web DNS 設定新站網址，那麼請填「<span class="important">http://schoolweb.tn.edu.tw/~' . $id . '</span>」）。</li></ul>下載後請將 mysql.sql 存到 <code>C:\\move\\</code> 底下即可。';
        $value = 'http://schoolweb.tn.edu.tw/~' . $id;
        $new_url = '<code>http://schoolweb.tn.edu.tw/~' . $id . '</code> 或 <code>http://' . $subdomain . '.' . $schooldomain . '.tn.edu.tw</code>';
    } else {
        $tn_note = $value = '';
        $new_url = '<span class="important">http://新主機的網址</span>';
    }

    $msg = '接下來，我們必須匯出本站在資料庫中的所有內容，並且幫您把裡面的一些網址替換掉，故請在下方填入您在集中式主機的完整網址<span class="danger">（網址最後不要有 /）</span>。' . $tn_note . '<p>
    <form action="' . $_SERVER['PHP_SELF'] . '" method="post">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="sizing-addon1">請輸入您在新網站（集中式網站）的網址：</span>
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
            <li>開啟文字編輯器，開啟 <code>C:\\move\\mysql.sql</code>，並執行取代功能（一般是 Ctrl+H）。</li>
            <li>搜尋 <code>' . XOOPS_URL . '</code>，取代成 ' . $new_url . '</li>
            ' . $replace . '
            <li>儲存</li>
    </div>';

    return $msg;
}

function export_sql($new_url)
{
    global $isTN;
    if (!$_SESSION['tad_adm_isAdmin']) {
        redirect_header($_SERVER['PHP_SELF'], 3, '不具備管理身份');
    }

    if ('/' === mb_substr($new_url, -1)) {
        $new_url = mb_substr($new_url, 0, -1);
    }
    set_time_limit(0);
    ignore_user_abort(true);
//    require XOOPS_ROOT_PATH . '/modules/tad_adm/class/MySQLDump.php';

    $db = new mysqli(XOOPS_DB_HOST, XOOPS_DB_USER, XOOPS_DB_PASS, XOOPS_DB_NAME);
    $dump = new \XoopsModules\Tad_adm\MySQLDump($db);
    $filename = XOOPS_ROOT_PATH . '/uploads/mysql.sql';
    if (file_exists($filename)) {
        unlink($filename);
    }
    $dump->save($filename);

    if (XOOPS_DB_PREFIX !== 'xx' and $isTN) {
        $sql_content = file_get_contents($filename);
        $new_content = str_replace('`' . XOOPS_DB_PREFIX . '_', '`xx_', $sql_content);
    } else {
        $new_content = file_get_contents($filename);
    }

    $new_content = str_replace(XOOPS_URL, $new_url, $new_content);
    header('Content-type: text/sql');
    header('Content-Disposition: attachment; filename=mysql.sql');
    echo $new_content;
    exit;
}

function upload_sql()
{
    global $source_mod, $on, $off, $add, $up, $down, $isTN;
    if ($isTN) {
        $id = $_SESSION['schoolweb_id'];
        if (!isset($_SESSION['schoolweb_id']) and mb_strpos($_SERVER['SERVER_NAME'], '.tn.edu.tw')) {
            $str = str_replace('.tn.edu.tw', '', $_SERVER['SERVER_NAME']);
            $s = explode('.', $str);
            $id = $s[1] ? "{$s[1]}_{$s[0]}" : $s[0];
        } else {
            list($schooldomain, $subdomain) = explode('_', $_SESSION['schoolweb_id']);
        }
        $msg = "{$up}最後，請登入<a href='https://schoolweb.tn.edu.tw/~{$id}/modules/tad_adm/pma.php?server=schooldb.tn.edu.tw&username={$id}&db={$id}&import=' target='_blank'>新主機的資料庫匯入程式</a>，點擊瀏覽按鈕，並選取<code>C:\\move\\mysql.sql</code>，再按「執行」以匯入資料庫內容即可。";
    } else {
        $msg = "{$up}最後，請登入新主機的資料庫管理（如：http://新主機網址/modules/tad_adm/pma.php），執行匯入，點擊瀏覽按鈕，並選取<code>C:\\move\\mysql.sql</code>，再按「執行」以匯入資料庫內容即可。</li>
        <li>修改 新主機上/xoops_data/data/secure.php，主要是修改底下這幾個資料庫帳密設定，修改後存檔：
        <div class='well card card-body bg-light'>
        define('XOOPS_DB_USER', '新主機的資料庫帳號');<br>
        define('XOOPS_DB_PASS', '新主機的資料庫密碼');<br>
        define('XOOPS_DB_NAME', '新主機的資料庫名稱');
        </div>";
    }

    return $msg;
}

function download_zip($FromDir)
{
    if (!$_SESSION['tad_adm_isAdmin'] or empty($FromDir) or !is_dir($FromDir)) {
        redirect_header($_SERVER['PHP_SELF'], 3, "查無 {$FromDir} 或不具備管理身份");
    }

    $dirname = basename($FromDir);

    $toZip = XOOPS_ROOT_PATH . "/uploads/{$dirname}.zip";
    if (file_exists($toZip)) {
        unlink($toZip);
    }

    if (false !== mb_strpos($FromDir, '/modules/')) {
        $type = '/modules';
    } elseif (false !== mb_strpos($FromDir, '/themes/')) {
        $type = '/themes';
    } elseif (false !== mb_strpos($FromDir, '/uploads/')) {
        del_tmp_zip();
        $type = '/';
    } else {
        redirect_header($_SERVER['PHP_SELF'], 3, "{$FromDir} 是不合法的路徑。");

        return;
    }

    require_once __DIR__ . '/class/pclzip.lib.php';
    $zipfile = new PclZip($toZip);
    $v_list = $zipfile->create($FromDir, PCLZIP_OPT_REMOVE_PATH, XOOPS_ROOT_PATH . $type);
    if (0 == $v_list) {
        die('Error : ' . $zipfile->errorInfo(true));
    }
    header('location:' . XOOPS_URL . "/uploads/{$dirname}.zip");

    exit;
}

function del_tmp_zip()
{
    $d = opendir(XOOPS_ROOT_PATH . '/uploads/');
    while (false !== ($file = readdir($d))) {
        if ('.' !== $file && '..' !== $file) {
            $typepath = $mypath . $file;
            if ('dir' !== filetype($typepath)) {
                if (in_array($file, $_SESSION['zip_del'])) {
                    unlink($typepath);
                }
            }
        }
    }
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
