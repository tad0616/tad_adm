<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_adm_adm_spam.html";
include_once "header.php";
include_once "../function.php";

/*-----------function區--------------*/
//列出所有使用者
function list_user($op = "", $mode = "normal")
{
    global $xoopsDB, $xoopsModuleConfig, $xoopsTpl;
    $all_data = "";
    if ($op == "byNeverLoginDays") {
        $dayLimit    = time() - $_GET['days'] * 86400;
        $andDayLimit = " and last_login=0 and user_regdate <= $dayLimit";
    } elseif ($op == "byNeverStartDays") {
        $dayLimit    = time() - $_GET['days'] * 86400;
        $andDayLimit = " and level=0 and user_regdate <= $dayLimit";
    } elseif ($op == "byEmail") {
        $andDayLimit = " and email like '%{$_GET['byemail']}'";
    } else {
        $andDayLimit = "";
    }
    $sql = "select * from " . $xoopsDB->prefix("users") . " where 1 $andDayLimit order by uid desc";

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = getPageBar($sql, $xoopsModuleConfig['list_amount'], 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result                = $xoopsDB->query($sql) or die($sql . "<br>" . mysql_error());
    $_SESSION['chk_start'] = time();
    $i                     = 0;
    $all_data              = "";
    while ($data = $xoopsDB->fetchArray($result)) {
        foreach ($data as $k => $v) {
            $$k = $v;
        }

        if ($mode != "force") {
            $adm = get_tad_adm($uid);
        } else {
            $adm['email'] = "";
        }

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

        $days_between = ceil(abs(time() - $last_login) / 86400);

        $bgcolor = "white";
        $checked = "";
        if ($appears > 0) {
            $color   = "red";
            $checked = "checked";
            if ($posts > 0) {
                $bgcolor = "yellow";
                $checked = "";
            }
        } elseif ($posts > 0) {
            $color = 'blue';
        } elseif (!empty($user_sig)) {
            if (preg_match("/[\x7f-\xff]/", $user_sig) or preg_match("/.tw/i", $user_sig)) {
                $checked = "";
            } else {
                $checked = "checked";
                $color   = "#CC6600";
            }
        } else {
            $color = '#505050';
        }

        $user_regdate = date('Y-m-d', $user_regdate);
        $last_login   = empty($last_login) ? _MA_TADADM_NEVERLOGIN : date('Y-m-d', $last_login);

        $all_data[$i]['color']        = $color;
        $all_data[$i]['bgcolor']      = $bgcolor;
        $all_data[$i]['uid']          = $uid;
        $all_data[$i]['uname']        = $uname;
        $all_data[$i]['name']         = $name;
        $all_data[$i]['posts']        = $posts;
        $all_data[$i]['email']        = $email;
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
    $days    = isset($_REQUEST['days']) ? intval($_REQUEST['days']) : 0;
    $days    = empty($days) ? 100 : $days;
    $g2p     = isset($_GET['g2p']) ? intval($_GET['g2p']) : 1;
    $byemail = isset($_REQUEST['byemail']) ? $_REQUEST['byemail'] : "";
    $max     = $xoopsModuleConfig['list_amount'] * 20;

    $xoopsTpl->assign('_MA_TADADM_AUTO_CHECK_DESC', sprintf(_MA_TADADM_AUTO_CHECK_DESC, $max));
    $xoopsTpl->assign('_MA_TADADM_WORKTIME', sprintf(_MA_TADADM_WORKTIME, $time));
    $xoopsTpl->assign('g2p', $g2p);
    $xoopsTpl->assign('_MA_TADADM_TOTAL', sprintf(_MA_TADADM_TOTAL, $total));
    $xoopsTpl->assign('all_data', $all_data);
    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('_MA_TADADM_BY_EMAIL', sprintf(_MA_TADADM_BY_EMAIL, "<input type='text' name='byemail' value='{$byemail}' class='span4' size=20>"));
    $xoopsTpl->assign('_MA_TADADM_NEVERLOGIN_DAY', sprintf(_MA_TADADM_NEVERLOGIN_DAY, "<input type='text' name='days' value='$days' class='span1' size=4>"));
    $xoopsTpl->assign('_MA_TADADM_NEVERSTART_DAY', sprintf(_MA_TADADM_NEVERSTART_DAY, "<input type='text' name='days' value='$days' class='span1' size=4>"));
}

//列出所有垃圾郵件
function list_spam()
{
    global $xoopsDB, $xoopsModuleConfig, $xoopsTpl;
    $all_data = "";

    $sql = "select a.uid,a.email,a.chk_date,b.`name`, b.`uname`, b.`email`, b.`url`, b.`user_avatar`, b.`user_regdate`, b.`user_icq`, b.`user_from`, b.`user_sig`, b.`user_viewemail`, b.`actkey`, b.`user_aim`, b.`user_yim`, b.`user_msnm`, b.`pass`, b.`posts`, b.`attachsig`, b.`rank`, b.`level`, b.`theme`, b.`timezone_offset`, b.`last_login`, b.`umode`, b.`uorder`, b.`notify_method`, b.`notify_mode`, b.`user_occ`, b.`bio`, b.`user_intrest`, b.`user_mailok` from " . $xoopsDB->prefix("tad_adm") . " as a left join " . $xoopsDB->prefix("users") . " as b on a.uid=b.uid where a.`result`='1' order by a.uid desc";

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = getPageBar($sql, 500, 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result = $xoopsDB->query($sql) or die($sql . "<br>" . mysql_error());

    $all_data = "";
    $i        = 0;

    while ($all = $xoopsDB->fetchArray($result)) {
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        $days_between = ceil(abs(time() - $last_login) / 86400);

        $bgcolor = "white";
        $checked = "checked";
        if ($appears > 0) {
            $color = "red";
            if ($posts > 0) {
                $bgcolor = "yellow";
                $checked = "";
            }
        } elseif ($posts > 0) {
            $color   = 'blue';
            $checked = "";
        } elseif (!empty($user_sig)) {
            if (preg_match("/[\x7f-\xff]/", $user_sig) or preg_match("/.tw/i", $user_sig)) {
            } else {
                $color = "#CC6600";
            }
        } else {
            $color = '#505050';
        }

        $user_regdate = date('Y-m-d', $user_regdate);
        $last_login   = empty($last_login) ? _MA_TADADM_NEVERLOGIN : date('Y-m-d', $last_login);

        $all_data[$i]['color']        = $color;
        $all_data[$i]['bgcolor']      = $bgcolor;
        $all_data[$i]['uid']          = $uid;
        $all_data[$i]['uname']        = $uname;
        $all_data[$i]['name']         = $name;
        $all_data[$i]['posts']        = $posts;
        $all_data[$i]['email']        = $email;
        $all_data[$i]['appears']      = $appears;
        $all_data[$i]['user_regdate'] = $user_regdate;
        $all_data[$i]['last_login']   = $last_login;
        $all_data[$i]['days_between'] = $days_between;
        $all_data[$i]['user_sig']     = $user_sig;
        $all_data[$i]['checked']      = $checked;

        $i++;
    }

    $xoopsTpl->assign('_MA_TADADM_TOTAL', sprintf(_MA_TADADM_TOTAL, $total));
    $xoopsTpl->assign('g2p', $_GET['g2p']);
    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('all_data', $all_data);
}

//新增資料到tad_adm中
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
    $xoopsDB->queryF($sql) or die($sql . "<br>" . mysql_error());

}

//以流水號取得某筆tad_adm資料
function get_tad_adm($uid = "")
{
    global $xoopsDB;
    if (empty($uid)) {
        return;
    }

    $sql    = "select * from `" . $xoopsDB->prefix("tad_adm") . "` where `uid` = '{$uid}'";
    $result = $xoopsDB->query($sql) or die($sql . "<br>" . mysql_error());
    $data   = $xoopsDB->fetchArray($result);
    return $data;
}

//刪除會員
function del_user($del_uid)
{
    global $xoopsDB;
    if (empty($del_uid)) {
        return;
    }

    $sql = "delete from `" . $xoopsDB->prefix("tad_adm") . "` where `uid` = '{$del_uid}'";
    $xoopsDB->queryF($sql) or die($sql . "<br>" . mysql_error());

    $member_handler = &xoops_gethandler('member');
    $user           = &$member_handler->getUser($del_uid);
    if (empty($user)) {
        return;
    }

    $groups = $user->getGroups();
    if (in_array(XOOPS_GROUP_ADMIN, $groups)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADADM_DONT_DEL_ROOT);
    } elseif (!$member_handler->deleteUser($user)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADADM_DEL_FAIL);
    } else {
        $online_handler = &xoops_gethandler('online');
        $online_handler->destroy($del_uid);
        xoops_notification_deletebyuser($del_uid);
        return;
        //redirect_header($_SERVER['PHP_SELF'], 3, "刪除成功！");
    }
    exit;
}

//刪除所有選取的使用者
function del_all_user($uid_arr = array())
{
    foreach ($uid_arr as $del_uid) {
        del_user($del_uid);
    }
}
/*-----------執行動作判斷區----------*/
$op   = empty($_REQUEST['op']) ? "" : $_REQUEST['op'];
$g2p  = empty($_REQUEST['g2p']) ? 1 : $_REQUEST['g2p'];
$mode = empty($_REQUEST['mode']) ? "" : $_REQUEST['mode'];

switch ($op) {
    /*---判斷動作請貼在下方---*/
    case "del_user":
        del_all_user($_POST['uid']);
        redirect_header($_SERVER['PHP_SELF'] . "?g2p=$g2p", 3, _MA_TADADM_DEL_OK);
        break;

    case "spam":
        list_spam();
        $xoopsTpl->assign('op', spam);
        break;

    default:
        list_user($op, $mode);
        if ($op == "all") {
            $g2p++;
            redirect_header($_SERVER['PHP_SELF'] . "?op=all&mode=$mode&g2p=$g2p", 3, _MA_TADADM_NEXT_PAGE);
        }
        break;

    /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
include_once 'footer.php';
