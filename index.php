<?php
use Xmf\Request;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;

require_once dirname(dirname(__DIR__)) . '/mainfile.php';

if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}

xoops_loadLanguage('main', 'tadtools');
require_once __DIR__ . '/function.php';

$op                = Request::getString('op');
$help_passwd       = Request::getString('help_passwd', '', 'POST');
$uid               = Request::getInt('uid');
$show              = Request::getBool('show');
$msg_box           = '';
$sys_adm           = false;
$SweetAlertCode    = '';
$TadAmModuleConfig = Utility::getXoopsModuleConfig('tad_adm');
$is_post           = 'POST' === strtoupper($_SERVER['REQUEST_METHOD'] ?? '');
$token_valid       = isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) && $GLOBALS['xoopsSecurity']->check();
$token_html        = isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) ? $GLOBALS['xoopsSecurity']->getTokenHTML() : '';

if ($xoopsUser) {
    $sys_adm = $xoopsUser->isAdmin(1);
} elseif ('helpme' === $op && $is_post && $token_valid) {
    $stored_login = (string) ($TadAmModuleConfig['login'] ?? '');
    $sys_adm      = ('' !== $stored_login && '' !== $help_passwd && hash_equals($stored_login, $help_passwd));
} elseif ('send_passwd' === $op) {
    if (!empty($TadAmModuleConfig['use_forgot_passwd']) && $is_post && $token_valid) {
        $result = send_passwd() ? 1 : 0;
        header("location: index.php?op=msg&show={$result}");
        exit;
    }
    header('location: index.php');
    exit;
} elseif ('msg' === $op) {
    $masked_mail = mask_admin_email((string) ($xoopsConfig['adminmail'] ?? ''));
    if ($show) {
        $msg = sprintf(_MD_TADADM_MAIL_PASSWD_OK, $masked_mail);
    } else {
        $msg = sprintf(_MD_TADADM_MAIL_PASSWD_FAIL, $masked_mail);
    }
    $msg_box = "<div class='alert alert-info'>$msg</div>";
}

if (!$sys_adm) {
    if ('forgot' === $op and !empty($TadAmModuleConfig['use_forgot_passwd'])) {
        $form = '
        <div class="card mb-3">
            <div class="card-header text-white bg-warning">' . _MD_TADADM_CHANGE_CONFIRM_TITLE . '</div>
            <div class="card-body">
                <form action="index.php" method="post" role="form" onsubmit="return confirm(\'' . htmlspecialchars(_MD_TADADM_CHANGE_CONFIRM_TEXT, ENT_QUOTES, 'UTF-8') . '\');">
                    ' . $token_html . '
                    <input type="hidden" name="op" value="send_passwd">
                    <button type="submit" class="btn btn-warning">' . _MD_TADADM_CHANGE_CONFIRM_BTN . '</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-white bg-primary">' . _MD_TADADM_FORGOT . '</div>
            <div class="card-body">
                <form action="index.php" method="post" role="form">
                    ' . $token_html . '
                    <div class="form-group row mb-3">
                        <label class="col-sm-12">' . _MD_TADADM_INPUT_PASSWD_DESC . '</label>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3" for="help_passwd">' . _MD_TADADM_INPUT_PASSWD . '</label>
                        <div class="col-sm-7">
                            <input type="password" name="help_passwd" id="help_passwd" class="form-control" placeholder="" autocomplete="one-time-code">
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden" name="op" value="helpme">
                            <button type="submit" class="btn btn-primary">' . _MD_TADADM_LOGIN . '</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>';
    } else {
        $forgot = ($TadAmModuleConfig['use_forgot_passwd']) ? '<a href="index.php?op=forgot" style="font-size: 0.75rem;color:gray;">' . _MD_TADADM_FORGOT . '</a>' : '';
        $form   = $SweetAlertCode . '
        <form action="' . XOOPS_URL . '/user.php" method="post" role="form">
            ' . $token_html . '
            <div class="card">
                <div class="card-header text-white bg-primary">' . _MD_TADADM_LOGIN . '</div>
                <div class="card-body">

                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label text-md-right" for="uname">' . _MD_TADADM_USER_S_ID . '</label>
                        <div class="col-sm-9">
                            <input type="text" name="uname"  id="uname" placeholder="' . _MD_TADADM_USER_ID . '"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label text-md-right" for="pass">' . _MD_TADADM_USER_S_PASS . '</label>
                        <div class="col-sm-9">
                            <input type="password" name="pass"  id="pass" placeholder="' . _MD_TADADM_USER_S_PASS . '"  class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-3 col-form-label text-md-right">' . $forgot . '</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="op" value="login">
                            <input type="hidden" name="xoops_redirect" value="/index.php">
                            <button type="submit" class="btn btn-primary">' . _MD_TADADM_LOGIN . '</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>';
    }

    $content = '
    <div class="row">
        <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="page-header">
                    <div class="h1">' . _MD_TADADM_NAME . '</div>
                </div>
                ' . $msg_box . '
                ' . $form . '
            </div>
        <div class="col-lg-3"></div>
    </div>
    ';
    die(Utility::html5($content, false, true, 4, true, 'container-fluid'));
}

