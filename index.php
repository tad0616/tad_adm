<?php
include_once "../../mainfile.php";

$op=isset($_REQUEST['op'])?$_REQUEST['op']:"";

if($xoopsUser) {
  $_SESSION['isAdmin']=$xoopsUser->isAdmin(1);
}elseif($op=="helpme"){
  $modhandler = &xoops_gethandler('module');
  $xoopsModule = &$modhandler->getByDirname("tad_adm");
  $config_handler =& xoops_gethandler('config');
  $xoopsModuleConfig =& $config_handler->getConfigsByCat(0, $xoopsModule->getVar('mid'));
  $_SESSION['isAdmin']=($xoopsModuleConfig['login']==$_POST['help_passwd'])?true:false;
}

if(!$_SESSION['isAdmin']){
  die('
  <!DOCTYPE html>
  <html lang="'._LANGCODE.'">
    <head>
      <meta charset="'._CHARSET.'">
      <title>'._MD_TADADM_NAME.'</title>
      <!-- Bootstrap -->
      <link href="'.XOOPS_URL.'/modules/tadtools/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
      <link href="'.XOOPS_URL.'/modules/tadtools/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    </head>
    <body>
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="page-header">
            <h1>'._MD_TADADM_NAME.'</h1>
          </div>
          <div class="row-fluid">
            <div class="span12">
            <form  class="well" action="'.$_SERVER['PHP_SELF'].'" method="post">
            <label>'._MD_TADADM_INPUT_PASSWD.'</label>
            <input type="text" name="help_passwd" class="span3" placeholder="'._MD_TADADM_INPUT_PASSWD.'...">
            <input type="hidden" name="op" value="helpme">
            <p class="help-block">'._MD_TADADM_INPUT_PASSWD_DESC.'...</p>
            <button type="submit" class="btn">'._MD_TADADM_LOGIN.'</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </body>
  </html>
  ');
}

$logout=($xoopsUser)?XOOPS_URL."/user.php?op=logout":"index.php?op=logout";


$v=isset($_REQUEST['v'])?$_REQUEST['v']:"0";

switch($op){
  case "debug_mode";
  debug_mode($v);
  header("location: {$_SERVER['PHP_SELF']}");
  break;

  case "clear_cache";
  clear_cache();
  header("location: {$_SERVER['PHP_SELF']}");
  break;

  case "clear_session";
  clear_session();
  header("location: {$_SERVER['PHP_SELF']}");
  break;

  case "theme_default";
  theme_default();
  header("location: {$_SERVER['PHP_SELF']}");
  break;

  case "close_site";
  close_site($v);
  header("location: {$_SERVER['PHP_SELF']}");
  break;

  case "logout";
  $_SESSION['isAdmin']=false;
  header("location: {$_SERVER['PHP_SELF']}");
  break;

}

//目前硬碟空間
function get_free_space(){
    $bytes = disk_free_space(".");
    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    $base = 1024;
    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    $space= sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
    return $space;
}


//改回預設佈景
function theme_default(){
  global $xoopsDB;

	$sql="update ".$xoopsDB->prefix("config")." set conf_value='default' where conf_name='theme_set'";
	$xoopsDB->queryF($sql) or die($sql."<br>". mysql_error());
}

//清除 session
function clear_session(){
  global $xoopsDB;
	$sql="TRUNCATE TABLE ".$xoopsDB->prefix("session")."";
	$xoopsDB->queryF($sql) or die($sql."<br>". mysql_error());
}

//清除快取
function clear_cache(){
	$dirname=XOOPS_VAR_PATH."/caches/smarty_compile";
	if(is_dir($dirname)){
    delete_directory($dirname) ;
    $fp = fopen("{$dirname}/index.html", 'w');
    fwrite($fp, '<script>history.go(-1);</script>');
    fclose($fp);
  }
}

//刪除目錄檔案
function delete_directory($dirname) {
    if (is_dir($dirname))
        $dir_handle = opendir($dirname);
    if (!$dir_handle)
        return false;
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file))
                unlink($dirname."/".$file);
            else
                delete_directory($dirname.'/'.$file);
        }
    }
    closedir($dir_handle);
    //rmdir($dirname);
    return true;
}

//session 資料表容量
function session_size(){
  global $xoopsDB;
	$sql="show table status where name='".$xoopsDB->prefix("session")."'";
	$result=$xoopsDB->queryF($sql) or die($sql."<br>". mysql_error());
  $row=$xoopsDB->fetchArray($result);

  $bytes = ($row['Data_length'] + $row['Index_length']);

  $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
  $base = 1024;
  $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
  $space= sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];

  return sprintf(_MD_TADADM_BRACKETS,$space);
}


