<?php
/*-----------引入檔案區--------------*/
$GLOBALS['xoopsOption']['template_main'] = 'tad_adm_adm_backup.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';
$isWin = 'WIN' === mb_strtoupper(mb_substr(PHP_OS, 0, 3)) ? true : false;
/*-----------function區--------------*/

function view_file()
{
    global $xoopsTpl, $isWin;
    $free_space = disk_free_space('.');
    $total_size = 0;
    $dir = XOOPS_ROOT_PATH . '/uploads/';
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (false !== ($file = readdir($dh))) {
                //刪除之前的備份
                if (false !== mb_strpos($file, 'user_bak_2')) {
                    unlink($dir . $file);
                }

                if ('.' === mb_substr($file, 0, 1) or false !== mb_strpos($file, '_bak_')) {
                    continue;
                }
                if (is_dir($dir . $file)) {
                    $all_dir[$i]['dir_path'] = $isWin ? iconv('Big5', 'UTF-8', $dir . $file) : $dir . $file;
                    $all_dir[$i]['dir_name'] = $isWin ? iconv('Big5', 'UTF-8', $file) : $file;
                    $dir_size = GetDirectorySize($dir . $file);
                    $total_size += $dir_size;
                    $all_dir[$i]['dir_size'] = format_size($dir_size);
                    $all_dir[$i]['size'] = $dir_size;
                } else {
                    $all_files[$i]['file_path'] = $isWin ? iconv('Big5', 'UTF-8', $dir . $file) : $dir . $file;
                    $all_files[$i]['file_name'] = $isWin ? iconv('Big5', 'UTF-8', $file) : $file;
                    $file_size = filesize($dir . $file);
                    $total_size += $file_size;
                    $all_files[$i]['file_size'] = format_size($file_size);
                    $all_files[$i]['size'] = $file_size;
                }
                $i++;
            }
            closedir($dh);
        }
    }

    $xoopsTpl->assign('dir', $dir);
    $xoopsTpl->assign('total_size', format_size($total_size));
    $xoopsTpl->assign('all_dir', $all_dir);
    $xoopsTpl->assign('all_files', $all_files);
    $xoopsTpl->assign('free_space', format_size($free_space));
}

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$g2p = system_CleanVars($_REQUEST, 'g2p', 0, 'int');

switch ($op) {
    default:
        view_file();
        $op = 'view_file';
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('op', $op);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tad_adm/css/module.css');
require_once __DIR__ . '/footer.php';