$logout = ($xoopsUser) ? XOOPS_URL . '/user.php?op=logout' : 'index.php?op=logout';

$v = Request::getInt('v');

$post_ops = ['unable_blocks', 'unable_modules', 'enable_blocks', 'enable_modules', 'reset_mem', 'debug_mode', 'clear_cache', 'clear_session', 'theme_default', 'close_site'];
if (in_array($op, $post_ops, true)) {
    if (!$is_post || !$token_valid) {
        header('location: index.php');
        exit;
    }
}

switch ($op) {
    case 'unable_blocks':
        unable_blocks();
        header('location: index.php');
        exit;

    case 'unable_modules':
        unable_modules();
        header('location: index.php');
        exit;

    case 'enable_blocks':
        enable_blocks();
        exit;

    case 'enable_modules':
        enable_modules();
        header('location: index.php');
        exit;

    case 'reset_mem':
        $new_pass = Request::getString('new_pass', '', 'POST');
        reset_mem($uid, $new_pass);
        header('location: ' . XOOPS_URL . "/userinfo.php?uid={$uid}");
        exit;

    case 'debug_mode':
        debug_mode($v);
        header('location: index.php');
        exit;

    case 'clear_cache':
        clear_cache();
        header('location: index.php');
        exit;

    case 'clear_session':
        clear_session();
        header('location: index.php');
        exit;

    case 'theme_default':
        theme_default();
        header('location: index.php');
        exit;

    case 'close_site':
        close_site($v);
        header('location: index.php');
        exit;

    case 'phpinfo':
        phpinfo();
        break;

    case 'logout':
        $sys_adm = false;
        header('location: index.php');
        exit;
}

//關閉所有模組
function unable_modules()
{
    global $xoopsDB;
    $mid_array = [];
    $sql       = 'SELECT `mid` FROM `' . $xoopsDB->prefix('modules') . '` WHERE `isactive`=1 AND `dirname`!=? AND `dirname`!=?';
    $result    = Utility::query($sql, 'ss', ['system', 'tad_adm']) or Utility::web_error($sql, __FILE__, __LINE__);
    while (list($mid) = $xoopsDB->fetchRow($result)) {
        $mid_array[] = (int) $mid;
    }

    if (empty($mid_array)) {
        return;
    }

    $all_mid = implode(',', $mid_array);
    $sql     = 'UPDATE `' . $xoopsDB->prefix('config') . '` SET `conf_value`=? WHERE `conf_name`=?';
    Utility::query($sql, 'ss', [$all_mid, 'module_id_temp']) or Utility::web_error($sql, __FILE__, __LINE__);

    $placeholders = implode(',', array_fill(0, count($mid_array), '?'));
    $types        = str_repeat('i', count($mid_array));
    $sql          = 'UPDATE `' . $xoopsDB->prefix('modules') . "` SET `isactive`=0 WHERE `mid` IN ({$placeholders})";
    Utility::query($sql, $types, $mid_array) or Utility::web_error($sql, __FILE__, __LINE__);
}

//還原所有模組
function enable_modules()
{
    global $xoopsDB, $TadAmModuleConfig;
    $mid_array = array_values(array_filter(array_map('intval', explode(',', (string) ($TadAmModuleConfig['module_id_temp'] ?? ''))), static fn($v) => $v > 0));
    if (!empty($mid_array)) {
        $placeholders = implode(',', array_fill(0, count($mid_array), '?'));
        $types        = 'i' . str_repeat('i', count($mid_array));
        $sql          = 'UPDATE `' . $xoopsDB->prefix('modules') . "` SET `isactive`=? WHERE `mid` IN ({$placeholders})";
        Utility::query($sql, $types, array_merge([1], $mid_array)) or Utility::web_error($sql, __FILE__, __LINE__);
    }

    $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '` SET `conf_value`=? WHERE `conf_name`=?';
    Utility::query($sql, 'ss', ['', 'module_id_temp']) or Utility::web_error($sql, __FILE__, __LINE__);
}

