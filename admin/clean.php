<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_adm_adm_clean.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';
$isWin = 'WIN' === mb_strtoupper(mb_substr(PHP_OS, 0, 3)) ? true : false;
/*-----------執行動作判斷區----------*/
$op    = Request::getString('op');
$g2p   = Request::getInt('g2p');
$dirs  = Request::getArray('dirs');
$files = Request::getArray('files');

switch ($op) {
    case 'del_templates':
        if ('POST' !== mb_strtoupper($_SERVER['REQUEST_METHOD'] ?? '')) {
            header('location:clean.php');
            exit;
        }

        if (!isset($GLOBALS['xoopsSecurity']) || !is_object($GLOBALS['xoopsSecurity']) || !method_exists($GLOBALS['xoopsSecurity'], 'check') || !$GLOBALS['xoopsSecurity']->check()) {
            header('location:clean.php');
            exit;
        }

        del_templates($dirs, $files);
        header('location:clean.php');
        exit;

    default:
        view_file();
        $op = 'view_file';
        break;
}

/*-----------秀出結果區--------------*/
$token = '';
if (isset($GLOBALS['xoopsSecurity']) && is_object($GLOBALS['xoopsSecurity']) && method_exists($GLOBALS['xoopsSecurity'], 'createToken')) {
    $token = $GLOBALS['xoopsSecurity']->createToken();
}
$xoopsTpl->assign('op', $op);
$xoopsTpl->assign('token', $token);
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/

function view_file()
{
    global $xoopsTpl, $isWin, $xoopsConfig;

    $theme_name = $xoopsConfig['theme_set'];
    $all_dir    = $all_files    = [];
    $dir        = XOOPS_ROOT_PATH . "/themes/{$theme_name}/modules/";
    $i          = $total_size          = 0;
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (false !== ($file = readdir($dh))) {
                if ('.' === mb_substr($file, 0, 1) or 'system' === $file or 'pm' === $file or 'profile' === $file) {
                    continue;
                } elseif (is_dir($dir . $file)) {
                    $all_dir[$i]['dir_path'] = $isWin ? iconv('Big5', 'UTF-8', $dir . $file) : $dir . $file;
                    $all_dir[$i]['dir_name'] = $isWin ? iconv('Big5', 'UTF-8', $file) : $file;
                    $dir_size                = GetDirectorySize($dir . $file);
                    $total_size += $dir_size;
                    $all_dir[$i]['dir_size'] = format_size($dir_size);
                    $all_dir[$i]['size']     = $dir_size;
                    $i++;
                } elseif (!empty($file)) {
                    $all_files[$i]['file_path'] = $isWin ? iconv('Big5', 'UTF-8', $dir . $file) : $dir . $file;
                    $all_files[$i]['file_name'] = $isWin ? iconv('Big5', 'UTF-8', $file) : $file;
                    $all_files[$i]['file_size'] = filesize($dir . $file);
                    $i++;
                }
            }
            closedir($dh);
        }
    }

    $xoopsTpl->assign('theme_name', $theme_name);
    $xoopsTpl->assign('dir', $dir);
    $xoopsTpl->assign('total_size', format_size($total_size));
    $xoopsTpl->assign('all_dir', $all_dir);
    $xoopsTpl->assign('all_files', $all_files);
    // $xoopsTpl->assign('free_space', format_size($free_space));
}

function del_templates($dirs = [], $files = [])
{
    global $xoopsConfig;

    $theme_name        = isset($xoopsConfig['theme_set']) ? $xoopsConfig['theme_set'] : '';
    $allowed_base      = XOOPS_ROOT_PATH . "/themes/{$theme_name}/modules/";
    $allowed_real_base = realpath($allowed_base);
    if (false === $allowed_real_base) {
        return;
    }

    $allowed_real_base = str_replace('\\', '/', $allowed_real_base);
    $allowed_real_base = rtrim($allowed_real_base, '/') . '/';

    $is_safe_path = function ($path) use ($allowed_real_base) {
        if (!is_string($path) || '' === trim($path)) {
            return false;
        }

        $candidate = $path;
        if (false === mb_strpos($candidate, '://')) {
            if (0 !== mb_strpos($candidate, '/')) {
                $candidate = XOOPS_ROOT_PATH . '/' . ltrim($candidate, '/');
            }
        }

        if (!file_exists($candidate)) {
            return false;
        }

        $resolved = realpath($candidate);
        if (false === $resolved) {
            return false;
        }

        $resolved = str_replace('\\', '/', $resolved);
        $resolved = rtrim($resolved, '/') . '/';

        if (is_link($candidate)) {
            return false;
        }

        return $resolved === $allowed_real_base || 0 === mb_strpos($resolved, $allowed_real_base);
    };

    if (is_array($dirs)) {
        foreach ($dirs as $dir) {
            if ($is_safe_path($dir) && is_dir($dir) && !is_link($dir)) {
                Utility::delete_directory($dir);
            }
        }
    }
    if (is_array($files)) {
        foreach ($files as $file) {
            if ($is_safe_path($file) && is_file($file) && !is_link($file)) {
                unlink($file);
            }
        }
    }
}
