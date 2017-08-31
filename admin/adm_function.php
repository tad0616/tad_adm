<?php
//列出所有模組
function list_modules($mode="tpl")
{
    global $xoopsDB,$xoopsModuleConfig,$xoopsTpl;
    $mod=get_tad_modules_info();
    $sql="select * from ".$xoopsDB->prefix("modules")." where isactive='1' order by hasmain desc, weight";
    $result = $xoopsDB->query($sql) or die($sql."<br>". mysql_error());

    $i=0;
    //模組部份
    $all_data="";
    while ($data=$xoopsDB->fetchArray($result)) {
        foreach ($data as $k=>$v) {
            $$k=$v;
        }
        if (!isset($mod[$dirname]['module']['kind'])) {
            continue;
        } elseif ($mod[$dirname]['module']['kind']=="module") {
            $ok['module'][]=$dirname;
        } else {
            continue;
        }
        $status=($mod[$dirname]['module']['new_status_version'])?" {$mod[$dirname]['module']['new_status']}{$mod[$dirname]['module']['new_status_version']}":"";

        $all_data[$i]['mid']=$mid;
        $all_data[$i]['name']=$name;
        $all_data[$i]['version']=round($version / 100, 2);
        $all_data[$i]['new_version']=($mod[$dirname]['module']['new_version'])?$mod[$dirname]['module']['new_version'].$status:"";

        $last_update=filemtime(XOOPS_ROOT_PATH."/modules/{$dirname}/xoops_version.php");
        $all_data[$i]['last_update']=date("Y-m-d H:i", $last_update);
        $all_data[$i]['new_last_update']=($mod[$dirname]['module']['new_last_update'])?date("Y-m-d H:i", $mod[$dirname]['module']['new_last_update']):"";
        $all_data[$i]['weight']=$weight;
        $all_data[$i]['isactive']=$isactive;
        $all_data[$i]['dirname']=$dirname;
        $all_data[$i]['hasmain']=$hasmain?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hasadmin']=$hasadmin?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hassearch']=$hassearch?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hasconfig']=$hasconfig?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hascomments']=$hascomments?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hasnotification']=$hasnotification?_MA_TADADM_1:_MA_TADADM_0;

        $version=intval($version);
        $new_version=$mod[$dirname]['module']['new_version'] * 100;
        $new_version=intval($new_version);

        $last_update=strtotime($all_data[$i]['last_update']);
        $new_last_update=strtotime($all_data[$i]['new_last_update']);

        $all_data[$i]['newversion']=$new_version;
        $all_data[$i]['now_version']=$version;

        $all_data[$i]['function']=($new_version > $version or $new_last_update > $last_update)?'update':'last_mod';

        $all_data[$i]['update_sn']=$mod[$dirname]['module']['update_sn'];
        $all_data[$i]['descript']=$mod[$dirname]['module']['update_descript'];
        $all_data[$i]['module_sn']=$mod[$dirname]['module']['module_sn'];
        $all_data[$i]['file_link']=$mod[$dirname]['module']['file_link'];
        $all_data[$i]['kind']=$mod[$dirname]['module']['kind'];

        $i++;


        //補充包部份
        if (isset($ok['fix']) and in_array($dirname, $ok['fix'])) {
            continue;
        } elseif (isset($mod[$dirname]['fix']['kind']) and $mod[$dirname]['fix']['kind']=="fix") {
            $ok['fix'][]=$dirname;
        } else {
            continue;
        }

        $status=($mod[$dirname]['fix']['new_status_version'])?" {$mod[$dirname]['fix']['new_status']}{$mod[$dirname]['fix']['new_status_version']}":"";

        $all_data[$i]['mid']=$mid;
        $all_data[$i]['name']=$mod[$dirname]['fix']['module_title'];
        $all_data[$i]['version']=round($version / 100, 2);
        $all_data[$i]['new_version']=($mod[$dirname]['fix']['new_version'])?$mod[$dirname]['fix']['new_version'].$status:"";

        $last_update=filemtime(XOOPS_ROOT_PATH."/modules/{$dirname}/xoops_version.php");
        $all_data[$i]['last_update']=date("Y-m-d H:i", $last_update);
        $all_data[$i]['new_last_update']=($mod[$dirname]['fix']['new_last_update'])?date("Y-m-d H:i", $mod[$dirname]['fix']['new_last_update']):"";
        $all_data[$i]['weight']=$weight;
        $all_data[$i]['isactive']=$isactive;
        $all_data[$i]['dirname']=$dirname;
        $all_data[$i]['hasmain']=$hasmain?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hasadmin']=$hasadmin?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hassearch']=$hassearch?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hasconfig']=$hasconfig?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hascomments']=$hascomments?_MA_TADADM_1:_MA_TADADM_0;
        $all_data[$i]['hasnotification']=$hasnotification?_MA_TADADM_1:_MA_TADADM_0;

        $version=intval($version);
        $new_version=$mod[$dirname]['fix']['new_version'] * 100;
        $new_version=intval($new_version);

        $last_update=strtotime($all_data[$i]['last_update']);
        $new_last_update=strtotime($all_data[$i]['new_last_update']);

        $all_data[$i]['newversion']=$new_version;
        $all_data[$i]['now_version']=$version;

        $all_data[$i]['function']=($new_version > $version or $new_last_update > $last_update)?'update':'last_mod';

        $all_data[$i]['update_sn']=$mod[$dirname]['fix']['update_sn'];
        $all_data[$i]['descript']=$mod[$dirname]['fix']['update_descript'];
        $all_data[$i]['module_sn']=$mod[$dirname]['fix']['module_sn'];
        $all_data[$i]['file_link']=$mod[$dirname]['fix']['file_link'];
        $all_data[$i]['kind']=$mod[$dirname]['fix']['kind'];

        $i++;
    }



    //佈景部份
    foreach ($mod as $dirname=>$data) {
        if (isset($ok['theme']) and in_array($dirname, $ok['theme'])) {
            continue;
        }
        $Version="";
        //佈景部份
        if (isset($data['theme']['kind']) and $data['theme']['kind']=="theme") {
            $ok['theme'][]=$dirname;
            if (is_dir(XOOPS_ROOT_PATH."/themes/{$dirname}")) {
                $handle = @fopen(XOOPS_ROOT_PATH."/themes/{$dirname}/theme.ini", "r");
                if ($handle) {
                    while (($buffer = fgets($handle, 4096)) !== false) {
                        $ini= explode("=", $buffer);
                        if (trim($ini[0])=="Version") {
                            $Version=str_replace("\"", "", trim($ini[1]));
                            break;
                        }
                    }
                    fclose($handle);
                }


                $status=($data['theme']['new_status_version'])?" {$data['theme']['new_status']}{$data['theme']['new_status_version']}":"";
                $all_data[$i]['mid']="";
                $all_data[$i]['name']=$data['theme']['module_title'];
                $all_data[$i]['version']=$Version;
                $all_data[$i]['new_version']=($data['theme']['new_version'])?$data['theme']['new_version'].$status:"";
                $last_update=filemtime(XOOPS_ROOT_PATH."/themes/{$dirname}/theme.ini");
                $all_data[$i]['last_update']=date("Y-m-d H:i", $last_update);
                $all_data[$i]['new_last_update']=($data['theme']['new_last_update'])?date("Y-m-d H:i", $data['theme']['new_last_update']):"";
                $all_data[$i]['weight']="";
                $all_data[$i]['isactive']="";
                $all_data[$i]['dirname']=$dirname;
                $all_data[$i]['hasmain']="";
                $all_data[$i]['hasadmin']="";
                $all_data[$i]['hassearch']="";
                $all_data[$i]['hasconfig']="";
                $all_data[$i]['hascomments']="";
                $all_data[$i]['hasnotification']="";

                $version=$Version*100;
                $new_version=$data['theme']['new_version']*100;
                $version=intval($version);
                $new_version=intval($new_version);

                $last_update=strtotime($all_data[$i]['last_update']);
                $new_last_update=strtotime($all_data[$i]['new_last_update']);
                $all_data[$i]['function']=($new_version > $version or $new_last_update > $last_update)?'update_theme':'last_theme';
                $all_data[$i]['update_sn']=$data['theme']['update_sn'];
                $all_data[$i]['descript']=$data['theme']['module_descript'];
                $all_data[$i]['module_sn']=$data['theme']['module_sn'];
                $all_data[$i]['file_link']=$data['theme']['file_link'];
                $all_data[$i]['kind']=$data['theme']['kind'];

                $i++;
            } else {
                $status=($data['theme']['new_status_version'])?" {$data['theme']['new_status']}{$data['theme']['new_status_version']}":"";
                $all_data[$i]['mid']="";
                $all_data[$i]['name']=$data['theme']['module_title'];
                $all_data[$i]['version']="";
                $all_data[$i]['new_version']=($data['theme']['new_version'])?$data['theme']['new_version'].$status:"";
                $last_update=file_exists((XOOPS_ROOT_PATH."/themes/{$dirname}/theme.ini"))?filemtime(XOOPS_ROOT_PATH."/themes/{$dirname}/theme.ini"):"";
                $all_data[$i]['last_update']=empty($last_update)?_MA_TADADM_MOD_UNINSTALL:date("Y-m-d H:i", $last_update);
                $all_data[$i]['new_last_update']=($data['theme']['new_last_update'])?date("Y-m-d H:i", $data['theme']['new_last_update']):"";
                $all_data[$i]['weight']="";
                $all_data[$i]['isactive']="";
                $all_data[$i]['dirname']=$dirname;
                $all_data[$i]['hasmain']="";
                $all_data[$i]['hasadmin']="";
                $all_data[$i]['hassearch']="";
                $all_data[$i]['hasconfig']="";
                $all_data[$i]['hascomments']="";
                $all_data[$i]['hasnotification']="";
                $all_data[$i]['function']=($data['theme']['new_last_update'] > $last_update)?'install_theme':'last_theme';
                $all_data[$i]['update_sn']=$data['theme']['update_sn'];
                $all_data[$i]['descript']=$data['theme']['module_descript'];
                $all_data[$i]['module_sn']=$data['theme']['module_sn'];
                $all_data[$i]['file_link']=$data['theme']['file_link'];
                $all_data[$i]['kind']=$data['theme']['kind'];

                $i++;
            }
        } else {
            continue;
        }
    }

    //未安裝部份
    foreach ($mod as $dirname=>$item) {
        foreach ($item as $kind=>$data) {
            if (in_array($dirname, $ok['module']) and $kind=="module") {
                continue;
            }
            if (in_array($dirname, $ok['theme']) and $kind=="theme") {
                continue;
            }
            if (in_array($dirname, $ok['fix']) and $kind=="fix") {
                continue;
            }

            $status=($data['new_status_version'])?" {$data['new_status']}{$data['new_status_version']}":"";
            $all_data[$i]['mid']="";
            $all_data[$i]['name']=$data['module_title'];
            $all_data[$i]['version']=$Version;
            $all_data[$i]['new_version']=($data['new_version'])?$data['new_version'].$status:"";

            $all_data[$i]['last_update']=_MA_TADADM_MOD_UNINSTALL;
            $all_data[$i]['new_last_update']=($data['new_last_update'])?date("Y-m-d H:i", $data['new_last_update']):"";
            $all_data[$i]['weight']="";
            $all_data[$i]['isactive']="";
            $all_data[$i]['dirname']=$dirname;
            $all_data[$i]['hasmain']="";
            $all_data[$i]['hasadmin']="";
            $all_data[$i]['hassearch']="";
            $all_data[$i]['hasconfig']="";
            $all_data[$i]['hascomments']="";
            $all_data[$i]['hasnotification']="";
            $all_data[$i]['function']=($kind=="fix")?"update":"install";
            $all_data[$i]['update_sn']=$data['update_sn'];
            $all_data[$i]['descript']=$data['module_descript'];
            $all_data[$i]['module_sn']=$data['module_sn'];
            $all_data[$i]['file_link']=$data['file_link'];
            $all_data[$i]['kind']=$data['kind'];

            $i++;
        }
    }

    if (empty($all_data)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADADM_NO_MODS);
        exit;
    }

    if ($mode=="return") {
        return $all_data;
    }
    $xoopsTpl->assign('all_data', $all_data);
}