//關閉所有區塊
function unable_blocks()
{
    global $xoopsDB;
    $bid_array = [];
    $sql       = 'SELECT `bid` FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `visible`=?';
    $result    = Utility::query($sql, 'i', [1]) or Utility::web_error($sql, __FILE__, __LINE__);

    while (list($bid) = $xoopsDB->fetchRow($result)) {
        $bid_array[] = (int) $bid;
    }

    if (!empty($bid_array)) {
        $all_bid = implode(',', $bid_array);

        $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '` SET `conf_value`=? WHERE `conf_name`=?';
        Utility::query($sql, 'ss', [$all_bid, 'block_id_temp']) or Utility::web_error($sql, __FILE__, __LINE__);

        $placeholders = implode(',', array_fill(0, count($bid_array), '?'));
        $types        = 'i' . str_repeat('i', count($bid_array));
        $sql          = 'UPDATE `' . $xoopsDB->prefix('newblocks') . "` SET `visible`=? WHERE `bid` IN ({$placeholders})";
        Utility::query($sql, $types, array_merge([0], $bid_array)) or Utility::web_error($sql, __FILE__, __LINE__);
    }
}

//還原所有區塊
function enable_blocks()
{
    global $xoopsDB, $TadAmModuleConfig;
    $bid_array = array_values(array_filter(array_map('intval', explode(',', (string) ($TadAmModuleConfig['block_id_temp'] ?? ''))), static fn($v) => $v > 0));
    if (!empty($bid_array)) {
        $placeholders = implode(',', array_fill(0, count($bid_array), '?'));
        $types        = str_repeat('i', count($bid_array));
        $sql          = 'UPDATE `' . $xoopsDB->prefix('newblocks') . "` SET `visible`=1 WHERE `bid` IN ({$placeholders})";
        Utility::query($sql, $types, $bid_array) or Utility::web_error($sql, __FILE__, __LINE__);

        $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '` SET `conf_value`=? WHERE `conf_name`=?';
        Utility::query($sql, 'ss', ['', 'block_id_temp']) or Utility::web_error($sql, __FILE__, __LINE__);
        redirect_header($_SERVER['PHP_SELF'], 3, "已成功執行！");
    } else {
        redirect_header($_SERVER['PHP_SELF'], 3, "沒有任何區塊被關閉！");
    }
}

//重設密碼
function reset_mem($uid = '', $passwd = '')
{
    global $xoopsDB, $sys_adm;
    $uid    = (int) $uid;
    $passwd = (string) $passwd;
    if ($sys_adm && $uid > 0 && '' !== $passwd) {
        $hashed = password_hash($passwd, PASSWORD_DEFAULT);
        $sql    = 'UPDATE `' . $xoopsDB->prefix('users') . '` SET `pass`=? WHERE `uid`=?';
        Utility::query($sql, 'si', [$hashed, $uid]) or Utility::web_error($sql, __FILE__, __LINE__);
    }
}

//遮罩管理員 Email（避免未登入頁洩漏完整信箱）
function mask_admin_email(string $email): string
{
    if ('' === $email || false === strpos($email, '@')) {
        return '***';
    }
    list($local, $domain) = explode('@', $email, 2);
    $prefix               = mb_substr($local, 0, 1);
    return htmlspecialchars($prefix . '***@' . $domain, ENT_QUOTES, 'UTF-8');
}

//寄發密碼
function send_passwd()
{
    global $xoopsConfig, $xoopsDB;
    $passwd = GeraHash(30);

    $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '` SET `conf_value`=? WHERE `conf_name`=? AND `conf_title`=?';
    Utility::query($sql, 'sss', [$passwd, 'login', '_MI_TADADM_LOGIN']) or Utility::web_error($sql, __FILE__, __LINE__);

    $myip    = htmlspecialchars((string) ($_SERVER['REMOTE_ADDR'] ?? ''), ENT_QUOTES, 'UTF-8');
    $content = sprintf(_MD_TADADM_MAIL_CONTENT, htmlspecialchars($passwd, ENT_QUOTES, 'UTF-8'), $myip);
    return send_now($xoopsConfig['adminmail'], _MD_TADADM_PASSWD, $content);
}

//立即寄出
function send_now($email = '', $title = '', $content = '')
{
    global $xoopsConfig, $xoopsDB, $TadAmModuleConfig, $xoopsModule;

    $xoopsMailer                           = getMailer();
    $xoopsMailer->multimailer->ContentType = 'text/html';
    $xoopsMailer->addHeaders('MIME-Version: 1.0');
    $headers = [];

    $msg = ($xoopsMailer->sendMail($email, $title, $content, $headers)) ? true : false;

    return $msg;
}

function GeraHash($qtd)
{
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $max_idx    = strlen($Caracteres) - 1;

    $Hash = '';
    for ($x = 1; $x <= $qtd; $x++) {
        $Posicao = random_int(0, $max_idx);
        $Hash .= $Caracteres[$Posicao];
    }

    return $Hash;
}

