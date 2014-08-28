<?php
$ini['allow_url_fopen'] = "是否允許打開遠端檔案？部份模組有抓取遠端檔案的需求，關閉此項目可能會導致該模組功能無法正常運作，但若主機有支援 curl 函數的話，那麼關閉此設定亦可。";

$ini['date.timezone'] = "主機預設時區，若主機在台灣，請務必設置為「Asia/Taipei」，否則系統抓到的可能會有誤差。";

$ini['display_errors'] = "是否顯示錯誤訊息？建議開啟！！否則網站變成空白時將很難進行除錯。";

$ini['file_uploads'] = "是否允許檔案上傳。需配合 upload_max_filesize, upload_tmp_dir, post_max_size 等設定。一般而言，上傳上限的設定，大小需求如下：memory_limit > post_max_size > upload_max_filesize";

$ini['max_file_uploads'] = "最多只能傳幾個檔案？請視需求設定之。";

$ini['max_execution_time'] = "每個程序最大允許執行時間(秒)，0 表示沒有限制。這個參數有助於阻止劣質程序無休止的佔用伺服器資源。
<br>檔案上傳時，若檔案很大，頻寬卻很小，那麼此值需調大一點，例如上傳 10M 檔案需要花2分鐘，那此值就不要小於 120。";

$ini['max_input_time'] = "每個程序解析輸入數據 (POST, GET, upload) 的最大允許時間(秒)。
<br> -1 表示不限制。";

$ini['max_input_vars']="表單可接收的變數數量，超過此數量，就可能無法完全接收表單內容。<br>部份系統有匯入功能，匯入後若有表單確定畫面，通常會有很多變數，因此，調大此值有助於匯入資料的完整性。";

$ini['memory_limit'] = "一個程序所能夠申請到的記憶體空間 (可以使用 K 和 M 作為單位)。
這有助於防止劣質程序消耗完伺服器上的所有記憶體。如果要取消記憶體限制，則必須將其設為 -1 。";

$ini['post_max_size'] = "允許的 POST 數據最大字節長度。此設定也影響到檔案上傳。
<br> 如果 POST 數據超出限制，那麼 \$_POST 和 \$_FILES 將會為空。
<br> 要上傳大檔案，該值必須大於 upload_max_filesize 指令的值。
<br> 如果啟用了記憶體限制，那麼該值應當小於 memory_limit 指令的值。";

$ini['short_open_tag'] = "是否允許使用「&lt;? ?&gt;」短標識。否則必須使用「&lt;?php ?&gt;」長標識。
<br> 除非你的php程序僅在受控環境下運行，且只供自己使用，否則請不要使用短標記。
<br> 如果要和XML結合使用PHP，可以選擇關閉此選項以方便直接嵌入「&lt;?xml ... ?&gt;」，
<br> 不然你必須用PHP來輸出：&lt;? echo '&lt;?xml version=\"1.0\"'; ?&gt;
<br> 本指令也會影響到縮寫形式「&lt;?=」，它和「&lt;? echo」等價，要使用它也必須打開短標記。";

$ini['upload_max_filesize'] = "允許上傳的檔案的最大尺寸。";
?>