//取得更新訊息
function get_tad_modules_info()
{
    $url="http://120.115.2.90/uploads/tad_modules/all.txt";
    if (function_exists('curl_init')) {
        $ch = curl_init();
        $timeout = 5;
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
    $all=explode('||', $data);
    foreach ($all as $arr_data) {
        list($module_title, $dirname, $update_sn, $new_version, $new_status, $new_status_version, $new_last_update, $file_link, $update_descript, $module_sn, $module_descript, $kind)=explode("-+-", $arr_data);
        $mod[$dirname][$kind]['module_title']=$module_title;
        $mod[$dirname][$kind]['update_sn']=$update_sn;
        $mod[$dirname][$kind]['new_version']=$new_version;
        $mod[$dirname][$kind]['new_status']=$new_status;
        $mod[$dirname][$kind]['new_status_version']=$new_status_version;
        $mod[$dirname][$kind]['new_last_update']=$new_last_update;
        $mod[$dirname][$kind]['update_descript']=str_replace("\n", "\\n", $update_descript);
        $mod[$dirname][$kind]['module_sn']=$module_sn;
        $mod[$dirname][$kind]['module_descript']=str_replace("\n", "\\n", $module_descript);
        $mod[$dirname][$kind]['file_link']=$file_link;
        $mod[$dirname][$kind]['kind']=$kind;
    }
    return $mod;
}

//登入SSH
function ssh_login($ssh_host, $ssh_id, $ssh_passwd, $file_link="", $dirname="", $act="", $update_sn="", $kind_dir="modules")
{
    include(XOOPS_ROOT_PATH.'/modules/tad_adm/admin/Net/SSH2.php');

    $ssh = new Net_SSH2($ssh_host);
    if (!$ssh->login($ssh_id, $ssh_passwd)) {
        redirect_header("main.php?op={$act}_module&dirname=$dirname&file_link=$file_link", 3, sprintf(_MA_TADADM_SSH_LOGIN_FAIL, $ssh_id, $ssh_host));
    } else {
        if (empty($_SESSION['tad_adm_ssh_host'])) {
            $_SESSION['tad_adm_ssh_host']=$ssh_host;
        }
        if (empty($_SESSION['tad_adm_ssh_id'])) {
            $_SESSION['tad_adm_ssh_id']=$ssh_id;
        }
        if (empty($_SESSION['tad_adm_ssh_passwd'])) {
            $_SESSION['tad_adm_ssh_passwd']=$ssh_passwd;
        }
    }

    $the_file=str_replace("http://120.115.2.90/uploads/tad_modules/file/", "", $file_link);
    $new_file=str_replace("http://120.115.2.90/uploads/tad_modules/file/", XOOPS_ROOT_PATH."/uploads/", $file_link);

    mk_dir(XOOPS_ROOT_PATH."/uploads/tad_adm");
    copyemz($file_link, $new_file, $update_sn);

    if (!is_file($new_file)) {
        redirect_header($_SERVER['PHP_SELF'], 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
    }
    //exit;
    require_once XOOPS_ROOT_PATH."/modules/tad_adm/class/dunzip2/dUnzip2.inc.php";
    require_once XOOPS_ROOT_PATH."/modules/tad_adm/class/dunzip2/dZip.inc.php";
    $zip = new dUnzip2($new_file);
    $zip->getList();
    $zip->unzipAll(XOOPS_ROOT_PATH."/uploads/tad_adm/");
    $ssh->exec("cp -fr ".XOOPS_ROOT_PATH."/uploads/tad_adm/$dirname ".XOOPS_ROOT_PATH."/{$kind_dir}/");
    $ssh->exec("chmod -R 755 ".XOOPS_ROOT_PATH."/{$kind_dir}/$dirname");
    $ssh->exec("chown -R {$ssh_id}:{$ssh_id} ".XOOPS_ROOT_PATH."/{$kind_dir}/$dirname");
    $ssh->exec("rm -fr ".XOOPS_ROOT_PATH."/uploads/tad_adm/{$dirname}");
    $ssh->exec("rm -f $new_file");

    if (is_dir(XOOPS_ROOT_PATH."/{$kind_dir}/{$dirname}")) {
        if ($kind_dir=="modules") {
            header("location:".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin&op={$act}&module={$dirname}");
        } else {
            add_theme_config($dirname);
            if ($act=="install") {
                redirect_header($_SERVER['PHP_SELF']."?op=list_all_modules", 3, sprintf(_MA_TADADM_THEME_INSTALL_OK, $dirname));
            } else {
                redirect_header($_SERVER['PHP_SELF']."?op=list_all_modules", 3, _MA_TADADM_THEME_UPDATE_OK);
            }
        }
    } else {
        redirect_header($_SERVER['PHP_SELF'], 3, sprintf(_MA_TADADM_MV_FAIL, XOOPS_ROOT_PATH."/uploads/tad_adm/$dirname"));
    }
}


//登入ftp
function ftp_log_in($ftp_host, $ftp_id, $ftp_passwd, $file_link="", $dirname="", $act="", $update_sn="", $kind_dir="modules")
{
    $the_file=str_replace("http://120.115.2.90/uploads/tad_modules/file/", "", $file_link);
    $new_file=str_replace("http://120.115.2.90/uploads/tad_modules/file/", XOOPS_ROOT_PATH."/uploads/", $file_link);
    mk_dir(XOOPS_ROOT_PATH."/uploads/tad_adm");
    copyemz($file_link, $new_file, $update_sn);

    if (!is_file($new_file)) {
        redirect_header($_SERVER['PHP_SELF'], 3, sprintf(_MA_TADADM_DL_FAIL, $file_link));
    }

    $conn=ftp_connect($ftp_host, 21, 60);
    if ($conn) {
        if (empty($_SESSION['tad_adm_ftp_host'])) {
            $_SESSION['tad_adm_ftp_host']=$ftp_host;
        }
        if (empty($_SESSION['tad_adm_ftp_id'])) {
            $_SESSION['tad_adm_ftp_id']=$ftp_id;
        }
        if (empty($_SESSION['tad_adm_ftp_passwd'])) {
            $_SESSION['tad_adm_ftp_passwd']=$ftp_passwd;
        }

        if (!ftp_login($conn, $ftp_id, $ftp_passwd)) {
            redirect_header($_SERVER['PHP_SELF'], 3, sprintf(_MA_TADADM_FTP_LOGIN_FAIL, $ftp_id, $ftp_host));
        }
    } else {
        redirect_header($_SERVER['PHP_SELF'], 3, _MA_TADADM_FTP_FAIL);
    }

    ftp_exec($conn, "unzip -d $new_file ".XOOPS_ROOT_PATH."/$kind_dir");

    $path=explode("/", XOOPS_ROOT_PATH);
    foreach ($path as $dir) {
        ftp_chdir($conn, $dir);
    }
    ftp_chdir($conn, "uploads");
    ftp_chdir($conn, "tad_adm");

    ftp_delete($conn, "../../{$kind_dir}/{$dirname}");
    ftp_delete($conn, $new_file);
    if (ftp_rename($conn, $dirname, "../../{$kind_dir}/{$dirname}")) {
        if ($kind_dir=="modules") {
            header("location:".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin&op={$act}&module={$dirname}");
        } else {
            add_theme_config($dirname);
            if ($act=="install") {
                redirect_header($_SERVER['PHP_SELF']."?op=list_all_modules", 3, sprintf(_MA_TADADM_THEME_INSTALL_OK, $dirname));
            } else {
                redirect_header($_SERVER['PHP_SELF']."?op=list_all_modules", 3, _MA_TADADM_THEME_UPDATE_OK);
            }
        }
    } else {
        redirect_header($_SERVER['PHP_SELF'], 3, sprintf(_MA_TADADM_MV_FAIL, XOOPS_ROOT_PATH."/uploads/tad_adm/$dirname"));
    }
    ftp_close($conn);
}


// //建立目錄
// function mk_dir($dir=""){
//     //若無目錄名稱秀出警告訊息
//     if(empty($dir))return;
//     //若目錄不存在的話建立目錄
//     if (!is_dir($dir)) {
//         umask(000);
//         //若建立失敗秀出警告訊息
//         mkdir($dir, 0777);
//     }
// }

function recurse_chown_chgrp($mypath, $uid, $gid)
{
    $d = opendir($mypath) ;
    while (($file = readdir($d)) !== false) {
        if ($file != "." && $file != "..") {
            $typepath = $mypath . "/" . $file ;

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
        if (!chmod($path, $dirmode)) {
            $dirmode_str=decoct($dirmode);
            print "Failed applying filemode '$dirmode_str' on directory '$path'\n";
            print "  `-> the directory '$path' will be skipped from recursive chmod\n";
            return;
        }
        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..') {  // skip self and parent pointing directories
                $fullpath = $path.'/'.$file;
                chmod_R($fullpath, $filemode, $dirmode);
            }
        }
        closedir($dh);
    } else {
        if (is_link($path)) {
            print "link '$path' is skipped\n";
            return;
        }
        if (!chmod($path, $filemode)) {
            $filemode_str=decoct($filemode);
            print "Failed applying filemode '$filemode_str' on file '$path'\n";
            return;
        }
    }
}

//安裝套件
function install_module($file_link="", $dirname="", $act="install", $update_sn="", $kind_dir="modules")
{
    global $xoopsTpl;
    if (empty($file_link)) {
        header("location:{$_SERVER['PHP_SELF']}");
    }
    //http://120.115.2.90/uploads/tad_modules/file/tadgallery_20120726_2.01.zip

    $is_writable=is_writable(XOOPS_ROOT_PATH."/{$kind_dir}/");

    if ($is_writable) {
        $new_file=str_replace("http://120.115.2.90/uploads/tad_modules/file/", XOOPS_ROOT_PATH."/{$kind_dir}/", $file_link);
        //下載檔案 for windows
        if (copyemz($file_link, $new_file, $update_sn)) {
            module_act($new_file, $dirname, $act, $kind_dir);
        }
    } else {
        $xoopsTpl->assign('now_op', 'login_form');
        $xoopsTpl->assign('update_sn', $update_sn);
        $xoopsTpl->assign('file_link', $file_link);
        $xoopsTpl->assign('dirname', $dirname);
        $xoopsTpl->assign('act', $act);
        $xoopsTpl->assign('kind_dir', $kind_dir);
        $tad_adm_ssh_host=empty($_SESSION['tad_adm_ssh_host'])?$_SERVER['SERVER_ADDR']:$_SESSION['tad_adm_ssh_host'];
        $xoopsTpl->assign('tad_adm_ssh_host', $tad_adm_ssh_host);
        $xoopsTpl->assign('tad_adm_ssh_id', $_SESSION['tad_adm_ssh_id']);
        $xoopsTpl->assign('tad_adm_ssh_passwd', $_SESSION['tad_adm_ssh_passwd']);
        $tad_adm_ftp_host=empty($_SESSION['tad_adm_ftp_host'])?$_SERVER['SERVER_ADDR']:$_SESSION['tad_adm_ftp_host'];
        $xoopsTpl->assign('tad_adm_ftp_host', $tad_adm_ftp_host);
        $xoopsTpl->assign('tad_adm_ftp_id', $_SESSION['tad_adm_ftp_id']);
        $xoopsTpl->assign('tad_adm_ftp_passwd', $_SESSION['tad_adm_ftp_passwd']);
    }
}


function module_act($new_file="", $dirname="", $act="install", $kind_dir="modules")
{
    global $xoopsConfig;

    if (is_file($new_file)) {
        require_once XOOPS_ROOT_PATH."/modules/tad_adm/class/dunzip2/dUnzip2.inc.php";
        require_once XOOPS_ROOT_PATH."/modules/tad_adm/class/dunzip2/dZip.inc.php";
        $zip = new dUnzip2($new_file);
        $zip->getList();
        $zip->unzipAll(XOOPS_ROOT_PATH."/{$kind_dir}/");
        $zip->close($new_file);
        unlink($new_file);

        chmod_R(XOOPS_ROOT_PATH."/{$kind_dir}/{$dirname}", 0755, 0755);

        include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
        $token=new XoopsFormHiddenToken();
        $token_code=$token->render();
        if ($kind_dir=="modules") {
            if ($act=="install") {
                $op="install_ok";
                $hidden="<input type='hidden' value='{$dirname}' name='module'>";
                $title=_MA_TADADM_MODULES_INSTALLING;
            } else {
                $op="update_ok";
                $hidden="<input type='hidden' value='{$dirname}' name='dirname'>";
                $title=_MA_TADADM_MODULES_UPDATING;
            }


            require(XOOPS_ROOT_PATH."/modules/{$dirname}/xoops_version.php");
            require(XOOPS_ROOT_PATH."/modules/{$dirname}/language/{$xoopsConfig['language']}/modinfo.php");

            $mod_name=constant($modversion['name']);

            $main="
      <link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadtools/bootstrap/css/bootstrap.css' />
      <link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadtools/bootstrap/css/bootstrap-responsive.css' />
      <link rel='stylesheet' type='text/css' media='screen' href='".XOOPS_URL."/modules/tadtools/css/xoops_adm.css' />
      <div class='well'>
        <form action='".XOOPS_URL."/modules/system/admin.php' method='post' style='text-align:center'>
          <img src='".XOOPS_URL."/modules/{$dirname}/{$modversion['image']}'>
          <div style='font-weight:bold;font-size:11pt;'>{$mod_name}</div>
          $hidden
          <input type='hidden' value='{$op}' name='op'>
          <input type='hidden' value='modulesadmin' name='fct'>
          $token_code
          <input type='submit' title='".$title."' value='".$title."' name='confirm_submit'>
        </form>
      </div>
      ";
            die($main);
            //header("location:".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin&op={$act}&module={$dirname}");
        } else {
            add_theme_config($dirname);
            if ($act=="install") {
                redirect_header($_SERVER['PHP_SELF']."?op=list_all_modules", 3, sprintf(_MA_TADADM_THEME_INSTALL_OK, $dirname));
            } else {
                redirect_header($_SERVER['PHP_SELF']."?op=list_all_modules", 3, _MA_TADADM_THEME_UPDATE_OK);
            }
        }
    } else {
        return false;
    }
}


function add_theme_config($theme)
{
    global $xoopsConfig,$xoopsDB;
    if (!in_array($theme, $xoopsConfig['theme_set_allowed'])) {
        $xoopsConfig['theme_set_allowed'][]=$theme;
        $theme_set_allowed=serialize($xoopsConfig['theme_set_allowed']);
        $sql="update ".$xoopsDB->prefix("config")." set conf_value='{$theme_set_allowed}' where conf_name='theme_set_allowed'";

        $xoopsDB->queryF($sql) or die($sql."<br>". mysql_error());

        $sql = "INSERT INTO `".$xoopsDB->prefix("tadtools_setup")."` (`tt_theme` , `tt_use_bootstrap`,`tt_bootstrap_color`) values('{$theme}', '0', 'bootstrap' ) ON DUPLICATE KEY UPDATE `tt_use_bootstrap` = '0',`tt_bootstrap_color`='bootstrap'";

        $xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'], 3, mysql_error());
    }
}

function copyemz($file1, $file2, $update_sn)
{
    global $xoopsConfig;
    $add_count_url="http://120.115.2.90/modules/tad_modules/api.php?update_sn={$update_sn}&from=".XOOPS_URL."&sitename={$xoopsConfig['sitename']}";

    $url=$file1;
    if (function_exists('curl_init')) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $contentx = curl_exec($ch);
        curl_close($ch);

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $add_count_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $count = curl_exec($ch);
        curl_close($ch);
    } elseif (function_exists('file_get_contents')) {
        $contentx = file_get_contents($url);
        $count = file_get_contents($add_count_url);
    } else {
        $handle = fopen($url, "rb");
        $contentx = stream_get_contents($handle);
        fclose($handle);

        $handle = fopen($add_count_url, "rb");
        $count = stream_get_contents($handle);
        fclose($handle);
    }

    $openedfile = fopen($file2, "w");
    fwrite($openedfile, $contentx);
    fclose($openedfile);
    if ($contentx === false) {
        $status=false;
    } else {
        $status=true;
    }

    return $status;
}
