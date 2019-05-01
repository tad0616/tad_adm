<?php
use XoopsModules\Tadtools\Utility;

global $xoopsModule;
if ('tad_adm' !== $xoopsModule->dirname()) {
    $modhandler = xoops_getHandler('module');
    $xModule = $modhandler->getByDirname('tad_adm');
    $config_handler = xoops_getHandler('config');
    $xoopsModuleConfig = $config_handler->getConfigsByCat(0, $xModule->mid());
    // die('aaa' . var_dump($xoopsModuleConfig));
}

//取得更新訊息
function get_tad_json_info($json = 'all.json')
{
    global $xoopsModuleConfig;
    $source = empty($xoopsModuleConfig['source']) ? 'http://120.115.2.90' : $xoopsModuleConfig['source'];
    $url = "{$source}/uploads/tad_modules/{$json}";

    if (function_exists('curl_init')) {
        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
    } elseif (function_exists('file_get_contents')) {
        $data = file_get_contents($url);
    } else {
        $handle = fopen($url, 'rb');
        $data = stream_get_contents($handle);
        fclose($handle);
    }

    if (empty($data)) {
        redirect_header('index.php', 3, _MA_TADADM_FAILED_TO_GET_JSON);
    }

    $mod = json_decode($data, true);

    // foreach ($all as $kind => $arr_data) {
    // list($module_title, $dirname, $update_sn, $new_version, $new_status, $new_status_version, $new_last_update, $file_link, $update_descript, $module_sn, $module_descript, $kind) = explode("-+-", $arr_data);
    //     foreach ($arr_data as $dirname => $m) {

    //         $mod[$dirname][$kind]['module_title']       = $module_title;
    //         $mod[$dirname][$kind]['update_sn']          = $update_sn;
    //         $mod[$dirname][$kind]['new_version']        = $new_version;
    //         $mod[$dirname][$kind]['new_status']         = $new_status;
    //         $mod[$dirname][$kind]['new_status_version'] = $new_status_version;
    //         $mod[$dirname][$kind]['new_last_update']    = $new_last_update;
    //         $mod[$dirname][$kind]['update_descript']    = str_replace("\n", "\\n", $update_descript);
    //         $mod[$dirname][$kind]['module_sn']          = $module_sn;
    //         $mod[$dirname][$kind]['module_descript']    = str_replace("\n", "\\n", $module_descript);
    //         $mod[$dirname][$kind]['file_link']          = $file_link;
    //         $mod[$dirname][$kind]['kind']               = $kind;
    //     }
    // }
    return $mod;
}

function get_work_dir($act)
{
    if (false !== mb_strpos($act, 'theme')) {
        $work_dir = 'themes';
    } elseif (false !== mb_strpos($act, 'adm_tpl')) {
        $work_dir = 'modules/system/themes';
    } elseif (false !== mb_strpos($act, 'module')) {
        $work_dir = 'modules';
    }

    return $work_dir;
}

function get_act_op($act)
{
    if (false !== mb_strpos($act, 'install')) {
        $act_op = 'install';
    } elseif (false !== mb_strpos($act, 'update')) {
        $act_op = 'update';
    } elseif (false !== mb_strpos($act, 'delete')) {
        $act_op = 'delete';
    }

    return $act_op;
}

//登入SSH
function ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link = '', $dirname = '', $act = '', $update_sn = '', $xoops_sn = '')
{
    global $xoopsModuleConfig;
    $ssh = '';
    set_include_path(XOOPS_ROOT_PATH . '/modules/tadtools/phpseclib');
    require 'Net/SSH2.php';
    $ssh = new Net_SSH2($ssh_host, $xoopsModuleConfig['ssh_port']);
    if (!$ssh->login($ssh_id, $ssh_passwd)) {
        redirect_header("main.php?op={$act}&dirname=$dirname&file_link=$file_link&tad_adm_tpl=clean", 3, sprintf(_MA_TADADM_SSH_LOGIN_FAIL, $ssh_id, $ssh_host));
    } else {
        if (empty($_SESSION['tad_adm_ssh_host'])) {
            $_SESSION['tad_adm_ssh_host'] = $ssh_host;
        }

        if (empty($_SESSION['tad_adm_ssh_id'])) {
            $_SESSION['tad_adm_ssh_id'] = $ssh_id;
        }

        if (empty($_SESSION['tad_adm_ssh_passwd'])) {
            $_SESSION['tad_adm_ssh_passwd'] = $ssh_passwd;
        }

        $work_dir = get_work_dir($act);

        //登入後要做的事
        if ($xoops_sn) {
            // die("next_to_up($file_link, $dirname, $work_dir, $update_sn, $act, $ssh);");
            next_to_up($file_link, $xoops_sn, $act, $ssh);
        } else {
            next_to_do($file_link, $dirname, $work_dir, $update_sn, $act, $ssh);
        }
    }
}

