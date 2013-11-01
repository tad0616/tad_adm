<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_adm_adm_main.html";
include_once "header.php";
include_once "../function.php";

/*-----------function區--------------*/

//列出所有模組
function list_modules(){
  global $xoopsDB,$xoopsModuleConfig,$xoopsTpl;
  $mod=get_tad_modules_info();
  $sql="select * from ".$xoopsDB->prefix("modules")." where isactive='1' order by weight";
  $result = $xoopsDB->query($sql) or die($sql."<br>". mysql_error());

  $i=0;
  $all_data="";
  while($data=$xoopsDB->fetchArray($result)){
    foreach($data as $k=>$v){
      $$k=$v;
    }
    $ok[]=$dirname;

    $status=($mod[$dirname]['new_status_version'])?" {$mod[$dirname]['new_status']}{$mod[$dirname]['new_status_version']}":"";

    $all_data[$i]['mid']=$mid;
    $all_data[$i]['name']=$name;
    $all_data[$i]['version']=round( $version / 100, 2 );
    $all_data[$i]['new_version']=($mod[$dirname]['new_version'])?$mod[$dirname]['new_version'].$status:"";

    $all_data[$i]['last_update']=date("Y-m-d H:i",$last_update);
    $all_data[$i]['new_last_update']=($mod[$dirname]['new_last_update'])?date("Y-m-d H:i",$mod[$dirname]['new_last_update']):"";
    $all_data[$i]['weight']=$weight;
    $all_data[$i]['isactive']=$isactive;
    $all_data[$i]['dirname']=$dirname;
    $all_data[$i]['hasmain']=$hasmain?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hasadmin']=$hasadmin?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hassearch']=$hassearch?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hasconfig']=$hasconfig?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hascomments']=$hascomments?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hasnotification']=$hasnotification?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['function']=($mod[$dirname]['new_last_update'] > $last_update)?'update':false;
    $all_data[$i]['update_sn']=$mod[$dirname]['update_sn'];
    $all_data[$i]['descript']=$mod[$dirname]['update_descript'];
    $all_data[$i]['module_sn']=$mod[$dirname]['module_sn'];
    $all_data[$i]['file_link']=$mod[$dirname]['file_link'];

    $i++;
  }

  foreach($mod as $dirname=>$data){
    if(in_array($dirname,$ok))continue;

    $status=($data['new_status_version'])?" {$data['new_status']}{$data['new_status_version']}":"";
    $all_data[$i]['mid']="";
    $all_data[$i]['name']=$data['module_title'];
    $all_data[$i]['version']="";
    $all_data[$i]['new_version']=($data['new_version'])?$data['new_version'].$status:"";

    $all_data[$i]['last_update']=_MA_TADADM_MOD_UNINSTALL;
    $all_data[$i]['new_last_update']=($data['new_last_update'])?date("Y-m-d H:i",$data['new_last_update']):"";
    $all_data[$i]['weight']="";
    $all_data[$i]['isactive']="";
    $all_data[$i]['dirname']=$dirname;
    $all_data[$i]['hasmain']="";
    $all_data[$i]['hasadmin']="";
    $all_data[$i]['hassearch']="";
    $all_data[$i]['hasconfig']="";
    $all_data[$i]['hascomments']="";
    $all_data[$i]['hasnotification']="";
    $all_data[$i]['function']="install";
    $all_data[$i]['update_sn']=$data['update_sn'];
    $all_data[$i]['descript']=$data['module_descript'];
    $all_data[$i]['module_sn']=$data['module_sn'];
    $all_data[$i]['file_link']=$data['file_link'];

    $i++;
  }

  if(empty($all_data)){
    redirect_header($_SERVER['PHP_SELF'],3, _MA_TADADM_NO_MODS);
    exit;
  }

  $xoopsTpl->assign('all_data',$all_data);
}

