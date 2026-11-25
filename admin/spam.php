<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_adm_adm_spam.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------執行動作判斷區----------*/
$op      = Request::getString('op');
$mode    = Request::getString('mode');
$byemail = Request::getString('byemail');
$g2p     = Request::getInt('g2p', 1);
$uid     = Request::getArray('uid');
$days    = Request::getInt('days');

switch ($op) {
    case 'del_user':
        if ('POST' !== strtoupper($_SERVER['REQUEST_METHOD'] ?? '') || !isset($GLOBALS['xoopsSecurity']) || !is_object($GLOBALS['xoopsSecurity']) || !$GLOBALS['xoopsSecurity']->check()) {
            $err = isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) ? implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()) : _NOPERM;
            redirect_header($_SERVER['PHP_SELF'] . "?g2p=$g2p", 3, $err);
            exit;
        }
        del_all_user($uid);
        redirect_header($_SERVER['PHP_SELF'] . "?g2p=$g2p", 3, _MA_TADADM_DEL_OK);
        break;

    case 'spam':
        list_spam($g2p);
        $xoopsTpl->assign('op', 'spam');
        break;

    default:
        list_user($op, $mode, $days, $byemail, $g2p);
        if ('all' === $op) {
            $g2p++;
            $safe_mode = ('force' === $mode) ? 'force' : 'normal';
            redirect_header($_SERVER['PHP_SELF'] . "?op=all&mode={$safe_mode}&g2p={$g2p}", 3, _MA_TADADM_NEXT_PAGE);
        }
        break;
}