//取得目錄下的檔案數
function files_counter(){
	$dirname=XOOPS_VAR_PATH."/caches/smarty_compile/";
  if (glob($dirname . "*.php") != false){
   $filecount = count(glob($dirname . "*.php"));
   return sprintf(_MD_TADADM_FILES_COUNT,$filecount);;
  }
}


//修改關站狀態
function close_site($v=0){
  global $xoopsDB;

	$sql="update ".$xoopsDB->prefix("config")." set conf_value='$v' where conf_name='closesite'";
	$xoopsDB->queryF($sql) or die($sql."<br>". mysql_error());
}


//修改除錯模式
function debug_mode($v=0){
  global $xoopsDB;

	$sql="update ".$xoopsDB->prefix("config")." set conf_value='$v' where conf_name='debug_mode'";
	$xoopsDB->queryF($sql) or die($sql."<br>". mysql_error());
}



function debug_mode_tool(){
  global $xoopsDB;

	$sql="select conf_value from ".$xoopsDB->prefix("config")." where conf_name='debug_mode'";
	$result = $xoopsDB->queryF($sql) or die($sql."<br>". mysql_error());
	list($debug)=$xoopsDB->fetchRow($result);
	if($debug==1){
    $debug_tool="
    <li><a href='index.php?op=debug_mode&v=0'><i class='icon-envelope'  title='".sprintf(_MD_TADADM_UNABLE_DEBUG,"PHP")."'></i>".sprintf(_MD_TADADM_UNABLE_DEBUG,"PHP")."</a></li>
    <li><a href='index.php?op=debug_mode&v=3'><i class='icon-envelope'  title='".sprintf(_MD_TADADM_ENABLE_DEBUG,"Smarty")."'></i>".sprintf(_MD_TADADM_ENABLE_DEBUG,"Smarty")."</a></li>";
  }elseif($debug==3){
    $debug_tool="
    <li><a href='index.php?op=debug_mode&v=1'><i class='icon-envelope'  title='".sprintf(_MD_TADADM_ENABLE_DEBUG,"PHP")."'></i>".sprintf(_MD_TADADM_ENABLE_DEBUG,"PHP")."</a></li>
    <li><a href='index.php?op=debug_mode&v=0'><i class='icon-envelope'  title='".sprintf(_MD_TADADM_UNABLE_DEBUG,"Smarty")."'></i>".sprintf(_MD_TADADM_UNABLE_DEBUG,"Smarty")."</a></li>";

  }else{
    $debug_tool="
    <li><a href='index.php?op=debug_mode&v=1'><i class='icon-envelope'  title='".sprintf(_MD_TADADM_ENABLE_DEBUG,"PHP")."'></i>".sprintf(_MD_TADADM_ENABLE_DEBUG,"PHP")."</a></li>
    <li><a href='index.php?op=debug_mode&v=3'><i class='icon-envelope'  title='".sprintf(_MD_TADADM_ENABLE_DEBUG,"Smarty")."'></i>".sprintf(_MD_TADADM_ENABLE_DEBUG,"Smarty")."</a></li>";
  }
  return $debug_tool;
}



//MySQL版本
ob_start();
phpinfo(INFO_MODULES);
$phpinfo = ob_get_contents();
ob_end_clean();
$info = stristr($phpinfo, 'Client API version');
preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match);
$gd = $match[0];

//檢查連線
$mysql_connect=mysql_connect(XOOPS_DB_HOST, XOOPS_DB_USER, XOOPS_DB_PASS)?"OK":_MD_TADADM_CANT_CONNECT;

