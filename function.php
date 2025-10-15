<?php
xoops_loadLanguage('main', 'tadtools');
$inSchoolWeb = is_link(XOOPS_ROOT_PATH . '/mainfile.php') ? true : false;

function GetDirectorySize($path)
{
    // 如果路徑不存在，直接回傳 0
    if (!file_exists($path)) {
        return 0;
    }

    // 使用遞迴計算資料夾大小，取代原本的 popen/du 方式
    return folderSize($path);
}

function folderSize($dir)
{
    $size = 0;
    try {
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS)) as $file) {
            $size += $file->getSize();
        }
    } catch (UnexpectedValueException $e) {
        // 目錄無法讀取就跳過
    }
    return $size;
}

function format_size($bytes = '')
{
    $si_prefix = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    $base      = 1024;
    $class     = min((int) log($bytes, $base), count($si_prefix) - 1);
    $space     = sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];

    return $space;
}