/*-----------秀出結果區--------------*/
$token_html = isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) ? $GLOBALS['xoopsSecurity']->getTokenHTML() : '';
$xoopsTpl->assign('token_html', $token_html);
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/
//列出所有使用者
function list_user($op = '', $mode = 'normal', $days = '', $byemail = '', $g2p = 1)
{
    global $xoopsDB, $xoopsModuleConfig, $xoopsTpl;
    if ('byNeverLoginDays' === $op) {
        $dayLimit    = time() - (int) $days * 86400;
        $andDayLimit = " AND u.`last_login`=0 AND u.`user_regdate` <= {$dayLimit}";
    } elseif ('byNeverStartDays' === $op) {
        $dayLimit    = time() - (int) $days * 86400;
        $andDayLimit = " AND u.`level`=0 AND u.`user_regdate` <= {$dayLimit}";
    } elseif ('byEmail' === $op) {
        $byemail_esc = $xoopsDB->escape(addcslashes((string) $byemail, '%_'));
        $andDayLimit = " AND u.`email` LIKE '%{$byemail_esc}'";
    } else {
        $andDayLimit = '';
    }
    $sql = 'SELECT u.`uid`, u.`uname`, u.`name`, u.`posts`, u.`email`, u.`url`, u.`user_regdate`, u.`last_login`, u.`user_sig`, a.`email` AS `adm_email`, a.`result` AS `adm_result`
        FROM `' . $xoopsDB->prefix('users') . '` AS u
        LEFT JOIN `' . $xoopsDB->prefix('tad_adm') . '` AS a ON u.`uid` = a.`uid`
        WHERE 1' . $andDayLimit . '
        ORDER BY u.`uid` DESC';

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, $xoopsModuleConfig['list_amount'], 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result                = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $_SESSION['chk_start'] = time();
    $i                     = 0;
    $all_data              = [];
    $sfs_context           = stream_context_create(['http' => ['timeout' => 5], 'ssl' => ['verify_peer' => true, 'verify_peer_name' => true]]);
    while (false !== ($data = $xoopsDB->fetchArray($result))) {
        $uid          = (int) ($data['uid'] ?? 0);
        $uname        = (string) ($data['uname'] ?? '');
        $name         = (string) ($data['name'] ?? '');
        $posts        = (int) ($data['posts'] ?? 0);
        $email        = (string) ($data['email'] ?? '');
        $url          = (string) ($data['url'] ?? '');
        $user_regdate = (int) ($data['user_regdate'] ?? 0);
        $last_login   = (int) ($data['last_login'] ?? 0);
        $user_sig     = (string) ($data['user_sig'] ?? '');
        $adm_email    = ('force' !== $mode) ? (string) ($data['adm_email'] ?? '') : '';

        if ('' !== $adm_email && $adm_email === $email) {
            $appears = (int) ($data['adm_result'] ?? 0);
        } else {
            $json   = '';
            $handle = @fopen('https://api.stopforumspam.org/api?email=' . rawurlencode($email) . '&json', 'rb', false, $sfs_context);
            if ($handle) {
                $json = (string) fgets($handle, 4096);
                fclose($handle);
            }

            $buffer  = '' !== $json ? json_decode($json, true) : null;
            $appears = is_array($buffer) ? (int) ($buffer['email']['appears'] ?? 0) : 0;
            replace_tad_adm($uid, $email, (string) $appears);
        }

        $days_between = ceil(abs(time() - $last_login) / 86400);

        $bgcolor = 'white';
        $checked = '';
        $color   = '#505050';
        if ($appears > 0) {
            $color   = 'red';
            $checked = 'checked';
            if ($posts > 0) {
                $bgcolor = 'yellow';
                $checked = '';
            }
        } elseif ($posts > 0) {
            $color = 'blue';
        } elseif (!empty($user_sig)) {
            if (preg_match("/[\x7f-\xff]/", $user_sig) or preg_match('/.tw/i', $user_sig)) {
                $checked = '';
            } else {
                $checked = 'checked';
                $color   = '#CC6600';
            }
        }

        $user_regdate = $user_regdate > 0 ? date('Y-m-d', $user_regdate) : '';
        $last_login   = empty($last_login) ? _MA_TADADM_NEVERLOGIN : date('Y-m-d', $last_login);

        $all_data[$i]['color']        = $color;
        $all_data[$i]['bgcolor']      = $bgcolor;
        $all_data[$i]['uid']          = $uid;
        $all_data[$i]['uname']        = $uname;
        $all_data[$i]['name']         = $name;
        $all_data[$i]['posts']        = $posts;
        $all_data[$i]['email']        = $email;
        $all_data[$i]['url']          = $url;
        $all_data[$i]['appears']      = $appears;
        $all_data[$i]['user_regdate'] = $user_regdate;
        $all_data[$i]['last_login']   = $last_login;
        $all_data[$i]['days_between'] = $days_between;
        $all_data[$i]['user_sig']     = $user_sig;
        $all_data[$i]['checked']      = $checked;

        $i++;
    }

    if (empty($all_data)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADADM_CKECKOK);
        exit;
    }

    $_SESSION['chk_end'] = time();

    $time    = $_SESSION['chk_end'] - $_SESSION['chk_start'];
    $days    = (int) $days;
    $days    = empty($days) ? 100 : $days;
    // 會直接放進 input 的 value，必須跳脫
    $byemail = htmlspecialchars(Request::getString('byemail'), ENT_QUOTES);
    $max     = $xoopsModuleConfig['list_amount'] * 20;

    $xoopsTpl->assign('_MA_TADADM_AUTO_CHECK_DESC', sprintf(_MA_TADADM_AUTO_CHECK_DESC, $max));
    $xoopsTpl->assign('_MA_TADADM_WORKTIME', sprintf(_MA_TADADM_WORKTIME, $time));
    $xoopsTpl->assign('g2p', $g2p);
    $xoopsTpl->assign('_MA_TADADM_TOTAL', sprintf(_MA_TADADM_TOTAL, $total));
    $xoopsTpl->assign('all_data', $all_data);
    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('_MA_TADADM_BY_EMAIL', sprintf(_MA_TADADM_BY_EMAIL, "<input type='text' name='byemail' value='{$byemail}' class='my-input' size=20>"));
    $xoopsTpl->assign('_MA_TADADM_NEVERLOGIN_DAY', sprintf(_MA_TADADM_NEVERLOGIN_DAY, "<input type='text' name='days' value='$days' class='my-input' size=4>"));
    $xoopsTpl->assign('_MA_TADADM_NEVERSTART_DAY', sprintf(_MA_TADADM_NEVERSTART_DAY, "<input type='text' name='days' value='$days' class='my-input' size=4>"));
}

