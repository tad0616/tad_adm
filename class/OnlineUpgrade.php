<?php
namespace XoopsModules\Tad_adm;

use XoopsModules\Tadtools\FancyBox;
use XoopsModules\Tadtools\FooTable;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Tad_adm\OnlineUpgrade;

class OnlineUpgrade
{
    // public $selector = '.footable';

    //建構函數
    public function __construct()
    {

    }

    //列出所有模組
    public static function list_modules($mode = 'tpl')
    {
        global $xoopsDB, $xoopsModuleConfig, $xoopsTpl, $xoopsConfig, $inSchoolWeb;

        //取得升級訊息
        $all_mods = self::get_tad_json_info('all2.json');
        // die(var_dump($mod));

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

    }

//列出所有XOOPS升級資訊
    public function list_xoops($mode = "tpl")
    {
        global $xoopsDB, $xoopsModuleConfig, $xoopsTpl, $xoopsConfig;
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
        // die(var_dump($all_patch));
        $xoopsTpl->assign('all_patch', $all_patch);

        $FooTable = new FooTable();
        $FooTable->render();

        $FancyBox = new FancyBox('.modulesadmin');
        $FancyBox->render(true);

        $xoopsTpl->assign('jquery', Utility::get_jquery(true));

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
            $handle = fopen($url, "rb");
            $data = stream_get_contents($handle);
            fclose($handle);
        }

        if (empty($data)) {
            redirect_header("index.php", 3, _MA_TADADM_FAILED_TO_GET_JSON);
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
        global $xoopsDB, $xoopsConfig;
        $dirname = $data['dirname'];
        $item = [];
        $path = '';

        switch ($kind) {
            case "module":

                foreach ($db_data as $k => $v) {
                    $$k = $v;
                }
                $Version = round($version / 100, 2);
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
                $Version = self::get_theme_version($dirname);
                $last_update = file_exists("{$path}/theme.ini") ? filemtime("{$path}/theme.ini") : '';
                $enable = in_array($dirname, $xoopsConfig['theme_set_allowed']) ? 1 : 0;
                $is_link = is_link($path);
                break;

            case "block":
                $Version = '';
                $last_update = $db_data['last_modified'];
                $enable = $db_data['visible'];
                $is_link = false;
                break;

            case "adm_tpl":
                $path = XOOPS_ROOT_PATH . "/modules/system/themes/{$dirname}";
                $Version = file_get_contents("{$path}/version.txt");
                $last_update = file_exists("{$path}/version.txt") ? filemtime("{$path}/version.txt") : '';
                $enable = $dirname == $xoopsConfig['cpanel'] ? 1 : 0;
                $is_link = is_link($path);
                break;
        }

        $status = self::version_status($Version, $data, $dirname, $data['kind'], $last_update);
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
        $item['new_version'] = ($data['new_version']) ? $data['new_version'] . $rc : '';
        $item['new_last_update'] = ($data['new_last_update']) ? date('Y-m-d H:i', $data['new_last_update']) : '';
        $item['logo'] = $data['logo'];
        $item['logo_thumb'] = $data['logo_thumb'];

        $item['now_version'] = $Version;
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
        $my_xoops_version = self::get_version('xoops');
        $my_php_version = self::get_version('php');
        $now_version = self::get_version('', $now_version);
        $new_version = self::get_version('', $mod_data['new_version']);
        $xoops_version = self::get_version('xoops', $mod_data['xoops_version']);
        $xoops_min_version = self::get_version('xoops', $mod_data['xoops_min_version']);
        $php_min_version = self::get_version('php', $mod_data["php_min_version"]);
        $php_max_version = self::get_version('php', $mod_data['php_max_version']);
        $min_tadtools_version = self::get_version('', $mod_data['tadtools_version']);
        $now_tadtools_version = self::get_version('tadtools');

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

            if ($type == "block" or $type == "upgrade" or $type == "patch") {
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

    //版本判斷
    public static function get_version($type = 'xoops', $ver = '')
    {
        global $xoopsDB;
        if (empty($ver) and empty($type)) {
            return;
        }
        switch ($type) {
            case 'xoops':
                if (empty($ver)) {
                    $ver = XOOPS_VERSION;
                }
                $version = explode('.', str_replace('XOOPS ', '', $ver));
                break;

            case 'php':
                if (empty($ver)) {
                    $ver = PHP_VERSION;
                }

                $version = explode('.', $ver);
                break;

            default:
                if (empty($ver)) {
                    $sql = "select version from `" . $xoopsDB->prefix("modules") . "` where dirname='{$type}'";
                    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);
                    list($ver) = $xoopsDB->fetchRow($result);
                    for ($i = 0; $i < strlen($ver); $i++) {
                        $version[] = substr($ver, $i, 1);
                    }
                } else {
                    if (isset($_GET['debug']) && $_GET['debug'] == 1) {
                        echo "$ver<br>";
                    }

                    $v = explode('.', $ver);
                    $version[] = $v[0];
                    if (isset($v[1])) {
                        for ($i = 0; $i < strlen($v[1]); $i++) {
                            $version[] = substr($v[1], $i, 1);
                        }
                    }
                    // die(var_dump($version));
                }
                break;
        }

        $v1 = $v2 = $v3 = 0;
        $sizeof = sizeof($version);
        if ($sizeof == 1) {
            list($v1) = $version;
        } elseif ($sizeof == 2) {
            list($v1, $v2) = $version;
        } else {
            list($v1, $v2, $v3) = $version;
        }

        $Version = intval($v1 * 10000 + $v2 * 100 + $v3);
        return $Version;
    }

    public static function get_theme_version($dirname)
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

    public static function getpwuid($file = "")
    {
        if (function_exists('posix_getpwuid')) {
            return posix_getpwuid(fileowner($file));
        } else {
            return "";
        }
    }

    public static function getgrgid($file = "")
    {
        if (function_exists('posix_getgrgid')) {
            return posix_getgrgid(filegroup($file));
        } else {
            return "";
        }
    }

}