// 產生帶 CSRF Token 的 POST 操作按鈕（外觀與清單連結一致）
function tad_adm_post_action(string $op, string $label, array $extra = []): string
{
    global $token_html;
    $hidden = "<input type='hidden' name='op' value='" . htmlspecialchars($op, ENT_QUOTES, 'UTF-8') . "'>";
    foreach ($extra as $k => $v) {
        $hidden .= "<input type='hidden' name='" . htmlspecialchars((string) $k, ENT_QUOTES, 'UTF-8') . "' value='" . htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8') . "'>";
    }
    return "<form action='index.php' method='post' style='display:inline;margin:0;'>{$token_html}{$hidden}<button type='submit' class='btn btn-link p-0 text-start text-decoration-none'><i class='fa fa-chevron-circle-right' aria-hidden='true'></i> {$label}</button></form>";
}

//目前硬碟空間
function get_free_space()
{
    $bytes = disk_free_space('.');
    return format_size(false === $bytes ? 0 : $bytes);
}

//改回預設佈景
function theme_default()
{
    global $xoopsDB;

    $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '` SET `conf_value`=? WHERE `conf_name`=?';
    Utility::query($sql, 'ss', ['default', 'theme_set']) or Utility::web_error($sql, __FILE__, __LINE__);

}

//清除 session
function clear_session()
{
    global $xoopsDB;
    $sql = 'TRUNCATE TABLE `' . $xoopsDB->prefix('session') . '`';
    Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

}

//清除快取
function clear_cache()
{
    $dirnames[] = XOOPS_VAR_PATH . '/caches/smarty_cache';
    $dirnames[] = XOOPS_VAR_PATH . '/caches/smarty_compile';
    $dirnames[] = XOOPS_VAR_PATH . '/caches/xoops_cache';
    foreach ($dirnames as $dirname) {
        if (is_dir($dirname)) {
            Utility::delete_directory($dirname);
            Utility::mk_dir($dirname);
            $fp = fopen("{$dirname}/index.html", 'wb');
            fwrite($fp, '<script>history.go(-1);</script>');
            fclose($fp);
        }
    }
}

//session 資料表容量
function session_size()
{
    global $xoopsDB;
    $sql    = "SHOW TABLE STATUS WHERE `Name`=?";
    $result = Utility::query($sql, 's', [$xoopsDB->prefix('session')]) or Utility::web_error($sql, __FILE__, __LINE__);
    $row    = $xoopsDB->fetchArray($result);

    $bytes = is_array($row) ? ((float) ($row['Data_length'] ?? 0) + (float) ($row['Index_length'] ?? 0)) : 0;
    $space = format_size($bytes);

    return sprintf(_MD_TADADM_BRACKETS, $space);
}

//取得目錄下的檔案數
function files_counter()
{
    $dirname = XOOPS_VAR_PATH . '/caches/smarty_compile/';
    if (false !== glob($dirname . '*.php')) {
        $filecount = count(glob($dirname . '*.php'));

        return sprintf(_MD_TADADM_FILES_COUNT, $filecount);
    }
}

//修改關站狀態
function close_site($v = 0)
{
    global $xoopsDB;

    $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '` SET `conf_value`=? WHERE `conf_name`=?';
    Utility::query($sql, 'ss', [$v, 'closesite']) or Utility::web_error($sql, __FILE__, __LINE__);

}

//修改除錯模式
function debug_mode($v = 0)
{
    global $xoopsDB;

    $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '` SET `conf_value`=? WHERE `conf_name`=?';
    Utility::query($sql, 'ss', [$v, 'debug_mode']) or Utility::web_error($sql, __FILE__, __LINE__);
}

function debug_mode_tool()
{
    global $xoopsDB;

    $sql    = 'SELECT `conf_value` FROM `' . $xoopsDB->prefix('config') . '` WHERE `conf_name`=?';
    $result = Utility::query($sql, 's', ['debug_mode']) or Utility::web_error($sql, __FILE__, __LINE__);

    $row   = $xoopsDB->fetchRow($result);
    $debug = is_array($row) ? ($row[0] ?? 0) : 0;
    if (1 == $debug) {
        $debug_tool = "
        <li class='list-group-item'>" . tad_adm_post_action('debug_mode', sprintf(_MD_TADADM_UNABLE_DEBUG, 'PHP'), ['v' => 0]) . "</li>
        <li class='list-group-item'>" . tad_adm_post_action('debug_mode', sprintf(_MD_TADADM_ENABLE_DEBUG, 'Smarty'), ['v' => 3]) . '</li>';
    } elseif (3 == $debug) {
        $debug_tool = "
        <li class='list-group-item'>" . tad_adm_post_action('debug_mode', sprintf(_MD_TADADM_ENABLE_DEBUG, 'PHP'), ['v' => 1]) . "</li>
        <li class='list-group-item'>" . tad_adm_post_action('debug_mode', sprintf(_MD_TADADM_UNABLE_DEBUG, 'Smarty'), ['v' => 0]) . '</li>';
    } else {
        $debug_tool = "
        <li class='list-group-item'>" . tad_adm_post_action('debug_mode', sprintf(_MD_TADADM_ENABLE_DEBUG, 'PHP'), ['v' => 1]) . "</li>
        <li class='list-group-item'>" . tad_adm_post_action('debug_mode', sprintf(_MD_TADADM_ENABLE_DEBUG, 'Smarty'), ['v' => 3]) . '</li>';
    }

    return $debug_tool;
}

