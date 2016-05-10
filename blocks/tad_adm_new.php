<?php
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

    $all_data = "";

    $sql    = "select * from " . $xoopsDB->prefix("users") . " order by uid desc limit 0,{$options[0]}";
    $result = $xoopsDB->query($sql) or die($sql . "<br>" . $xoopsDB->error());

    while ($data = $xoopsDB->fetchArray($result)) {
        foreach ($data as $k => $v) {
            $$k = $v;
        }

        $adm = get_tad_adm($uid);
        if ($adm['email'] == $email) {
            $appears = $adm['result'];
        } else {

            $handle = fopen("http://www.stopforumspam.com/api?email={$email}&f=json", "r");
            if ($handle) {
                $json = fgets($handle, 4096);
                fclose($handle);
            }

            $buffer  = json_decode($json, true);
            $appears = $buffer['email']['appears'];
            replace_tad_adm($uid, $email, $appears);
        }

        $bgcolor = "transparent";
        $checked = "";
        if ($appears > 0) {
            $color   = "red";
            $checked = "checked";
            if ($posts > 0) {
                $bgcolor = "yellow";
                $checked = "";
            }
        } elseif ($posts > 0) {
            continue;
        } elseif (!empty($user_sig)) {
            if (preg_match("/[\x7f-\xff]/", $user_sig) or preg_match("/.tw/i", $user_sig)) {
                continue;
            } else {
                $checked = "checked";
                $color   = "#CC6600";
            }
        } else {
            continue;
        }

        $user_regdate = date('Y-m-d', $user_regdate);
        $last_login   = empty($last_login) ? _MB_TADADM_NEVERLOGIN : date('Y-m-d', $last_login);

        $all_data .= "
    <fieldset style='color:{$color};background-color:{$bgcolor};'>
    <legend><input type='checkbox' name='uid[]' value='$uid' $checked id='uid_{$uid}'>{$uname}<label for='uid_{$uid}'> ({$uid}){$name}</label></legend>
    <div style='word-wrap:break-word;word-break:break-all;font-size:10px;'><label for='uid_{$uid}'>$email</label></div>
    <div style='word-wrap:break-word;word-break:break-all;font-size:10px;'><label for='uid_{$uid}'>$url</label></div>
    <div style='word-wrap:break-word;word-break:break-all;font-size:10px;'>$user_regdate ~ $last_login</div>
    <div style='word-wrap:break-word;word-break:break-all;font-size:10px;'>$user_sig</div>
    </fieldset>";
    }

    if (empty($all_data)) {
        return;
    }

    $block = "
  <form action='" . XOOPS_URL . "/modules/tad_adm/admin/spam.php' method='post'>
    $all_data
    <input type='hidden' name='g2p' value='{$_GET['g2p']}'>
    <input type='hidden' name='op' value='del_user'>
    <input type='submit' value='" . _MB_TADADM_DEL_CHK . "'>
  </form>
  ";
    return $block;
}

//區塊編輯函式 (tad_adm_new_edit)
function tad_adm_new_edit($options)
{
    $form = _MB_TADADM_SEARCH_NUM . "<input type='text' name='options[0]' value='{$options[0]}'>
  <div>" . _MB_TADADM_SEARCH_NUM_DESC . "</div>";
    return $form;
}

//新增資料到tad_adm中
if (!function_exists('replace_tad_adm')) {
    function replace_tad_adm($uid = '', $email = '', $result = '')
    {
        global $xoopsDB, $xoopsUser;

        $myts   = &MyTextSanitizer::getInstance();
        $email  = $myts->addSlashes($email);
        $result = $myts->addSlashes($result);

        $chk_date = date('Y-m-d H:i:s', xoops_getUserTimestamp(time()));

        $sql = "replace into `" . $xoopsDB->prefix("tad_adm") . "`
    (`uid` , `email` , `result` , `chk_date`)
    values('{$uid}' , '{$email}' , '{$result}' , '{$chk_date}')";
        $xoopsDB->queryF($sql) or die($sql . "<br>" . $xoopsDB->error());

    }
}

if (!function_exists('get_tad_adm')) {
    //以流水號取得某筆tad_adm資料
    function get_tad_adm($uid = "")
    {
        global $xoopsDB;
        if (empty($uid)) {
            return;
        }

        $sql    = "select * from `" . $xoopsDB->prefix("tad_adm") . "` where `uid` = '{$uid}'";
        $result = $xoopsDB->query($sql) or die($sql . "<br>" . $xoopsDB->error());
        $data   = $xoopsDB->fetchArray($result);
        return $data;
    }
}
