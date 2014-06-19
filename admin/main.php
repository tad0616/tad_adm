<?php
/*-----------引入檔案區--------------*/
$xoopsOption['template_main'] = "tad_adm_adm_main.html";
include_once "header.php";
include_once "../function.php";
require "adm_function.php";

/*-----------function區--------------*/



/*-----------執行動作判斷區----------*/
$op = empty($_REQUEST['op'])? "":$_REQUEST['op'];
$update_sn = empty($_REQUEST['update_sn'])? "":intval($_REQUEST['update_sn']);
$file_link = empty($_REQUEST['file_link'])? "":$_REQUEST['file_link'];
$dirname = empty($_REQUEST['dirname'])? "":$_REQUEST['dirname'];
$act = empty($_REQUEST['act'])? "":$_REQUEST['act'];
$kind_dir = empty($_REQUEST['kind_dir'])? "":$_REQUEST['kind_dir'];
$ssh_id = empty($_POST['ssh_id'])? "":$_POST['ssh_id'];
$ssh_passwd = empty($_POST['ssh_passwd'])? "":$_POST['ssh_passwd'];
$ssh_host = empty($_POST['ssh_host'])? "":$_POST['ssh_host'];
$ftp_id = empty($_POST['ftp_id'])? "":$_POST['ftp_id'];
$ftp_passwd = empty($_POST['ftp_passwd'])? "":$_POST['ftp_passwd'];
$ftp_host = empty($_POST['ftp_host'])? "":$_POST['ftp_host'];

switch($op){
  /*---判斷動作請貼在下方---*/
  case "install_module":
  install_module($file_link,$dirname,"install",$update_sn,'modules');
  break;

  case "update_module":
  install_module($file_link,$dirname,"update",$update_sn,'modules');
  break;

  case "ssh_login":
  ssh_login($ssh_host,$ssh_id,$ssh_passwd,$file_link,$dirname,$act,$update_sn,$kind_dir);
  break;

  case "ftp_login":
  ftp_log_in($ftp_host,$ftp_id,$ftp_passwd,$file_link,$dirname,$act,$update_sn,$kind_dir);
  break;

  case "install_theme":
  install_module($file_link,$dirname,"install",$update_sn,'themes');
  break;

  case "update_theme":
  install_module($file_link,$dirname,"update",$update_sn,'themes');
  break;

  default:
  list_modules();
  break;
  /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
include_once 'footer.php';
?>