//檢查連線
$mysql_connect = $xoopsDB ? 'OK' : _MD_TADADM_CANT_CONNECT;

//MySQL版本
$sql    = 'SELECT VERSION()';
$result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

list($mysql_version) = $xoopsDB->fetchRow($result);
// $mysql_version = function_exists('$GLOBALS['xoopsDB']->getServerVersion') ? $GLOBALS['xoopsDB']->getServerVersion() : $xoopsDB->getServerVersion();

$other = '';
if ($xoopsDB) {
    // 合併使用者統計查詢，減少重複全表掃描
    $sql = 'SELECT
        COUNT(*) AS all_cnt,
        SUM(CASE WHEN `last_login` = 0 THEN 1 ELSE 0 END) AS never_login_cnt,
        SUM(CASE WHEN `user_regdate` = 0 THEN 1 ELSE 0 END) AS never_start_cnt,
        SUM(CASE WHEN `user_regdate` != 0 AND `last_login` != 0 THEN 1 ELSE 0 END) AS normal_cnt
        FROM `' . $xoopsDB->prefix('users') . '`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $stat   = $xoopsDB->fetchRow($result) ?: [0, 0, 0, 0];
    $all_user_count         = (int) ($stat[0] ?? 0);
    $never_login_user_count = (int) ($stat[1] ?? 0);
    $never_start_user_count = (int) ($stat[2] ?? 0);
    $normal_user_count      = (int) ($stat[3] ?? 0);

    //各群組人數（以 SQL GROUP BY 彙總，避免全表載入 PHP）
    $sql = 'SELECT a.`groupid`, COUNT(*) AS cnt, b.`name`
        FROM `' . $xoopsDB->prefix('groups_users_link') . '` AS a
        LEFT JOIN `' . $xoopsDB->prefix('groups') . '` AS b ON a.`groupid` = b.`groupid`
        GROUP BY a.`groupid`, b.`name`
        ORDER BY a.`groupid`';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $groupid_count = $group_name = [];
    while (list($groupid, $cnt, $name) = $xoopsDB->fetchRow($result)) {
        $groupid_count[$groupid] = (int) $cnt;
        $group_name[$groupid]    = $name;
    }

    $groupid_count_list = '';

    foreach ($groupid_count as $groupid => $counter) {
        if (0 == $groupid) {
            $gname = _MD_TADADM_NO_GROUP;
        } elseif (3 == $groupid) {
            $gname = _MD_TADADM_GUEST;
        } else {
            $gname = empty($group_name[$groupid]) ? _MD_TADADM_SOME_GROUP . " {$groupid}" : $group_name[$groupid];
        }
        $gname_safe   = htmlspecialchars((string) $gname, ENT_QUOTES, 'UTF-8');
        $groupid_safe = (int) $groupid;
        $groupid_count_list .= "
        <tr>
            <th>
                <span class='label label-info'>{$groupid_safe}</span>
                " . sprintf(_MD_TADADM_GROUP, $gname_safe) . "
            </th>
            <td style='text-align: right;'>
            " . sprintf(_MD_TADADM_GROUP_COUNTEER, $counter) . '
            </td>
        </tr>';
    }

    $other = "
    <tr>
        <th>
            <i class='fa fa-caret-right'  title='XOOPS " . _MD_TADADM_MEM_AMOUNT . "'></i>
            XOOPS " . _MD_TADADM_MEM_AMOUNT . _TAD_FOR . "
        </th>
        <td style='text-align: right;'>
            " . $all_user_count . ' ' . _MD_TADADM_PEOPLE . "
        </td>
    </tr>
    <tr>
        <th>
            <i class='fa fa-caret-right'  title='XOOPS " . _MD_TADADM_AVAILABLE_MEM_AMOUNT . "'></i>
            XOOPS " . _MD_TADADM_AVAILABLE_MEM_AMOUNT . _TAD_FOR . "
        </th>
        <td style='text-align: right;'>
            " . $normal_user_count . ' ' . _MD_TADADM_PEOPLE . "
        </td>
    </tr>
    <tr>
        <th>
            <i class='fa fa-caret-right'  title='XOOPS " . _MD_TADADM_UNAVAILABLE_MEM_AMOUNT . "'></i>
            XOOPS " . _MD_TADADM_UNAVAILABLE_MEM_AMOUNT . _TAD_FOR . "
        </th>
        <td style='text-align: right;'>
            " . $never_start_user_count . ' ' . _MD_TADADM_PEOPLE . "
        </td>
    </tr>
    <tr>
        <th>
            <i class='fa fa-caret-right'  title='XOOPS " . _MD_TADADM_NEVER_LOGIN . "'></i>
            XOOPS " . _MD_TADADM_NEVER_LOGIN . _TAD_FOR . "
        </th>
        <td style='text-align: right;'>
            " . $never_login_user_count . ' ' . _MD_TADADM_PEOPLE . "
        </td>
    </tr>
    $groupid_count_list
    ";
}

