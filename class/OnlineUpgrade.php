<?php
namespace XoopsModules\Tad_adm;

use XoopsModules\Tadtools\EasyResponsiveTabs;
use XoopsModules\Tadtools\FancyBox;
use XoopsModules\Tadtools\FooTable;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tad_adm\DunZip2;

class OnlineUpgrade
{
    //建構函數
    public function __construct()
    {
    }

    public static function get_adm_config()
    {
        global $xoopsModule, $xoopsModuleConfig;

        if ('tad_adm' !== $xoopsModule->dirname()) {
            $moduleHandler = xoops_getHandler('module');
            $xModule = $moduleHandler->getByDirname('tad_adm');
            $configHandler = xoops_getHandler('config');
            $TadAmModuleConfig = $configHandler->getConfigsByCat(0, $xModule->mid());
        } else {
            $TadAmModuleConfig = $xoopsModuleConfig;
        }
        return $TadAmModuleConfig;
    }

    //列出所有模組
    public static function list_modules($mode = 'tpl')
    {
        global $xoopsDB, $xoopsTpl, $xoopsConfig, $inSchoolWeb;

        //取得升級訊息
        $all_mods = self::get_tad_json_info('all2.json');
        // Utility::dd($all_mods);
        // 已安裝模組
        $mods = $blocks = [];
        $sql = 'SELECT * FROM ' . $xoopsDB->prefix('modules') . '';
        $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
        while ($mod = $xoopsDB->fetchArray($result)) {
            $dirname = $mod['dirname'];
            $mods[$dirname] = $mod;
        }
        $installed_modules = array_keys($mods);

        // 已安裝區塊
        $sql = 'SELECT * FROM ' . $xoopsDB->prefix('newblocks') . " WHERE `mid`=0 AND `dirname`!='' ORDER BY side, weight";
        $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
        while ($block = $xoopsDB->fetchArray($result)) {
            $dirname = $block['dirname'];
            $blocks[$dirname] = $block;
        }
        $installed_blocks = array_keys($blocks);

        foreach ($all_mods as $kind => $items) {
            foreach ($items as $dirname => $data) {
                switch ($kind) {
                    case "module":
                        $is_installed = in_array($dirname, $installed_modules) ? true : false;
                        $item = isset($mods[$dirname]) ? $mods[$dirname] : [];
                        break;

                    case "theme":
                        $is_installed = is_dir(XOOPS_ROOT_PATH . "/themes/{$dirname}") ? true : false;
                        $item = '';
                        break;

                    case "block":
                        $is_installed = in_array($dirname, $installed_blocks) ? true : false;
                        $item = isset($blocks[$dirname]) ? $blocks[$dirname] : [];
                        break;

                    case "adm_tpl":
                        $is_installed = is_dir(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}") ? true : false;
                        $item = '';
                        break;

                    case "other":
                        $is_installed = file_exists(XOOPS_ROOT_PATH . "/uploads/module_sn_{$data['module_sn']}.txt") ? true : false;
                        // die(var_dump($is_installed));
                        $item = '';
                        break;
                }

                if ($is_installed) {
                    list($function, $enable, $mod_data) = self::get_installed($kind, $data, $item);
                    $all_install[$function][$kind][$enable][$dirname] = $mod_data;
                } else {
                    list($function, $mod_data) = self::get_uninstall($kind, $data);
                    $all_uninstall[$kind][$function][$dirname] = $mod_data;
                }
            }
        }
        // var_dump($all_install['latest']['theme']);
        // var_dump($all_install);
        // var_dump($all_uninstall);
        // exit;
        if ($mode == 'return') {
            return [$all_install, $all_uninstall];
        }

        $xoopsTpl->assign('all_install', $all_install);
        $xoopsTpl->assign('all_uninstall', $all_uninstall);
        $xoopsTpl->assign('theme_set', $xoopsConfig['theme_set']);
        $xoopsTpl->assign('inSchoolWeb', $inSchoolWeb);

        $FancyBox = new FancyBox('.modulesadmin', '640', '480');
        $FancyBox->render(true);

        $SweetAlert = new SweetAlert();
        $SweetAlert->render('delete_theme', 'main.php?op=delete_theme&dirname=', 'theme');

        $FooTable = new FooTable();
        $FooTable->render();

        $xoopsTpl->assign('jquery', Utility::get_jquery(true));

        $EasyResponsiveTabs = new EasyResponsiveTabs('#modTab');
        $EasyResponsiveTabs->rander();
    }

//列出所有XOOPS升級資訊
    public static function list_xoops($mode = "tpl")
    {
        global $xoopsDB, $xoopsTpl, $xoopsConfig;
        //取得升級訊息
        $xoops_patch = self::get_tad_json_info('xoops.json');

        // die(var_dump($mod));
        // $xoops_patch[1]["xoops_sn"]          = "6";
        // $xoops_patch[1]["xoops_title"]       = "BootStrap4升級";
        // $xoops_patch[1]["xoops_version"]     = "2.59";
        // $xoops_patch[1]["xoops_status"]      = "Release";
        // $xoops_patch[1]["xoops_type"]        = "patch";
        // $xoops_patch[1]["php_min_version"]   = "5.37";
        // $xoops_patch[1]["php_max_version"]   = "0";
        // $xoops_patch[1]["xoops_min_version"] = "2.59";
        // $xoops_patch[1]["xoops_install"]     = "Patch檔無法單獨安裝，僅供升級使用。";
        // $xoops_patch[1]["xoops_update"]      = "請完整備份檔案及資料庫內容。";
        // $xoops_patch[1]["xoops_date"]  = 1546316860;
        // $xoops_patch[1]["xoops_count"] = "0";
        // $xoops_patch[1]["file_link"]   = "https://campus-xoops.tn.edu.tw/uploads/tad_modules/file/bs4_upgrade.zip";

        //後台部份
        $all_patch = $all_upgrade = array();
        foreach ($xoops_patch as $k => $xoops) {
            $type = $xoops['xoops_type'];
            list($function, $mod_data) = self::get_patch($type, $xoops);
            $all_patch[$type][$function][] = $mod_data;
        }
        // Utility::dd($all_patch);
        $xoopsTpl->assign('all_patch', $all_patch);

        $FooTable = new FooTable();
        $FooTable->render();

        $FancyBox = new FancyBox('.modulesadmin');
        $FancyBox->render(true);

        $xoopsTpl->assign('jquery', Utility::get_jquery(true));

        $EasyResponsiveTabs = new EasyResponsiveTabs('#xoopsTab');
        $EasyResponsiveTabs->rander();
    }