//安裝套件
function to_do($file_link = '', $dirname = '', $act = 'install_module', $update_sn = '')
{
    global $xoopsTpl, $xoopsModuleConfig, $inSchoolWeb;
    $op = get_act_op($act);
    if (empty($file_link) and ('install' === $op or 'update' === $op)) {
        header("location:{$_SERVER['PHP_SELF']}");
        exit;
    }

    $work_dir = get_work_dir($act);
    $is_writable = is_writable(XOOPS_ROOT_PATH . "/{$work_dir}/");

    //若是可以寫入
    if ($is_writable or $inSchoolWeb) {
        next_to_do($file_link, $dirname, $work_dir, $update_sn, $act);
    } else {
        $xoopsTpl->assign('action', 'main.php');
        $xoopsTpl->assign('now_op', 'login_form');
        $xoopsTpl->assign('dirname', $dirname);
        $xoopsTpl->assign('act', $act);
        $xoopsTpl->assign('update_sn', $update_sn);
        $xoopsTpl->assign('file_link', $file_link);
        $tad_adm_ssh_host = empty($_SESSION['tad_adm_ssh_host']) ? $_SERVER['SERVER_ADDR'] : $_SESSION['tad_adm_ssh_host'];
        $xoopsTpl->assign('tad_adm_ssh_host', $tad_adm_ssh_host);
        $xoopsTpl->assign('tad_adm_ssh_id', $_SESSION['tad_adm_ssh_id']);
        $xoopsTpl->assign('tad_adm_ssh_passwd', $_SESSION['tad_adm_ssh_passwd']);
    }
}

