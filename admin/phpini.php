<?php
use Xmf\Request;
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = 'tad_adm_adm_phpini.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------執行動作判斷區----------*/
$op  = Request::getString('op');
$g2p = Request::getInt('g2p');

switch ($op) {

    default:
        phpini($op);
        break;

}

/*-----------秀出結果區--------------*/
require_once __DIR__ . '/footer.php';

/*-----------function區--------------*/

function phpini()
{
    global $xoopsConfig, $xoopsTpl;

    include_once "../language/{$xoopsConfig['language']}/ini_arr.php";

    $php_ini_path = php_ini_loaded_file();
    $xoopsTpl->assign('php_ini_path', $php_ini_path);

    $show_ini = ['allow_url_fopen', 'date.timezone', 'display_errors', 'file_uploads', 'max_execution_time', 'max_file_uploads', 'max_input_time', 'max_input_vars', 'memory_limit', 'post_max_size', 'upload_max_filesize'];

    $adv_val = [
        'max_execution_time'  => '150',         //380
        'max_input_time'      => '120',         //390
        'max_input_vars'      => '5000',        //397
        'memory_limit'        => '240M',        //401
        'display_errors'      => '0',           //474
        'post_max_size'       => '220M',        //668
        'file_uploads'        => '1',           //810
        'upload_max_filesize' => '200M',        //821
        'max_file_uploads'    => '300',         //824
        'allow_url_fopen'     => '1',           //832
        'date.timezone'       => 'Asia/Taipei', //940
    ];

    $allini = ini_get_all();
    //die(var_export(ini_get_all()));

    $i    = 0;
    $main = [];
    foreach ($allini as $k => $v) {
        if (!in_array($k, $show_ini)) {
            continue;
        }

        $global_value = str_replace(',', ' , ', (string) ($v['global_value'] ?? ''));

        $main[$i]['k']            = $k;
        $main[$i]['global_value'] = $global_value;
        $main[$i]['ini']          = isset($ini[$k]) ? $ini[$k] : '';
        $main[$i]['adv']          = $adv_val[$k];

        $size_keys = ['memory_limit', 'post_max_size', 'upload_max_filesize'];
        if ($adv_val[$k] === $global_value) {
            $color = '#000000';
        } elseif (in_array($k, $size_keys, true)) {
            $cur_bytes = phpini_to_bytes($global_value);
            $adv_bytes = phpini_to_bytes($adv_val[$k]);
            // memory_limit 為 -1 代表不限制，視為大於建議值
            if ($cur_bytes < 0 || $cur_bytes > $adv_bytes) {
                $color = '#3B5E7F';
            } elseif ($cur_bytes === $adv_bytes) {
                $color = '#000000';
            } else {
                $color = 'red';
            }
        } elseif (is_numeric($global_value) && is_numeric($adv_val[$k])) {
            if ((float) $global_value > (float) $adv_val[$k]) {
                $color = '#3B5E7F';
            } elseif ((float) $global_value === (float) $adv_val[$k]) {
                $color = '#000000';
            } else {
                $color = 'red';
            }
        } else {
            $color = 'red';
        }

        $main[$i]['color'] = $color;
        $i++;
    }

    $xoopsTpl->assign('main', $main);
}

function phpini_to_bytes($val)
{
    $val = trim((string) $val);
    if ('' === $val) {
        return 0;
    }
    if ('-1' === $val) {
        return -1;
    }
    $num  = (float) $val;
    $unit = strtoupper(substr($val, -1));
    switch ($unit) {
        case 'G':
            return (int) round($num * 1024 * 1024 * 1024);
        case 'M':
            return (int) round($num * 1024 * 1024);
        case 'K':
            return (int) round($num * 1024);
        default:
            return (int) round($num);
    }
}