//列出所有垃圾郵件
function list_spam($g2p = 1)
{
    global $xoopsDB, $xoopsTpl;

    $sql = 'SELECT a.`uid`, a.`result` AS `appears`, a.`chk_date`, COALESCE(b.`email`, a.`email`) AS `email`, b.`name`, b.`uname`, b.`url`, b.`user_regdate`, b.`user_sig`, b.`posts`, b.`last_login` FROM `'
    . $xoopsDB->prefix('tad_adm')
    . '` AS a LEFT JOIN `'
    . $xoopsDB->prefix('users')
        . '` AS b ON a.`uid`=b.`uid` WHERE a.`result` > 0 ORDER BY a.`uid` DESC';

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 500, 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $all_data = [];
    $i        = 0;

    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        $uid          = (int) ($all['uid'] ?? 0);
        $uname        = (string) ($all['uname'] ?? '');
        $name         = (string) ($all['name'] ?? '');
        $posts        = (int) ($all['posts'] ?? 0);
        $email        = (string) ($all['email'] ?? '');
        $url          = (string) ($all['url'] ?? '');
        $appears      = (int) ($all['appears'] ?? 0);
        $user_regdate = (int) ($all['user_regdate'] ?? 0);
        $last_login   = (int) ($all['last_login'] ?? 0);
        $user_sig     = (string) ($all['user_sig'] ?? '');

        $days_between = ceil(abs(time() - $last_login) / 86400);

        $bgcolor = 'white';
        $checked = 'checked';
        $color   = '#505050';
        if ($appears > 0) {
            $color = 'red';
            if ($posts > 0) {
                $bgcolor = 'yellow';
                $checked = '';
            }
        } elseif ($posts > 0) {
            $color   = 'blue';
            $checked = '';
        } elseif (!empty($user_sig)) {
            if (preg_match("/[\x7f-\xff]/", $user_sig) or preg_match('/.tw/i', $user_sig)) {
            } else {
                $color = '#CC6600';
            }
        }

        $user_regdate = $user_regdate > 0 ? date('Y-m-d', $user_regdate) : '';
        $last_login   = empty($last_login) ? _MA_TADADM_NEVERLOGIN : date('Y-m-d', $last_login);

        $all_data[$i]['color']        = $color;
        $all_data[$i]['bgcolor']      = $bgcolor;
        $all_data[$i]['uid']          = $uid;
        $all_data[$i]['uname']        = $uname;
        $all_data[$i]['name']         = $name;
        $all_data[$i]['posts']        = $posts;
        $all_data[$i]['email']        = $email;
        $all_data[$i]['url']          = $url;
        $all_data[$i]['appears']      = $appears;
        $all_data[$i]['user_regdate'] = $user_regdate;
        $all_data[$i]['last_login']   = $last_login;
        $all_data[$i]['days_between'] = $days_between;
        $all_data[$i]['user_sig']     = $user_sig;
        $all_data[$i]['checked']      = $checked;

        $i++;
    }

    $xoopsTpl->assign('_MA_TADADM_TOTAL', sprintf(_MA_TADADM_TOTAL, $total));
    $xoopsTpl->assign('g2p', $g2p);
    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('all_data', $all_data);
}

//新增資料到tad_adm中
function replace_tad_adm($uid = '', $email = '', $result = '')
{
    global $xoopsDB, $xoopsUser;

    $chk_date = date('Y-m-d H:i:s', xoops_getUserTimestamp(time()));
    $sql      = 'REPLACE INTO `' . $xoopsDB->prefix('tad_adm') . '`
    (`uid`, `email`, `result`, `chk_date`)
    VALUES (?, ?, ?, ?)';
    Utility::query($sql, 'isss', [$uid, $email, $result, $chk_date]) or Utility::web_error($sql, __FILE__, __LINE__);

}

//以流水號取得某筆tad_adm資料
function get_tad_adm($uid = '')
{
    global $xoopsDB;
    if (empty($uid)) {
        return;
    }

    $sql = 'SELECT *
    FROM `' . $xoopsDB->prefix('tad_adm') . '`
    WHERE `uid` = ?';
    $result = Utility::query($sql, 'i', [$uid]) or Utility::web_error($sql, __FILE__, __LINE__);

    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//刪除會員
function del_user($del_uid)
{
    global $xoopsDB;
    $del_uid = (int) $del_uid;
    if ($del_uid <= 0) {
        return;
    }

    $memberHandler = xoops_getHandler('member');
    $user          = $memberHandler->getUser($del_uid);
    if (!empty($user)) {
        $groups = $user->getGroups();
        if (in_array(XOOPS_GROUP_ADMIN, $groups)) {
            redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADADM_DONT_DEL_ROOT);
        } elseif (!$memberHandler->deleteUser($user)) {
            redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADADM_DEL_FAIL);
        } else {
            $onlineHandler = xoops_getHandler('online');
            $onlineHandler->destroy($del_uid);
            xoops_notification_deletebyuser($del_uid);
        }
    }

    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_adm') . '`
    WHERE `uid` = ?';
    Utility::query($sql, 'i', [$del_uid]) or Utility::web_error($sql, __FILE__, __LINE__);
}

//刪除所有選取的使用者
function del_all_user($uid_arr = [])
{
    if (!is_array($uid_arr)) {
        return;
    }
    foreach ($uid_arr as $del_uid) {
        del_user($del_uid);
    }
}