    //取得系統的升級或修補檔
    public static function get_patch($type, $data)
    {
        global $xoopsDB, $xoopsConfig;

        $item = [];

        $status = self::version_status('', $data, '', $type);
        list($background, $function) = self::get_patch_status($status);

        $item = $data;

        $item['status'] = $status;
        $item['function'] = $function;
        $item['background'] = $background;
        $item['xoops_date'] = date('Y-m-d H:i:s', $data['xoops_date']);

        $item_data[] = $function;
        $item_data[] = $item;

        return $item_data;
    }

    //取得升級訊息
    public static function get_tad_json_info($json = 'all.json')
    {
        $TadAmModuleConfig = self::get_adm_config();
        $source = empty($TadAmModuleConfig['source']) ? 'http://120.115.2.90' : $TadAmModuleConfig['source'];
        $url = "{$source}/uploads/tad_modules/{$json}";
        $error = '';
        if (function_exists('curl_init')) {
            $ch = curl_init();
            $timeout = 5;

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);
            if ($data === false) {
                $error = "<br>Curl error ($url):" . curl_errno($ch) . curl_error($ch);
            }
            curl_close($ch);
        } elseif (function_exists('file_get_contents')) {
            $data = file_get_contents($url);
        } else {
            $handle = fopen($url, "rb");
            $data = stream_get_contents($handle);
            fclose($handle);
        }

        if (empty($data)) {
            redirect_header("index.php", 3, _MA_TADADM_FAILED_TO_GET_JSON . $error);
        }

