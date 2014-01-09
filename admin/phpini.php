<?php
//  ------------------------------------------------------------------------ //
// 本模組由 tad 製作
// 製作日期：2012-11-26
// $Id:$
// ------------------------------------------------------------------------- //

/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_adm_adm_phpini.html";
include_once "header.php";
include_once "../function.php";

/*-----------function區--------------*/
//
function phpini(){
	global $xoopsDB,$xoopsConfig,$xoopsTpl;

  include_once "../language/{$xoopsConfig['language']}/ini_arr.php";

  $allini=ini_get_all();
  //die(var_export(ini_get_all()));


  $i=0;
  $main="";
  foreach($allini as $k=>$v){
    $global_value=str_replace(',',' , ',$v['global_value']);

    $main[$i]['k']=$k;
    $main[$i]['global_value']=$global_value;
    $main[$i]['ini']=isset($ini[$k])?$ini[$k]:"";
    $i++;
  }

  $xoopsTpl->assign('main', $main);
}


/*-----------執行動作判斷區----------*/
$op = empty($_REQUEST['op'])? "":$_REQUEST['op'];
$g2p=empty($_REQUEST['g2p'])?1:$_REQUEST['g2p'];


switch($op){
	/*---判斷動作請貼在下方---*/

	default:
	$main=phpini($op);
	break;

	/*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
include_once 'footer.php';
?>