function next_to_do($file_link = '', $dirname = '', $work_dir = '', $update_sn = '', $act = '', $ssh = '')
{
    global $xoopsModuleConfig, $inSchoolWeb;

    $op = get_act_op($act);

    if ('install_theme' === $act) {
        if ($inSchoolWeb or get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
            update_allowed($dirname, 1);
            redirect_header('main.php?#admTab4', 3, sprintf(_MA_TADADM_THEME_INSTALL_OK, $dirname));
        }
    } elseif ('update_theme' === $act) {
        if ($inSchoolWeb or get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
            update_allowed($dirname, 1);
            redirect_header('main.php?#admTab4', 3, _MA_TADADM_THEME_UPDATE_OK);
        }
    } elseif ('delete_theme' === $act) {
        if ($inSchoolWeb or Utility::delete_directory(XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}", $ssh)) {
            update_allowed($dirname, 0);
        }
        redirect_header('main.php#admTab4', 3, _MA_TADADM_THEME_DELETE_OK);
    } elseif ('install_adm_tpl' === $act) {
        if ($inSchoolWeb or get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
            add_adm_tpl_config($dirname);
            redirect_header($_SERVER['PHP_SELF'] . '?op=list_all_modules&tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_ADM_TPL_INSTALL_OK, $dirname));
        }
    } elseif ('update_adm_tpl' === $act) {
        if ($inSchoolWeb or get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
            add_adm_tpl_config($dirname);
            redirect_header($_SERVER['PHP_SELF'] . '?op=list_all_modules&tad_adm_tpl=clean', 3, _MA_TADADM_ADM_TPL_UPDATE_OK);
        }
    } elseif ('install_module' === $act) {
        if ($inSchoolWeb or get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
            header('location:' . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op={$op}&module={$dirname}&tad_adm_tpl=clean");
            exit;
        }
    } elseif ('update_module' === $act) {
        if ($inSchoolWeb or get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
            header('location:' . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op={$op}&module={$dirname}&tad_adm_tpl=clean");
            exit;
        }
    }
}

function next_to_up($file_link = '', $xoops_sn = '', $act = '', $ssh = '')
{
    global $xoopsModuleConfig;

    if ('patch' === $act) {
        if (get_upgrade_file($file_link, 'patch', $xoops_sn, $ssh)) {
            redirect_header('xoops.php', 3, _MA_TADADM_PATCH_OK);
        }
    } elseif ('upgrade' === $act) {
        if (get_upgrade_file($file_link, 'upgrade', $xoops_sn, $ssh)) {
            redirect_header('xoops.php?#admTab2', 3, _MA_TADADM_UPGRADE_OK);
        }
    }
}

function get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)
{
    global $xoopsConfig, $xoopsDB, $xoopsModuleConfig, $inSchoolWeb;
    if (!$inSchoolWeb) {
        $file_link = str_replace('[source]', $xoopsModuleConfig['source'], $file_link);
        if ('tad_adm' === $dirname) {
            $new_file = str_replace('http://120.115.2.90/uploads/tad_modules/file/', XOOPS_ROOT_PATH . '/uploads/', $file_link);
        } else {
            $new_file = str_replace("{$xoopsModuleConfig['source']}/uploads/tad_modules/file/", XOOPS_ROOT_PATH . '/uploads/', $file_link);
        }
        Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_adm');
        copyemz($file_link, $new_file, $update_sn);

        if (!is_file($new_file)) {
            redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
        }

        if (is_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname")) {
            Utility::delete_directory(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname");
        }

        require_once XOOPS_ROOT_PATH . '/modules/tad_adm/class/dunzip2/dUnzip2.inc.php';
        require_once XOOPS_ROOT_PATH . '/modules/tad_adm/class/dunzip2/dZip.inc.php';
        $zip = new dUnzip2($new_file);
        $zip->getList();
        $zip->unzipAll(XOOPS_ROOT_PATH . '/uploads/tad_adm/');
        $zip->close($new_file);

        if ('' != $ssh) {
            $ssh->exec('cp -fr ' . XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname " . XOOPS_ROOT_PATH . "/{$work_dir}/");
            $ssh->exec('chmod -R 755 ' . XOOPS_ROOT_PATH . "/{$work_dir}/$dirname");
            $ssh->exec("chown -R {$ssh_id}:{$ssh_id} " . XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}");
            $ssh->exec('rm -fr ' . XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}");
            $ssh->exec("rm -f $new_file");
        } else {
            // echo XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname<br>";
            // echo XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}";
            // exit;

            Utility::full_copy(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname", XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}/");
            //重設權限
            chmod_R(XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}", 0755, 0755);
            unlink($new_file);
        }
    }

    if (is_dir(XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}")) {
        return true;
    }
    redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_MV_FAIL, XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname"));
}

function get_upgrade_file($file_link, $dirname, $xoops_sn, $ssh)
{
    global $xoopsConfig, $xoopsDB, $xoopsModuleConfig;
    $file_link = str_replace('[source]', $xoopsModuleConfig['source'], $file_link);
    $new_file = str_replace("{$xoopsModuleConfig['source']}/uploads/tad_modules/file/", XOOPS_ROOT_PATH . '/uploads/', $file_link);

    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_adm');
    // die("$file_link, $new_file");
    copyemz($file_link, $new_file, 0, $xoops_sn);

    if (!is_file($new_file)) {
        redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
    }

    if (is_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname")) {
        Utility::delete_directory(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname");
    }
    Utility::mkdir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname");

    require_once XOOPS_ROOT_PATH . '/modules/tad_adm/class/dunzip2/dUnzip2.inc.php';
    require_once XOOPS_ROOT_PATH . '/modules/tad_adm/class/dunzip2/dZip.inc.php';
    $zip = new dUnzip2($new_file);
    $zip->getList();
    $zip->unzipAll(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/");
    $zip->close($new_file);
    if ('' != $ssh) {
        $sh = "#!/bin/sh\n";
        $handle = fopen(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/ssh.txt", 'rb');
        if ($handle) {
            while (false !== ($buffer = fgets($handle, 4096))) {
                $buffer = str_replace('XOOPS_ROOT_PATH', XOOPS_ROOT_PATH, $buffer);
                $buffer = str_replace('XOOPS_VAR_PATH', XOOPS_VAR_PATH, $buffer);
                $buffer = str_replace('XOOPS_PATH', XOOPS_PATH, $buffer);
                $buffer = str_replace('NEW_FILE', $new_file, $buffer);
                $buffer = str_replace('XOOPS_SN', $xoops_sn, $buffer);
                $buffer = str_replace("\r", "\n", $buffer);
                $sh .= $buffer;
            }
            fclose($handle);
        }

        file_put_contents(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/upgrade.sh", $sh);
        chmod_R(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/upgrade.sh", 0777, 0777);
        $ssh->exec(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/upgrade.sh");
    } else {
        $handle = fopen(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/go.txt", 'rb');
        if ($handle) {
            while (false !== ($buffer = fgets($handle, 4096))) {
                eval($buffer);
            }
            fclose($handle);
        }
    }

    if ('upgrade' === $dirname) {
        redirect_header(XOOPS_URL . '/upgrade', 3, _MA_TADADM_UPGRADE_FROM_URL);
    } else {
        return true;
    }
    // if (is_dir(XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}")) {
    //     return true;
    // } else {
    //     redirect_header($_SERVER['PHP_SELF'] . "?tad_adm_tpl=clean", 3, sprintf(_MA_TADADM_MV_FAIL, XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname"));
    // }
}

//區塊相關動作
function do_block($act, $update_sn)
{
    global $xoopsModuleConfig, $xoopsDB;

    $ver = (int) str_replace('.', '', mb_substr(XOOPS_VERSION, 6, 5));
    $add_count_url = "{$xoopsModuleConfig['source']}/modules/tad_modules/api.php?update_sn={$update_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=$ver&language={$xoopsConfig['language']}";

    $url = "{$xoopsModuleConfig['source']}/uploads/tad_modules/{$update_sn}.json";
    // die(var_export($url));

    if (function_exists('curl_init')) {
        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);

        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $add_count_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $count = curl_exec($ch);
        curl_close($ch);
    } elseif (function_exists('file_get_contents')) {
        $data = file_get_contents($url);
        $count = file_get_contents($add_count_url);
    } else {
        $handle = fopen($url, 'rb');
        $data = stream_get_contents($handle);
        fclose($handle);

        $handle = fopen($add_count_url, 'rb');
        $count = stream_get_contents($handle);
        fclose($handle);
    }
    // die(var_export($data));
    $block = json_decode($data, true);
    // die(var_export($block));
    $last_modified = time();
    if ('install' === $act) {
        $sql = 'INSERT INTO ' . $xoopsDB->prefix('newblocks') . " (`mid`,`func_num`,`options`,`name`,`title`,`content`,`side`,`weight`,`visible`,`block_type`,`c_type`,`isactive`,`dirname`,`func_file`,`show_func`,`edit_func`,`template`,`bcachetime`,`last_modified`) values('0', '0', '', '自訂區塊', '{$block['title']}', '{$block['content']}', '{$block['side']}', '0', '1', 'C', '{$block['c_type']}', '1', '{$block['dirname']}', '', '}', '', '', '0', '{$last_modified}')";
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
        $block_id = $xoopsDB->getInsertId();

        $module_id = ($block['side'] <= 1) ? 0 : -1;
        $sql = 'INSERT INTO ' . $xoopsDB->prefix('block_module_link') . " (`block_id` , `module_id`) values('{$block_id}', '{$module_id}')";
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        $sql = 'INSERT INTO ' . $xoopsDB->prefix('group_permission') . " (`gperm_groupid` , `gperm_itemid` , `gperm_modid` , `gperm_name`) values('1', '{$block_id}', '1', 'block_read'),('2', '{$block_id}', '1', 'block_read'),('3', '{$block_id}', '1', 'block_read')";
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    } else {
        $sql = 'UPDATE  ' . $xoopsDB->prefix('newblocks') . " SET `content`='{$block['content']}',`last_modified`='{$last_modified}' where dirname='{$block['dirname']}'";
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    }
}

function update_allowed($theme, $val)
{
    global $xoopsConfig, $xoopsDB;

    if ($val) {
        list($bootstrap_color, $theme_kind) = get_theme_color($theme);
        $xoopsConfig['theme_set_allowed'][] = $theme;
        $theme_set_allowed = serialize($xoopsConfig['theme_set_allowed']);

        $sql = 'update ' . $xoopsDB->prefix('config') . " set conf_value='{$theme_set_allowed}' where conf_name='theme_set_allowed'";
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        $sql = 'INSERT INTO ' . $xoopsDB->prefix('tadtools_setup') . " (`tt_theme` , `tt_use_bootstrap`,`tt_bootstrap_color`, `tt_theme_kind`) values('{$theme}', '0', '$bootstrap_color' , '$theme_kind') ON DUPLICATE KEY UPDATE `tt_use_bootstrap` = '0', `tt_bootstrap_color`='$bootstrap_color', `tt_theme_kind`='$theme_kind'";

        $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'], 3, $xoopsDB->error());
    } else {
        $array = array_diff($xoopsConfig['theme_set_allowed'], $theme);
        $theme_set_allowed = serialize($array);

        $sql = 'update ' . $xoopsDB->prefix('config') . " set conf_value='{$theme_set_allowed}' where conf_name='theme_set_allowed'";
        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        $sql = 'delete from `' . $xoopsDB->prefix('tadtools_setup') . "` where `tt_theme`='$theme'";
        $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'], 3, $xoopsDB->error());
    }
}

function act_form($dirname, $op, $title)
{
    global $xoopsConfig;
    require_once XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php";
    xoops_loadLanguage('modinfo', 'tad_adm');
    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    $token = new \XoopsFormHiddenToken();
    $token_code = $token->render();

    $mod_name = constant($modversion['name']);

    $main = "
        <link rel='stylesheet' type='text/css' media='screen' href='" . XOOPS_URL . "/modules/tadtools/bootstrap4/css/bootstrap.css' />
        <link rel='stylesheet' type='text/css' media='screen' href='" . XOOPS_URL . "/modules/tadtools/css/xoops_adm4.css' />
        <div class='well card card-body bg-light'>
            <form action='" . XOOPS_URL . "/modules/system/admin.php' method='post' style='text-align:center'>
            <img src='" . XOOPS_URL . "/modules/{$dirname}/{$modversion['image']}'>
            <div style='font-weight:bold;font-size:11pt;'>{$mod_name}</div>
            <input type='hidden' name='module' value='{$dirname}'>
            <input type='hidden' name='dirname' value='{$dirname}'>
            <input type='hidden' name='op' value='{$op}'>
            <input type='hidden' name='fct' value='modulesadmin'>
            $token_code
            <input type='submit' title='" . $title . "' value='" . $title . "' name='confirm_submit'>
            </form>
        </div>
        ";
    die($main);
}

function add_adm_tpl_config($theme)
{
    global $xoopsConfig, $xoopsDB;
    if ($xoopsConfig['cpanel'] != $theme) {
        $sql = 'update ' . $xoopsDB->prefix('config') . " set conf_value='{$theme}' where conf_name='cpanel'";

        $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    }
}

function copyemz($file1, $file2, $update_sn = '', $xoops_sn = '')
{
    global $xoopsConfig, $xoopsModuleConfig;
    $ver = (int) str_replace('.', '', mb_substr(XOOPS_VERSION, 6, 5));
    if ($xoops_sn) {
        $add_count_url = "{$xoopsModuleConfig['source']}/modules/tad_modules/api.php?xoops_sn={$xoops_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=$ver&language={$xoopsConfig['language']}";
    } else {
        $add_count_url = "{$xoopsModuleConfig['source']}/modules/tad_modules/api.php?update_sn={$update_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=$ver&language={$xoopsConfig['language']}";
    }

    $url = $file1;
    if (function_exists('curl_init')) {
        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $contentx = curl_exec($ch);
        curl_close($ch);

        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $add_count_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $count = curl_exec($ch);
        curl_close($ch);
    } elseif (function_exists('file_get_contents')) {
        $contentx = file_get_contents($url);
        $count = file_get_contents($add_count_url);
    } else {
        $handle = fopen($url, 'rb');
        $contentx = stream_get_contents($handle);
        fclose($handle);

        $handle = fopen($add_count_url, 'rb');
        $count = stream_get_contents($handle);
        fclose($handle);
    }

    $openedfile = fopen($file2, 'wb');
    fwrite($openedfile, $contentx);
    fclose($openedfile);
    if (false === $contentx) {
        $status = false;
    } else {
        $status = true;
    }
    // die($status);
    return $status;
}

function getpwuid($file = '')
{
    if (function_exists('posix_getpwuid')) {
        return posix_getpwuid(fileowner($file));
    }

    return '';
}

function getgrgid($file = '')
{
    if (function_exists('posix_getgrgid')) {
        return posix_getgrgid(filegroup($file));
    }

    return '';
}

function get_logo($dirname)
{
    global $xoopsConfig;
    require XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php";
    xoops_loadLanguage('modinfo', 'tad_adm');
    return XOOPS_URL . "/modules/{$dirname}/{$modversion['image']}";
}

function get_theme_version($dirname)
{
    $handle = @fopen(XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini", 'rb');
    if ($handle) {
        while (false !== ($buffer = fgets($handle, 4096))) {
            $ini = explode('=', $buffer);
            if ('Version' === trim($ini[0])) {
                $Version = str_replace('"', '', trim($ini[1]));
                break;
            }
        }
        fclose($handle);
    }

    return $Version;
}

function get_theme_type($dirname)
{
    global $xoopsConfig;
    require XOOPS_ROOT_PATH . "/themes/{$dirname}/config.php";

    return $theme_set_allowed;
}

function recurse_chown_chgrp($mypath, $uid, $gid)
{
    $d = opendir($mypath);
    while (false !== ($file = readdir($d))) {
        if ('.' !== $file && '..' !== $file) {
            $typepath = $mypath . '/' . $file;

            //print $typepath. " : " . filetype ($typepath). "<BR>" ;
            if ('dir' === filetype($typepath)) {
                recurse_chown_chgrp($typepath, $uid, $gid);
            }

            chown($typepath, $uid);
            chgrp($typepath, $gid);
        }
    }
}

function chmod_R($path, $filemode, $dirmode)
{
    if (is_dir($path)) {
        $fileowner = getpwuid($path);
        $filegroup = getgrgid($path);
        $fileperms = mb_substr(sprintf('%o', fileperms($path)), -4);
        if (!chmod($path, $dirmode)) {
            $dirmode_str = decoct($dirmode);

            print sprintf(_MA_TADADM_CHMOD_FAILED, $path, $dirmode_str, $fileowner['name'], $filegroup['name'], $fileperms);

            return;
        }
        $dh = opendir($path);
        while (false !== ($file = readdir($dh))) {
            if ('.' !== $file && '..' !== $file) {
                // skip self and parent pointing directories
                $fullpath = $path . '/' . $file;
                chmod_R($fullpath, $filemode, $dirmode);
            }
        }
        closedir($dh);
    } else {
        if (is_link($path)) {
            // print "link '$path' is skipped\n";
            return;
        }
        if (!chmod($path, $filemode)) {
            $fileowner = getpwuid($path);
            $filegroup = posix_getgrgid(filegroup($path));
            $fileperms = mb_substr(sprintf('%o', fileperms($path)), -4);
            $filemode_str = decoct($filemode);
            print sprintf(_MA_TADADM_CHMOD_FAILED, $path, $filemode_str, $fileowner['name'], $filegroup['name'], $fileperms);

            return;
        }
    }
}
