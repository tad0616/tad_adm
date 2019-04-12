<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_adm_adm_main.tpl";
include_once "header.php";
include_once "../function.php";
require "adm_function.php";

/*-----------function區--------------*/

if (file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/FooTable.php")) {
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/FooTable.php";

    $FooTable = new FooTable();
    $FooTable->render();
}

if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php")) {
    redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
}
include_once XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php";
$fancybox = new fancybox('.modulesadmin', '640', '480');
$fancybox->render(true);

$fancybox2 = new fancybox('.readme', '640', '480');
$fancybox2->render(false);

//列出所有模組
function list_modules($mode = "tpl")
{
    global $xoopsDB, $xoopsModuleConfig, $xoopsTpl, $xoopsConfig,$inSchoolWeb;
    $xoopsTpl->assign('inSchoolWeb',$inSchoolWeb);


    //取得更新訊息
    $mod = get_tad_json_info('all.json');
    //         $mod[$dirname]['module'][$kind]['module_title']       = $module_title;
    //         $mod[$dirname]['module'][$kind]['update_sn']          = $update_sn;
    //         $mod[$dirname]['module'][$kind]['new_version']        = $new_version;
    //         $mod[$dirname]['module'][$kind]['new_status']         = $new_status;
    //         $mod[$dirname]['module'][$kind]['new_status_version'] = $new_status_version;
    //         $mod[$dirname]['module'][$kind]['new_last_update']    = $new_last_update;
    //         $mod[$dirname]['module'][$kind]['update_descript']    = str_replace("\n", "\\n", $update_descript);
    //         $mod[$dirname]['module'][$kind]['module_sn']          = $module_sn;
    //         $mod[$dirname]['module'][$kind]['module_descript']    = str_replace("\n", "\\n", $module_descript);
    //         $mod[$dirname]['module'][$kind]['file_link']          = $file_link;
    //         $mod[$dirname]['module'][$kind]['kind']               = $kind;

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/bubblepopup.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/bubblepopup.php";
    $bubblepopup = new bubblepopup();

    //抓出現有模組
    $sql    = "SELECT * FROM " . $xoopsDB->prefix("modules") . " ORDER BY hasmain DESC, weight";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);

    $i = 0;
    //模組部份
    $all_install_modules = [];
    while ($data = $xoopsDB->fetchArray($result)) {
        foreach ($data as $k => $v) {
            $$k = $v;
        }
        if (!isset($mod[$dirname])) {
            continue;
        }
        if ($mod[$dirname]['module']['kind'] == "module") {
            $ok['module'][] = $dirname;
        } else {
            continue;
        }

        $version     = intval($version);
        $new_version = $mod[$dirname]['module']['new_version'] * 100;
        $new_version = intval($new_version);

        $last_update     = filemtime(XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php");
        $new_last_update = $mod[$dirname]['module']['new_last_update'];

        $function = (($new_version > $version) or ($new_last_update > $last_update)) ? 'update' : 'last_mod';

        $all_install_modules[$isactive][$function][$i]['newversion']  = $new_version;
        $all_install_modules[$isactive][$function][$i]['now_version'] = $version;

        $all_install_modules[$isactive][$function][$i]['function'] = $function;

        $status = ($mod[$dirname]['module']['new_status_version']) ? " {$mod[$dirname]['module']['new_status']}{$mod[$dirname]['module']['new_status_version']}" : "";

        $all_install_modules[$isactive][$function][$i]['mid']         = $mid;
        $all_install_modules[$isactive][$function][$i]['name']        = $name;
        $all_install_modules[$isactive][$function][$i]['version']     = round($version / 100, 2);
        $all_install_modules[$isactive][$function][$i]['new_version'] = ($mod[$dirname]['module']['new_version']) ? $mod[$dirname]['module']['new_version'] . $status : "";

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

    $all_active_modules    = isset($all_install_modules[1]) ? $all_install_modules[1] : [];
    $all_un_active_modules = isset($all_install_modules[0]) ? $all_install_modules[0] : [];

    //後台部份
    $all_admin = $all_un_admin = [];
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

                $last_update     = strtotime($all_admin[$i]['last_update']);
                $new_last_update = strtotime($all_admin[$i]['new_last_update']);
                // die("$last_update $new_last_update");
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

    //區塊部份
    $all_block = $all_un_block = [];
    //抓出現有區塊
    $sql    = "SELECT bid,dirname,visible, last_modified FROM " . $xoopsDB->prefix("newblocks") . " WHERE `mid`=0 AND `dirname`!='' ORDER BY side, weight";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
    while (list($bid, $dirname, $visible, $last_modified) = $xoopsDB->fetchRow($result)) {
        $bid_array[$bid]             = $dirname;
        $bid_visible[$dirname]       = $visible;
        $bid_last_modified[$dirname] = $last_modified;
    }
    foreach ($mod as $dirname => $data) {
        if (isset($ok['block']) and in_array($dirname, $ok['block'])) {
            continue;
        }

        //區塊部份
        if (isset($data['block']['kind']) and $data['block']['kind'] == "block") {
            $ok['block'][] = $dirname;
            if (in_array($dirname, $bid_array)) {

                $is_visible = $bid_visible[$dirname];

                $all_block[$is_visible][$i]['allowed']         = $is_visible;
                $all_block[$is_visible][$i]['name']            = $data['block']['module_title'];
                $all_block[$is_visible][$i]['last_update']     = date("Y-m-d H:i", $bid_last_modified[$dirname]);
                $all_block[$is_visible][$i]['new_last_update'] = ($data['block']['new_last_update']) ? date("Y-m-d H:i", $data['block']['new_last_update']) : "";
                $all_block[$is_visible][$i]['dirname']         = $dirname;

                $last_update                             = strtotime($all_block[$is_visible][$i]['last_update']);
                $new_last_update                         = strtotime($all_block[$is_visible][$i]['new_last_update']);
                $all_block[$is_visible][$i]['function']  = ($new_last_update > $last_update) ? 'update_block' : 'last_block';
                $all_block[$is_visible][$i]['update_sn'] = $data['block']['update_sn'];
                $all_block[$is_visible][$i]['descript']  = $data['block']['module_descript'];
                $bubblepopup->add_tip("#{$dirname}_tip", preg_replace('/\s\s+/', '<br>', trim($data['block']['module_descript'])));
                $all_block[$is_visible][$i]['module_sn']  = $data['block']['module_sn'];
                $all_block[$is_visible][$i]['kind']       = $data['block']['kind'];
                $all_block[$is_visible][$i]['logo']       = $data['block']['logo'];
                $all_block[$is_visible][$i]['logo_thumb'] = $data['block']['logo_thumb'];
            } else {
                $all_un_block[$i]['name']            = $data['block']['module_title'];
                $all_un_block[$i]['new_last_update'] = ($data['block']['new_last_update']) ? date("Y-m-d H:i", $data['block']['new_last_update']) : "";
                $all_un_block[$i]['dirname']         = $dirname;
                $all_un_block[$i]['function']        = 'install_block';
                $all_un_block[$i]['update_sn']       = $data['block']['update_sn'];
                $all_un_block[$i]['descript']        = $data['block']['module_descript'];
                $bubblepopup->add_tip("#{$dirname}_tip", preg_replace('/\s\s+/', '<br>', trim($data['block']['module_descript'])));
                $all_un_block[$i]['module_sn']  = $data['block']['module_sn'];
                $all_un_block[$i]['kind']       = $data['block']['kind'];
                $all_un_block[$i]['logo']       = $data['block']['logo'];
                $all_un_block[$i]['logo_thumb'] = $data['block']['logo_thumb'];
            }

            $i++;
        } else {
            continue;
        }
    }

    //佈景部份
    $all_theme = $all_un_theme = [];
    foreach ($mod as $dirname => $data) {
        if (isset($ok['theme']) and in_array($dirname, $ok['theme'])) {
            continue;
        }

        $Version = "";
        //佈景部份
        if (isset($data['theme']['kind']) and $data['theme']['kind'] == "theme") {
            $ok['theme'][] = $dirname;
            if (is_dir(XOOPS_ROOT_PATH . "/themes/{$dirname}")) {

                $type       = get_theme_type($dirname) ? 'web' : 'spec';
                $Version    = get_theme_version($dirname);
                $is_allowed = in_array($dirname, $xoopsConfig['theme_set_allowed']);

                $status = ($data['theme']['new_status_version']) ? " {$data['theme']['new_status']}{$data['theme']['new_status_version']}" : "";

                $all_theme[$type][$is_allowed][$i]['allowed']     = $is_allowed;
                $all_theme[$type][$is_allowed][$i]['name']        = $data['theme']['module_title'];
                $all_theme[$type][$is_allowed][$i]['version']     = $Version;
                $all_theme[$type][$is_allowed][$i]['new_version'] = ($data['theme']['new_version']) ? $data['theme']['new_version'] . $status : "";
                $all_theme[$type][$is_allowed][$i]['is_link']     = is_link(XOOPS_ROOT_PATH . "/themes/{$dirname}");

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

                $last_update     = strtotime($all_theme[$type][$is_allowed][$i]['last_update']);
                $new_last_update = strtotime($all_theme[$type][$is_allowed][$i]['new_last_update']);
                // die("$last_update $new_last_update");
                $all_theme[$type][$is_allowed][$i]['function']  = (($new_version > $version) or ($new_last_update > $last_update)) ? 'update_theme' : 'last_theme';
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

                $all_un_theme[$i]['module_sn']  = $data['theme']['module_sn'];
                $all_un_theme[$i]['file_link']  = $data['theme']['file_link'];
                $all_un_theme[$i]['kind']       = $data['theme']['kind'];
                $all_un_theme[$i]['logo']       = $data['theme']['logo'];
                $all_un_theme[$i]['logo_thumb'] = $data['theme']['logo_thumb'];

                $i++;
            }
        } else {
            continue;
        }
    }

    //未安裝部份
    $all_mods = [];
    foreach ($mod as $dirname => $item) {
        foreach ($item as $kind => $data) {
            if (in_array($dirname, $ok['module']) and $kind == "module") {
                continue;
            }

            if (in_array($dirname, $ok['adm_tpl']) and $kind == "adm_tpl") {
                continue;
            }

            if (in_array($dirname, $ok['block']) and $kind == "block") {
                continue;
            }

            if (in_array($dirname, $ok['theme']) and $kind == "theme") {
                continue;
            }

            if (isset($ok['fix']) and in_array($dirname, $ok['fix']) and $kind == "fix") {
                continue;
            }

            // $i = $data['module_sn'];
            $i = $dirname;

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
            $all_mods[$i]['logo']            = $data['logo'];

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
    // die(var_export($all_block));
    $xoopsTpl->assign('all_block', $all_block);
    $xoopsTpl->assign('all_un_block', $all_un_block);

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
    $sweet_alert->render("delete_theme", "main.php?op=delete_theme&dirname=", 'theme');

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php";
    $fancybox = new fancybox('.fancybox');
    $fancybox->render(false);
}

function active_module($mid)
{
    global $xoopsDB;
    $sql = "UPDATE " . $xoopsDB->prefix("modules") . " SET isactive='1' WHERE `mid`='{$mid}'";
    $xoopsDB->queryF($sql) or web_error($sql, __FILE__, __LINE__);
}

function get_theme_color($dirname)
{
    global $xoopsConfig;
    include XOOPS_ROOT_PATH . "/themes/{$dirname}/config.php";
    return [$theme_color, $theme_kind];
}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op         = system_CleanVars($_REQUEST, 'op', '', 'string');
$update_sn  = system_CleanVars($_REQUEST, 'update_sn', 0, 'int');
$xoops_sn  = system_CleanVars($_REQUEST, 'xoops_sn', 0, 'int');
$file_link  = system_CleanVars($_REQUEST, 'file_link', '', 'string');
$dirname    = system_CleanVars($_REQUEST, 'dirname', '', 'string');
$act        = system_CleanVars($_REQUEST, 'act', '', 'string');
$kind_dir   = system_CleanVars($_REQUEST, 'kind_dir', '', 'string');
$ssh_id     = system_CleanVars($_REQUEST, 'ssh_id', '', 'string');
$ssh_passwd = system_CleanVars($_REQUEST, 'ssh_passwd', '', 'string');
$ssh_host   = system_CleanVars($_REQUEST, 'ssh_host', '', 'string');
$kind       = system_CleanVars($_REQUEST, 'kind', '', 'string');
$mid        = system_CleanVars($_REQUEST, 'mid', 0, 'int');
$val        = system_CleanVars($_REQUEST, 'val', 0, 'int');
$theme      = system_CleanVars($_REQUEST, 'theme', '', 'string');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    case "ssh_login":
        ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link, $dirname, $act, $update_sn, $xoops_sn);
        break;

    case "install_module":
        to_do($file_link, $dirname, "install_module", $update_sn);
        break;

    case "update_module":
        to_do($file_link, $dirname, "update_module", $update_sn);
        break;

    case "install_theme":
        to_do($file_link, $dirname, "install_theme", $update_sn);
        break;

    case "update_theme":
        to_do($file_link, $dirname, "update_theme", $update_sn);
        break;

    case "delete_theme":
        to_do('', $dirname, "delete_theme");
        break;

    case "install_adm_tpl":
        to_do($file_link, $dirname, "install_adm_tpl", $update_sn);
        break;

    case "update_adm_tpl":
        to_do($file_link, $dirname, "update_adm_tpl", $update_sn);
        break;

    case "install_block":
        do_block('install', $update_sn);
        header("location: main.php#admTab6");
        exit;

    case "update_block":
        do_block('update', $update_sn);
        header("location: main.php#admTab6");
        exit;

    case "active":
        active_module($mid);
        header("location: main.php");
        exit;

    case "update_allowed":
        update_allowed($theme, $val);
        header("location: main.php#admTab4");
        exit;

    default:
        list_modules();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tad_adm/css/module.css');
include_once 'footer.php';