$other="";
if($mysql_connect=="OK"){

  //註冊人數
	$sql="select count(*) from ".$xoopsDB->prefix("users")."";
	$result = $xoopsDB->query($sql) or die($sql."<br>". mysql_error());
	list($all_user_count)=$xoopsDB->fetchRow($result);

  //從未登入人數
	$sql="select count(*) from ".$xoopsDB->prefix("users")." where last_login=0";
	$result = $xoopsDB->query($sql) or die($sql."<br>". mysql_error());
	list($never_login_user_count)=$xoopsDB->fetchRow($result);

  //未啟用人數
	$sql="select count(*) from ".$xoopsDB->prefix("users")." where user_regdate=0";
	$result = $xoopsDB->query($sql) or die($sql."<br>". mysql_error());
	list($never_start_user_count)=$xoopsDB->fetchRow($result);

  //正常會員人數
	$sql="select count(*) from ".$xoopsDB->prefix("users")." where user_regdate!=0 and last_login!=0";
	$result = $xoopsDB->query($sql) or die($sql."<br>". mysql_error());
	list($normal_user_count)=$xoopsDB->fetchRow($result);

  //各群組人數
	$sql="select a.`groupid`, a.`uid`, b.`name` from ".$xoopsDB->prefix("groups_users_link")." as a left join ".$xoopsDB->prefix("groups")." as b on a.`groupid` = b.`groupid`";
	$result = $xoopsDB->query($sql) or die($sql."<br>". mysql_error());
	while(list($groupid ,$uid , $name)=$xoopsDB->fetchRow($result)){
    $groupid_count[$groupid]++;
    $group_name[$groupid]=$name;
  }
  sort($groupid_count);
  $groupid_count_list="<li class=\"divider\"></li>";
  foreach($groupid_count as $groupid => $counter){
    if($groupid==0){
      $gname=_MD_TADADM_NO_GROUP;
    }elseif($groupid==3){
      $gname=_MD_TADADM_GUEST;
    }else{
      $gname=empty($group_name[$groupid])?_MD_TADADM_SOME_GROUP." {$groupid}":$group_name[$groupid];
    }
    $groupid_count_list.="<li><i class='icon-envelope'  title='".sprintf(_MD_TADADM_GROUP_COUNTEER,$gname,$counter)."'></i>".sprintf(_MD_TADADM_GROUP_COUNTEER,$gname,$counter)."</li>";
  }


  $other="<li class=\"divider\"></li>
  <li><i class='icon-envelope'  title='XOOPS "._MD_TADADM_MEM_AMOUNT."'></i>XOOPS "._MD_TADADM_MEM_AMOUNT.": ".$all_user_count." "._MD_TADADM_PEOPLE."</li>
  <li><i class='icon-envelope'  title='XOOPS "._MD_TADADM_AVAILABLE_MEM_AMOUNT."'></i>XOOPS "._MD_TADADM_AVAILABLE_MEM_AMOUNT.": ".$normal_user_count." "._MD_TADADM_PEOPLE."</li>
  <li><i class='icon-envelope'  title='XOOPS "._MD_TADADM_UNAVAILABLE_MEM_AMOUNT."'></i>XOOPS "._MD_TADADM_UNAVAILABLE_MEM_AMOUNT." :".$never_start_user_count." "._MD_TADADM_PEOPLE."</li>
  <li><i class='icon-envelope'  title='XOOPS "._MD_TADADM_NEVER_LOGIN."'></i>XOOPS "._MD_TADADM_NEVER_LOGIN.": ".$never_login_user_count." "._MD_TADADM_PEOPLE."</li>
  $groupid_count_list
  ";
}

$main1="
<fieldset>
  <legend>"._MD_TADADM_SYSTEM_INFO."</legend>
  <ul class='nav nav-list'>
    <li><i class='icon-envelope'  title='XOOPS "._MD_TADADM_VERSION."'></i>XOOPS "._MD_TADADM_VERSION.": ".XOOPS_VERSION."</li>
    <li><i class='icon-envelope'  title='XOOPS "._MD_TADADM_LANGUAGE."'></i>XOOPS "._MD_TADADM_LANGUAGE.": ".$xoopsConfig['language']."</li>
    <li><i class='icon-envelope'  title='PHP "._MD_TADADM_VERSION."'></i>PHP "._MD_TADADM_VERSION.": ".phpversion()."</li>
    <li><i class='icon-envelope'  title='MySQL "._MD_TADADM_VERSION."'></i>MySQL "._MD_TADADM_VERSION.": ".$gd."</li>
    <li><i class='icon-envelope'  title='MySQL "._MD_TADADM_CONNECT."'></i>MySQL "._MD_TADADM_CONNECT.": ".$mysql_connect."</li>
    $other
    <li class=\"divider\"></li>
    <li><i class='icon-envelope'  title='"._MD_TADADM_AVAILABLE_SPACE."'></i>"._MD_TADADM_AVAILABLE_SPACE.": ".get_free_space()."</li>
  </ul>
</fieldset>";


$theme_set=($xoopsConfig['theme_set']=='default')?"":"<li><a href='index.php?op=theme_default'><i class='icon-envelope'  title='"._MD_TADADM_DEFAULT_THEME."'></i>".sprintf(_MD_TADADM_DEFAULT_THEME_DESC,$xoopsConfig['theme_set'])."</a></li>";

$main2="
<fieldset>
  <legend>"._MD_TADADM_AID."</legend>
  <ul class='nav nav-list'>
    ".debug_mode_tool()."
    <li><a href='index.php?op=clear_cache'><i class='icon-envelope'  title='"._MD_TADADM_CLEAR_CACHE."'></i>"._MD_TADADM_CLEAR_CACHE.files_counter()."</a></li>
    <li><a href='index.php?op=clear_session'><i class='icon-envelope'  title='"._MD_TADADM_CLEAR_SESSION."'></i>"._MD_TADADM_CLEAR_SESSION.session_size()."</a></li>
    $theme_set

  </ul>
