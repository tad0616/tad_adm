<?php
include_once "../../tadtools/language/{$xoopsConfig['language']}/admin_common.php";
define("_TAD_NEED_TADTOOLS"," 需要 tadtools 模組，可至<a href='http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50' target='_blank'>Tad教材網</a>下載。");

define("_MA_TADADM_ADMENU1", "主管理介面");

//phpini.php
define("_MA_TADADM_PHPINI_ITEM", "設定項目");
define("_MA_TADADM_PHPINI_ITEM_VAL", "設定值");
define("_MA_TADADM_PHPINI_ITEM_DESC", "相關說明");

//main.php
define("_MA_TADADM_1", '<i class="icon-ok"></i>');
define("_MA_TADADM_0", "");
define("_MA_TADADM_MOD_DISPLAY", "選單");
define("_MA_TADADM_MOD_UPDATE_MODULE", "立即升級");
define("_MA_TADADM_MOD_INSTALL_MODULE", "立即安裝");
define("_MA_TADADM_MOD_UPDATE_THEME", "升級佈景");
define("_MA_TADADM_MOD_INSTALL_THEME", "安裝佈景");
define("_MA_TADADM_MOD_LATEST", "已是最新");
define("_MA_TADADM_NO_MODS", "沒有任何模組");
define("_MA_TADADM_MOD_NAME", "模組名稱");
define("_MA_TADADM_MOD_VERSION", "目前版本");
define("_MA_TADADM_MOD_NEW_VERSION", "最新版本");
define("_MA_TADADM_MOD_LAST_UPDATE", "上次更新");
define("_MA_TADADM_MOD_NEW_LAST_UPDATE", "發布日期");
define("_MA_TADADM_MOD_DIRNAME", "目錄名稱");
define("_MA_TADADM_MOD_HASMAIN", "前台");
define("_MA_TADADM_MOD_HASADMIN", "後台");
define("_MA_TADADM_MOD_HASSEARCH", "搜尋");
define("_MA_TADADM_MOD_HASCONFIG", "偏好設定");
define("_MA_TADADM_MOD_HASCOMMENTS", "評論");
define("_MA_TADADM_MOD_HASNOTIFICATION", "通知");
define("_MA_TADADM_MOD_UNINSTALL", "未安裝");
define("_MA_TADADM_MOD_UPDATE_DESC", "新版說明");
define("_MA_TADADM_MOD_ABOUT_MOD", "模組簡介");
define("_MA_TADADM_LOGIN", "登入");
define("_MA_TADADM_SSH", "SSH登入");
define("_MA_TADADM_SSH_HOST", "請輸入SSH登入主機");
define("_MA_TADADM_SSH_ID", "請輸入SSH登入帳號");
define("_MA_TADADM_SSH_PASS", "請輸入SSH登入密碼");
define("_MA_TADADM_FTP", "FTP登入");
define("_MA_TADADM_FTP_HOST", "請輸入FTP登入主機");
define("_MA_TADADM_FTP_ID", "請輸入FTP登入帳號");
define("_MA_TADADM_FTP_PASS", "請輸入FTP登入密碼");
define("_MA_TADADM_DL_FAIL", "「%s」下載失敗！");
define("_MA_TADADM_EXEC_FAIL", "「%s」執行失敗！");
define("_MA_TADADM_MV_FAIL", "「%s」搬移至modules下失敗！");
define("_MA_TADADM_SSH_LOGIN_FAIL", "「%s」以SSH登入「%s」失敗！");
define("_MA_TADADM_FTP_LOGIN_FAIL", "「%s」以FTP登入「%s」失敗！");
define("_MA_TADADM_FTP_FAIL", "FTP 連線失敗！（可能該伺服器無FTP服務或未啟動FTP服務）");
define("_MA_TADADM_KIND" , "種類");
define("_MA_TADADM_MODULE" , "模組");
define("_MA_TADADM_THEME" , "佈景");
define("_MA_TADADM_THEME_UPDATE_OK" , "佈景更新完畢！");
define("_MA_TADADM_THEME_INSTALL_OK" , "佈景安裝完畢！請將「使用者可選擇的佈景」欄位加入「%s」佈景。");
define("_MA_TADADM_FTP_NOTE" , "FTP僅適用與安裝新模組，因為權限關係，FTP模式無法覆蓋原有資料夾，故不適用於更新模組。");