        $mod = json_decode($data, true);
        return $mod;
    }
    public static function get_installed_status($status)
    {
        if ($status == "ok") {
            $info[] = 'rgb(255, 226, 226)';
            $info[] = 'upgrade';
        } elseif ($status == "latest") {
            $info[] = 'rgb(248, 255, 240)';
            $info[] = 'latest';
        } else {
            $info[] = 'rgb(222, 222, 222)';
            $info[] = 'unable';
        }
        return $info;
    }

    public static function get_uninstall_status($status)
    {
        if ($status == "ok") {
            $info[] = 'rgb(255, 255, 255)';
            $info[] = 'install';
        } else {
            $info[] = 'rgb(222, 222, 222)';
            $info[] = 'unable';
        }
        return $info;
    }

    public static function get_patch_status($status)
    {
        if ($status == "ok") {
            $info[] = 'rgb(226, 226, 255)';
            $info[] = 'upgrade';
        } elseif ($status == "latest") {
            $info[] = 'rgb(248, 255, 240)';
            $info[] = 'latest';
        } else {
            $info[] = 'rgb(222, 222, 222)';
            $info[] = 'unable';
        }
        return $info;
    }

    //已安裝模組部份
    public static function get_installed($kind, $data, $db_data)
    {
        global $xoopsConfig;
        $dirname = $data['dirname'];
        $item = [];
        $path = '';

        switch ($kind) {
            case "module":
                foreach ($db_data as $k => $v) {
                    $$k = $v;
                }
                $int_new_version = Utility::get_version('module', $data['new_version'], $dirname);
                $int_version = Utility::get_version('module', $version, $dirname);
                $path = XOOPS_ROOT_PATH . "/modules/{$dirname}";
                $enable = $isactive;
                $is_link = is_link($path);

                $item['mid'] = $mid;
                $item['hasmain'] = $hasmain ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hasadmin'] = $hasadmin ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hassearch'] = $hassearch ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hasconfig'] = $hasconfig ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hascomments'] = $hascomments ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hasnotification'] = $hasnotification ? _MA_TADADM_1 : _MA_TADADM_0;

                break;

            case "theme":
                $path = XOOPS_ROOT_PATH . "/themes/{$dirname}";

                $int_new_version = Utility::get_version('theme', $data['new_version'], $dirname);
                $int_version = Utility::get_version('theme', null, $dirname);
                // $int_version = Utility::get_theme_version($dirname);
                $last_update = file_exists("{$path}/theme.ini") ? filemtime("{$path}/theme.ini") : '';
                $enable = in_array($dirname, $xoopsConfig['theme_set_allowed']) ? 1 : 0;
                $is_link = is_link($path);
                break;

            case "block":
                $int_new_version = Utility::get_version('block', $data['new_version']);
                $int_version = '';
                $last_update = $db_data['last_modified'];
                $enable = $db_data['visible'];
                $is_link = false;
                break;

            case "adm_tpl":
                $path = XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}";

                $int_new_version = Utility::get_version('adm_tpl', $data['new_version']);
                $int_version = Utility::get_version('adm_tpl', file_get_contents("{$path}/version.txt"));
                $last_update = file_exists("{$path}/version.txt") ? filemtime("{$path}/version.txt") : '';
                $enable = $dirname == $xoopsConfig['cpanel'] ? 1 : 0;
                $is_link = is_link($path);
                break;

            case "other":
                $int_new_version = Utility::get_version('other', $data['new_version']);
                $int_version = '';
                $last_update = file_get_contents(XOOPS_ROOT_PATH . "/uploads/module_sn_{$module_sn}.txt");
                $enable = 1;
                $is_link = false;
                break;
        }

        $status = self::version_status($int_version, $data, $dirname, $data['kind'], $last_update);
        list($background, $function) = self::get_installed_status($status);

        $rc = ($data['new_status_version']) ? " {$data['new_status']}{$data['new_status_version']}" : '';

        $item['name'] = $data['module_title'];
        $item['dirname'] = $dirname;
        $item['descript'] = preg_replace('/\s\s+/', '<br>', trim($data['update_descript']));
        $item['update_sn'] = $data['update_sn'];
        $item['module_sn'] = $data['module_sn'];
        $item['file_link'] = $data['file_link'];
        $item['kind'] = $data['kind'];
        $item['status'] = $status;
        $item['function'] = $function;
        $item['background'] = $background;
        // $item['new_version'] = ($data['new_version']) ? $data['new_version'] . $rc : '';
        $item['new_version'] = ($data['new_version']) ? Utility::version_format($data['kind'], $int_new_version) . $rc : '';
        $item['new_last_update'] = ($data['new_last_update']) ? date('Y-m-d H:i', $data['new_last_update']) : '';
        $item['logo'] = $data['logo'];
        $item['logo_thumb'] = $data['logo_thumb'];

        $item['now_version'] = Utility::version_format($data['kind'], $int_version);
        // $item['now_version'] = $int_version;
        $item['last_update'] = date('Y-m-d H:i', $last_update);

        if (file_exists($path)) {
            $item['fileowner'] = self::getpwuid($path);
            $item['filegroup'] = self::getgrgid($path);
            $item['fileperms'] = mb_substr(sprintf('%o', fileperms($path)), -4);
        } else {
            $item['fileowner'] = $item['filegroup'] = $item['fileperms'] = '';
        }
        $item['is_link'] = $is_link;
        $item['enable'] = $enable;

        $item_data[] = $function;
        $item_data[] = $enable;
        $item_data[] = $item;
        // if($kind=="other")die(print_r($item_data));
        return $item_data;
    }

    //未安裝模組
    public static function get_uninstall($kind, $data)
    {
        $status = self::version_status('', $data, $data['dirname'], $data['kind']);
        list($background, $function) = self::get_uninstall_status($status);
        $rc = ($data['new_status_version']) ? " {$data['new_status']}{$data['new_status_version']}" : '';

        $item['name'] = $data['module_title'];
        $item['dirname'] = $data['dirname'];
        $item['descript'] = nl2br(trim($data['module_descript']));
        $item['update_sn'] = $data['update_sn'];
        $item['module_sn'] = $data['module_sn'];
        $item['file_link'] = $data['file_link'];
        $item['kind'] = $kind = $data['kind'];
        $item['status'] = $status;
        $item['function'] = $function;
        $item['background'] = $background;
        $item['logo'] = $data['logo'];
        $item['logo_thumb'] = $data['logo_thumb'];
        $item['new_version'] = ($data['new_version']) ? $data['new_version'] . $rc : '';
        $item['new_last_update'] = ($data['new_last_update']) ? date('Y-m-d H:i', $data['new_last_update']) : '';

        $item_data[] = $function;
        $item_data[] = $item;

        return $item_data;
    }

    // 判斷目前的版本和網上的版本及各種相依條件
    public static function version_status($now_version, $mod_data, $dirname = '', $type = 'module', $last_update = '')
    {
        $debug = isset($_GET['debug']) ? $_GET['debug'] : 0;

        if ($debug == 1) {
            echo "<h5>{$type}-{$dirname}</h5>";
        }

        $mod_data['new_version'] = isset($mod_data['new_version']) ? $mod_data['new_version'] : '';
        $mod_data['xoops_version'] = isset($mod_data['xoops_version']) ? $mod_data['xoops_version'] : '';
        $mod_data['xoops_min_version'] = isset($mod_data['xoops_min_version']) ? $mod_data['xoops_min_version'] : '';
        $mod_data['php_min_version'] = isset($mod_data['php_min_version']) ? $mod_data['php_min_version'] : '';
        $mod_data['php_max_version'] = isset($mod_data['php_max_version']) ? $mod_data['php_max_version'] : '';
        $mod_data['tadtools_version'] = isset($mod_data['tadtools_version']) ? $mod_data['tadtools_version'] : '';
        // 20511
        $my_xoops_version = Utility::get_version('xoops');
        $my_php_version = Utility::get_version('php');
        $now_version = Utility::get_version($type, $now_version, $dirname);
        $new_version = Utility::get_version($type, $mod_data['new_version'], $dirname);
        $xoops_version = Utility::get_version('xoops', $mod_data['xoops_version']);
        $xoops_min_version = Utility::get_version('xoops', $mod_data['xoops_min_version']);
        $php_min_version = Utility::get_version('php', $mod_data["php_min_version"]);
        $php_max_version = Utility::get_version('php', $mod_data['php_max_version']);
        $min_tadtools_version = Utility::get_version('module', $mod_data['tadtools_version'], 'tadtools');
        $now_tadtools_version = Utility::get_version('module', '', 'tadtools');

        $chk_file = '';
        if ($type == "upgrade") {
            $filemtime = file_exists(XOOPS_ROOT_PATH . "/mainfile.php") ? filemtime(XOOPS_ROOT_PATH . "/mainfile.php") : 0;
            $now_mod_last_update = $last_update ? $last_update : $filemtime;
            $new_mod_last_update = $mod_data['xoops_date'];
            $chk_file = XOOPS_ROOT_PATH . "/uploads/xoops_sn_{$mod_data['xoops_sn']}.txt";
        } elseif ($type == "patch") {
            $now_mod_last_update = 0;
            $new_mod_last_update = $mod_data['xoops_date'];
            $chk_file = XOOPS_ROOT_PATH . "/uploads/xoops_sn_{$mod_data['xoops_sn']}.txt";
        } elseif ($type == "theme") {
            $filemtime = file_exists(XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini") ? filemtime(XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini") : 0;
            $now_mod_last_update = $last_update ? $last_update : $filemtime;
            $new_mod_last_update = $mod_data['new_last_update'];
        } elseif ($type == "adm_tpl") {
            $filemtime = file_exists(XOOPS_ROOT_PATH . "/themes/system/themes/tad/version.txt") ? filemtime(XOOPS_ROOT_PATH . "/themes/system/themes/tad/version.txt") : 0;
            $now_mod_last_update = $last_update ? $last_update : $filemtime;
            $new_mod_last_update = $mod_data['new_last_update'];
        } elseif ($type == "block") {
            $now_mod_last_update = $last_update;
            $new_mod_last_update = $mod_data['new_last_update'];
        } elseif ($type == "other") {
            $now_mod_last_update = strtotime(file_get_contents(XOOPS_ROOT_PATH . "/uploads/module_sn_{$mod_data['module_sn']}.txt"));
            $new_mod_last_update = $mod_data['new_last_update'];
            // die("{$now_mod_last_update}={$new_mod_last_update}");
            // $chk_file            = XOOPS_ROOT_PATH . "/uploads/module_sn_{$mod_data['module_sn']}.txt";
        } else {
            $filemtime = file_exists(XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php") ? filemtime(XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php") : 0;
            $now_mod_last_update = $last_update ? $last_update : $filemtime;
            $new_mod_last_update = $mod_data['new_last_update'];
        }

        $status = '';
        if (!empty($mod_data['php_min_version']) and $my_php_version < $php_min_version) {
            $status = 'PHP ' . _MA_TADADM_VERSION . _MA_TADADM_LOWER . ($mod_data['php_min_version']) . _MA_TADADM_UNABLE_UPGRADE;
            if ($debug == 1) {
                echo "<div>php_min_version: $my_php_version < $php_min_version</div>";
            }

        } elseif (!empty($mod_data['php_max_version']) and $my_php_version > $php_max_version) {
            $status = 'PHP ' . _MA_TADADM_VERSION . _MA_TADADM_HIGHER . ($mod_data['php_max_version']) . _MA_TADADM_UNABLE_UPGRADE;
            if ($debug == 1) {
                echo "<div>my_php_version: $my_php_version > $php_max_version</div>";
            }

        } elseif (!empty($mod_data['xoops_min_version']) and $my_xoops_version < $xoops_min_version) {
            $status = 'XOOPS ' . _MA_TADADM_VERSION . _MA_TADADM_LOWER . ($mod_data['xoops_min_version']) . _MA_TADADM_UNABLE_UPGRADE;
            if ($debug == 1) {
                echo "<div>xoops_min_version: $my_xoops_version < $xoops_min_version</div>";
            }

        } elseif (!empty($mod_data['xoops_version']) and $my_xoops_version > $xoops_version) {
            $status = 'XOOPS ' . _MA_TADADM_VERSION . _MA_TADADM_HIGHER . ($mod_data['xoops_version']) . _MA_TADADM_NONEED_UPGRADE;
            if ($debug == 1) {
                echo "<div>xoops_max_version: $my_xoops_version > $xoops_version</div>";
            }

        } elseif (!empty($mod_data['xoops_version']) and $my_xoops_version == $xoops_version) {
            $status = 'XOOPS ' . _MA_TADADM_VERSION . _MA_TADADM_EQUAL . ($mod_data['xoops_version']) . _MA_TADADM_NONEED_UPGRADE;
            if ($debug == 1) {
                echo "<div>xoops=version: $my_xoops_version == $xoops_version</div>";
            }

        } elseif (!empty($mod_data['tadtools_version']) and $now_tadtools_version < $min_tadtools_version) {
            $status = 'Tadtools ' . _MA_TADADM_VERSION . _MA_TADADM_LOWER . ($mod_data['tadtools_version']) . _MA_TADADM_UNABLE_UPGRADE;
            if ($debug == 1) {
                echo "<div>Tadtools: $now_tadtools_version < $min_tadtools_version</div>";
            }

        } elseif (!empty($chk_file) and file_exists($chk_file)) {
            $status = _MA_TADADM_PATCH_INSTALLED;
            if ($debug == 1) {
                echo "<div>file exist: $chk_file</div>";
            }
        } else {
            if ($debug == 1) {
                $now_last_update = date("Y-m-d H:i:s", $now_mod_last_update);
                $new_last_update = date("Y-m-d H:i:s", $new_mod_last_update);
            }

            if ($type == "block" or $type == "upgrade" or $type == "patch" or $type == "other") {
                $status = ($now_mod_last_update < $new_mod_last_update) ? 'ok' : 'latest';

                if ($debug == 1) {
                    echo "<div>date: $status ($now_last_update < $new_last_update)</div>";
                }
            } else {
                $status = (($now_version < $new_version) or ($now_mod_last_update < $new_mod_last_update)) ? 'ok' : 'latest';

                if ($debug == 1) {
                    echo "<div>date: $status ($now_version < $new_version) or ($now_last_update < $new_last_update)</div>";
                }
            }
        }
        return $status;
    }

    public static function get_act_op($act)
    {
        if (strpos($act, 'install') !== false) {
            $act_op = "install";
        } elseif (strpos($act, 'update') !== false) {
            $act_op = "update";
        } elseif (strpos($act, 'upgrade') !== false) {
            $act_op = "update";
        } elseif (strpos($act, 'delete') !== false) {
            $act_op = "delete";
        }
        return $act_op;
    }

    //安裝套件
    public static function to_do($file_link = '', $dirname = '', $act = 'install_module', $update_sn = '')
    {
        global $xoopsTpl, $inSchoolWeb;
        //從 act 判斷目前要執行什麼動作
        $op = self::get_act_op($act);
        if (empty($file_link) and ('install' === $op or 'update' === $op)) {
            header("location:{$_SERVER['PHP_SELF']}");
            exit;
        }

        // 偵測工作目錄是否可寫入
        $work_dir = self::get_work_dir($act);
        $is_writable = is_writable(XOOPS_ROOT_PATH . "/{$work_dir}/");

        //若是可以寫入
        if ($is_writable or $inSchoolWeb) {
            self::next_to_do($file_link, $dirname, $work_dir, $update_sn, $act);
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

    public static function update_allowed($theme, $val)
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

    public static function add_adm_tpl_config($theme)
    {
        global $xoopsConfig, $xoopsDB;
        if ($xoopsConfig['cpanel'] != $theme) {
            $sql = 'update ' . $xoopsDB->prefix('config') . " set conf_value='{$theme}' where conf_name='cpanel'";

            $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);
        }
    }

    public static function next_to_do($file_link = '', $dirname = '', $work_dir = '', $update_sn = '', $act = '', $ssh = '')
    {
        global $inSchoolWeb;

        $op = self::get_act_op($act);

        if ('install_theme' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
                self::update_allowed($dirname, 1);
                redirect_header('main.php', 3, sprintf(_MA_TADADM_THEME_INSTALL_OK, $dirname));
            }
        } elseif ('upgrade_theme' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
                self::update_allowed($dirname, 1);
                redirect_header('main.php', 3, _MA_TADADM_THEME_UPDATE_OK);
            }
        } elseif ('delete_theme' === $act) {
            if ($inSchoolWeb or self::delete_theme($dirname, $ssh)) {
                self::update_allowed($dirname, 0);
                redirect_header('main.php', 3, XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}" . _MA_TADADM_THEME_DELETE_OK);
            } else {
                redirect_header('main.php', 3, XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}" . _MA_TADADM_THEME_DELETE_FAIL);

            }
        } elseif ('install_adm_tpl' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
                self::add_adm_tpl_config($dirname);
                redirect_header($_SERVER['PHP_SELF'] . '?op=list_all_modules&tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_ADM_TPL_INSTALL_OK, $dirname));
            }
        } elseif ('upgrade_adm_tpl' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
                self::add_adm_tpl_config($dirname);
                redirect_header($_SERVER['PHP_SELF'] . '?op=list_all_modules&tad_adm_tpl=clean', 3, _MA_TADADM_ADM_TPL_UPDATE_OK);
            }
        } elseif ('install_module' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
                header('location:' . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op={$op}&module={$dirname}&tad_adm_tpl=clean");
                exit;
            }
        } elseif ('upgrade_module' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
                header('location:' . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op={$op}&module={$dirname}&tad_adm_tpl=clean");
                exit;
            }
        } elseif ('install_other' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
                header('location:' . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op={$op}&module={$dirname}&tad_adm_tpl=clean");
                exit;
            }
        } elseif ('upgrade_other' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)) {
                header('location:' . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op={$op}&module={$dirname}&tad_adm_tpl=clean");
                exit;
            }
        }
    }

    //安裝套件
    public static function to_up($file_link = '', $act = 'patch', $xoops_sn = '')
    {
        global $xoopsTpl;

        if (empty($file_link)) {
            header("location:{$_SERVER['PHP_SELF']}");
            exit;
        }

        $is_writable = is_writable(XOOPS_ROOT_PATH);

        //若是可以寫入
        if ($is_writable) {
            self::next_to_up($file_link, $xoops_sn, $act);
        } else {
            $xoopsTpl->assign('action', 'xoops.php');
            $xoopsTpl->assign('now_op', 'login_form');
            $xoopsTpl->assign('dirname', '');
            $xoopsTpl->assign('act', $act);
            $xoopsTpl->assign('xoops_sn', $xoops_sn);
            $xoopsTpl->assign('file_link', $file_link);
            $tad_adm_ssh_host = empty($_SESSION['tad_adm_ssh_host']) ? $_SERVER['SERVER_ADDR'] : $_SESSION['tad_adm_ssh_host'];
            $xoopsTpl->assign('tad_adm_ssh_host', $tad_adm_ssh_host);
            $xoopsTpl->assign('tad_adm_ssh_id', $_SESSION['tad_adm_ssh_id']);
            $xoopsTpl->assign('tad_adm_ssh_passwd', $_SESSION['tad_adm_ssh_passwd']);
        }
    }

    public static function next_to_up($file_link = '', $xoops_sn = '', $act = '', $ssh = '')
    {
        if ('patch' === $act) {
            if (self::get_upgrade_file($file_link, 'patch', $xoops_sn, $ssh)) {
                redirect_header('xoops.php', 3, _MA_TADADM_PATCH_OK);
            }
        } elseif ('upgrade' === $act) {
            if (self::get_upgrade_file($file_link, 'upgrade', $xoops_sn, $ssh)) {
                redirect_header('xoops.php', 3, _MA_TADADM_UPGRADE_OK);
            }
        }
    }

    //取得XOOPS升級或補釘
    public static function delete_theme($theme, $ssh = '')
    {
        if ('' != $ssh) {
            $ssh->exec("rm -Rf " . XOOPS_ROOT_PATH . "/themes/$theme");
            return true;
        }

        return false;
    }

    //取得XOOPS升級或補釘
    public static function get_upgrade_file($file_link, $dirname, $xoops_sn, $ssh)
    {

        $TadAmModuleConfig = self::get_adm_config();
        $file_link = str_replace('[source]', $TadAmModuleConfig['source'], $file_link);
        $new_file = str_replace($TadAmModuleConfig['source'] . "/uploads/tad_modules/file/", XOOPS_ROOT_PATH . '/uploads/', $file_link);

        Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_adm');
        // die("$file_link, $new_file");
        self::copyemz($file_link, $new_file, 0, $xoops_sn);

        if (!is_file($new_file)) {
            redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
        }

        if (is_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname")) {
            Utility::delete_directory(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname");
        }
        Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname");

        $zip = new DunZip2($new_file);
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
            self::chmod_R(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/upgrade.sh", 0777, 0777);
            $ssh->exec(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/upgrade.sh");
        } else {
            $handle = fopen(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/go.txt", 'rb');
            if ($handle) {
                while (false !== ($buffer = fgets($handle, 4096))) {
                    $buffer = str_replace('full_copy', '\XoopsModules\Tadtools\Utility::full_copy', $buffer);
                    $buffer = str_replace('delete_directory', '\XoopsModules\Tadtools\Utility::delete_directory', $buffer);
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

    //登入SSH
    public static function ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link = '', $dirname = '', $act = '', $update_sn = '', $xoops_sn = '')
    {

        $TadAmModuleConfig = self::get_adm_config();

        $ssh = '';
        // require XOOPS_ROOT_PATH . '/modules/tadtools/vendor/autoload.php';
        // $ssh = new SSH2($ssh_host, $TadAmModuleConfig['ssh_port']);

        set_include_path(XOOPS_ROOT_PATH . '/modules/tadtools/phpseclib');
        require 'Net/SSH2.php';
        $ssh = new \Net_SSH2($ssh_host, $TadAmModuleConfig['ssh_port']);

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

            $work_dir = self::get_work_dir($act);

            //登入後要做的事
            if ($xoops_sn) {
                // die("next_to_up($file_link, $dirname, $work_dir, $update_sn, $act, $ssh);");
                self::next_to_up($file_link, $xoops_sn, $act, $ssh);
            } else {
                self::next_to_do($file_link, $dirname, $work_dir, $update_sn, $act, $ssh);
            }
        }
    }

    public static function get_work_dir($act)
    {
        $work_dir = '';
        if (false !== mb_strpos($act, 'theme')) {
            $work_dir = 'themes';
        } elseif (false !== mb_strpos($act, 'adm_tpl')) {
            $work_dir = 'modules/system/themes';
        } elseif (false !== mb_strpos($act, 'module')) {
            $work_dir = 'modules';
        }

        return $work_dir;
    }

    public static function copyemz($file1, $file2, $update_sn = '', $xoops_sn = '')
    {
        global $xoopsConfig;

        $TadAmModuleConfig = self::get_adm_config();
        $ver = (int) str_replace('.', '', substr(XOOPS_VERSION, 6, 5));
        if ($xoops_sn) {
            $add_count_url = $TadAmModuleConfig['source'] . "/modules/tad_modules/api.php?xoops_sn={$xoops_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=$ver&language={$xoopsConfig['language']}";
        } else {
            $add_count_url = $TadAmModuleConfig['source'] . "/modules/tad_modules/api.php?update_sn={$update_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=$ver&language={$xoopsConfig['language']}";
        }

        $url = $file1;
        // die($url);
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
            // die('curl');
        } elseif (function_exists('file_get_contents')) {
            $contentx = file_get_contents($url);
            $count = file_get_contents($add_count_url);
            // die('file_get_contents');
        } else {
            $handle = fopen($url, 'rb');
            $contentx = stream_get_contents($handle);
            fclose($handle);

            $handle = fopen($add_count_url, 'rb');
            $count = stream_get_contents($handle);
            fclose($handle);
        }
        // die('fopen');

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

    public static function getpwuid($file = "")
    {
        return self::GetUsernameFromUid(fileowner($file));
    }

    public static function GetUsernameFromUid($uid)
    {

        if (function_exists('posix_getpwuid')) {

            $a = posix_getpwuid($uid);

            return $a['name'];

        }

        # This works on BSD but not with GNU

        elseif (strstr(php_uname('s'), 'BSD')) {

            exec('id -u ' . (int) $uid, $o, $r);

            if ($r == 0) {
                return trim($o['0']);
            } else {
                return $uid;
            }

        } elseif (is_readable('/etc/passwd')) {

            exec(sprintf('grep :%s: /etc/passwd | cut -d: -f1', (int) $uid), $o, $r);

            if ($r == 0) {
                return trim($o['0']);
            } else {
                return $uid;
            }

        } else {
            return $uid;
        }

    }

    public static function getgrgid($file = "")
    {
        if (function_exists('posix_getgrgid')) {
            return posix_getgrgid(filegroup($file));
        } else {
            return [];
        }
    }
    public static function chmod_R($path, $filemode, $dirmode)
    {
        if (is_dir($path)) {
            $fileowner = self::getpwuid($path);
            $filegroup = self::getgrgid($path);
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
                    self::chmod_R($fullpath, $filemode, $dirmode);
                }
            }
            closedir($dh);
        } else {
            if (is_link($path)) {
                // print "link '$path' is skipped\n";
                return;
            }
            if (!chmod($path, $filemode)) {
                $fileowner = self::getpwuid($path);
                $filegroup = self::getgrgid($path);
                $fileperms = mb_substr(sprintf('%o', fileperms($path)), -4);
                $filemode_str = decoct($filemode);
                print sprintf(_MA_TADADM_CHMOD_FAILED, $path, $filemode_str, $fileowner['name'], $filegroup['name'], $fileperms);

                return;
            }
        }
    }

    //下載檔案
    public static function get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh)
    {
        global $inSchoolWeb;

        $TadAmModuleConfig = self::get_adm_config();

        if (!$inSchoolWeb) {
            $file_link = str_replace('[source]', $TadAmModuleConfig['source'], $file_link);
            if ('tad_adm' === $dirname) {
                $new_file = str_replace('http://120.115.2.90/uploads/tad_modules/file/', XOOPS_ROOT_PATH . '/uploads/', $file_link);
            } else {
                $new_file = str_replace($TadAmModuleConfig['source'] . "/uploads/tad_modules/file/", XOOPS_ROOT_PATH . '/uploads/', $file_link);
            }
            Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_adm');
            self::copyemz($file_link, $new_file, $update_sn);

            if (!is_file($new_file)) {
                redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
            }

            if (is_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname")) {
                Utility::delete_directory(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname");
            }

            $zip = new DunZip2($new_file);
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
                self::chmod_R(XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}", 0755, 0755);
                unlink($new_file);
            }
        }

        if (is_dir(XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}")) {
            return true;
        }
        redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_MV_FAIL, XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname"));
    }

    //區塊相關動作
    public static function do_block($act, $update_sn)
    {
        global $xoopsDB;

        $TadAmModuleConfig = self::get_adm_config();
        $ver = (int) str_replace('.', '', substr(XOOPS_VERSION, 6, 5));
        $add_count_url = $TadAmModuleConfig['source'] . "/modules/tad_modules/api.php?update_sn={$update_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=$ver&language={$xoopsConfig['language']}";

        $url = $TadAmModuleConfig['source'] . "/uploads/tad_modules/{$update_sn}.json";
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

    //素材相關動作
    public static function do_other($file_link, $update_sn, $module_sn)
    {
        global $xoopsDB;

        $TadAmModuleConfig = self::get_adm_config();

        $file_link = str_replace('[source]', $TadAmModuleConfig['source'], $file_link);
        $new_file = str_replace($TadAmModuleConfig['source'] . "/uploads/tad_modules/file/", XOOPS_ROOT_PATH . '/uploads/', $file_link);

        Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_adm');
        self::copyemz($file_link, $new_file, $update_sn);

        if (!is_file($new_file)) {
            redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
        }

        if (is_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$module_sn")) {
            Utility::delete_directory(XOOPS_ROOT_PATH . "/uploads/tad_adm/$module_sn");
        }
        Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$module_sn");

        $zip = new DunZip2($new_file);
        $zip->getList();
        $zip->unzipAll(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$module_sn}/");
        $zip->close($new_file);
        if (!is_writable(XOOPS_ROOT_PATH)) {
            $sh = "#!/bin/sh\n";
            $handle = fopen(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$module_sn}/ssh.txt", 'rb');
            if ($handle) {
                while (false !== ($buffer = fgets($handle, 4096))) {
                    $buffer = str_replace('XOOPS_ROOT_PATH', XOOPS_ROOT_PATH, $buffer);
                    $buffer = str_replace('XOOPS_VAR_PATH', XOOPS_VAR_PATH, $buffer);
                    $buffer = str_replace('XOOPS_PATH', XOOPS_PATH, $buffer);
                    $buffer = str_replace('NEW_FILE', $new_file, $buffer);
                    $buffer = str_replace('MODULE_SN', $module_sn, $buffer);
                    $buffer = str_replace("\r", "\n", $buffer);
                    $sh .= $buffer;
                }
                fclose($handle);
            }
        } else {
            $handle = fopen(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$module_sn}/go.txt", 'rb');
            if ($handle) {
                while (false !== ($buffer = fgets($handle, 4096))) {
                    $buffer = str_replace('full_copy', '\XoopsModules\Tadtools\Utility::full_copy', $buffer);
                    $buffer = str_replace('delete_directory', '\XoopsModules\Tadtools\Utility::delete_directory', $buffer);
                    eval($buffer);
                }
                fclose($handle);
            }
        }

        return true;
    }
}
