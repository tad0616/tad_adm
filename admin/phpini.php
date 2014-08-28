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

  $show_ini=array('allow_url_fopen','date.timezone','display_errors','file_uploads','max_execution_time','max_file_uploads','max_input_time','max_input_vars','memory_limit','post_max_size','short_open_tag','upload_max_filesize');

  $adv_val=array(
    'allow_url_fopen'=>'1',
    'date.timezone'=>'Asia/Taipei',
    'display_errors'=>'1',
    'file_uploads'=>'1',
    'max_execution_time'=>'150',
    'max_file_uploads'=>'300',
    'max_input_time'=>'120',
    'max_input_vars'=>'5000',
    'memory_limit'=>'240M',
    'post_max_size'=>'220M',
    'short_open_tag'=>'1',
    'upload_max_filesize'=>'200M'
    );

  $allini=ini_get_all();
  //die(var_export(ini_get_all()));


  $i=0;
  $main="";
  foreach($allini as $k=>$v){

    if(!in_array($k, $show_ini)){
      continue;
    }

    $global_value=str_replace(',',' , ',$v['global_value']);

    $main[$i]['k']=$k;
    $main[$i]['global_value']=$global_value;
    $main[$i]['ini']=isset($ini[$k])?$ini[$k]:"";
    $main[$i]['adv']=$adv_val[$k];
    if($adv_val[$k]==$global_value){
      $color="#000000";
    }elseif($global_value > $adv_val[$k]){
      $color="#3B5E7F";
    }else{
      $color="red";
    }

    $main[$i]['color']=$color;
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