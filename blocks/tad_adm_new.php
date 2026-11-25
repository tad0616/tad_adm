<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}

//區塊主函式 (tad_adm_new)
function tad_adm_new($options)
{
    global $xoopsDB, $xoopsUser;

    if (!$xoopsUser) {
        return;
    }

    if (!$xoopsUser->isAdmin(1)) {
        return;
    }

    $limit    = isset($options[0]) && (int) $options[0] > 0 ? (int) $options[0] : 10;
    $all_data = '';
    $sql      = 'SELECT u.`uid`, u.`uname`, u.`name`, u.`posts`, u.`email`, u.`url`, u.`user_regdate`, u.`last_login`, u.`user_sig`, a.`email` AS `adm_email`, a.`result` AS `adm_result`
        FROM `' . $xoopsDB->prefix('users') . '` AS u
        LEFT JOIN `' . $xoopsDB->prefix('tad_adm') . '` AS a ON u.`uid` = a.`uid`
        ORDER BY u.`uid` DESC
        LIMIT ?, ?';
    $result      = Utility::query($sql, 'ii', [0, $limit]) or Utility::web_error($sql, __FILE__, __LINE__);
    $sfs_context = stream_context_create(['http' => ['timeout' => 5], 'ssl' => ['verify_peer' => true, 'verify_peer_name' => true]]);

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
        $adm_email    = (string) ($data['adm_email'] ?? '');

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

        $bgcolor = 'transparent';
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
            continue;
        } elseif (!empty($user_sig)) {
            if (preg_match("/[\x7f-\xff]/", $user_sig) or preg_match('/.tw/i', $user_sig)) {
                continue;
            }
            $checked = 'checked';
            $color   = '#CC6600';
        } else {
            continue;
        }

        $user_regdate_str = $user_regdate > 0 ? date('Y-m-d', $user_regdate) : '';
        $last_login_str   = empty($last_login) ? _MB_TADADM_NEVERLOGIN : date('Y-m-d', $last_login);

        $uname_safe    = htmlspecialchars($uname, ENT_QUOTES, 'UTF-8');
        $name_safe     = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $email_safe    = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $url_safe      = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        $user_sig_safe = htmlspecialchars($user_sig, ENT_QUOTES, 'UTF-8');

        $all_data .= "
        <fieldset style='color:{$color};background-color:{$bgcolor};'>
        <legend><input type='checkbox' name='uid[]' value='{$uid}' {$checked} id='uid_{$uid}'>{$uname_safe}<label for='uid_{$uid}'> ({$uid}){$name_safe}</label></legend>
        <div style='word-wrap:break-word;word-break:break-all;font-size: 0.625rem;'><label for='uid_{$uid}'>{$email_safe}</label></div>
        <div style='word-wrap:break-word;word-break:break-all;font-size: 0.625rem;'><label for='uid_{$uid}'>{$url_safe}</label></div>
        <div style='word-wrap:break-word;word-break:break-all;font-size: 0.625rem;'>{$user_regdate_str} ~ {$last_login_str}</div>
        <div style='word-wrap:break-word;word-break:break-all;font-size: 0.625rem;'>{$user_sig_safe}</div>
        </fieldset>";
    }

    if (empty($all_data)) {
        return;
    }
    $g2p        = Request::getInt('g2p', 1);
    $token_html = isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) ? $GLOBALS['xoopsSecurity']->getTokenHTML() : '';
    $block      = "
    <form action='" . XOOPS_URL . "/modules/tad_adm/admin/spam.php' method='post'>
        $all_data
        {$token_html}
        <input type='hidden' name='g2p' value='{$g2p}'>
        <input type='hidden' name='op' value='del_user'>
        <input type='submit' value='" . _MB_TADADM_DEL_CHK . "'>
    </form>
    ";

    return $block;
}

//區塊編輯函式 (tad_adm_new_edit)
function tad_adm_new_edit($options)
{
    $opt0 = isset($options[0]) ? (int) $options[0] : 10;
    $form = "
    <ol class='my-form'>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TADADM_SEARCH_NUM . "</lable>
            <div class='my-content'>
                <input type='text' name='options[0]' value='{$opt0}' class='my-input' size=5>
                <span class='my-help'>" . _MB_TADADM_SEARCH_NUM_DESC . '</span>
            </div>
        </li>
    </ol>
    ';

    return $form;
}

//新增資料到tad_adm中
if (!function_exists('replace_tad_adm')) {
    function replace_tad_adm($uid = '', $email = '', $result = '')
    {
        global $xoopsDB;

        $chk_date = date('Y-m-d H:i:s', xoops_getUserTimestamp(time()));
        $sql = 'REPLACE INTO `' . $xoopsDB->prefix('tad_adm') . '`
        (`uid`, `email`, `result`, `chk_date`)
        VALUES (?, ?, ?, ?)';
        $result = Utility::query($sql, 'isss', [$uid, $email, $result, $chk_date]) or Utility::web_error($sql, __FILE__, __LINE__);
    }
}

if (!function_exists('get_tad_adm')) {
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
}