$main1 = "
<div class='card'>
    <div class='card-header text-white bg-primary'>" . _MD_TADADM_SYSTEM_INFO . "</div>
    <table class='table table-striped'>
        <tr>
            <th>
                <i class='fa fa-caret-right'  title='XOOPS " . _MD_TADADM_VERSION . "'></i>
                XOOPS " . _MD_TADADM_VERSION . _TAD_FOR . '
            </th>
            <td>
                ' . XOOPS_VERSION . "
            </td>
        </tr>
        <tr>
            <th>
                <i class='fa fa-caret-right'  title='XOOPS " . _MD_TADADM_LANGUAGE . "'></i>
                XOOPS " . _MD_TADADM_LANGUAGE . _TAD_FOR . '
            </th>
            <td>
                ' . $xoopsConfig['language'] . "
            </td>
        </tr>
        <tr>
            <th>
                <i class='fa fa-caret-right'  title='XOOPS " . _MD_TADADM_XOOPS_ROOT_PATH . "'></i>
                XOOPS " . _MD_TADADM_XOOPS_ROOT_PATH . _TAD_FOR . '
            </th>
            <td>
                ' . XOOPS_ROOT_PATH . "
            </td>
        </tr>
        <tr>
            <th>
                <i class='fa fa-caret-right'  title='" . _MD_TADADM_XOOPS_VAR_PATH . "'></i>
                " . _MD_TADADM_XOOPS_VAR_PATH . _TAD_FOR . '
            </th>
            <td>
                ' . XOOPS_VAR_PATH . "
            </td>
        </tr>
        <tr>
            <th>
                <i class='fa fa-caret-right'  title='" . _MD_TADADM_XOOPS_TRUST_PATH . "'></i>
                " . _MD_TADADM_XOOPS_TRUST_PATH . _TAD_FOR . '
            </th>
            <td>
                ' . XOOPS_TRUST_PATH . "
            </td>
        </tr>
        <tr>
            <th>
                <i class='fa fa-caret-right'  title='PHP " . _MD_TADADM_VERSION . "'></i>
                PHP " . _MD_TADADM_VERSION . _TAD_FOR . '
            </th>
            <td>
                ' . phpversion() . "
            </td>
        </tr>
        <tr>
            <th>
                <i class='fa fa-caret-right'  title='MySQL " . _MD_TADADM_VERSION . "'></i>
                MySQL" . _MD_TADADM_VERSION . _TAD_FOR . '
            </th>
            <td>
                ' . $mysql_version . "
            </td>
        </tr>
        <tr>
            <th>
                <i class='fa fa-caret-right'  title='MySQL " . _MD_TADADM_CONNECT . "'></i>
                MySQL" . _MD_TADADM_CONNECT . _TAD_FOR . '
            </th>
            <td>
                ' . $mysql_connect . "
            </td>
        </tr>
        <tr>
            <th>
                <i class='fa fa-caret-right'  title='" . _MD_TADADM_AVAILABLE_SPACE . "'></i>
                " . _MD_TADADM_AVAILABLE_SPACE . _TAD_FOR . '
            </th>
            <td>
                ' . get_free_space() . "
            </td>
        </tr>
    </table>
    </div>

    <div class='card'>
    <div class='card-header text-white bg-info'>" . _MD_TADADM_USER_AND_GROUP . "</div>

    <table class='table table-striped'>
        $other
    </table>
</div>";

$theme_set = ('default' === $xoopsConfig['theme_set']) ? '' : "<li class='list-group-item'>" . tad_adm_post_action('theme_default', sprintf(_MD_TADADM_DEFAULT_THEME_DESC, htmlspecialchars((string) $xoopsConfig['theme_set'], ENT_QUOTES, 'UTF-8'))) . '</li>';

