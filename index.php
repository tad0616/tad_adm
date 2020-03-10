<?php
use XoopsModules\Tadtools\Utility;

require_once dirname(dirname(__DIR__)) . '/mainfile.php';
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}
xoops_loadLanguage('main', 'tadtools');
require_once __DIR__ . '/function.php';

$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : '';

if ($xoopsUser) {
    $_SESSION['isAdmin'] = $xoopsUser->isAdmin(1);
} elseif ('helpme' === $op) {
    $moduleHandler = xoops_getHandler('module');
    $xoopsModule = $moduleHandler->getByDirname('tad_adm');
    $configHandler = xoops_getHandler('config');
    $xoopsModuleConfig = &$configHandler->getConfigsByCat(0, $xoopsModule->getVar('mid'));

    $_SESSION['isAdmin'] = ('' != $xoopsModuleConfig['login'] and '' != $_POST['help_passwd'] and $xoopsModuleConfig['login'] == $_POST['help_passwd']) ? true : false;
} elseif ('send_passwd' === $op) {
    send_passwd();
    header("location: {$_SERVER['PHP_SELF']}?op=forgot");
    exit;
}

if (!$_SESSION['isAdmin']) {
    $sql = 'update ' . $xoopsDB->prefix('config') . " set `conf_value`='' where `conf_name`='login' and `conf_title`='_MI_TADADM_LOGIN'";

    if ('forgot' === $op) {
        $form = '
        <div class="card">
            <div class="card-header text-white bg-primary">' . _MD_TADADM_FORGOT . '</div>
            <div class="card-body">
                <form action="' . $_SERVER['PHP_SELF'] . '" method="post" role="form">
                    <div class="form-group row">
                        <label class="col-sm-12">' . _MD_TADADM_INPUT_PASSWD_DESC . '</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3" for="help_passwd">' . _MD_TADADM_INPUT_PASSWD . '</label>
                        <div class="col-sm-7">
                            <input type="text" name="help_passwd" id="help_passwd" class="form-control" placeholder="">
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
        $form = '
        <form action="' . XOOPS_URL . '/user.php" method="post" role="form">
            <div class="card">
                <div class="card-header text-white bg-primary">' . _MD_TADADM_LOGIN . '</div>
                <div class="card-body">

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
                        <label class="col-sm-3 col-form-label text-md-right"><a href="index.php?op=forgot" style="font-size: 0.75em;color:gray;">' . _MD_TADADM_FORGOT . '</a></label>
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
                    <h1>' . _MD_TADADM_NAME . '</h1>
                </div>
                ' . $form . '
            </div>
        <div class="col-lg-3"></div>
    </div>
    ';
    die(Utility::html5($content, false, true, 4, true, 'container-fluid'));
}

$logout = ($xoopsUser) ? XOOPS_URL . '/user.php?op=logout' : 'index.php?op=logout';

$v = isset($_REQUEST['v']) ? $_REQUEST['v'] : '0';

switch ($op) {
    case 'unable_blocks':
        unable_blocks();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
    case 'unable_modules':
        unable_modules();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
    case 'enable_blocks':
        enable_blocks();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
    case 'enable_modules':
        enable_modules();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
    case 'reset_mem':
        reset_mem($_POST['uid'], $_POST['new_pass']);
        header('location: ' . XOOPS_URL . "/userinfo.php?uid={$_POST['uid']}");
        exit;
    case 'debug_mode':
        debug_mode($v);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
    case 'clear_cache':
        clear_cache();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
    case 'clear_session':
        clear_session();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
    case 'theme_default':
        theme_default();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
    case 'close_site':
        close_site($v);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
    case 'phpinfo':
        phpinfo();
        break;
    case 'logout':
        $_SESSION['isAdmin'] = false;
        header("location: {$_SERVER['PHP_SELF']}");
        exit;
}

//關閉所有模組
function unable_modules()
{
    global $xoopsDB;
    $sql = 'SELECT mid FROM ' . $xoopsDB->prefix('modules') . " WHERE `isactive`=1 AND `dirname`!='system' AND `dirname`!='tad_adm'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    while (list($mid) = $xoopsDB->fetchRow($result)) {
        $mid_array[] = $mid;
    }

    $all_mid = implode(',', $mid_array);
    $sql = 'update ' . $xoopsDB->prefix('config') . " set `conf_value`='{$all_mid}' where `conf_name`='module_id_temp'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $sql = 'update ' . $xoopsDB->prefix('modules') . " set `isactive`='0' where `mid` in($all_mid)";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

//還原所有模組
function enable_modules()
{
    global $xoopsDB, $xoopsModuleConfig;
    $sql = 'update ' . $xoopsDB->prefix('modules') . " set `isactive`='1' where `mid` in({$xoopsModuleConfig['module_id_temp']})";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $sql = 'update ' . $xoopsDB->prefix('config') . " set `conf_value`='' where `conf_name`='module_id_temp'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

//關閉所有區塊
function unable_blocks()
{
    global $xoopsDB;
    $sql = 'SELECT bid FROM ' . $xoopsDB->prefix('newblocks') . ' WHERE `visible`=1';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    while (list($bid) = $xoopsDB->fetchRow($result)) {
        $bid_array[] = $bid;
    }

    $all_bid = implode(',', $bid_array);
    $sql = 'update ' . $xoopsDB->prefix('config') . " set `conf_value`='{$all_bid}' where `conf_name`='block_id_temp'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $sql = 'update ' . $xoopsDB->prefix('newblocks') . " set `visible`='0' where `bid` in($all_bid)";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

//還原所有區塊
function enable_blocks()
{
    global $xoopsDB, $xoopsModuleConfig;
    $sql = 'update ' . $xoopsDB->prefix('newblocks') . " set `visible`='1' where `bid` in({$xoopsModuleConfig['block_id_temp']})";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $sql = 'update ' . $xoopsDB->prefix('config') . " set `conf_value`='' where `conf_name`='block_id_temp'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

//重設密碼
function reset_mem($uid = '', $passwd = '')
{
    global $xoopsDB;
    $passwd = md5($passwd);
    $sql = 'update ' . $xoopsDB->prefix('users') . " set `pass`='{$passwd}' where `uid`='{$uid}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

//寄發密碼
function send_passwd()
{
    global $xoopsConfig, $xoopsDB;
    $passwd = GeraHash(30);
    $sql = 'update ' . $xoopsDB->prefix('config') . " set `conf_value`='{$passwd}' where `conf_name`='login' and `conf_title`='_MI_TADADM_LOGIN'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    if (empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $myip = $_SERVER['REMOTE_ADDR'];
    } else {
        $myip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $myip = $myip[0];
    }

    $content = sprintf(_MD_TADADM_MAIL_CONTENT, $passwd, $myip);
    if (send_now($xoopsConfig['adminmail'], _MD_TADADM_PASSWD, $content)) {
        return sprintf(_MD_TADADM_MAIL_PASSWD_OK, $xoopsConfig['adminmail']);
    }

    return sprintf(_MD_TADADM_MAIL_PASSWD_FAIL, $xoopsConfig['adminmail']);
}

//立即寄出
function send_now($email = '', $title = '', $content = '')
{
    global $xoopsConfig, $xoopsDB, $xoopsModuleConfig, $xoopsModule;

    $xoopsMailer = &getMailer();
    $xoopsMailer->multimailer->ContentType = 'text/html';
    $xoopsMailer->addHeaders('MIME-Version: 1.0');

    $msg .= ($xoopsMailer->sendMail($email, $title, $content, $headers)) ? true : false;

    return $msg;
}

function GeraHash($qtd)
{
    //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
    $Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
    $QuantidadeCaracteres = mb_strlen($Caracteres);
    $QuantidadeCaracteres--;

    $Hash = null;
    for ($x = 1; $x <= $qtd; $x++) {
        $Posicao = mt_rand(0, $QuantidadeCaracteres);
        $Hash .= mb_substr($Caracteres, $Posicao, 1);
    }

    return $Hash;
}

//目前硬碟空間
function get_free_space()
{
    $bytes = disk_free_space('.');
    $si_prefix = ['B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB'];
    $base = 1024;
    $class = min((int) log($bytes, $base), count($si_prefix) - 1);
    $space = sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];

    return $space;
}

//改回預設佈景
function theme_default()
{
    global $xoopsDB;

    $sql = 'update ' . $xoopsDB->prefix('config') . " set conf_value='default' where conf_name='theme_set'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

//清除 session
function clear_session()
{
    global $xoopsDB;
    $sql = 'TRUNCATE TABLE ' . $xoopsDB->prefix('session') . '';
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
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
    $sql = "show table status where name='" . $xoopsDB->prefix('session') . "'";
    $result = $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $row = $xoopsDB->fetchArray($result);

    $bytes = ($row['Data_length'] + $row['Index_length']);

    $si_prefix = ['B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB'];
    $base = 1024;
    $class = min((int) log($bytes, $base), count($si_prefix) - 1);
    $space = sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];

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

    $sql = 'update ' . $xoopsDB->prefix('config') . " set conf_value='$v' where conf_name='closesite'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

//修改除錯模式
function debug_mode($v = 0)
{
    global $xoopsDB;

    $sql = 'update ' . $xoopsDB->prefix('config') . " set conf_value='$v' where conf_name='debug_mode'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
}

function debug_mode_tool()
{
    global $xoopsDB;

    $sql = 'SELECT conf_value FROM ' . $xoopsDB->prefix('config') . " WHERE conf_name='debug_mode'";
    $result = $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($debug) = $xoopsDB->fetchRow($result);
    if (1 == $debug) {
        $debug_tool = "
        <li class='list-group-item'><a href='index.php?op=debug_mode&v=0'><i class='fa fa-chevron-circle-right'  title='" . sprintf(_MD_TADADM_UNABLE_DEBUG, 'PHP') . "'></i> " . sprintf(_MD_TADADM_UNABLE_DEBUG, 'PHP') . "</a></li>
        <li class='list-group-item'><a href='index.php?op=debug_mode&v=3'><i class='fa fa-chevron-circle-right'  title='" . sprintf(_MD_TADADM_ENABLE_DEBUG, 'Smarty') . "'></i> " . sprintf(_MD_TADADM_ENABLE_DEBUG, 'Smarty') . '</a></li>';
    } elseif (3 == $debug) {
        $debug_tool = "
        <li class='list-group-item'><a href='index.php?op=debug_mode&v=1'><i class='fa fa-chevron-circle-right'  title='" . sprintf(_MD_TADADM_ENABLE_DEBUG, 'PHP') . "'></i> " . sprintf(_MD_TADADM_ENABLE_DEBUG, 'PHP') . "</a></li>
        <li class='list-group-item'><a href='index.php?op=debug_mode&v=0'><i class='fa fa-chevron-circle-right'  title='" . sprintf(_MD_TADADM_UNABLE_DEBUG, 'Smarty') . "'></i> " . sprintf(_MD_TADADM_UNABLE_DEBUG, 'Smarty') . '</a></li>';
    } else {
        $debug_tool = "
        <li class='list-group-item'><a href='index.php?op=debug_mode&v=1'><i class='fa fa-chevron-circle-right'  title='" . sprintf(_MD_TADADM_ENABLE_DEBUG, 'PHP') . "'></i> " . sprintf(_MD_TADADM_ENABLE_DEBUG, 'PHP') . "</a></li>
        <li class='list-group-item'><a href='index.php?op=debug_mode&v=3'><i class='fa fa-chevron-circle-right'  title='" . sprintf(_MD_TADADM_ENABLE_DEBUG, 'Smarty') . "'></i> " . sprintf(_MD_TADADM_ENABLE_DEBUG, 'Smarty') . '</a></li>';
    }

    return $debug_tool;
}

//檢查連線
$mysql_connect = $xoopsDB ? 'OK' : _MD_TADADM_CANT_CONNECT;

//MySQL版本
$sql = 'select version()';
$result = $xoopsDB->queryF($sql);
list($mysql_version) = $xoopsDB->fetchRow($result);
// $mysql_version = function_exists('$GLOBALS['xoopsDB']->getServerVersion') ? $GLOBALS['xoopsDB']->getServerVersion() : $xoopsDB->getServerVersion();

$other = '';
if ($xoopsDB) {
    //註冊人數
    $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('users') . '';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($all_user_count) = $xoopsDB->fetchRow($result);

    //從未登入人數
    $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('users') . ' WHERE last_login=0';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($never_login_user_count) = $xoopsDB->fetchRow($result);

    //未啟用人數
    $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('users') . ' WHERE user_regdate=0';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($never_start_user_count) = $xoopsDB->fetchRow($result);

    //正常會員人數
    $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('users') . ' WHERE user_regdate!=0 AND last_login!=0';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($normal_user_count) = $xoopsDB->fetchRow($result);

    //各群組人數
    $sql = 'SELECT a.`groupid`, a.`uid`, b.`name` FROM ' . $xoopsDB->prefix('groups_users_link') . ' AS a LEFT JOIN ' . $xoopsDB->prefix('groups') . ' AS b ON a.`groupid` = b.`groupid` ORDER BY a.`groupid`';

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $groupid_count = $group_name = [];
    while (list($groupid, $uid, $name) = $xoopsDB->fetchRow($result)) {
        if (isset($groupid_count[$groupid])) {
            $groupid_count[$groupid]++;
        } else {
            $groupid_count[$groupid] = 1;
        }
        $group_name[$groupid] = $name;
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
        $groupid_count_list .= "
        <tr>
            <th>
                <span class='label label-info'>{$groupid}</span>
                " . sprintf(_MD_TADADM_GROUP, $gname) . "
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

$theme_set = ('default' === $xoopsConfig['theme_set']) ? '' : "<li class='list-group-item'><a href='index.php?op=theme_default'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_DEFAULT_THEME . "'></i> " . sprintf(_MD_TADADM_DEFAULT_THEME_DESC, $xoopsConfig['theme_set']) . '</a></li>';

$main2 = "
<div class='card'>
    <div class='card-header text-white bg-warning'>" . _MD_TADADM_AID . "</div>
    <ul class='list-group list-group-flush'>
        " . debug_mode_tool() . "
        <li class='list-group-item'>
            <a href='index.php?op=clear_cache'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_CLEAR_CACHE . "'></i> " . _MD_TADADM_CLEAR_CACHE . files_counter() . "</a></li>
        <li class='list-group-item'><a href='index.php?op=clear_session'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_CLEAR_SESSION . "'></i> " . _MD_TADADM_CLEAR_SESSION . session_size() . "</a></li>
        $theme_set

    </ul>
</div>";

$close_site = '1' == $xoopsConfig['closesite'] ? "<li class='list-group-item'><a href='index.php?op=close_site&v=0'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_ENABLE_WEB . "'></i> " . _MD_TADADM_ENABLE_WEB . '</a></li>' : "<li class='list-group-item'><a href='index.php?op=close_site&v=1'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_UNABLE_WEB . "'></i> " . _MD_TADADM_UNABLE_WEB . '</a></li>';

$admin_options = '';
$sql = 'SELECT a.uid,b.uname FROM ' . $xoopsDB->prefix('groups_users_link') . ' AS a LEFT JOIN ' . $xoopsDB->prefix('users') . ' AS b ON a.uid=b.uid WHERE a.groupid=1';
$result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
while (list($uid, $uname) = $xoopsDB->fetchRow($result)) {
    $admin_options .= "<option value='{$uid}'>{$uname}</option>";
}

$XoopsFormSelectUserOption = '';
$sql = 'SELECT a.uid,b.uname,b.name FROM ' . $xoopsDB->prefix('groups_users_link') . ' AS a LEFT JOIN ' . $xoopsDB->prefix('users') . ' AS b ON a.uid=b.uid WHERE a.groupid=2 ORDER BY b.uname';
$result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
while (list($uid, $uname, $name) = $xoopsDB->fetchRow($result)) {
    if (empty($uname)) {
        continue;
    }

    $showname = empty($name) ? '' : " ({$name})";
    $XoopsFormSelectUserOption .= "<option value='{$uid}'>{$uname}{$showname}</option>";
}

if ('' != $xoopsModuleConfig['module_id_temp']) {
    $modules_amount = count(explode(',', $xoopsModuleConfig['module_id_temp']));
    $modules_tool = "<a href='index.php?op=enable_modules'><i class='fa fa-chevron-circle-right' title='" . sprintf(_MD_TADADM_ENABLE_ALL_MODS, $modules_amount) . "'></i> " . sprintf(_MD_TADADM_ENABLE_ALL_MODS, $modules_amount) . '</a>';
} else {
    //計算模組數量
    $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('modules') . " WHERE `isactive`=1 AND `dirname`!='system' AND `dirname`!='tad_adm'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($modules_amount) = $xoopsDB->fetchRow($result);

    $modules_tool = "<a href='index.php?op=unable_modules'><i class='fa fa-chevron-circle-right' title='" . sprintf(_MD_TADADM_UNABLE_ALL_MODS, $modules_amount) . "'></i> " . sprintf(_MD_TADADM_UNABLE_ALL_MODS, $modules_amount) . '</a>';
}

if ('' != $xoopsModuleConfig['block_id_temp']) {
    $blocks_amount = count(explode(',', $xoopsModuleConfig['block_id_temp']));
    $blocks_tool = "<a href='index.php?op=enable_blocks'><i class='fa fa-chevron-circle-right' title='" . sprintf(_MD_TADADM_ENABLE_ALL_BLOCKS, $blocks_amount) . "'></i> " . sprintf(_MD_TADADM_ENABLE_ALL_BLOCKS, $blocks_amount) . '</a>';
} else {
    //計算區塊數量
    $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('newblocks') . ' WHERE `visible`=1';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    list($blocks_amount) = $xoopsDB->fetchRow($result);

    $blocks_tool = "<a href='index.php?op=unable_blocks'><i class='fa fa-chevron-circle-right' title='" . sprintf(_MD_TADADM_UNABLE_ALL_BLOCKS, $blocks_amount) . "'></i> " . sprintf(_MD_TADADM_UNABLE_ALL_BLOCKS, $blocks_amount) . '</a>';
}

$main3 = "
<div class='card'>
    <div class='card-header text-white bg-danger'>" . _MD_TADADM_WEB_FUNCTION . "</div>
    <ul class='list-group list-group-flush'>
        $close_site
        <li class='list-group-item'>
            <form  action='{$_SERVER['PHP_SELF']}' method='post' role='form'>
                <div class='form-group row'>
                    <label class='sr-only'>" . _MD_TADADM_RESET_ADMIN_PASSWD . "</label>
                    <div class='col-sm-4'>
                        <select name='uid' class='form-control'>
                            {$admin_options}
                        </select>
                    </div>
                    <div class='col-sm-4'>
                        <input type='text' name='new_pass' class='form-control' placeholder='" . _MD_TADADM_RESET_ADMIN_PASSWD . "'>
                    </div>
                    <div class='col-sm-4'>
                        <input type='hidden' name='op' value='reset_mem'>
                        <button type='submit' class='btn btn-danger btn-block'>" . _MD_TADADM_RESET_ADMIN_PASSWD . "</button>
                    </div>
                </div>
            </form>
        </li>
        <li class='list-group-item'>
            <form action='{$_SERVER['PHP_SELF']}' method='post' role='form'>
                <div class='form-group row'>
                    <label class='sr-only'>" . _MD_TADADM_RESET_MEM_PASSWD . "</label>
                    <div class='col-sm-4'>
                        <select name='uid' class='form-control'>
                        {$XoopsFormSelectUserOption}
                        </select>
                    </div>
                    <div class='col-sm-4'>
                        <input type='text' name='new_pass' class='form-control' placeholder='" . _MD_TADADM_RESET_MEM_PASSWD . "'>
                    </div>
                    <div class='col-sm-4'>
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

$into_admin = ($xoopsUser) ? "<li class='list-group-item'><a href='" . XOOPS_URL . "/admin.php' target='_blank'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_ADMIN . "'></i> " . _MD_TADADM_ADMIN . '</a></li>' : '';
$into_setup = ($xoopsUser) ? "<li class='list-group-item'><a href='" . XOOPS_URL . "/modules/system/admin.php?fct=preferences&op=show&confcat_id=1' target='_blank'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_PREFERENCES . "'></i> " . _MD_TADADM_PREFERENCES . '</a></li>' : '';
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
        <li class='list-group-item'><a href='move.php' target='_blank'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_MOVE288 . "'></i> " . _MD_TADADM_MOVE288 . "</a></li>
        <li class='list-group-item'><a href='$logout' target='_blank'><i class='fa fa-chevron-circle-right'  title='" . _MD_TADADM_LOGOUT . "'></i> " . _MD_TADADM_LOGOUT . '</a></li>

    </ul>
</div>';

$content = '
<div class="page-header">
    <h1>' . _MD_TADADM_NAME . '</h1>
</div>
<div class="row">
    <div class="col-lg-4 col-sm-6">' . $main1 . '</div>
    <div class="col-lg-4 col-sm-6">' . $main2 . $main3 . '</div>
    <div class="col-lg-4 col-sm-6">' . $main4 . '</div>
</div>';

echo Utility::html5($content, false, true, 4, true, 'container-fluid');