//spam.php
define("_MA_TADADM_NEVERLOGIN", "未登入過");
define("_MA_TADADM_CKECKOK", "清查完畢或查無資料");
define("_MA_TADADM_WORKTIME", "執行時間：%s 秒");
define("_MA_TADADM_AUTO_CHECK", "自動清查模式");
define("_MA_TADADM_AUTO_CHECK_DESC", "（使用一次即可，第一次用來清查所有帳號。此功能會自動檢查所有帳號，並自動換頁。由於換頁有20次之限制，故若帳號超過 %s 個，最後畫面可能會因為強制中斷而變成空白。此時，滑鼠請直接點擊網址列，然後按Enter，使之繼續檢查即可，直至檢查完畢為止。）");
define("_MA_TADADM_AUTO_CHECK_DESC1", "檢查時會連至 <a href='http://www.stopforumspam.com' target='_blank'>http://www.stopforumspam.com</a> 檢查該帳號的 Email 是否為登記有案的垃圾帳號，故第一次速度會比較慢。");
define("_MA_TADADM_AUTO_CHECK_DESC2", "檢查後就會將結果存入資料庫，所以，第二次瀏覽帳號就會變快了。");
define("_MA_TADADM_AUTO_CHECK_DESC3", "<span style='color:red'>紅色代表這是登記有案的「垃圾帳號」</span>；<span style='color:#CC6600'>橘色代表「從簽名檔來研判八成是垃圾帳號」</span>；<span style='color:#505050'>黑色代表應該是一般帳號</span>，<span style='color:blue'>藍色是有發布過文章的帳號</span>");
define("_MA_TADADM_AUTO_CHECK_DESC4", "<a href='main.php?op=all&mode=force'>強制重查！</a>之前查過的Email會註記為已查，故不會再次至 stopforumspam 檢查該 Email 是否為垃圾郵件以加快檢查速度。但有些 Email 是之後才被 stopforumspam 列為垃圾郵件，故每隔一段時間，可利用此功能，重查一下 Email 是否有被列為垃圾郵件。");
define("_MA_TADADM_AUTO_CHECK_DESC5", "<a href='main.php?op=spam'>僅列出查為垃圾郵件列表</a>（執行「強制重查」後，可利用此功能觀看有找出哪些垃圾郵件並刪除之。）");
define("_MA_TADADM_UNAME", "帳號");
define("_MA_TADADM_COUNT", "發表數");
define("_MA_TADADM_EMAIL", "信箱");
define("_MA_TADADM_SPAM", "垃圾");
define("_MA_TADADM_REGIST", "註冊日");
define("_MA_TADADM_LASTLOGIN", "未登入日");
define("_MA_TADADM_SIGN", "簽名");
define("_MA_TADADM_DONT_DEL_ROOT", "不能刪除管理員");
define("_MA_TADADM_DEL_FAIL", "刪除使用者失敗！");
define("_MA_TADADM_DEL_OK", "刪除完畢！");
define("_MA_TADADM_NEXT_PAGE", "切換到下一頁");
define("_MA_TADADM_TOTAL", "共 %s 筆資料");
define("_MA_TADADM_NEVERSTART_DAY", "列出未啟動，並註冊超過 %s 天");
define("_MA_TADADM_NEVERLOGIN_DAY", "列出從未登入過，並註冊超過 %s 天");
define("_MA_TADADM_BY_EMAIL", "列出 Email 結尾（網域）為 %s 的資料");

define("_MA_TADADM_SELECT_ALL", "全選");

?>