//取得更新訊息
function get_tad_modules_info(){
  $url="http://120.115.2.90/uploads/tad_modules/all.txt";
  if(function_exists('curl_init')) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
  } elseif(function_exists('file_get_contents')) {
    $data = file_get_contents($url);
  }else{
    $handle = fopen($url, "rb");
    $data = stream_get_contents($handle);
    fclose($handle);
  }
  $all=explode('||',$data);
  foreach($all as $arr_data){
    list($module_title,$dirname,$update_sn,$new_version,$new_status,$new_status_version,$new_last_update,$file_link,$update_descript,$module_sn,$module_descript)=explode("-+-",$arr_data);
    $mod[$dirname]['module_title']=$module_title;
    $mod[$dirname]['update_sn']=$update_sn;
    $mod[$dirname]['new_version']=$new_version;
    $mod[$dirname]['new_status']=$new_status;
    $mod[$dirname]['new_status_version']=$new_status_version;
    $mod[$dirname]['new_last_update']=$new_last_update;
    $mod[$dirname]['update_descript']=str_replace("\n", "\\n", $update_descript);
    $mod[$dirname]['module_sn']=$module_sn;
    $mod[$dirname]['module_descript']=str_replace("\n", "\\n", $module_descript);
    $mod[$dirname]['file_link']=$file_link;
  }
  return $mod;
}

//安裝模組
function install_module($file_link="",$dirname=""){
  if(empty($file_link))header("location:main.php");
  //http://120.115.2.90/uploads/tad_modules/file/tadgallery_20120726_2.01.zip
  $new_file=str_replace("http://120.115.2.90/uploads/tad_modules/file/", XOOPS_ROOT_PATH."/modules/", $file_link);
  //下載檔案 for windows
  copyemz($file_link, $new_file);

  require_once "../class/dunzip2/dUnzip2.inc.php";
  require_once "../class/dunzip2/dZip.inc.php";
  $zip = new dUnzip2($new_file);
  $zip->getList();
  $zip->unzipAll(XOOPS_ROOT_PATH."/modules/");
  header("location:".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin&op=install&module={$dirname}");
}


//更新模組
function update_module($file_link="",$dirname=""){
  if(empty($file_link))header("location:main.php");
  //http://120.115.2.90/uploads/tad_modules/file/tadgallery_20120726_2.01.zip
  $new_file=str_replace("http://120.115.2.90/uploads/tad_modules/file/", XOOPS_ROOT_PATH."/modules/", $file_link);
  unlink($new_file);
  //下載檔案 for windows
  copyemz($file_link, $new_file);

  require_once "../class/dunzip2/dUnzip2.inc.php";
  require_once "../class/dunzip2/dZip.inc.php";
  $zip = new dUnzip2($new_file);
  $zip->getList();
  $zip->unzipAll(XOOPS_ROOT_PATH."/modules/");
  header("location:".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin&op=update&module={$dirname}");
}


function copyemz($file1,$file2){
  $url=$file1;
  if(function_exists('curl_init')) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $contentx = curl_exec($ch);
    curl_close($ch);
  } elseif(function_exists('file_get_contents')) {
    $contentx = file_get_contents($url);
  }else{
    $handle = fopen($url, "rb");
    $contentx = stream_get_contents($handle);
    fclose($handle);
  }

  $openedfile = fopen($file2, "w");
  fwrite($openedfile, $contentx);
  fclose($openedfile);
  if ($contentx === FALSE) {
    $status=false;
  }else $status=true;

  return $status;
}

/*-----------執行動作判斷區----------*/
$op = empty($_REQUEST['op'])? "":$_REQUEST['op'];
$file_link = empty($_REQUEST['file_link'])? "":$_REQUEST['file_link'];
$dirname = empty($_REQUEST['dirname'])? "":$_REQUEST['dirname'];

switch($op){
  /*---判斷動作請貼在下方---*/
  case "install_module":
  install_module($file_link,$dirname);
  break;

  case "update_module":
  update_module($file_link,$dirname);
  break;

  default:
  list_modules();
  break;
  /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
include_once 'footer.php';
?>