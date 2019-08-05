<?php
xoops_loadLanguage('main', 'tadtools');

$inSchoolWeb = is_link(XOOPS_ROOT_PATH . '/mainfile.php') ? true : false;

/********************* 自訂函數 ********************
 * @param $path
 * @return bool|false|float|int|string
 */
function GetDirectorySize($path)
{
    $isWin = 'WIN' === mb_strtoupper(mb_substr(PHP_OS, 0, 3)) ? true : false;
    $isDCS = false !== mb_strpos(XOOPS_ROOT_PATH, 'DWASFiles') ? true : false;

    if ($isDCS) {
        return folderSize($path);
    } elseif ($isWin) {
        $bytestotal = 0;
        $obj = new COM('scripting.filesystemobject');
        if (is_object($obj)) {
            $ref = $obj->getfolder($path);

            return $ref->size;
            $obj = null;
        } else {
            die('can not create object');
        }
    } else {
        $io = popen('/usr/bin/du -sk ' . $path, 'r');
        $size = fgets($io, 4096);
        $size = mb_substr($size, 0, mb_strpos($size, "\t"));
        pclose($io);
        $size = $size * 1024;

        return $size;
    }
}

function folderSize($dir)
{
    $size = 0;
    foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : folderSize($each);
    }

    return $size;
}

function format_size($bytes = '')
{
    $si_prefix = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    $base = 1024;
    $class = min((int) log($bytes, $base), count($si_prefix) - 1);
    $space = sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class];

    return $space;
}