</fieldset>";



$close_site=$xoopsConfig['closesite']=='1'?"<li><a href='index.php?op=close_site&v=0'><i class='icon-envelope'  title='"._MD_TADADM_ENABLE_WEB."'></i>"._MD_TADADM_ENABLE_WEB."</a></li>":"<li><a href='index.php?op=close_site&v=1'><i class='icon-envelope'  title='"._MD_TADADM_UNABLE_WEB."'></i>"._MD_TADADM_UNABLE_WEB."</a></li>";
$main3="
<fieldset>
  <legend>"._MD_TADADM_WEB_FUNCTION."</legend>
  <ul class='nav nav-list'>
    $close_site
    <li><a href='index.php?op=reset_root'><i class='icon-envelope'  title='"._MD_TADADM_RESET_ADMIN_PASSWD."'></i>"._MD_TADADM_RESET_ADMIN_PASSWD."</a></li>
    <li><a href='index.php?op=reset_mem'><i class='icon-envelope'  title='"._MD_TADADM_RESET_MEM_PASSWD."'></i>"._MD_TADADM_RESET_MEM_PASSWD."</a></li>
    <li><a href='index.php?op=unable_blocks'><i class='icon-envelope'  title='"._MD_TADADM_UNABLE_ALL_BLOCKS."'></i>"._MD_TADADM_UNABLE_ALL_BLOCKS."</a></li>
    <li><a href='index.php?op=unable_modules'><i class='icon-envelope'  title='"._MD_TADADM_UNABLE_ALL_MODS."'></i>"._MD_TADADM_UNABLE_ALL_MODS."</a></li>
  </ul>
</fieldset>";

$into_admin=($xoopsUser)?"<li><a href='".XOOPS_URL."/admin.php' target='_blank'><i class='icon-envelope'  title='"._MD_TADADM_ADMIN."'></i>"._MD_TADADM_ADMIN."</a></li>":"";
$into_setup=($xoopsUser)?"<li><a href='".XOOPS_URL."/modules/system/admin.php?fct=preferences&op=show&confcat_id=1' target='_blank'><i class='icon-envelope'  title='"._MD_TADADM_PREFERENCES."'></i>"._MD_TADADM_PREFERENCES."</a></li>":"";
$into_module=($xoopsUser)?"<li><a href='".XOOPS_URL."/modules/system/admin.php?fct=modulesadmin' target='_blank'><i class='icon-envelope'  title='"._MD_TADADM_MODULES."'></i>"._MD_TADADM_MODULES."</a></li>":"";

$main4="
<fieldset>
  <legend>"._MD_TADADM_LINKS."</legend>
  <ul class='nav nav-list'>
    <li><a href='".XOOPS_URL."' target='_blank'><i class='icon-envelope'  title='"._MD_TADADM_LINK_TO." ".XOOPS_URL."'></i>"._MD_TADADM_LINK_TO." ".XOOPS_URL."</a></li>
    <li><a href='".XOOPS_URL."/user.php' target='_blank'><i class='icon-envelope'  title='"._MD_TADADM_LOGIN_PAGE."'></i>"._MD_TADADM_LOGIN_PAGE."</a></li>
    $into_admin
    $into_setup
    $into_module
    <li><a href='pma.php' target='_blank'><i class='icon-envelope'  title='"._MD_TADADM_DB."'></i>"._MD_TADADM_DB."</a></li>
    <li><a href='$logout' target='_blank'><i class='icon-envelope'  title='"._MD_TADADM_LOGOUT."'></i>"._MD_TADADM_LOGOUT."</a></li>

  </ul>
</fieldset>";


echo '
<!DOCTYPE html>
<html lang="'._LANGCODE.'">
  <head>
    <meta charset="'._CHARSET.'">
    <title>'._MD_TADADM_NAME.'</title>
    <!-- Bootstrap -->
    <link href="'.XOOPS_URL.'/modules/tadtools/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="'.XOOPS_URL.'/modules/tadtools/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
  </head>
  <body>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="page-header">
          <h1>'._MD_TADADM_NAME.'</h1>
        </div>
        <div class="row-fluid">
          <div class="span3">'.$main1.'</div>
          <div class="span3">'.$main2.'</div>
          <div class="span3">'.$main3.'</div>
          <div class="span3">'.$main4.'</div>
        </div>
      </div>
    </div>
  </div>


  </body>
</html>
';

?>

