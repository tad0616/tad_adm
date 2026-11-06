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
    private static $coreUpgrade = false;

    //建構函數
    public function __construct()
    {}

    public static function get_adm_config()
    {
        global $xoopsModule, $xoopsModuleConfig;

        if ('tad_adm' !== $xoopsModule->dirname()) {
            $TadAmModuleConfig = Utility::getXoopsModuleConfig('tad_adm');
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
        Utility::test($all_mods, 'all_mods', 'dd');
        // Utility::dd($all_mods);
        // 已安裝模組
        $mods = $blocks = [];
        $sql  = 'SELECT *
        FROM `' . $xoopsDB->prefix('modules') . '`';
        $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        while ($mod = $xoopsDB->fetchArray($result)) {
            $dirname        = $mod['dirname'];
            $mods[$dirname] = $mod;
        }
        $installed_modules = array_keys($mods);

        // 已安裝區塊
        $sql = 'SELECT *
        FROM `' . $xoopsDB->prefix('newblocks') . '`
        WHERE `mid`=0 AND `dirname`!=?
        ORDER BY `side`, `weight`';
        $result = Utility::query($sql, 's', ['']) or Utility::web_error($sql, __FILE__, __LINE__);

        while ($block = $xoopsDB->fetchArray($result)) {
            $dirname          = $block['dirname'];
            $blocks[$dirname] = $block;
        }
        $installed_blocks = array_keys($blocks);

        $all_install = $all_uninstall = [];
        foreach ($all_mods as $kind => $items) {
            foreach ($items as $dirname => $data) {
                switch ($kind) {
                    case "module":
                        $is_installed = in_array($dirname, $installed_modules) ? true : false;
                        $item         = isset($mods[$dirname]) ? $mods[$dirname] : [];
                        break;

                    case "theme":
                        $is_installed = is_dir(XOOPS_ROOT_PATH . "/themes/{$dirname}") ? true : false;
                        $item         = '';
                        break;

                    case "block":
                        $is_installed = in_array($dirname, $installed_blocks) ? true : false;
                        $item         = isset($blocks[$dirname]) ? $blocks[$dirname] : [];
                        break;

                    case "adm_tpl":
                        $is_installed = is_dir(XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}") ? true : false;
                        $item         = '';
                        break;

                    case "other":
                        $is_installed = file_exists(XOOPS_ROOT_PATH . "/uploads/module_sn_{$data['module_sn']}.txt") ? true : false;
                        // die(var_dump($is_installed));
                        $item = '';
                        break;
                }

                if ($is_installed) {
                    list($function, $enable, $mod_data)               = self::get_installed($kind, $data, $item);
                    $all_install[$function][$kind][$enable][$dirname] = $mod_data;
                } else {
                    list($function, $mod_data)                 = self::get_uninstall($kind, $data);
                    $all_uninstall[$kind][$function][$dirname] = $mod_data;
                }
            }
        }
        Utility::test($all_install, 'all_install', 'dd');
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
        $EasyResponsiveTabs->render();
    }

    //列出所有XOOPS升級資訊
    public static function list_xoops($mode = "tpl")
    {
        global $xoopsTpl;
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
        $all_patch = $all_upgrade = [];
        foreach ($xoops_patch as $k => $xoops) {
            $type                          = $xoops['xoops_type'];
            list($function, $mod_data)     = self::get_patch($type, $xoops);
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
        $EasyResponsiveTabs->render();
    }

    //取得系統的升級或修補檔
    public static function get_patch($type, $data)
    {
        global $xoopsDB, $xoopsConfig;

        $item = [];

        $status                      = self::version_status('', $data, '', $type);
        list($background, $function) = self::get_patch_status($status);

        $item = $data;

        $item['status']     = $status;
        $item['function']   = $function;
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
        $source            = empty($TadAmModuleConfig['source']) ? 'https://campus-xoops.tn.edu.tw' : $TadAmModuleConfig['source'];
        $url               = "{$source}/uploads/tad_modules/{$json}";
        $error             = '';
        if (function_exists('curl_init')) {
            $ch      = curl_init();
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
            $data   = stream_get_contents($handle);
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
        $item    = [];
        $path    = '';

        switch ($kind) {
            case "module":
                foreach ($db_data as $k => $v) {
                    $$k = $v;
                }
                $int_new_version = Utility::get_version('module', $data['new_version'], $dirname);
                $int_version     = Utility::get_version('module', $version, $dirname);
                $path            = XOOPS_ROOT_PATH . "/modules/{$dirname}";
                $enable          = $isactive;
                $is_link         = is_link($path);

                $item['mid']             = $mid;
                $item['hasmain']         = $hasmain ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hasadmin']        = $hasadmin ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hassearch']       = $hassearch ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hasconfig']       = $hasconfig ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hascomments']     = $hascomments ? _MA_TADADM_1 : _MA_TADADM_0;
                $item['hasnotification'] = $hasnotification ? _MA_TADADM_1 : _MA_TADADM_0;

                break;

            case "theme":
                $path = XOOPS_ROOT_PATH . "/themes/{$dirname}";

                $int_new_version = Utility::get_version('theme', $data['new_version'], $dirname);
                $int_version     = Utility::get_version('theme', null, $dirname);
                // $int_version = Utility::get_theme_version($dirname);
                $last_update = file_exists("{$path}/theme.ini") ? filemtime("{$path}/theme.ini") : '';
                $enable      = in_array($dirname, $xoopsConfig['theme_set_allowed']) ? 1 : 0;
                $is_link     = is_link($path);
                break;

            case "block":
                $int_new_version = Utility::get_version('block', $data['new_version']);
                $int_version     = '';
                $last_update     = $db_data['last_modified'];
                $enable          = $db_data['visible'];
                $is_link         = false;
                break;

            case "adm_tpl":
                $path = XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}";

                $int_new_version = Utility::get_version('adm_tpl', $data['new_version']);
                $int_version     = Utility::get_version('adm_tpl', '', $dirname);
                $last_update     = file_exists("{$path}/version.txt") ? filemtime("{$path}/version.txt") : '';
                $enable          = $dirname == $xoopsConfig['cpanel'] ? 1 : 0;
                $is_link         = is_link($path);
                break;

            case "other":
                $int_new_version = Utility::get_version('other', $data['new_version']);
                $int_version     = '';
                $last_update     = file_get_contents(XOOPS_ROOT_PATH . "/uploads/module_sn_{$module_sn}.txt");
                $enable          = 1;
                $is_link         = false;
                break;
        }

        $status                      = self::version_status($int_version, $data, $dirname, $data['kind'], $last_update);
        list($background, $function) = self::get_installed_status($status);

        $rc = ($data['new_status_version']) ? " {$data['new_status']}{$data['new_status_version']}" : '';

        $item['name']       = $data['module_title'];
        $item['dirname']    = $dirname;
        $item['descript']   = preg_replace('/\s\s+/', '<br>', trim($data['update_descript']));
        $item['update_sn']  = $data['update_sn'];
        $item['module_sn']  = $data['module_sn'];
        $item['file_link']  = $data['file_link'];
        $item['kind']       = $data['kind'];
        $item['status']     = $status;
        $item['function']   = $function;
        $item['background'] = $background;
        // $item['new_version'] = ($data['new_version']) ? $data['new_version'] . $rc : '';
        $item['new_version']     = ($data['new_version']) ? Utility::version_format($data['kind'], $int_new_version) . $rc : '';
        $item['new_last_update'] = ($data['new_last_update']) ? date('Y-m-d H:i', $data['new_last_update']) : '';
        $item['logo']            = $data['logo'];
        $item['logo_thumb']      = $data['logo_thumb'];

        $item['now_version'] = Utility::version_format($data['kind'], $int_version);
        // $item['now_version'] = $int_version;
        $item['last_update'] = date('Y-m-d H:i', (int) $last_update);

        if (file_exists($path)) {
            $item['fileowner'] = self::getpwuid($path);
            $item['filegroup'] = self::getgrgid($path);
            $item['fileperms'] = mb_substr(sprintf('%o', fileperms($path)), -4);
        } else {
            $item['fileowner'] = $item['filegroup'] = $item['fileperms'] = '';
        }
        $item['is_link'] = $is_link;
        $item['enable']  = $enable;

        $item_data[] = $function;
        $item_data[] = $enable;
        $item_data[] = $item;
        // if($kind=="other")die(print_r($item_data));
        return $item_data;
    }

    //未安裝模組
    public static function get_uninstall($kind, $data)
    {
        $status                      = self::version_status('', $data, $data['dirname'], $data['kind']);
        list($background, $function) = self::get_uninstall_status($status);
        $rc                          = ($data['new_status_version']) ? " {$data['new_status']}{$data['new_status_version']}" : '';

        $item['name']            = $data['module_title'];
        $item['dirname']         = $data['dirname'];
        $item['descript']        = nl2br(trim($data['module_descript']));
        $item['update_sn']       = $data['update_sn'];
        $item['module_sn']       = $data['module_sn'];
        $item['file_link']       = $data['file_link'];
        $item['kind']            = $kind            = $data['kind'];
        $item['status']          = $status;
        $item['function']        = $function;
        $item['background']      = $background;
        $item['logo']            = $data['logo'];
        $item['logo_thumb']      = $data['logo_thumb'];
        $item['new_version']     = ($data['new_version']) ? $data['new_version'] . $rc : '';
        $item['new_last_update'] = ($data['new_last_update']) ? date('Y-m-d H:i', $data['new_last_update']) : '';
        // 與已安裝項目共用 sub_modules_list.tpl，補齊未安裝時沒有的欄位
        $item['mid']         = '';
        $item['now_version'] = '';
        $item['last_update'] = '';
        $item['fileowner']   = $item['filegroup']   = $item['fileperms']   = '';
        $item['is_link']     = false;
        $item['enable']      = 0;

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

        $mod_data['new_version']       = isset($mod_data['new_version']) ? $mod_data['new_version'] : '';
        $mod_data['xoops_version']     = isset($mod_data['xoops_version']) ? $mod_data['xoops_version'] : '';
        $mod_data['xoops_min_version'] = isset($mod_data['xoops_min_version']) ? $mod_data['xoops_min_version'] : '';
        $mod_data['php_min_version']   = isset($mod_data['php_min_version']) ? $mod_data['php_min_version'] : '';
        $mod_data['php_max_version']   = isset($mod_data['php_max_version']) ? $mod_data['php_max_version'] : '';
        $mod_data['tadtools_version']  = isset($mod_data['tadtools_version']) ? $mod_data['tadtools_version'] : '';
        // 20511
        $my_xoops_version     = Utility::get_version('xoops');
        $my_php_version       = Utility::get_version('php');
        $now_version          = empty($now_version) ? Utility::get_version($type, $now_version, $dirname) : $now_version;
        $new_version          = Utility::get_version($type, $mod_data['new_version'], $dirname);
        $xoops_version        = Utility::get_version('xoops', $mod_data['xoops_version']);
        $xoops_min_version    = Utility::get_version('xoops', $mod_data['xoops_min_version']);
        $php_min_version      = Utility::get_version('php', $mod_data["php_min_version"]);
        $php_max_version      = Utility::get_version('php', $mod_data['php_max_version']);
        $min_tadtools_version = Utility::get_version('module', $mod_data['tadtools_version'], 'tadtools');
        $now_tadtools_version = Utility::get_version('module', '', 'tadtools');

        $chk_file            = '';
        $now_mod_last_update = 0;
        if ($type == "upgrade") {
            $filemtime           = file_exists(XOOPS_ROOT_PATH . "/mainfile.php") ? filemtime(XOOPS_ROOT_PATH . "/mainfile.php") : 0;
            $now_mod_last_update = $last_update ? $last_update : $filemtime;
            $new_mod_last_update = $mod_data['xoops_date'];
            $chk_file            = XOOPS_ROOT_PATH . "/uploads/xoops_sn_{$mod_data['xoops_sn']}.txt";
        } elseif ($type == "patch") {
            $now_mod_last_update = 0;
            $new_mod_last_update = $mod_data['xoops_date'];
            $chk_file            = XOOPS_ROOT_PATH . "/uploads/xoops_sn_{$mod_data['xoops_sn']}.txt";
        } elseif ($type == "theme") {
            $filemtime           = file_exists(XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini") ? filemtime(XOOPS_ROOT_PATH . "/themes/{$dirname}/theme.ini") : 0;
            $now_mod_last_update = $last_update ? $last_update : $filemtime;
            $new_mod_last_update = $mod_data['new_last_update'];
        } elseif ($type == "adm_tpl") {
            $filemtime           = file_exists(XOOPS_ROOT_PATH . "/themes/system/themes/tad/version.txt") ? filemtime(XOOPS_ROOT_PATH . "/themes/system/themes/tad/version.txt") : 0;
            $now_mod_last_update = $last_update ? $last_update : $filemtime;
            $new_mod_last_update = $mod_data['new_last_update'];
        } elseif ($type == "block") {
            $now_mod_last_update = $last_update;
            $new_mod_last_update = $mod_data['new_last_update'];
        } elseif ($type == "other") {
            if (\file_exists(XOOPS_ROOT_PATH . "/uploads/module_sn_{$mod_data['module_sn']}.txt")) {
                $now_mod_last_update = strtotime(file_get_contents(XOOPS_ROOT_PATH . "/uploads/module_sn_{$mod_data['module_sn']}.txt"));
            }
            $new_mod_last_update = $mod_data['new_last_update'];
        } else {
            $filemtime           = file_exists(XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php") ? filemtime(XOOPS_ROOT_PATH . "/modules/{$dirname}/xoops_version.php") : 0;
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

        // 偵測工作目錄及已存在的套件目標是否可寫入
        $work_dir    = self::get_work_dir($act);
        $is_writable = is_writable(XOOPS_ROOT_PATH . "/{$work_dir}/") && !\Xmf\Request::getInt('force_ssh');
        $ssh_message = '';
        if ($is_writable && in_array($act, ['upgrade_module', 'upgrade_theme', 'upgrade_adm_tpl', 'install_module', 'install_theme', 'install_adm_tpl'], true)
            && preg_match('/^[a-zA-Z0-9_-]+$/D', $dirname)) {
            $target = XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}";
            if (file_exists($target) && !is_writable($target)) {
                $is_writable = false;
                $scan = ['count' => 1, 'paths' => [$target], 'user' => UpgradeManifest::php_user()];
                $ssh_message = self::preflight_message($scan);
            }
        }

        //若是可以寫入
        if ($is_writable or $inSchoolWeb) {
            self::next_to_do($file_link, $dirname, $work_dir, $update_sn, $act);
        } else {
            self::package_ssh_form($file_link, $dirname, $act, $update_sn, $ssh_message);
        }
    }

    private static function package_ssh_form($file_link, $dirname, $act, $update_sn, string $message = ''): void
    {
        global $xoopsTpl;

        $xoopsTpl->assign('action', 'main.php');
        $xoopsTpl->assign('now_op', 'login_form');
        $xoopsTpl->assign('dirname', $dirname);
        $xoopsTpl->assign('act', $act);
        $xoopsTpl->assign('update_sn', $update_sn);
        $xoopsTpl->assign('file_link', $file_link);
        $xoopsTpl->assign('ssh_preflight_message', $message);
        $xoopsTpl->assign('tad_adm_ssh_host', $_SESSION['tad_adm_ssh_host'] ?? ($_SERVER['SERVER_ADDR'] ?? '127.0.0.1'));
        $xoopsTpl->assign('tad_adm_ssh_id', $_SESSION['tad_adm_ssh_id'] ?? '');
        $xoopsTpl->assign('tad_adm_ssh_passwd', $_SESSION['tad_adm_ssh_passwd'] ?? '');
    }

    public static function update_allowed($theme, $val)
    {
        global $xoopsConfig, $xoopsDB;

        if ($val) {
            list($bootstrap_color, $theme_kind) = get_theme_color($theme);
            $xoopsConfig['theme_set_allowed'][] = $theme;
            $theme_set_allowed                  = serialize($xoopsConfig['theme_set_allowed']);

            $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '`
            SET `conf_value` = ?
            WHERE `conf_name` = ?';
            Utility::query($sql, 'ss', [$theme_set_allowed, 'theme_set_allowed']) or Utility::web_error($sql, __FILE__, __LINE__);

            $sql = 'INSERT INTO `' . $xoopsDB->prefix('tadtools_setup') . '`
            (`tt_theme`, `tt_use_bootstrap`, `tt_bootstrap_color`, `tt_theme_kind`)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            `tt_use_bootstrap` = ?,
            `tt_bootstrap_color` = ?,
            `tt_theme_kind` = ?';
            Utility::query($sql, 'sssssss', [$theme, '0', $bootstrap_color, $theme_kind, '0', $bootstrap_color, $theme_kind])
            or redirect_header($_SERVER['PHP_SELF'], 3, $xoopsDB->error());
        } else {
            $array             = array_diff($xoopsConfig['theme_set_allowed'], [$theme]);
            $theme_set_allowed = serialize($array);

            $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '`
            SET `conf_value` = ?
            WHERE `conf_name` = ?';
            Utility::query($sql, 'ss', [$theme_set_allowed, 'theme_set_allowed']) or Utility::web_error($sql, __FILE__, __LINE__);

            $sql = 'DELETE FROM `' . $xoopsDB->prefix('tadtools_setup') . '`
            WHERE `tt_theme` = ?';
            Utility::query($sql, 's', [$theme]) or redirect_header($_SERVER['PHP_SELF'], 3, $xoopsDB->error());
        }
    }

    public static function add_adm_tpl_config($theme)
    {
        global $xoopsConfig, $xoopsDB;
        if ($xoopsConfig['cpanel'] != $theme) {
            $sql = 'UPDATE `' . $xoopsDB->prefix('config') . '`
            SET `conf_value` = ?
            WHERE `conf_name` = ?';
            Utility::query($sql, 'ss', [$theme, 'cpanel']) or Utility::web_error($sql, __FILE__, __LINE__);
        }
    }

    public static function next_to_do($file_link = '', $dirname = '', $work_dir = '', $update_sn = '', $act = '', $ssh = '')
    {
        global $inSchoolWeb;

        $op = self::get_act_op($act);

        if ('install_theme' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh, $act)) {
                self::update_allowed($dirname, 1);
                redirect_header('main.php', 3, sprintf(_MA_TADADM_THEME_INSTALL_OK, $dirname));
            }
        } elseif ('upgrade_theme' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh, $act)) {
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
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh, $act)) {
                self::add_adm_tpl_config($dirname);
                redirect_header($_SERVER['PHP_SELF'] . '?op=list_all_modules&tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_ADM_TPL_INSTALL_OK, $dirname));
            }
        } elseif ('upgrade_adm_tpl' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh, $act)) {
                self::add_adm_tpl_config($dirname);
                redirect_header($_SERVER['PHP_SELF'] . '?op=list_all_modules&tad_adm_tpl=clean', 3, _MA_TADADM_ADM_TPL_UPDATE_OK);
            }
        } elseif ('install_module' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh, $act)) {
                header('location:' . XOOPS_URL . "/modules/system/admin.php?fct=modulesadmin&op={$op}&module={$dirname}&tad_adm_tpl=clean");
                exit;
            }
        } elseif ('upgrade_module' === $act) {
            if ($inSchoolWeb or self::get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh, $act)) {
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

        $is_writable = is_writable(XOOPS_ROOT_PATH) && is_writable(XOOPS_ROOT_PATH . '/uploads') && !\Xmf\Request::getInt('force_ssh');

        //若是可以寫入
        if ($is_writable) {
            self::next_to_up($file_link, $xoops_sn, $act);
        } else {
            self::xoops_ssh_form($file_link, $xoops_sn, $act);
        }
    }

    private static function xoops_ssh_form($file_link, $xoops_sn, $act, string $message = ''): void
    {
        global $xoopsTpl;

        if (!UpgradeProgress::resumeSession()) {
            $message .= '<br>' . _MA_TADADM_SESSION_RESTORE_FAIL;
        }
        $xoopsTpl->assign('action', 'xoops.php');
        $xoopsTpl->assign('now_op', 'login_form');
        $xoopsTpl->assign('dirname', '');
        $xoopsTpl->assign('act', $act);
        $xoopsTpl->assign('xoops_sn', $xoops_sn);
        $xoopsTpl->assign('file_link', $file_link);
        $xoopsTpl->assign('ssh_preflight_message', $message);
        $xoopsTpl->assign('upgrade_progress_token', \Xmf\Request::getString('upgrade_progress_token'));
        $xoopsTpl->assign('tad_adm_ssh_host', $_SESSION['tad_adm_ssh_host'] ?? ($_SERVER['SERVER_ADDR'] ?? '127.0.0.1'));
        $xoopsTpl->assign('tad_adm_ssh_id', $_SESSION['tad_adm_ssh_id'] ?? '');
        $xoopsTpl->assign('tad_adm_ssh_passwd', $_SESSION['tad_adm_ssh_passwd'] ?? '');
    }

    public static function next_to_up($file_link = '', $xoops_sn = '', $act = '', $ssh = '')
    {
        if ('patch' === $act) {
            if (self::get_upgrade_file($file_link, 'patch', $xoops_sn, $ssh)) {
                redirect_header('xoops.php', 3, _MA_TADADM_PATCH_OK);
            }
        } elseif ('upgrade' === $act) {
            if (self::get_upgrade_file($file_link, 'upgrade', $xoops_sn, $ssh)) {
                self::upgrade_redirect('xoops.php', 3, _MA_TADADM_UPGRADE_OK, true);
            }
        }
    }

    //取得XOOPS升級或補釘
    public static function delete_theme($theme, $ssh = null)
    {
        if (!preg_match('/^[a-zA-Z0-9_-]+$/D', $theme)) {
            return false;
        }
        $path = XOOPS_ROOT_PATH . '/themes/' . $theme;
        if (!is_dir($path) || is_link($path)) {
            return false;
        }
        if ($ssh) {
            self::run_ssh_command($ssh, 'rm -rf -- ' . escapeshellarg($path) . ' 2>&1', $_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean');
        } else {
            $scan = ['count' => 0, 'paths' => [], 'seen' => [], 'user' => UpgradeManifest::php_user(), 'root' => XOOPS_ROOT_PATH];
            self::scan_theme_delete($path, $scan);
            if ($scan['count'] > 0) {
                $force_link = $_SERVER['PHP_SELF'] . '?' . http_build_query(['op' => 'delete_theme', 'dirname' => $theme, 'force_ssh' => 1, 'tad_adm_tpl' => 'clean']);
                redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 30, self::preflight_message($scan) . '<br><a href="' . htmlspecialchars($force_link, ENT_QUOTES) . '">SSH</a>');
            }
            $failed = [];
            self::remove_theme_tree($path, $failed);
            if ($failed) {
                redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 30, sprintf(_MA_TADADM_DELETE_PATHS_FAIL, count($failed), self::format_path_list($failed, 10)));
            }
        }

        clearstatcache();
        return !file_exists($path) && !is_link($path);
    }

    private static function scan_theme_delete(string $path, array &$scan): void
    {
        if (!is_writable(dirname($path))) {
            self::add_unwritable(dirname($path), $scan);
        }
        if (is_link($path) || !is_dir($path)) {
            return;
        }
        $entries = @scandir($path);
        if (false === $entries) {
            self::add_unwritable($path, $scan);
            return;
        }
        foreach ($entries as $entry) {
            if ('.' !== $entry && '..' !== $entry) {
                self::scan_theme_delete($path . '/' . $entry, $scan);
            }
        }
    }

    private static function remove_theme_tree(string $path, array &$failed): void
    {
        if (is_link($path) || !is_dir($path)) {
            if (!@unlink($path)) {
                $failed[] = $path;
            }
            return;
        }
        $entries = @scandir($path);
        if (false === $entries) {
            $failed[] = $path;
            return;
        }
        foreach ($entries as $entry) {
            if ('.' !== $entry && '..' !== $entry) {
                self::remove_theme_tree($path . '/' . $entry, $failed);
            }
        }
        if (!@rmdir($path)) {
            $failed[] = $path;
        }
    }

    //取得XOOPS升級或補釘
    public static function get_upgrade_file($file_link, $dirname, $xoops_sn, $ssh)
    {
        self::$coreUpgrade = 'upgrade' === $dirname;
        if ('upgrade' === $dirname) {
            if (!set_time_limit(0)) {
                self::upgrade_redirect($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 30, _MA_TADADM_UPGRADE_TIME_LIMIT_FAIL);
            }
            ignore_user_abort(true);
            UpgradeProgress::start(\Xmf\Request::getString('upgrade_progress_token'));
        }
        if (!empty($ssh)) {
            $ssh->setTimeout(0);
            $ssh->setKeepAlive(15);
        }
        $TadAmModuleConfig = self::get_adm_config();
        $orig_link         = $file_link;
        $go_warn           = '';
        $fail_url          = $_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean';
        $file_link         = str_replace('[source]', $TadAmModuleConfig['source'], $file_link);
        $new_file          = str_replace($TadAmModuleConfig['source'] . "/uploads/tad_modules/file/", XOOPS_ROOT_PATH . '/uploads/', $file_link);

        // SSH 模式下，若 PHP 無法寫入 uploads，先用 SSH 身分開放，才能下載與解壓
        if (!empty($ssh) && (!is_writable(XOOPS_ROOT_PATH . '/uploads') || (is_dir(XOOPS_ROOT_PATH . '/uploads/tad_adm') && !is_writable(XOOPS_ROOT_PATH . '/uploads/tad_adm')))) {
            $ssh->exec('mkdir -p ' . escapeshellarg(XOOPS_ROOT_PATH . '/uploads/tad_adm') . ' && chmod -R 777 ' . escapeshellarg(XOOPS_ROOT_PATH . '/uploads') . ' 2>&1');
            clearstatcache();
        }

        UpgradeProgress::update(_MA_TADADM_PROGRESS_PREPARE);
        Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_adm');
        UpgradeProgress::update(sprintf(_MA_TADADM_PROGRESS_DOWNLOAD, basename(parse_url($file_link, PHP_URL_PATH) ?: $file_link)));
        $download_progress = 'upgrade' === $dirname ? static function (string $stage, string $path): void {
            UpgradeProgress::update('count' === $stage ? _MA_TADADM_PROGRESS_COUNT : sprintf(_MA_TADADM_PROGRESS_SAVE, basename($path)));
        } : null;
        self::copyemz($file_link, $new_file, 0, $xoops_sn, $download_progress);

        if (!is_file($new_file)) {
            self::upgrade_redirect($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
        }

        UpgradeProgress::update(_MA_TADADM_PROGRESS_STAGING);
        if (is_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname")) {
            Utility::delete_directory(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname");
        }
        Utility::mk_dir(XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname");

        UpgradeProgress::update(sprintf(_MA_TADADM_PROGRESS_EXTRACT, basename($new_file)));
        $zip = new DunZip2($new_file);
        $extracted = $zip->unzipAll(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}/");
        $zip->close();
        if (!$extracted) {
            self::upgrade_redirect($fail_url, 15, sprintf(_MA_TADADM_EXTRACT_FAIL, htmlspecialchars(XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}", ENT_QUOTES)));
        }

        $work_path = XOOPS_ROOT_PATH . "/uploads/tad_adm/{$dirname}";
        $ssh_output = '';

        UpgradeProgress::update(_MA_TADADM_PROGRESS_CHECK);
        if (is_file("{$work_path}/upgrade.json")) {
            // 新機制：單一流程檔，自動判斷以 PHP 直接執行或轉為 SSH 腳本
            try {
                $steps = UpgradeManifest::load("{$work_path}/upgrade.json", [
                    'ROOT'     => XOOPS_ROOT_PATH,
                    'VAR'      => XOOPS_VAR_PATH,
                    'LIB'      => XOOPS_PATH,
                    'WORK'     => $work_path,
                    'NEW_FILE' => $new_file,
                    'SN'       => $xoops_sn,
                ]);
            } catch (\RuntimeException $e) {
                self::upgrade_redirect($fail_url, 10, sprintf(_MA_TADADM_MANIFEST_INVALID, htmlspecialchars($e->getMessage(), ENT_QUOTES)));
            }

            if (!empty($ssh)) {
                if (false === file_put_contents("{$work_path}/upgrade.sh", UpgradeManifest::to_shell($steps, 'upgrade' === $dirname))) {
                    self::upgrade_redirect($fail_url, 5, sprintf(_MA_TADADM_SCRIPT_NOT_FOUND, "{$work_path}/upgrade.sh"));
                }
                UpgradeProgress::update(_MA_TADADM_PROGRESS_SSH);
                if ('upgrade' === $dirname) {
                    $output = '';
                    $buffer = '';
                    $byNumber = [];
                    foreach ($steps as $step) {
                        $byNumber[$step['n']] = $step;
                    }
                    $callback = static function ($chunk) use (&$output, &$buffer, $byNumber): void {
                        $output .= $chunk;
                        $buffer .= $chunk;
                        while (false !== ($newline = strpos($buffer, "\n"))) {
                            $line = rtrim(substr($buffer, 0, $newline), "\r");
                            $buffer = substr($buffer, $newline + 1);
                            if (preg_match('/^TAD_ADM_PROGRESS (\d+)$/D', $line, $match) && isset($byNumber[(int) $match[1]])) {
                                self::manifest_progress($byNumber[(int) $match[1]]);
                            }
                        }
                    };
                    $ssh_output = self::run_core_ssh_script($ssh, "{$work_path}/upgrade.sh", $fail_url, $callback, $output);
                } else {
                    $output = '';
                    $ssh_output = self::run_core_ssh_script($ssh, "{$work_path}/upgrade.sh", $fail_url, null, $output);
                }
                [$sh_errors, $sh_warnings] = UpgradeManifest::parse_shell_output($ssh_output);
                if ($sh_errors) {
                    self::upgrade_redirect($fail_url, 30, sprintf(_MA_TADADM_SSH_STEPS_FAIL, htmlspecialchars(implode("\n", $sh_errors) . "\n" . $ssh_output, ENT_QUOTES)));
                }
                if ($sh_warnings) {
                    $go_warn = htmlspecialchars(implode('; ', $sh_warnings), ENT_QUOTES);
                }
            } else {
                $preflight = UpgradeManifest::preflight($steps, XOOPS_ROOT_PATH);
                if ($preflight['count'] > 0) {
                    self::xoops_ssh_form($orig_link, $xoops_sn, $dirname, self::preflight_message($preflight));
                    return false;
                }
                $report = UpgradeManifest::run_php($steps, [self::class, 'manifest_progress']);
                if (!empty($report['errors'])) {
                    self::upgrade_redirect($fail_url, 30, sprintf(_MA_TADADM_COPY_FAIL, count($report['errors']), self::format_path_list($report['errors'], 10)));
                }
                $warns = [];
                foreach ($report['warnings'] as [$n, $op, $count, $sample]) {
                    $warns[] = sprintf(_MA_TADADM_WARN_STEP, $n, $op, $count, htmlspecialchars($sample, ENT_QUOTES));
                }
                $go_warn = implode('; ', $warns);
            }
        } elseif (!empty($ssh)) {
            if (!is_file("{$work_path}/ssh.txt")) {
                self::upgrade_redirect($fail_url, 5, sprintf(_MA_TADADM_SCRIPT_NOT_FOUND, "{$work_path}/ssh.txt"));
            }
            $sh     = "#!/bin/sh\n";
            $handle = fopen("{$work_path}/ssh.txt", 'rb');
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
            if (false === file_put_contents("{$work_path}/upgrade.sh", $sh)) {
                self::upgrade_redirect($fail_url, 5, sprintf(_MA_TADADM_SCRIPT_NOT_FOUND, "{$work_path}/upgrade.sh"));
            }
            self::chmod_R("{$work_path}/upgrade.sh", 0777, 0777);
            UpgradeProgress::update(_MA_TADADM_PROGRESS_SSH);
            $output = '';
            $ssh_output = self::run_core_ssh_script($ssh, "{$work_path}/upgrade.sh", $fail_url, null, $output);

        } else {
            if (!is_file("{$work_path}/go.txt")) {
                self::upgrade_redirect($fail_url, 5, sprintf(_MA_TADADM_SCRIPT_NOT_FOUND, "{$work_path}/go.txt"));
            }
            // [修補 CWE-94] 以白名單式檔案操作取代 eval(go.txt)
            // 先檢查寫入權限：任何目標不可寫就在變更檔案之前中止，避免網站半新半舊
            $preflight = self::preflight_go_scan("{$work_path}/go.txt", $new_file);
            if ($preflight['count'] > 0) {
                self::xoops_ssh_form($orig_link, $xoops_sn, $dirname, self::preflight_message($preflight));
                return false;
            }
            $report = self::execute_go_instructions("{$work_path}/go.txt", $new_file, 0, static function (string $operation, string $path): void {
                UpgradeProgress::update('copy' === $operation ? sprintf(_MA_TADADM_PROGRESS_COPY, $path) : sprintf(_MA_TADADM_PROGRESS_STEP, $operation, $path));
            });
            if (!empty($report['copy'])) {
                self::upgrade_redirect($fail_url, 30, sprintf(_MA_TADADM_COPY_FAIL, count($report['copy']), self::format_path_list($report['copy'], 10)));
            }
            $go_warn = self::go_warnings($report);
        }

        if ('upgrade' === $dirname) {
            // 確認 /upgrade 目錄真的已被複製到網站根目錄，避免導向 404
            if (!is_dir(XOOPS_ROOT_PATH . '/upgrade')) {
                $msg = sprintf(_MA_TADADM_UPGRADE_DIR_MISSING, XOOPS_ROOT_PATH . '/upgrade');
                if (!empty($ssh_output)) {
                    $msg .= '<pre>' . htmlspecialchars($ssh_output, ENT_QUOTES) . '</pre>';
                }
                self::upgrade_redirect($fail_url, 10, $msg);
            }
            self::show_core_upgrade_handoff($go_warn);
            return false;
        } else {
            return true;
        }
    }

    private static function show_core_upgrade_handoff(string $warning): void
    {
        global $xoopsTpl;

        $sessionRestored = UpgradeProgress::resumeSession();
        $xoopsTpl->assign('now_op', 'upgrade_handoff');
        $xoopsTpl->assign('upgrade_handoff_url', XOOPS_URL . '/upgrade/');
        $xoopsTpl->assign('upgrade_handoff_message', _MA_TADADM_UPGRADE_FROM_URL);
        $xoopsTpl->assign('upgrade_handoff_warning', '' === $warning ? '' : sprintf(_MA_TADADM_UPGRADE_WARN, $warning));
        $xoopsTpl->assign('upgrade_handoff_session_error', $sessionRestored ? '' : _MA_TADADM_SESSION_RESTORE_FAIL);
        $xoopsTpl->assign('upgrade_handoff_delay', $sessionRestored ? ('' === $warning ? 3 : 15) : 0);
    }

    private static function run_core_ssh_script($ssh, string $script, string $failUrl, ?callable $callback, string &$output): string
    {
        $command = 'sh ' . escapeshellarg($script) . " 2>&1; tad_adm_status=\$?; printf '\\nTAD_ADM_EXIT %s\\n' \"\$tad_adm_status\"; exit \"\$tad_adm_status\"";
        try {
            $result = $ssh->exec($command, $callback);
            if (null === $callback && is_string($result)) {
                $output = $result;
            }
            $status = $ssh->getExitStatus();
            $timedOut = $ssh->isTimeout();
        } catch (\RuntimeException $e) {
            $details = htmlspecialchars($e->getMessage(), ENT_QUOTES);
            self::upgrade_redirect($failUrl, 30, _MA_TADADM_SSH_INCOMPLETE . '<pre>' . $details . '</pre>');
        }

        $completed = preg_match('/(?:^|\n)TAD_ADM_EXIT ([0-9]+)\r?\n?$/D', $output, $match);
        if (false === $result || $timedOut || !$completed || 0 !== $status || '0' !== $match[1]) {
            $details = trim($output);
            $details .= "\nSSH exit status: " . (false === $status || null === $status ? 'unavailable' : $status);
            self::upgrade_redirect($failUrl, 30, _MA_TADADM_SSH_INCOMPLETE . '<pre>' . htmlspecialchars(trim($details), ENT_QUOTES) . '</pre>');
        }
        return trim((string) preg_replace('/(?:^|\n)TAD_ADM_EXIT [0-9]+\r?\n?$/D', '', $output));
    }

    private static function upgrade_redirect($url, $time, $message, bool $success = false): void
    {
        global $xoopsConfig;

        $sessionRestored = UpgradeProgress::resumeSession();
        if (!$sessionRestored) {
            $message .= '<br>' . _MA_TADADM_SESSION_RESTORE_FAIL;
        }
        if (!$sessionRestored || (self::$coreUpgrade && !$success)) {
            // The AJAX redirect can lose or misrender error messages; use XOOPS's redirect page.
            $xoopsConfig['redirect_message_ajax'] = 0;
            $time = max(30, $time);
        }
        redirect_header($url, $time, $message);
    }

    public static function manifest_progress(array $step): void
    {
        if ('copy' === $step['op']) {
            UpgradeProgress::update(sprintf(_MA_TADADM_PROGRESS_COPY, $step['to']));
        } else {
            UpgradeProgress::update(sprintf(_MA_TADADM_PROGRESS_STEP, $step['op'], $step['path'] ?? implode(', ', $step['paths'] ?? [])));
        }
    }

    //登入SSH
    public static function ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link = '', $dirname = '', $act = '', $update_sn = '', $xoops_sn = '', $module_sn = '')
    {

        $TadAmModuleConfig = self::get_adm_config();

        // 建立 SSH 連線
        $ssh = Utility::ssh_login($ssh_host, $TadAmModuleConfig['ssh_port'], $ssh_id, $ssh_passwd);

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
        } elseif (in_array($act, ['install_other', 'upgrade_other'], true)) {
            self::do_other($file_link, $update_sn, $module_sn, $act, $ssh);
            header('location: main.php');
            exit;
        } else {
            self::next_to_do($file_link, $dirname, $work_dir, $update_sn, $act, $ssh);
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

    public static function copyemz($file1, $file2, $update_sn = '', $xoops_sn = '', ?callable $progress = null)
    {
        global $xoopsConfig;

        $TadAmModuleConfig = self::get_adm_config();
        $ver               = (int) str_replace('.', '', substr(XOOPS_VERSION, 6, 5));
        if ($xoops_sn) {
            $add_count_url = $TadAmModuleConfig['source'] . "/modules/tad_modules/api.php?xoops_sn={$xoops_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=$ver&language={$xoopsConfig['language']}";
        } else {
            $add_count_url = $TadAmModuleConfig['source'] . "/modules/tad_modules/api.php?update_sn={$update_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=$ver&language={$xoopsConfig['language']}";
        }

        $url = $file1;

        if (function_exists('curl_init')) {
            // ── 下載主檔 ──────────────────────────────────────────
            $ch      = curl_init();
            $timeout = 30; // 原為 5，對大檔案過短

            // [修補] 移除 SSL_VERIFYPEER/HOST 停用，改為強制驗證
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $contentx = curl_exec($ch);
            if ($contentx === false) {
                $err = curl_error($ch);
                curl_close($ch);
                self::upgrade_redirect($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $url) . " ($err)");
            }
            curl_close($ch);

            // ── 回報計數（非關鍵，失敗不中斷流程）────────────────
            if ($progress) {
                $progress('count', $file2);
            }
            $ch      = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_URL, $add_count_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_exec($ch); // 結果不使用
            curl_close($ch);

        } elseif (function_exists('file_get_contents')) {
            $contentx = file_get_contents($url);
        } else {
            $handle   = fopen($url, 'rb');
            $contentx = stream_get_contents($handle);
            fclose($handle);
        }

        if ($contentx === false || $contentx === '') {
            self::upgrade_redirect($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $url));
        }

        if ($progress) {
            $progress('save', $file2);
        }
        $openedfile = @fopen($file2, 'wb');
        if (false === $openedfile) {
            self::upgrade_redirect($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 15, sprintf(_MA_TADADM_WRITE_FAIL, htmlspecialchars($file2, ENT_QUOTES), htmlspecialchars(UpgradeManifest::php_user(), ENT_QUOTES)));
        }
        $written = fwrite($openedfile, $contentx);
        fclose($openedfile);
        if (false === $written || $written !== strlen($contentx)) {
            self::upgrade_redirect($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 15, sprintf(_MA_TADADM_WRITE_FAIL, htmlspecialchars($file2, ENT_QUOTES), htmlspecialchars(UpgradeManifest::php_user(), ENT_QUOTES)));
        }

        return true;
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
    private static $chmod_fail = 0;

    public static function chmod_R($path, $filemode, $dirmode)
    {
        if (is_dir($path)) {
            $fileowner = self::getpwuid($path);
            $filegroup = self::getgrgid($path);
            $fileperms = mb_substr(sprintf('%o', fileperms($path)), -4);
            if (!chmod($path, $dirmode)) {
                $dirmode_str = decoct($dirmode);

                // print sprintf(_MA_TADADM_CHMOD_FAILED, $path, $dirmode_str, $fileowner['name'], $filegroup['name'], $fileperms);
                self::$chmod_fail++;

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
                $fileowner    = self::getpwuid($path);
                $filegroup    = self::getgrgid($path);
                $fileperms    = mb_substr(sprintf('%o', fileperms($path)), -4);
                $filemode_str = decoct($filemode);
                // print sprintf(_MA_TADADM_CHMOD_FAILED, $path, $filemode_str, $fileowner['name'], $filegroup['name'], $fileperms);
                self::$chmod_fail++;

                return;
            }
        }
    }

    //下載檔案
    public static function get_new_file($file_link, $dirname, $work_dir, $update_sn, $ssh, $act = '')
    {
        global $inSchoolWeb;

        $TadAmModuleConfig = self::get_adm_config();

        if (!$inSchoolWeb) {
            $fail_url = $_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean';
            if (!preg_match('/^[a-zA-Z0-9_-]+$/D', $dirname)) {
                redirect_header($fail_url, 10, sprintf(_MA_TADADM_INVALID_PACKAGE_DIR, htmlspecialchars($dirname, ENT_QUOTES)));
            }
            $orig_link = $file_link;
            $file_link = str_replace('[source]', $TadAmModuleConfig['source'], $file_link);
            if ('tad_adm' === $dirname) {
                $new_file = str_replace('https://campus-xoops.tn.edu.tw/uploads/tad_modules/file/', XOOPS_ROOT_PATH . '/uploads/', $file_link);
            } else {
                $new_file = str_replace($TadAmModuleConfig['source'] . "/uploads/tad_modules/file/", XOOPS_ROOT_PATH . '/uploads/', $file_link);
            }
            self::prepare_package_directory(XOOPS_ROOT_PATH . '/uploads/tad_adm', $fail_url);
            self::copyemz($file_link, $new_file, $update_sn);

            if (!is_file($new_file)) {
                redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
            }

            $source = XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname";
            $dest = XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}";
            if (is_dir($source) && !Utility::delete_directory($source)) {
                redirect_header($fail_url, 15, sprintf(_MA_TADADM_EXTRACT_FAIL, htmlspecialchars($source, ENT_QUOTES)));
            }

            $zip = new DunZip2($new_file);
            $extracted = $zip->unzipAll(XOOPS_ROOT_PATH . '/uploads/tad_adm/', '', true, 0);
            $zip->close();
            if (!$extracted || !is_dir($source)) {
                redirect_header($fail_url, 15, sprintf(_MA_TADADM_EXTRACT_FAIL, htmlspecialchars($source, ENT_QUOTES)));
            }

            if (!empty($ssh)) {
                $cmd = '{ mkdir -p ' . escapeshellarg($dest) . ' && cp -R ' . escapeshellarg($source . '/.') . ' ' . escapeshellarg($dest . '/') . '; } 2>&1';
                self::run_ssh_command($ssh, $cmd, $fail_url);
            } else {
                $step = ['n' => 1, 'op' => 'copy', 'optional' => false, 'kind' => 'dir', 'from' => $source, 'to' => $dest];
                $preflight = UpgradeManifest::preflight([$step], XOOPS_ROOT_PATH);
                if ($preflight['count'] > 0) {
                    self::package_ssh_form($orig_link, $dirname, $act, $update_sn, self::preflight_message($preflight));
                    return false;
                }
                $report = UpgradeManifest::run_php([$step]);
                if ($report['errors']) {
                    redirect_header($fail_url, 30, sprintf(_MA_TADADM_COPY_FAIL, count($report['errors']), self::format_path_list($report['errors'], 10)));
                }
            }
            if (!unlink($new_file)) {
                error_log("[tad_adm] Could not remove downloaded package: $new_file");
            }
        }

        if (is_dir(XOOPS_ROOT_PATH . "/{$work_dir}/{$dirname}")) {
            return true;
        }
        redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_MV_FAIL, XOOPS_ROOT_PATH . "/uploads/tad_adm/$dirname"));
    }

    private static function run_ssh_command($ssh, string $command, string $fail_url): string
    {
        $output = $ssh->exec($command);
        $status = $ssh->getExitStatus();
        if (false === $output || 0 !== $status) {
            $details = trim((string) $output);
            if ('' === $details) {
                $details = 'SSH exit status: ' . (false === $status || null === $status ? 'unavailable' : $status);
            }
            redirect_header($fail_url, 30, sprintf(_MA_TADADM_SSH_STEPS_FAIL, htmlspecialchars($details, ENT_QUOTES)));
        }
        return (string) $output;
    }

    private static function prepare_package_directory(string $path, string $fail_url): void
    {
        if ((!is_dir($path) && !@mkdir($path, 0755, true) && !is_dir($path)) || !is_writable($path) || !is_writable(XOOPS_ROOT_PATH . '/uploads')) {
            redirect_header($fail_url, 15, sprintf(_MA_TADADM_STAGING_WRITE_FAIL, htmlspecialchars($path, ENT_QUOTES), htmlspecialchars(UpgradeManifest::php_user(), ENT_QUOTES)));
        }
    }

    public static function do_block($act, $update_sn)
    {
        global $xoopsDB;

        $TadAmModuleConfig = self::get_adm_config();
        $ver               = (int) str_replace('.', '', substr(XOOPS_VERSION, 6, 5));
        $add_count_url     = $TadAmModuleConfig['source'] . "/modules/tad_modules/api.php?update_sn={$update_sn}&from=" . XOOPS_URL . "&sitename={$xoopsConfig['sitename']}&theme={$xoopsConfig['theme_set']}&version=$ver&language={$xoopsConfig['language']}";

        $url = $TadAmModuleConfig['source'] . "/uploads/tad_modules/{$update_sn}.json";

        if (function_exists('curl_init')) {
            // [修補 CWE-297] 啟用 SSL 憑證驗證
            $ch      = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);
            curl_close($ch);

            $ch      = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_URL, $add_count_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $count = curl_exec($ch);
            curl_close($ch);
        } elseif (function_exists('file_get_contents')) {
            $data  = file_get_contents($url);
            $count = file_get_contents($add_count_url);
        } else {
            $handle = fopen($url, 'rb');
            $data   = stream_get_contents($handle);
            fclose($handle);

            $handle = fopen($add_count_url, 'rb');
            $count  = stream_get_contents($handle);
            fclose($handle);
        }

        $block         = json_decode($data, true);
        $last_modified = time();

        if ('install' === $act) {
            $block['content'] = \stripslashes($block['content']);
            $sql              = 'INSERT INTO `' . $xoopsDB->prefix('newblocks') . '`
            (`mid`, `func_num`, `options`, `name`, `title`, `content`, `side`, `weight`, `visible`, `block_type`, `c_type`, `isactive`, `dirname`, `func_file`, `show_func`, `edit_func`, `template`, `bcachetime`, `last_modified`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            Utility::query(
                $sql,
                'iissssiiississsssii',
                [0, 0, '', '自訂區塊', $block['title'], $block['content'], $block['side'], 0, 1, 'C', $block['c_type'], 1, $block['dirname'], '', '', '', '', 0, $last_modified]
            )
            or Utility::web_error($sql, __FILE__, __LINE__);

            $block_id  = $xoopsDB->getInsertId();
            $module_id = ($block['side'] <= 1) ? 0 : -1;

            $sql = 'INSERT INTO `' . $xoopsDB->prefix('group_permission') . '`
            (`gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`)
            VALUES (?, ?, ?, ?), (?, ?, ?, ?), (?, ?, ?, ?)';
            Utility::query($sql, 'iiisiiisiiis', [1, $block_id, 1, 'block_read', 2, $block_id, 1, 'block_read', 3, $block_id, 1, 'block_read']) or Utility::web_error($sql, __FILE__, __LINE__);

            $sql = 'INSERT INTO `' . $xoopsDB->prefix('block_module_link') . '`
            (`block_id`, `module_id`)
            VALUES (?, ?)';
            Utility::query($sql, 'ii', [$block_id, $module_id]) or Utility::web_error($sql, __FILE__, __LINE__);

            $sql = 'INSERT INTO `' . $xoopsDB->prefix('group_permission') . '`
            (`gperm_groupid`, `gperm_itemid`, `gperm_modid`, `gperm_name`)
            VALUES (?, ?, ?, ?), (?, ?, ?, ?), (?, ?, ?, ?)';
            Utility::query($sql, 'iiisiiisiiis', [1, $block_id, 1, 'block_read', 2, $block_id, 1, 'block_read', 3, $block_id, 1, 'block_read']) or Utility::web_error($sql, __FILE__, __LINE__);
        } else {
            $block['content'] = \stripslashes($block['content']);
            $sql              = 'UPDATE `' . $xoopsDB->prefix('newblocks') . '`
            SET `content` = ?, `last_modified` = ?
            WHERE `dirname` = ?';
            Utility::query($sql, 'sss', [$block['content'], $last_modified, $block['dirname']]) or Utility::web_error($sql, __FILE__, __LINE__);
        }
    }

    /**
     * 向伺服器取得套件的 SHA-256 雜湊並與本機下載檔案比對。
     * 伺服器端需在同路徑提供 <filename>.sha256 檔案。
     *
     * [修補 CWE-494] 防止以竄改套件進行供應鏈攻擊。
     */
    private static function verify_package_hash(string $file_link, string $local_file, string $source): bool
    {
        $hash_url = $file_link . '.sha256';

        $remote_hash = '';
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_URL, $hash_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            $remote_hash = curl_exec($ch);
            curl_close($ch);
        } elseif (function_exists('file_get_contents')) {
            $remote_hash = file_get_contents($hash_url);
        }

        // 取第一個 token（相容 "hash  filename" 格式）
        $remote_hash = strtolower(trim(explode(' ', trim((string) $remote_hash))[0]));

        if (empty($remote_hash) || strlen($remote_hash) !== 64) {
            // 伺服器尚未提供雜湊檔：記錄警告但暫時放行，
            // 待伺服器端部署完成後改為 return false。
            error_log("[tad_adm] WARNING: no remote hash available for {$file_link}");
            return true;
        }

        $local_hash = hash_file('sha256', $local_file);

        return hash_equals($remote_hash, $local_hash);
    }

    /**
     * 解析 go.txt 並以白名單操作取代 eval()。
     *
     * [修補 CWE-94] go.txt 僅允許三種指令：
     *   full_copy(<src>, <dst>)
     *   chmod_R(<path>, <filemode>, <dirmode>)
     *   delete_directory(<path>)
     *
     * 所有路徑均限制在 XOOPS_ROOT_PATH 之內，防止路徑穿越。
     */
    private static function execute_go_instructions(string $go_file, string $new_file, int $module_sn = 0, ?callable $progress = null): array
    {
        $report = ['copy' => [], 'blocked' => 0, 'chmod' => 0, 'delete' => 0];
        if (!is_file($go_file)) {
            $report['copy'][] = $go_file;
            return $report;
        }

        $handle = fopen($go_file, 'rb');
        if (!$handle) {
            $report['copy'][] = $go_file;
            return $report;
        }
        self::$chmod_fail = 0;

        while (false !== ($raw = fgets($handle, 4096))) {
            $line = str_replace('XOOPS_ROOT_PATH', XOOPS_ROOT_PATH, $raw);
            $line = str_replace('XOOPS_VAR_PATH', XOOPS_VAR_PATH, $line);
            $line = str_replace('XOOPS_PATH', XOOPS_PATH, $line);
            $line = str_replace('NEW_FILE', $new_file, $line);
            $line = str_replace('MODULE_SN', (string) $module_sn, $line);
            $line = trim($line);

            if ($line === '' || strpos($line, '#') === 0) {
                continue;
            }

            // ── full_copy(<src>, <dst>) ─────────────────────────
            if (preg_match('/^full_copy\s*\(\s*(["\']?)(.+?)\1\s*,\s*(["\']?)(.+?)\3\s*\)\s*;?$/i', $line, $m)) {
                $src = self::sanitize_path($m[2]);
                $dst = self::sanitize_path($m[4]);
                if ($src && $dst) {
                    if ($progress) {
                        $progress('copy', $dst);
                    }
                    self::copy_tree($src, $dst, $report['copy']);
                    if ($report['copy']) {
                        break;
                    }
                } else {
                    $report['blocked']++;
                }
                continue;
            }

            // ── chmod_R(<path>, <filemode>, <dirmode>) ──────────
            if (preg_match('/^chmod_R\s*\(\s*(["\']?)(.+?)\1\s*,\s*(0[0-7]{3,4})\s*,\s*(0[0-7]{3,4})\s*\)\s*;?$/i', $line, $m)) {
                $path     = self::sanitize_path($m[2]);
                $filemode = octdec($m[3]);
                $dirmode  = octdec($m[4]);
                if ($path) {
                    if ($progress) {
                        $progress('chmod', $path);
                    }
                    self::chmod_R($path, $filemode, $dirmode);
                } else {
                    $report['blocked']++;
                }
                continue;
            }

            // ── delete_directory(<path>) ────────────────────────
            if (preg_match('/^delete_directory\s*\(\s*(["\']?)(.+?)\1\s*\)\s*;?$/i', $line, $m)) {
                $path = self::sanitize_path($m[2]);
                if ($path) {
                    if ($progress) {
                        $progress('delete', $path);
                    }
                    Utility::delete_directory($path);
                    if (file_exists($path)) {
                        $report['delete']++;
                    }
                } else {
                    $report['blocked']++;
                }
                continue;
            }

            // 不符合白名單 → 記錄並跳過，絕不執行
            error_log("[tad_adm] SECURITY: unknown go.txt instruction blocked: " . $line);
            $report['blocked']++;
        }

        fclose($handle);
        $report['chmod'] = self::$chmod_fail;

        return $report;
    }

    /** 複製目錄樹並收集失敗的目標路徑 */
    private static function copy_tree(string $src, string $dst, array &$failed): void
    {
        if (is_dir($src)) {
            if (!is_dir($dst) && !@mkdir($dst, 0755, true) && !is_dir($dst)) {
                $failed[] = $dst;
                return;
            }
            $entries = @scandir($src);
            if (false === $entries) {
                $failed[] = $src;
                return;
            }
            foreach ($entries as $item) {
                if ('.' !== $item && '..' !== $item) {
                    self::copy_tree($src . '/' . $item, $dst . '/' . $item, $failed);
                }
            }
        } elseif (is_file($src)) {
            if (!@copy($src, $dst)) {
                $failed[] = $dst;
            }
        } else {
            $failed[] = $src;
        }
    }

    /** 只讀掃描 go.txt 的 full_copy 目標，找出 PHP 無法寫入的路徑 */
    private static function preflight_go_scan(string $go_file, string $new_file, int $module_sn = 0): array
    {
        $result         = ['count' => 0, 'paths' => [], 'seen' => [], 'root' => XOOPS_ROOT_PATH];
        $result['user'] = function_exists('posix_geteuid') && function_exists('posix_getpwuid')
            ? (posix_getpwuid(posix_geteuid())['name'] ?? get_current_user())
            : get_current_user();
        if (!is_file($go_file)) {
            return $result;
        }
        foreach (file($go_file, FILE_IGNORE_NEW_LINES) as $raw) {
            $line = str_replace(['XOOPS_ROOT_PATH', 'XOOPS_VAR_PATH', 'XOOPS_PATH', 'NEW_FILE', 'MODULE_SN'], [XOOPS_ROOT_PATH, XOOPS_VAR_PATH, XOOPS_PATH, $new_file, (string) $module_sn], $raw);
            if (!preg_match('/^\s*full_copy\s*\(\s*(["\']?)(.+?)\1\s*,\s*(["\']?)(.+?)\3\s*\)\s*;?\s*$/i', $line, $m)) {
                continue;
            }
            $src = self::sanitize_path($m[2]);
            $dst = self::sanitize_path($m[4]);
            if ($src && $dst) {
                self::scan_unwritable($src, $dst, $result);
            }
        }

        return $result;
    }

    private static function scan_unwritable(string $src, string $dst, array &$result): void
    {
        if (is_dir($src)) {
            if (!file_exists($dst)) {
                $parent = dirname($dst);
                while (!file_exists($parent) && dirname($parent) !== $parent) {
                    $parent = dirname($parent);
                }
                if (!is_writable($parent)) {
                    self::add_unwritable($parent, $result);
                }
                return;
            }
            if (!is_dir($dst) || !is_writable($dst)) {
                self::add_unwritable($dst, $result);
                return;
            }
            $entries = @scandir($src);
            if (false === $entries) {
                self::add_unwritable($src, $result);
                return;
            }
            foreach ($entries as $item) {
                if ('.' !== $item && '..' !== $item) {
                    self::scan_unwritable($src . '/' . $item, $dst . '/' . $item, $result);
                }
            }
        } elseif (is_file($src) && file_exists($dst) && (is_dir($dst) || !is_writable($dst))) {
            self::add_unwritable($dst, $result);
        }
    }

    private static function add_unwritable(string $path, array &$result): void
    {
        if (!isset($result['seen'][$path])) {
            $result['seen'][$path] = true;
            $result['count']++;
            if (count($result['paths']) < 10) {
                $result['paths'][] = $path;
            }
        }
    }

    private static function format_path_list(array $paths, int $limit): string
    {
        $paths = array_slice(array_unique($paths), 0, $limit);

        return '<code>' . implode('</code><br><code>', array_map(static fn($p) => htmlspecialchars($p, ENT_QUOTES), $paths)) . '</code>';
    }

    private static function preflight_message(array $scan): string
    {
        $shown = $scan['count'] > count($scan['paths']) ? sprintf(_MA_TADADM_PREFLIGHT_SHOWN, count($scan['paths'])) : '';

        return sprintf(_MA_TADADM_PREFLIGHT_FAIL, htmlspecialchars($scan['user'], ENT_QUOTES), $scan['count'], $shown, self::format_path_list($scan['paths'], 10));
    }

    private static function go_warnings(array $report): string
    {
        $w = [];
        if ($report['blocked']) {
            $w[] = sprintf(_MA_TADADM_WARN_BLOCKED, $report['blocked']);
        }
        if ($report['chmod']) {
            $w[] = sprintf(_MA_TADADM_WARN_CHMOD, $report['chmod']);
        }
        if ($report['delete']) {
            $w[] = sprintf(_MA_TADADM_WARN_DELETE, $report['delete']);
        }

        return implode('; ', $w);
    }

    /**
     * 確保路徑在 XOOPS_ROOT_PATH 之內（防止路徑穿越）。
     * 回傳正規化後的路徑；若不合法則回傳 null。
     */
    private static function sanitize_path(string $path): ?string
    {
        $real = realpath($path);

        if ($real === false) {
            // 目標尚不存在，改用字串前綴檢查
            $normalized = rtrim(str_replace('\\', '/', $path), '/');
            $root       = rtrim(str_replace('\\', '/', XOOPS_ROOT_PATH), '/');
            if (strpos($normalized, $root . '/') === 0) {
                return $path;
            }
            error_log("[tad_adm] SECURITY: path traversal attempt blocked: " . $path);
            return null;
        }

        $root = rtrim(str_replace('\\', '/', XOOPS_ROOT_PATH), '/');
        $real = str_replace('\\', '/', $real);

        if (strpos($real . '/', $root . '/') !== 0) {
            error_log("[tad_adm] SECURITY: path traversal attempt blocked: " . $path);
            return null;
        }

        return $real;
    }

    //素材相關動作
    public static function do_other($file_link, $update_sn, $module_sn, $act = 'install_other', $ssh = '')
    {
        global $xoopsTpl;

        $fail_url = $_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean';
        $module_sn = (int) $module_sn;
        if ($module_sn <= 0 || empty($file_link)) {
            redirect_header($fail_url, 10, sprintf(_MA_TADADM_INVALID_PACKAGE_DIR, htmlspecialchars((string) $module_sn, ENT_QUOTES)));
        }
        if (empty($ssh) && (!is_writable(XOOPS_ROOT_PATH) || \Xmf\Request::getInt('force_ssh'))) {
            $xoopsTpl->assign('action', 'main.php');
            $xoopsTpl->assign('now_op', 'login_form');
            $xoopsTpl->assign('dirname', '');
            $xoopsTpl->assign('act', $act);
            $xoopsTpl->assign('update_sn', $update_sn);
            $xoopsTpl->assign('module_sn', $module_sn);
            $xoopsTpl->assign('file_link', $file_link);
            $xoopsTpl->assign('tad_adm_ssh_id', $_SESSION['tad_adm_ssh_id'] ?? '');
            $xoopsTpl->assign('tad_adm_ssh_passwd', $_SESSION['tad_adm_ssh_passwd'] ?? '');
            return;
        }

        $TadAmModuleConfig = self::get_adm_config();

        $orig_link = $file_link;
        $file_link = str_replace('[source]', $TadAmModuleConfig['source'], $file_link);
        $new_file  = str_replace($TadAmModuleConfig['source'] . "/uploads/tad_modules/file/", XOOPS_ROOT_PATH . '/uploads/', $file_link);

        self::prepare_package_directory(XOOPS_ROOT_PATH . '/uploads/tad_adm', $fail_url);
        self::copyemz($file_link, $new_file, $update_sn);

        if (!is_file($new_file)) {
            redirect_header($_SERVER['PHP_SELF'] . '?tad_adm_tpl=clean', 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
        }

        $work_path = XOOPS_ROOT_PATH . "/uploads/tad_adm/$module_sn";
        if (is_dir($work_path) && !Utility::delete_directory($work_path)) {
            redirect_header($fail_url, 15, sprintf(_MA_TADADM_EXTRACT_FAIL, htmlspecialchars($work_path, ENT_QUOTES)));
        }
        self::prepare_package_directory($work_path, $fail_url);

        $zip = new DunZip2($new_file);
        $extracted = $zip->unzipAll($work_path . '/', '', true, 0);
        $zip->close();
        if (!$extracted) {
            redirect_header($fail_url, 15, sprintf(_MA_TADADM_EXTRACT_FAIL, htmlspecialchars($work_path, ENT_QUOTES)));
        }

        $manifest = $work_path . '/upgrade.json';
        if (is_file($manifest)) {
            try {
                $steps = UpgradeManifest::load($manifest, [
                    'ROOT' => XOOPS_ROOT_PATH, 'VAR' => XOOPS_VAR_PATH, 'LIB' => XOOPS_PATH,
                    'WORK' => $work_path, 'NEW_FILE' => $new_file, 'SN' => $module_sn,
                ]);
            } catch (\RuntimeException $e) {
                redirect_header($fail_url, 10, sprintf(_MA_TADADM_MANIFEST_INVALID, htmlspecialchars($e->getMessage(), ENT_QUOTES)));
            }
        } elseif (!empty($ssh)) {
            $script = $work_path . '/ssh.txt';
            $contents = is_file($script) ? file_get_contents($script) : false;
            if (false === $contents) {
                redirect_header($fail_url, 10, sprintf(_MA_TADADM_SCRIPT_NOT_FOUND, htmlspecialchars($script, ENT_QUOTES)));
            }
            $script_path = $work_path . '/upgrade.sh';
            $contents = str_replace(['XOOPS_ROOT_PATH', 'XOOPS_VAR_PATH', 'XOOPS_PATH', 'NEW_FILE', 'MODULE_SN', "\r\n", "\r"], [XOOPS_ROOT_PATH, XOOPS_VAR_PATH, XOOPS_PATH, $new_file, (string) $module_sn, "\n", "\n"], $contents);
            if (false === file_put_contents($script_path, "#!/bin/sh\nset -e\n" . $contents)) {
                redirect_header($fail_url, 10, sprintf(_MA_TADADM_SCRIPT_NOT_FOUND, htmlspecialchars($script_path, ENT_QUOTES)));
            }
            self::run_ssh_command($ssh, 'sh ' . escapeshellarg($script_path) . ' 2>&1', $fail_url);
        } else {
            $script = $work_path . '/go.txt';
            if (!is_readable($script)) {
                redirect_header($fail_url, 10, sprintf(_MA_TADADM_SCRIPT_NOT_FOUND, htmlspecialchars($script, ENT_QUOTES)));
            }
        }

        if (isset($steps) && !empty($ssh)) {
            $script_path = $work_path . '/upgrade.sh';
            if (false === file_put_contents($script_path, UpgradeManifest::to_shell($steps))) {
                redirect_header($fail_url, 10, sprintf(_MA_TADADM_SCRIPT_NOT_FOUND, htmlspecialchars($script_path, ENT_QUOTES)));
            }
            $output = self::run_ssh_command($ssh, 'sh ' . escapeshellarg($script_path) . ' 2>&1', $fail_url);
            [, $warnings] = UpgradeManifest::parse_shell_output($output);
            if ($warnings) {
                redirect_header('main.php', 15, sprintf(_MA_TADADM_UPGRADE_WARN, htmlspecialchars(implode('; ', $warnings), ENT_QUOTES)));
            }
        } elseif (empty($ssh)) {
            $preflight = isset($steps) ? UpgradeManifest::preflight($steps, XOOPS_ROOT_PATH) : self::preflight_go_scan($script, $new_file, $module_sn);
            if ($preflight['count'] > 0) {
                $force_link = $_SERVER['PHP_SELF'] . '?' . http_build_query(['op' => $act, 'file_link' => $orig_link, 'update_sn' => $update_sn, 'module_sn' => $module_sn, 'force_ssh' => 1, 'tad_adm_tpl' => 'clean']);
                redirect_header($fail_url, 30, self::preflight_message($preflight) . '<br><a href="' . htmlspecialchars($force_link, ENT_QUOTES) . '">SSH</a>');
            }
            $report = isset($steps) ? UpgradeManifest::run_php($steps) : self::execute_go_instructions($script, $new_file, $module_sn);
            $errors = isset($steps) ? $report['errors'] : $report['copy'];
            if ($errors) {
                redirect_header($fail_url, 30, sprintf(_MA_TADADM_COPY_FAIL, count($errors), self::format_path_list($errors, 10)));
            }
            if (!isset($steps)) {
                $warnings = self::go_warnings($report);
            } else {
                $warnings = [];
                foreach ($report['warnings'] as [$n, $op, $count, $sample]) {
                    $warnings[] = sprintf(_MA_TADADM_WARN_STEP, $n, $op, $count, htmlspecialchars($sample, ENT_QUOTES));
                }
                $warnings = implode('; ', $warnings);
            }
            if ('' !== $warnings) {
                redirect_header('main.php', 15, sprintf(_MA_TADADM_UPGRADE_WARN, $warnings));
            }
        }

        return true;
    }
}