$main2 = "
<div class='card'>
    <div class='card-header text-white bg-warning'>" . _MD_TADADM_AID . "</div>
    <ul class='list-group list-group-flush'>
        " . debug_mode_tool() . "
        <li class='list-group-item'>" . tad_adm_post_action('clear_cache', _MD_TADADM_CLEAR_CACHE . files_counter()) . "</li>
        <li class='list-group-item'>" . tad_adm_post_action('clear_session', _MD_TADADM_CLEAR_SESSION . session_size()) . "</li>
        $theme_set

    </ul>
</div>";

$close_site = '1' == $xoopsConfig['closesite']
    ? "<li class='list-group-item'>" . tad_adm_post_action('close_site', _MD_TADADM_ENABLE_WEB, ['v' => 0]) . '</li>'
    : "<li class='list-group-item'>" . tad_adm_post_action('close_site', _MD_TADADM_UNABLE_WEB, ['v' => 1]) . '</li>';

$admin_options = '';
$sql           = 'SELECT a.`uid`, b.`uname`
        FROM `' . $xoopsDB->prefix('groups_users_link') . '` AS a
        LEFT JOIN `' . $xoopsDB->prefix('users') . '` AS b ON a.`uid` = b.`uid`
        WHERE a.`groupid`=?';
$result = Utility::query($sql, 'i', [1]) or Utility::web_error($sql, __FILE__, __LINE__);
while (list($uid, $uname) = $xoopsDB->fetchRow($result)) {
    $uid_safe   = (int) $uid;
    $uname_safe = htmlspecialchars((string) $uname, ENT_QUOTES, 'UTF-8');
    $admin_options .= "<option value='{$uid_safe}'>{$uname_safe}</option>";
}

$XoopsFormSelectUserOption = '';
$sql                       = 'SELECT a.`uid`, b.`uname`, b.`name`
        FROM `' . $xoopsDB->prefix('groups_users_link') . '` AS a
        LEFT JOIN `' . $xoopsDB->prefix('users') . '` AS b ON a.`uid` = b.`uid`
        WHERE a.`groupid`=?
        ORDER BY b.`uname`';
$result = Utility::query($sql, 'i', [2]) or Utility::web_error($sql, __FILE__, __LINE__);

while (list($uid, $uname, $name) = $xoopsDB->fetchRow($result)) {
    if (empty($uname)) {
        continue;
    }

    $uid_safe   = (int) $uid;
    $uname_safe = htmlspecialchars((string) $uname, ENT_QUOTES, 'UTF-8');
    $showname   = empty($name) ? '' : ' (' . htmlspecialchars((string) $name, ENT_QUOTES, 'UTF-8') . ')';
    $XoopsFormSelectUserOption .= "<option value='{$uid_safe}'>{$uname_safe}{$showname}</option>";
}

if ('' != $TadAmModuleConfig['module_id_temp']) {
    $modules_amount = count(explode(',', $TadAmModuleConfig['module_id_temp']));
    $modules_tool   = tad_adm_post_action('enable_modules', sprintf(_MD_TADADM_ENABLE_ALL_MODS, $modules_amount));
} else {
    //計算模組數量
    $sql = 'SELECT COUNT(*)
        FROM `' . $xoopsDB->prefix('modules') . '`
        WHERE `isactive`=1 AND `dirname`!=? AND `dirname`!=?';
    $result = Utility::query($sql, 'ss', ['system', 'tad_adm']) or Utility::web_error($sql, __FILE__, __LINE__);

    list($modules_amount) = $xoopsDB->fetchRow($result);

    $modules_tool = tad_adm_post_action('unable_modules', sprintf(_MD_TADADM_UNABLE_ALL_MODS, $modules_amount));
}

if ('' != $TadAmModuleConfig['block_id_temp']) {
    $blocks_amount = count(explode(',', $TadAmModuleConfig['block_id_temp']));
    $blocks_tool   = tad_adm_post_action('enable_blocks', sprintf(_MD_TADADM_ENABLE_ALL_BLOCKS, $blocks_amount));
} else {
    //計算區塊數量
    $sql = 'SELECT COUNT(*)
        FROM `' . $xoopsDB->prefix('newblocks') . '`
        WHERE `visible`=1';
    $result              = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($blocks_amount) = $xoopsDB->fetchRow($result);

    $blocks_tool = tad_adm_post_action('unable_blocks', sprintf(_MD_TADADM_UNABLE_ALL_BLOCKS, $blocks_amount));
}

