<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2012-11-26
// $Id:$
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_adm_adm_main.html";
include_once "header.php";
include_once "../function.php";

/*-----------function區--------------*/

//列出所有模組
function list_modules(){
	global $xoopsDB,$xoopsModuleConfig,$xoopsTpl;

	$sql="select * from ".$xoopsDB->prefix("modules")." where isactive='1' order by weight";
	$result = $xoopsDB->query($sql) or die($sql."<br>". mysql_error());

  $i=0;
  $all_data="";
	while($data=$xoopsDB->fetchArray($result)){
    foreach($data as $k=>$v){
      $$k=$v;
    }

    $handle = fopen("http://campus-xoops.tn.edu.tw/uploads/tad_modules/{$dirname}.txt", "rb");
    $new_version = stream_get_contents($handle);
    fclose($handle);
    list($new_version,$new_status,$new_status_version,$new_last_update)=explode("-",$new_version);
    $status=($new_status_version)?" {$new_status}{$new_status_version}":"";

    $all_data[$i]['mid']=$mid;
    $all_data[$i]['name']=$name;
    $all_data[$i]['version']=round( $version / 100, 2 );
    $all_data[$i]['new_version']=($new_version)?$new_version.$status:"";
    $all_data[$i]['last_update']=date("Y-m-d H:i",$last_update);
    $all_data[$i]['new_last_update']=($new_last_update)?date("Y-m-d H:i",$new_last_update):"";
    $all_data[$i]['weight']=$weight;
    $all_data[$i]['isactive']=$isactive;
    $all_data[$i]['dirname']=$dirname;
    $all_data[$i]['hasmain']=$hasmain?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hasadmin']=$hasadmin?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hassearch']=$hassearch?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hasconfig']=$hasconfig?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hascomments']=$hascomments?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['hasnotification']=$hasnotification?_MA_TADADM_1:_MA_TADADM_0;
    $all_data[$i]['function']=($new_last_update > $last_update)?true:false;

    $i++;
  }

  if(empty($all_data)){
    redirect_header($_SERVER['PHP_SELF'],3, _MA_TADADM_NO_MODS);
    exit;
  }

  $xoopsTpl->assign('all_data',$all_data);
}

/*-----------執行動作判斷區----------*/
$op = empty($_REQUEST['op'])? "":$_REQUEST['op'];

switch($op){
	/*---判斷動作請貼在下方---*/
	default:
	list_modules();
	break;
	/*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
include_once 'footer.php';
?>