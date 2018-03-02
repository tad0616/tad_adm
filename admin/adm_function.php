<?php
global $xoopsModule;
if ($xoopsModule->dirname() != 'tad_adm') {
    $modhandler        = xoops_gethandler('module');
    $xModule           = $modhandler->getByDirname("tad_adm");
    $config_handler    = xoops_gethandler('config');
    $xoopsModuleConfig = $config_handler->getConfigsByCat(0, $xModule->mid());
    // die('aaa' . var_dump($xoopsModuleConfig));
}

//列出所有模組
function list_modules($mode = "tpl")
{
    global $xoopsDB, $xoopsModuleConfig, $xoopsTpl, $xoopsConfig;
    //取得更新訊息
    $mod = get_tad_modules_info();
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

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/bubblepopup.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/bubblepopup.php";
    $bubblepopup = new bubblepopup();

    //抓出現有模組
    $sql    = "SELECT * FROM " . $xoopsDB->prefix("modules") . " ORDER BY hasmain DESC, weight";
    $result = $xoopsDB->query($sql) or web_error($sql);

    $i = 0;
    //模組部份
    $all_install_modules = array();
    while ($data = $xoopsDB->fetchArray($result)) {
        foreach ($data as $k => $v) {
            $$k = $v;
        }

        if ($mod[$dirname]['module']['kind'] == "module") {
            $ok['module'][] = $dirname;
        } else {
            continue;
        }

        $version     = intval($version);
        $new_version = $mod[$dirname]['module']['new_version'] * 100;
        $new_version = intval($new_version);

        $last_update     = strtotime($all_install_modules[$isactive][$function][$i]['last_update']);
        $new_last_update = strtotime($all_install_modules[$isactive][$function][$i]['new_last_update']);

        $function = ($new_version > $version or $new_last_update > $last_update) ? 'update' : 'last_mod';

        $all_install_modules[$isactive][$function][$i]['newversion']  = $new_version;
        $all_install_modules[$isactive][$function][$i]['now_version'] = $version;

        $all_install_modules[$isactive][$function][$i]['function'] = $function;

        $status = ($mod[$dirname]['module']['new_status_version']) ? " {$mod[$dirname]['module']['new_status']}{$mod[$dirname]['module']['new_status_version']}" : "";

        $all_install_modules[$isactive][$function][$i]['mid']         = $mid;
        $all_install_modules[$isactive][$function][$i]['name']        = $name;
        $all_install_modules[$isactive][$function][$i]['version']     = round($version / 100, 2);
        $all_install_modules[$isactive][$function][$i]['new_version'] = ($mod[$dirname]['module']['new_version']) ? $mod[$dirname]['module']['new_version'] . $status : "";

        $last_update                                                      = filemtime(XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php");
        $all_install_modules[$isactive][$function][$i]['last_update']     = date("Y-m-d H:i", $last_update);
        $all_install_modules[$isactive][$function][$i]['new_last_update'] = ($mod[$dirname]['module']['new_last_update']) ? date("Y-m-d H:i", $mod[$dirname]['module']['new_last_update']) : "";

        if (file_exists(XOOPS_ROOT_PATH . "/modules/{$dirname}")) {
            $all_install_modules[$isactive][$function][$i]['fileowner'] = getpwuid(XOOPS_ROOT_PATH . "/modules/{$dirname}");
            $all_install_modules[$isactive][$function][$i]['filegroup'] = getgrgid(XOOPS_ROOT_PATH . "/modules/{$dirname}");
            $all_install_modules[$isactive][$function][$i]['fileperms'] = substr(sprintf('%o', fileperms(XOOPS_ROOT_PATH . "/modules/{$dirname}")), -4);
        } else {
            $all_install_modules[$isactive][$function][$i]['fileowner'] = $all_install_modules[$isactive][$function][$i]['filegroup'] = $all_install_modules[$isactive][$function][$i]['fileperms'] = '';
        }

        $all_install_modules[$isactive][$function][$i]['weight']          = $weight;
        $all_install_modules[$isactive][$function][$i]['isactive']        = $isactive;
        $all_install_modules[$isactive][$function][$i]['dirname']         = $dirname;
        $all_install_modules[$isactive][$function][$i]['hasmain']         = $hasmain ? _MA_TADADM_1 : _MA_TADADM_0;
        $all_install_modules[$isactive][$function][$i]['hasadmin']        = $hasadmin ? _MA_TADADM_1 : _MA_TADADM_0;
        $all_install_modules[$isactive][$function][$i]['hassearch']       = $hassearch ? _MA_TADADM_1 : _MA_TADADM_0;
        $all_install_modules[$isactive][$function][$i]['hasconfig']       = $hasconfig ? _MA_TADADM_1 : _MA_TADADM_0;
        $all_install_modules[$isactive][$function][$i]['hascomments']     = $hascomments ? _MA_TADADM_1 : _MA_TADADM_0;
        $all_install_modules[$isactive][$function][$i]['hasnotification'] = $hasnotification ? _MA_TADADM_1 : _MA_TADADM_0;

        $all_install_modules[$isactive][$function][$i]['update_sn'] = $mod[$dirname]['module']['update_sn'];
        $all_install_modules[$isactive][$function][$i]['descript']  = $mod[$dirname]['module']['update_descript'];
        $bubblepopup->add_tip("#{$dirname}_tip", preg_replace('/\s\s+/', '<br>', trim($mod[$dirname]['module']['update_descript'])));

        $all_install_modules[$isactive][$function][$i]['module_sn'] = $mod[$dirname]['module']['module_sn'];
        $all_install_modules[$isactive][$function][$i]['file_link'] = $mod[$dirname]['module']['file_link'];
        $all_install_modules[$isactive][$function][$i]['kind']      = $mod[$dirname]['module']['kind'];
        $all_install_modules[$isactive][$function][$i]['logo']      = get_logo($dirname);

        // if ($isactive) {
        //     $all_active_modules = $all_install_modules;
        // } else {
        //     $all_un_active_modules = $all_install_modules;
        // }

        $i++;
    }

    $all_active_modules    = $all_install_modules[1];
    $all_un_active_modules = $all_install_modules[0];

    //後台部份
    $all_admin = $all_un_admin = array();
    foreach ($mod as $dirname => $data) {
        if (isset($ok['adm_tpl']) and in_array($dirname, $ok['adm_tpl'])) {
            continue;
        }

        $Version = "";
        //後台部份
        if (isset($data['adm_tpl']['kind']) and $data['adm_tpl']['kind'] == "adm_tpl") {
            $ok['adm_tpl'][] = $dirname;
            if (is_dir(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}")) {
                $Version = file_get_contents(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}/version.txt");

                $status                       = ($data['adm_tpl']['new_status_version']) ? " {$data['adm_tpl']['new_status']}{$data['adm_tpl']['new_status_version']}" : "";
                $all_admin[$i]['mid']         = "";
                $all_admin[$i]['name']        = $data['adm_tpl']['module_title'];
                $all_admin[$i]['version']     = $Version;
                $all_admin[$i]['new_version'] = ($data['adm_tpl']['new_version']) ? $data['adm_tpl']['new_version'] . $status : "";

                if (file_exists(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}/version.txt")) {
                    $last_update = filemtime(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}/version.txt");
                } else {
                    $last_update = $data['adm_tpl']['new_last_update'];
                }
                $all_admin[$i]['last_update'] = date("Y-m-d H:i", $last_update);

                $all_admin[$i]['new_last_update'] = ($data['adm_tpl']['new_last_update']) ? date("Y-m-d H:i", $data['adm_tpl']['new_last_update']) : "";

                if (file_exists(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}")) {
                    $all_admin[$i]['fileowner'] = getpwuid(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}");
                    $all_admin[$i]['filegroup'] = getgrgid(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}");
                    $all_admin[$i]['fileperms'] = substr(sprintf('%o', fileperms(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}")), -4);
                } else {
                    $all_admin[$i]['fileowner'] = $all_admin[$i]['filegroup'] = $all_admin[$i]['fileperms'] = '';
                }
                $all_admin[$i]['weight']          = "";
                $all_admin[$i]['isactive']        = "";
                $all_admin[$i]['dirname']         = $dirname;
                $all_admin[$i]['hasmain']         = "";
                $all_admin[$i]['hasadmin']        = "";
                $all_admin[$i]['hassearch']       = "";
                $all_admin[$i]['hasconfig']       = "";
                $all_admin[$i]['hascomments']     = "";
                $all_admin[$i]['hasnotification'] = "";

                $version     = $Version * 100;
                $new_version = $data['adm_tpl']['new_version'] * 100;
                $version     = intval($version);
                $new_version = intval($new_version);

                $last_update                = strtotime($all_admin[$i]['last_update']);
                $new_last_update            = strtotime($all_admin[$i]['new_last_update']);
                $all_admin[$i]['function']  = ($new_version > $version or $new_last_update > $last_update) ? 'update_adm_tpl' : 'last_adm_tpl';
                $all_admin[$i]['update_sn'] = $data['adm_tpl']['update_sn'];
                $all_admin[$i]['descript']  = $data['adm_tpl']['module_descript'];
                $bubblepopup->add_tip("#{$dirname}_tip", preg_replace('/\s\s+/', '<br>', trim($data['adm_tpl']['module_descript'])));

                $all_admin[$i]['module_sn'] = $data['adm_tpl']['module_sn'];
                $all_admin[$i]['file_link'] = $data['adm_tpl']['file_link'];
                $all_admin[$i]['kind']      = $data['adm_tpl']['kind'];

                $i++;
            } else {
                $status                              = ($data['adm_tpl']['new_status_version']) ? " {$data['adm_tpl']['new_status']}{$data['adm_tpl']['new_status_version']}" : "";
                $all_un_admin[$i]['mid']             = "";
                $all_un_admin[$i]['name']            = $data['adm_tpl']['module_title'];
                $all_un_admin[$i]['version']         = "";
                $all_un_admin[$i]['new_version']     = ($data['adm_tpl']['new_version']) ? $data['adm_tpl']['new_version'] . $status : "";
                $last_update                         = file_exists((XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}/version.txt")) ? filemtime(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}/version.txt") : "";
                $all_un_admin[$i]['last_update']     = empty($last_update) ? _MA_TADADM_MOD_UNINSTALL : date("Y-m-d H:i", $last_update);
                $all_un_admin[$i]['new_last_update'] = ($data['adm_tpl']['new_last_update']) ? date("Y-m-d H:i", $data['adm_tpl']['new_last_update']) : "";

                if (file_exists(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}")) {
                    $all_un_admin[$i]['fileowner'] = getpwuid(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}");
                    $all_un_admin[$i]['filegroup'] = getgrgid(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}");
                    $all_un_admin[$i]['fileperms'] = substr(sprintf('%o', fileperms(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}")), -4);
                } else {
                    $all_un_admin[$i]['fileowner'] = $all_un_admin[$i]['filegroup'] = $all_un_admin[$i]['fileperms'] = '';
                }

                $all_un_admin[$i]['weight']          = "";
                $all_un_admin[$i]['isactive']        = "";
                $all_un_admin[$i]['dirname']         = $dirname;
                $all_un_admin[$i]['hasmain']         = "";
                $all_un_admin[$i]['hasadmin']        = "";
                $all_un_admin[$i]['hassearch']       = "";
                $all_un_admin[$i]['hasconfig']       = "";
                $all_un_admin[$i]['hascomments']     = "";
                $all_un_admin[$i]['hasnotification'] = "";
                $all_un_admin[$i]['function']        = ($data['adm_tpl']['new_last_update'] > $last_update) ? 'install_adm_tpl' : 'last_adm_tpl';
                $all_un_admin[$i]['update_sn']       = $data['adm_tpl']['update_sn'];
                $all_un_admin[$i]['descript']        = $data['adm_tpl']['module_descript'];
                $bubblepopup->add_tip("#{$dirname}_tip", preg_replace('/\s\s+/', '<br>', trim($data['adm_tpl']['module_descript'])));

                $all_un_admin[$i]['module_sn'] = $data['adm_tpl']['module_sn'];
                $all_un_admin[$i]['file_link'] = $data['adm_tpl']['file_link'];
                $all_un_admin[$i]['kind']      = $data['adm_tpl']['kind'];

                $i++;
            }
        } else {
            continue;
        }
    }

    //佈景部份
    $all_theme = $all_un_theme = array();
    foreach ($mod as $dirname => $data) {
        if (isset($ok['theme']) and in_array($dirname, $ok['theme'])) {
            continue;
        }

        $Version = "";
        //佈景部份
        if (isset($data['theme']['kind']) and $data['theme']['kind'] == "theme") {
            $ok['theme'][] = $dirname;
            if (is_dir(XOOPS_ROOT_PATH . "/themes/{$dirname}")) {

                $Version    = get_theme_version($dirname);
                $type       = get_theme_type($dirname) ? 'web' : 'spec';
                $is_allowed = in_array($dirname, $xoopsConfig['theme_set_allowed']);

                $status = ($data['theme']['new_status_version']) ? " {$data['theme']['new_status']}{$data['theme']['new_status_version']}" : "";

                $all_theme[$type][$is_allowed][$i]['allowed']     = $is_allowed;
                $all_theme[$type][$is_allowed][$i]['name']        = $data['theme']['module_title'];
                $all_theme[$type][$is_allowed][$i]['version']     = $Version;
                $all_theme[$type][$is_allowed][$i]['new_version'] = ($data['theme']['new_version']) ? $data['theme']['new_version'] . $status : "";

                if (file_exists(XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini")) {
                    $last_update = filemtime(XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini");
                } else {
                    $last_update = $data['theme']['new_last_update'];
                }
                $all_theme[$type][$is_allowed][$i]['last_update'] = date("Y-m-d H:i", $last_update);

                $all_theme[$type][$is_allowed][$i]['new_last_update'] = ($data['theme']['new_last_update']) ? date("Y-m-d H:i", $data['theme']['new_last_update']) : "";

                if (file_exists(XOOPS_ROOT_PATH . "/themes/{$dirname}")) {
                    $all_theme[$type][$is_allowed][$i]['fileowner'] = getpwuid(XOOPS_ROOT_PATH . "/themes/{$dirname}");
                    $all_theme[$type][$is_allowed][$i]['filegroup'] = getgrgid(XOOPS_ROOT_PATH . "/themes/{$dirname}");
                    $all_theme[$type][$is_allowed][$i]['fileperms'] = substr(sprintf('%o', fileperms(XOOPS_ROOT_PATH . "/themes/{$dirname}")), -4);
                } else {
                    $all_theme[$type][$is_allowed][$i]['fileowner'] = $all_theme[$type][$is_allowed][$i]['filegroup'] = $all_theme[$type][$is_allowed][$i]['fileperms'] = '';
                }
                $all_theme[$type][$is_allowed][$i]['dirname'] = $dirname;

                $version     = $Version * 100;
                $new_version = $data['theme']['new_version'] * 100;
                $version     = intval($version);
                $new_version = intval($new_version);

                $last_update                                    = strtotime($all_theme[$type][$is_allowed][$i]['last_update']);
                $new_last_update                                = strtotime($all_theme[$type][$is_allowed][$i]['new_last_update']);
                $all_theme[$type][$is_allowed][$i]['function']  = ($new_version > $version or $new_last_update > $last_update) ? 'update_theme' : 'last_theme';
                $all_theme[$type][$is_allowed][$i]['update_sn'] = $data['theme']['update_sn'];
                $all_theme[$type][$is_allowed][$i]['descript']  = $data['theme']['module_descript'];
                $bubblepopup->add_tip("#{$dirname}_tip", preg_replace('/\s\s+/', '<br>', trim($data['theme']['module_descript'])));

                $all_theme[$type][$is_allowed][$i]['module_sn'] = $data['theme']['module_sn'];
                $all_theme[$type][$is_allowed][$i]['file_link'] = $data['theme']['file_link'];
                $all_theme[$type][$is_allowed][$i]['kind']      = $data['theme']['kind'];
                $all_theme[$type][$is_allowed][$i]['logo']      = XOOPS_URL . "/themes/$dirname/shot.gif";
                $i++;
            } else {
                $status                              = ($data['theme']['new_status_version']) ? " {$data['theme']['new_status']}{$data['theme']['new_status_version']}" : "";
                $all_un_theme[$i]['mid']             = "";
                $all_un_theme[$i]['name']            = $data['theme']['module_title'];
                $all_un_theme[$i]['version']         = "";
                $all_un_theme[$i]['new_version']     = ($data['theme']['new_version']) ? $data['theme']['new_version'] . $status : "";
                $last_update                         = file_exists((XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini")) ? filemtime(XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini") : "";
                $all_un_theme[$i]['last_update']     = empty($last_update) ? _MA_TADADM_MOD_UNINSTALL : date("Y-m-d H:i", $last_update);
                $all_un_theme[$i]['new_last_update'] = ($data['theme']['new_last_update']) ? date("Y-m-d H:i", $data['theme']['new_last_update']) : "";

                if (file_exists(XOOPS_ROOT_PATH . "/themes/{$dirname}")) {
                    $all_un_theme[$i]['fileowner'] = getpwuid(XOOPS_ROOT_PATH . "/themes/{$dirname}");
                    $all_un_theme[$i]['filegroup'] = getgrgid(XOOPS_ROOT_PATH . "/themes/{$dirname}");
                    $all_un_theme[$i]['fileperms'] = substr(sprintf('%o', fileperms(XOOPS_ROOT_PATH . "/themes/{$dirname}")), -4);
                } else {
                    $all_un_theme[$i]['fileowner'] = $all_un_theme[$i]['filegroup'] = $all_un_theme[$i]['fileperms'] = '';
                }

                $all_un_theme[$i]['dirname']   = $dirname;
                $all_un_theme[$i]['function']  = ($data['theme']['new_last_update'] > $last_update) ? 'install_theme' : 'last_theme';
                $all_un_theme[$i]['update_sn'] = $data['theme']['update_sn'];
                $all_un_theme[$i]['descript']  = $data['theme']['module_descript'];
                $bubblepopup->add_tip("#{$dirname}_tip", preg_replace('/\s\s+/', '<br>', trim($data['theme']['module_descript'])));

                $all_un_theme[$i]['module_sn'] = $data['theme']['module_sn'];
                $all_un_theme[$i]['file_link'] = $data['theme']['file_link'];
                $all_un_theme[$i]['kind']      = $data['theme']['kind'];

                $i++;
            }
        } else {
            continue;
        }
    }

    //未安裝部份
    $all_mods = array();
    foreach ($mod as $dirname => $item) {
        foreach ($item as $kind => $data) {
            if (in_array($dirname, $ok['module']) and $kind == "module") {
                continue;
            }

            if (in_array($dirname, $ok['adm_tpl']) and $kind == "adm_tpl") {
                continue;
            }

            if (in_array($dirname, $ok['theme']) and $kind == "theme") {
                continue;
            }

            if (isset($ok['fix']) and in_array($dirname, $ok['fix']) and $kind == "fix") {
                continue;
            }

            $i = $data['module_sn'];

            $all_mods[$i]['name']            = $data['module_title'];
            $all_mods[$i]['new_version']     = ($data['new_version']) ? $data['new_version'] . $status : "";
            $all_mods[$i]['new_last_update'] = ($data['new_last_update']) ? date("Y-m-d H:i", $data['new_last_update']) : "";
            $all_mods[$i]['dirname']         = $dirname;
            $all_mods[$i]['function']        = ($kind == "fix") ? "update" : "install";
            $all_mods[$i]['update_sn']       = $data['update_sn'];
            $all_mods[$i]['descript']        = nl2br(trim($data['module_descript']));
            $all_mods[$i]['module_sn']       = $data['module_sn'];
            $all_mods[$i]['file_link']       = $data['file_link'];
            $all_mods[$i]['kind']            = $data['kind'];

            // $i++;
        }
    }

    // if (empty($all_install_modules)) {
    //     redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADADM_NO_MODS);
    //     exit;
    // }

    if ($mode == "return") {
        return $all_install_modules;
    }
    $xoopsTpl->assign('all_active_modules', $all_active_modules);
    $xoopsTpl->assign('all_un_active_modules', $all_un_active_modules);
    ksort($all_mods);
    $xoopsTpl->assign('all_mods', $all_mods);
    $xoopsTpl->assign('all_theme', $all_theme);

    $xoopsTpl->assign('theme_set', $xoopsConfig['theme_set']);
    $xoopsTpl->assign('theme_set_allowed', $xoopsConfig['theme_set_allowed']);

    $xoopsTpl->assign('all_un_theme', $all_un_theme);
    $xoopsTpl->assign('all_admin', $all_admin);
    $xoopsTpl->assign('all_un_admin', $all_un_admin);

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/easy_responsive_tabs.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/easy_responsive_tabs.php";
    $responsive_tabs = new easy_responsive_tabs('#admTab');
    $responsive_tabs->rander();

    $bubblepopup->render();

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
    $sweet_alert = new sweet_alert();
    $sweet_alert->render("del_theme", "main.php?op=del_theme&theme=", 'theme');

}

//取得更新訊息
function get_tad_modules_info()
{
    global $xoopsModuleConfig;
    $source = empty($xoopsModuleConfig['source']) ? 'http://120.115.2.90' : $xoopsModuleConfig['source'];
    $url    = "{$source}/uploads/tad_modules/all.json";
    if (function_exists('curl_init')) {
        // die('curl_init');
        $ch      = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $data = curl_exec($ch);
        curl_close($ch);
    } elseif (function_exists('file_get_contents')) {
        // die('file_get_contents');
        $data = file_get_contents($url);
    } else {
        // die('fopen');
        $handle = fopen($url, "rb");
        $data   = stream_get_contents($handle);
        fclose($handle);
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
    if ($act == "install_theme") {
        $work_dir = "themes";
    } elseif ($act == "install_adm_tpl") {
        $work_dir = "modules/system/themes";
    } elseif ($act == "install_module") {
        $work_dir = "modules";
    }
    return $work_dir;
}

//登入SSH
function ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link = "", $dirname = "", $act = "", $update_sn = "")
{
    global $xoopsModuleConfig;
    $ssh='';
    include XOOPS_ROOT_PATH . '/modules/tad_adm/admin/Net/SSH2.php';
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
    }

    $work_dir = get_work_dir($act);

    //登入後要做的事
    next_to_do($file_link, $dirname, $work_dir, $update_sn, $act, $ssh);

}

function recurse_chown_chgrp($mypath, $uid, $gid)
{
    $d = opendir($mypath);
    while (($file = readdir($d)) !== false) {
        if ($file != "." && $file != "..") {
            $typepath = $mypath . "/" . $file;

            //print $typepath. " : " . filetype ($typepath). "<BR>" ;
            if (filetype($typepath) == 'dir') {
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
        $fileperms = substr(sprintf('%o', fileperms($path)), -4);
        if (!chmod($path, $dirmode)) {
            $dirmode_str = decoct($dirmode);

            print sprintf(_MA_TADADM_CHMOD_FAILED, $path, $dirmode_str, $fileowner['name'], $filegroup['name'], $fileperms);
            return;
        }
        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..') {
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
            $fileowner    = getpwuid($path);
            $filegroup    = posix_getgrgid(filegroup($path));
            $fileperms    = substr(sprintf('%o', fileperms($path)), -4);
            $filemode_str = decoct($filemode);
            print sprintf(_MA_TADADM_CHMOD_FAILED, $path, $filemode_str, $fileowner['name'], $filegroup['name'], $fileperms);
            return;
        }
    }
}

//安裝套件
function to_do($op='',$file_link = "", $dirname = "", $act = "install_module", $update_sn = "")
{
    global $xoopsTpl, $xoopsModuleConfig;

    if (empty($file_link)) {
        header("location:{$_SERVER['PHP_SELF']}");
    }

    $work_dir    = get_work_dir($act);
    $is_writable = is_writable(XOOPS_ROOT_PATH . "/{$work_dir}/");

    //若是可以寫入
    if ($is_writable) {
        next_to_do($op,$file_link, $dirname, $work_dir, $update_sn, $act);
    } else {
        $xoopsTpl->assign('now_op', 'login_form');
        $xoopsTpl->assign('update_sn', $update_sn);
        $xoopsTpl->assign('file_link', $file_link);
        $xoopsTpl->assign('dirname', $dirname);
        $xoopsTpl->assign('act', $act);
        $tad_adm_ssh_host = empty($_SESSION['tad_adm_ssh_host']) ? $_SERVER['SERVER_ADDR'] : $_SESSION['tad_adm_ssh_host'];
        $xoopsTpl->assign('tad_adm_ssh_host', $tad_adm_ssh_host);
        $xoopsTpl->assign('tad_adm_ssh_id', $_SESSION['tad_adm_ssh_id']);
        $xoopsTpl->assign('tad_adm_ssh_passwd', $_SESSION['tad_adm_ssh_passwd']);
    }
}

function next_to_do($op='',$file_link = '', $dirname = '', $work_dir = '', $update_sn = '', $act = '', $ssh = '')
{
    global $xoopsModuleConfig;
    // die("$file_link , $dirname, $work_dir, $update_sn, $act");
    $file_link = str_replace("[source]", $xoopsModuleConfig['source'], $file_link);
    if ($dirname == "tad_adm") {
        $new_file = str_replace("http://120.115.2.90/uploads/tad_modules/file/", XOOPS_ROOT_PATH . "/uploads/", $file_link);
    } else {
        $new_file = str_replace("{$xoopsModuleConfig['source']}/uploads/tad_modules/file/", XOOPS_ROOT_PATH . "/uploads/", $file_link);
    }
    mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm");
    copyemz($file_link, $new_file, $update_sn);

    if (!is_file($new_file)) {
        redirect_header($_SERVER['PHP_SELF'] . "?tad_adm_tpl=clean", 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
    }

    require_once XOOPS_ROOT_PATH . "/modules/tad_adm/class/dunzip2/dUnzip2.inc.php";
    require_once XOOPS_ROOT_PATH . "/modules/tad_adm/class/dunzip2/dZip.inc.php";
    $zip = new dUnzip2($new_file);
    $zip->getList();
    $zip->unzipAll(XOOPS_ROOT_PATH . "/uploads/tad_adm/");
    $zip->close($new_file);

    if ($ssh != "") {
        $ssh->exec("cp -fr " . XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname " . XOOPS_ROOT_PATH . "/{$work_dir}/");
        $ssh->exec("chmod -R 755 " . XOOPS_ROOT_PATH . "/{$work_dir}/$dirname");
        $ssh->exec("chown -R {$ssh_id}:{$ssh_id} " . XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}");
        $ssh->exec("rm -fr " . XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}");
        $ssh->exec("rm -f $new_file");
    } else {
        full_copy(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname", XOOPS_ROOT_PATH . "/{$work_dir}/");
        //重設權限
        chmod_R(XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}", 0755, 0755);
        unlink($new_file);

    }

    if (is_dir(XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}")) {
        if ($act == "install_theme") {
            add_theme_config($dirname);
            redirect_header($_SERVER['PHP_SELF'] . "?op=list_all_modules&tad_adm_tpl=clean", 3, sprintf(_MA_TADADM_THEME_INSTALL_OK, $dirname));
        } elseif ($act == "update_theme") {
            add_theme_config($dirname);
            redirect_header($_SERVER['PHP_SELF'] . "?op=list_all_modules&tad_adm_tpl=clean", 3, _MA_TADADM_THEME_UPDATE_OK);
        } elseif ($act == "install_adm_tpl") {
            add_adm_tpl_config($dirname);
            redirect_header($_SERVER['PHP_SELF'] . "?op=list_all_modules&tad_adm_tpl=clean", 3, sprintf(_MA_TADADM_ADM_TPL_INSTALL_OK, $dirname));
        } elseif ($act == "update_adm_tpl") {
            add_adm_tpl_config($dirname);
            redirect_header($_SERVER['PHP_SELF'] . "?op=list_all_modules&tad_adm_tpl=clean", 3, _MA_TADADM_ADM_TPL_UPDATE_OK);
        } elseif ($act == "install_module") {
            header("location:" . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op={$op}&module={$dirname}&tad_adm_tpl=clean");
            exit;
        } elseif ($act == "update_module") {
            header("location:" . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op={$op}&module={$dirname}&tad_adm_tpl=clean");
            exit;
        }
    } else {
        redirect_header($_SERVER['PHP_SELF'] . "?tad_adm_tpl=clean", 3, sprintf(_MA_TADADM_MV_FAIL, XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname"));
    }

}

//拷貝目錄
function full_copy($source = "", $target = "")
{
    if (is_dir($source)) {
        @mkdir($target);
        $d = dir($source);
        while (false !== ($entry = $d->read())) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            $Entry = $source . '/' . $entry;
            if (is_dir($Entry)) {
                full_copy($Entry, $target . '/' . $entry);
                continue;
            }
            copy($Entry, $target . '/' . $entry);
        }
        $d->close();
    } else {
        copy($source, $target);
    }
}

function act_form($dirname, $op, $title)
{
    global $xoopsConfig;
    require XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php";
    require XOOPS_ROOT_PATH . "/modules/{$dirname}/language/{$xoopsConfig['language']}/modinfo.php";
// die("$dirname, $op, $title");
    include_once XOOPS_ROOT_PATH . "/class/xoopsformloader.php";
    $token      = new XoopsFormHiddenToken();
    $token_code = $token->render();

    $mod_name = constant($modversion['name']);

    $main = "
        <link rel='stylesheet' type='text/css' media='screen' href='" . XOOPS_URL . "/modules/tadtools/bootstrap3/css/bootstrap.css' />
        <link rel='stylesheet' type='text/css' media='screen' href='" . XOOPS_URL . "/modules/tadtools/css/xoops_adm.css' />
        <div class='well'>
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
        $sql = "update " . $xoopsDB->prefix("config") . " set conf_value='{$theme}' where conf_name='cpanel'";

        $xoopsDB->queryF($sql) or web_error($sql);
    }
}

function add_theme_config($theme)
{
    global $xoopsConfig, $xoopsDB;
    if (!in_array($theme, $xoopsConfig['theme_set_allowed'])) {
        $xoopsConfig['theme_set_allowed'][] = $theme;
        $theme_set_allowed                  = serialize($xoopsConfig['theme_set_allowed']);
        $sql                                = "update " . $xoopsDB->prefix("config") . " set conf_value='{$theme_set_allowed}' where conf_name='theme_set_allowed'";

        $xoopsDB->queryF($sql) or web_error($sql);

        $sql = "INSERT INTO `" . $xoopsDB->prefix("tadtools_setup") . "` (`tt_theme` , `tt_use_bootstrap`,`tt_bootstrap_color`) values('{$theme}', '0', 'bootstrap' ) ON DUPLICATE KEY UPDATE `tt_use_bootstrap` = '0',`tt_bootstrap_color`='bootstrap'";

        $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'], 3, $xoopsDB->error());
    }
}

function copyemz($file1, $file2, $update_sn)
{
    global $xoopsConfig, $xoopsModuleConfig;

    $add_count_url = "{$xoopsModuleConfig['source']}/modules/tad_modules/api.php?update_sn={$update_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=" . XOOPS_VERSION . "&language={$xoopsConfig['language']}";

    // die("$file1");
    $url = $file1;
    if (function_exists('curl_init')) {
        $ch      = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $contentx = curl_exec($ch);
        curl_close($ch);

        $ch      = curl_init();
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
        $count    = file_get_contents($add_count_url);
    } else {
        $handle   = fopen($url, "rb");
        $contentx = stream_get_contents($handle);
        fclose($handle);

        $handle = fopen($add_count_url, "rb");
        $count  = stream_get_contents($handle);
        fclose($handle);
    }

    $openedfile = fopen($file2, "w");
    fwrite($openedfile, $contentx);
    fclose($openedfile);
    if ($contentx === false) {
        $status = false;
    } else {
        $status = true;
    }
// die($status);
    return $status;
}

function getpwuid($file = "")
{
    if (function_exists('posix_getpwuid')) {
        return posix_getpwuid(fileowner($file));
    } else {
        return "";
    }
}

function getgrgid($file = "")
{
    if (function_exists('posix_getgrgid')) {
        return posix_getgrgid(filegroup($file));
    } else {
        return "";
    }
}

function get_logo($dirname)
{
    global $xoopsConfig;
    include XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php";
    include XOOPS_ROOT_PATH . "/modules/{$dirname}/language/{$xoopsConfig['language']}/modinfo.php";
    return XOOPS_URL . "/modules/{$dirname}/{$modversion['image']}";
}

function get_theme_version($dirname)
{
    $handle = @fopen(XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini", "r");
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
            $ini = explode("=", $buffer);
            if (trim($ini[0]) == "Version") {
                $Version = str_replace("\"", "", trim($ini[1]));
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
    include XOOPS_ROOT_PATH . "/themes/{$dirname}/config.php";
    return $theme_set_allowed;
}