$main3 = "
<div class='card'>
    <div class='card-header text-white bg-danger'>" . _MD_TADADM_WEB_FUNCTION . "</div>
    <ul class='list-group list-group-flush'>
        $close_site
        <li class='list-group-item'>
            <form  action='index.php' method='post' role='form'>
                {$token_html}
                <div class='form-group row mb-3'>
                    <label class='sr-only visually-hidden'>" . _MD_TADADM_RESET_ADMIN_PASSWD . "</label>
                    <div class='col-sm-4'>
                        <select name='uid' class='form-control form-select'>
                            {$admin_options}
                        </select>
                    </div>
                    <div class='col-sm-4'>
                        <input type='text' name='new_pass' class='form-control' placeholder='" . _MD_TADADM_RESET_ADMIN_PASSWD . "'>
                    </div>
                    <div class='col-sm-4 d-grid gap-2'>
                        <input type='hidden' name='op' value='reset_mem'>
                        <button type='submit' class='btn btn-danger btn-block'>" . _MD_TADADM_RESET_ADMIN_PASSWD . "</button>
                    </div>
                </div>
            </form>
        </li>
        <li class='list-group-item'>
            <form action='index.php' method='post' role='form'>
                {$token_html}
                <div class='form-group row mb-3'>
                    <label class='sr-only visually-hidden'>" . _MD_TADADM_RESET_MEM_PASSWD . "</label>
                    <div class='col-sm-4'>
                        <select name='uid' class='form-control form-select'>
                        {$XoopsFormSelectUserOption}
                        </select>
                    </div>
                    <div class='col-sm-4'>
                        <input type='text' name='new_pass' class='form-control' placeholder='" . _MD_TADADM_RESET_MEM_PASSWD . "'>
                    </div>
                    <div class='col-sm-4 d-grid gap-2'>
                        <input type='hidden' name='op' value='reset_mem'>
                        <button type='submit' class='btn btn-warning btn-block'>" . _MD_TADADM_RESET_MEM_PASSWD . "</button>
                    </div>
                </div>
            </form>
        </li>
        <li class='list-group-item'>{$blocks_tool}</li>
        <li class='list-group-item'>{$modules_tool}</li>
    </ul>
</div>";

$into_admin  = ($xoopsUser) ? "<li class='list-group-item'><a href='" . XOOPS_URL . "/admin.php' target='_blank'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_ADMIN . "'></i> " . _MD_TADADM_ADMIN . '</a></li>' : '';
$into_setup  = ($xoopsUser) ? "<li class='list-group-item'><a href='" . XOOPS_URL . "/modules/system/admin.php?fct=preferences&op=show&confcat_id=1' target='_blank'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_PREFERENCES . "'></i> " . _MD_TADADM_PREFERENCES . '</a></li>' : '';
$into_module = ($xoopsUser) ? "<li class='list-group-item'><a href='" . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin' target='_blank'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_MODULES . "'></i> " . _MD_TADADM_MODULES . '</a></li>' : '';

$main4 = "
<div class='card'>
    <div class='card-header text-white bg-success'>" . _MD_TADADM_LINKS . "</div>
    <ul class='list-group list-group-flush'>
        <li class='list-group-item'>
            <a href='" . XOOPS_URL . "' target='_blank'>
                <i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_LINK_TO . ' ' . XOOPS_URL . "'></i>
                " . _MD_TADADM_LINK_TO . ' ' . XOOPS_URL . "
            </a>
        </li>
        <li class='list-group-item'>
            <a href='" . XOOPS_URL . "/user.php' target='_blank'>
                <i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_LOGIN_PAGE . "'></i>
                " . _MD_TADADM_LOGIN_PAGE . "
            </a>
        </li>
        <li class='list-group-item'>
            <a href='index.php?op=phpinfo'>
            <i class='fa fa-chevron-circle-right'  title='phpinfo'></i>
            phpinfo()
            </a>
        </li>
        $into_admin
        $into_setup
        $into_module
        <li class='list-group-item'><a href='pma.php' target='_blank'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_DB . "'></i> " . _MD_TADADM_DB . "</a></li>
        <li class='list-group-item'><a href='$logout' target='_blank'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_LOGOUT . "'></i> " . _MD_TADADM_LOGOUT . '</a></li>

    </ul>
</div>';

$content = '
<div class="page-header">
    <h2>' . _MD_TADADM_NAME . '</h2>
</div>
<div class="row">
    <div class="col-lg-4 col-sm-6">' . $main1 . '</div>
    <div class="col-lg-4 col-sm-6">' . $main2 . $main3 . '</div>
    <div class="col-lg-4 col-sm-6">' . $main4 . '</div>
</div>';

echo Utility::html5($content, false, true, 4, true, 'container-fluid');
