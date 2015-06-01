<?php
$ini['child_terminate'] = "PHP script after the end of the request whether to allow the use of apache_child_terminate () function terminates the child process.
This command is only available
<br> installed as Apache1.3 modules will be in UNIX platforms PHP. In other cases the existence of neither.";

$ini['engine'] = "PHP parsing engine is enabled.
<br> Tip: You can host-based virtual directory or to turn on or off PHP parsing engine in httpd.conf.";

$ini['last_modified']          = "is placed in the Last-Modified response header last modified time of the PHP script.";
$ini['xbithack']               = "What is the end of the file regardless of whether, as the PHP executable bits are set to resolve.";
$ini['date.default_latitude']  = "Default latitude";
$ini['date.default_longitude'] = "Default longitude";
$ini['date.sunrise_zenith']    = "default sunrise zenith";
$ini['date.sunset_zenith']     = "default sunset zenith";
$ini['date.timezone']          = "TZ environment variable is not set for the default date and time functions for all time zones. Priority
<br> application time zone is:
<br> 1. time zone setting function with date_default_timezone_set () (If you set it)
<br> 2. TZ environment variable (if non-empty words)
<br> 3. the instruction value (if set words)
<br> 4. PHP own speculation (if the operating system supports)
<br> 5. If the above are not successful, then use UTC ";
$ini['assert.active']          = "Whether to enable assert () assert assessments";
$ini['assert.bail']            = "suspend execution of the script is in the assertion failure occurs when";
$ini['assert.callback']        = "assertion failure occurred callback executed";
$ini['assert.quiet_eval']      = "assess whether the use of quiet (do not show any error messages, the equivalent error_reporting = 0).
<br> closed in assessing if the assertion expression when using the current value of error_reporting directive. ";
$ini['assert.warning']         = "Are assertion failures are warned each";

$ini['safe_mode'] = "whether to enable safe mode.
<br> When open, PHP will check whether the owner of the current script and is operated by the same owner of the file,
<br> same is allowed to operate, various refused to operate. ";

$ini['safe_mode_gid'] = "in safe mode, the default when accessing files does a UID compare check.
<br> but strict UID check in some cases but is not suitable, relaxed GID check is sufficient.
<br> If you want to relax this to a GID compare only to do, you can turn on this parameter. ";

$ini['safe_mode_allowed_env_vars'] = "in safe mode, the user can only change the environment variables prefix list (comma separated).
<br> allows users to set certain environment variables may lead to potential security vulnerabilities.
<br> Note: If this parameter is empty, PHP will allow the user to change any environment variable! ";

$ini['safe_mode_protected_env_vars'] = "environment variable list in safe mode, the user can not change (comma separated).
<br> these variables is set to allow the case even in safe_mode_allowed_env_vars next instruction will be protected. ";

$ini['safe_mode_exec_dir'] = "in safe mode, only the directory of the executable program only allows the function to be executed system program execution.
<br> These functions are: system, escapeshellarg, escapeshellcmd, exec, passthru,
<br> proc_close, proc_get_status, proc_nice, proc_open, proc_terminate, shell_exec ";

$ini['safe_mode_include_dir'] = "in safe mode, the set of directories and subdirectories under the file which is included, will skip the UID/GID checks.
<br> other words, if here is empty, file any UID / GID does not comply are not allowed to be included.
<br> directory settings here must already exist in include_path or full path directive to include.
<br> between multiple directories (semicolon under Win) separated by a colon.
<br> limit specified is actually a prefix, not a directory name,
<br> That '/dir/incl' will allow access to '/dir/include' and '/dir/incls'
<br> If you want to access control in a specified directory, then in the end with a slash. ";

$ini['allow_url_fopen'] = "whether to allow open remote file";

$ini['allow_url_include'] = "whether to allow include / require remote file.";

$ini['disable_classes'] = "This command accepts a comma-delimited list of class names used to disable a particular class.";

$ini['disable_function'] = "This command accepts a comma-delimited list of function names to disable certain functions.";

$ini['enable_dl'] = "whether to allow the use dl () function. dl (function efficiently only when PHP as apache module installed).
<br> disable dl () function is mainly for security reasons, because it can bypass the restrictions open_basedir directive.
<br> in safe mode is always disabled dl () function, regardless of how to set up here.
<br> PHP6 removed the directive, which is equivalent to Off. ";

$ini['expose_php'] = "Are exposed the fact that PHP is installed on the server (plus its signature in the http header).
<br> it does not have a direct security threat, but it makes the client know that the server is installed PHP. ";

$ini['open_basedir'] = "PHP will allow all file operations (including the file itself) are limited in this group under the directory list.
<br> When a script tries to open a file outside the specified directory tree, will be rejected.
<br> all symbolic links are resolved, it is impossible to avoid this restriction with a symlink.
<br> special value '.' specifies the directory to store the script will be used as the reference directory,
<br> but somewhat dangerous, because the working directory of the script can easily be () to change the chdir.
<br> For shared servers, set this in httpd.conf flexible instruction for different virtual host or directory will become very useful.
<br> in Windows using a semicolon to separate directories, separated by colons using UNIX system directory.
When <br> as an Apache module, open_basedir paths from parent directories will automatically be inherited.
<br> limit specified is actually a prefix, not a directory name,
<br> That '/dir/incl' will allow access to '/dir/include' and '/dir/incls'
<br> If you want to access control in a specified directory, then end with a slash.
<br> default is allowed to open all files. ";

$ini['sql.safe_mode '] = "whether to use SQL safe mode.
<br> If you open a database connection function specifies a default value instead of the default value will be used to support these arguments.
<br> connection function for each of the different databases, the default value, please refer to the corresponding manual page. ";

$ini['error_reporting'] = "Error reporting level is superimposed bit field, it is recommended to use E_ALL | E_STRICT
<br> 1 E_ERROR fatal runtime error
<br> 2 E_WARNING warnings (non-fatal errors) runtime
<br> 4 E_PARSE Parse error when compiling
<br> 8 E_NOTICE runtime reminder (often a bug, it may be intentional)
<br> 16 E_CORE_ERROR PHP Start time fatal error during initialization
<br> 32 E_CORE_WARNING PHP initialization process starts when warnings (non-fatal error)
<br> 64 E_COMPILE_ERROR fatal error when compiling
<br> 128 E_COMPILE_WARNING compiler warnings (non-fatal error) when
<br> 256 E_USER_ERROR user-defined Fatal error
<br> 512 E_USER_WARNING user-defined warnings (non-fatal errors)
<br> 1024 E_USER_NOTICE user-defined alert (often a bug, it may be intentional)
<br> 2048 E_STRICT coding standardization warning (suggestions on how to revise the forward-compatible)
<br> 4096 E_RECOVERABLE_ERROR nearly fatal run-time errors, if not then deemed to be captured E_ERROR
<br> 6143 E_ALL E_STRICT all errors except outside (PHP6 for 8191, which includes all)
<br> can also use 2147483647 (all bits are all 1) open now or in the future, various error may occur";

$ini['track_errors'] = "是否在變數 \$php_errormsg中保存最近一個錯誤或警告消息。";

$ini['display_errors'] ='This determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user.
<br> You\'re strongly advised to use error logging in place of error displaying on production web sites,
<br> otherwise it may expose some security information to hackers,
<br> such as file path on your web server, database planning or other information.';

$ini['display_startup_errors'] = "是否顯示PHP啟動時的錯誤。
<br> 即使display_errors指令被打開，關閉此參數也將不顯示PHP啟動時的錯誤。
<br> 建議你關掉這個特性，除非你必須要用於調試中。";

$ini['report_memleaks'] = "是否報告內存洩漏。這個參數只在以調試方式編譯的PHP中起作用，
<br> 並且必須在error_reporting指令中包含 E_WARNING";

$ini['report_zend_debug'] = "尚無說明文檔";

$ini['html_errors'] = "是否在出錯信息中使用HTML標記。
<br> 注意: 不要在發佈的站點上使用這個特性！";

$ini['docref_root'] = "";
$ini['docref_ext']  = "如果打開了html_errors指令，PHP將會在出錯信息上顯示超連接，
<br> 直接鏈接到一個說明這個錯誤或者導致這個錯誤的函數的頁面。
<br> 你可以從[url]http://www.php.net/docs.php[/url]下載php手冊，
<br> 並將docref_root指令指向你本地的手冊所在的URL目錄。
<br> 你還必須設置docref_ext指令來指定檔案的擴展名(必須含有'.')。
<br> 注意: 不要在發佈的站點上使用這個特性。";

$ini['error_prepend_string'] = "用於錯誤信息前輸出的字符串";
$ini['error_append_string']  = "用於錯誤信息後輸出的字符串";
$ini['xmlrpc_errors']        = "";
$ini['xmlrpc_error_number']  = "尚無文檔";

$ini['define_syslog_variables'] = "是否定義各種系統日誌變數，如：\$LOG_PID, \$LOG_CRON 等等。
<br> 關掉它以提高效率的好主意。
<br> 你可以在運行時調用define_syslog_variables()函數來定義這些變數。";

$ini['error_log'] = "將錯誤日誌記錄到哪個檔案中。該檔案必須對Web伺服器用戶可寫。
<br> syslog 表示記錄到系統日誌中(NT下的事件日誌, Unix下的syslog(3))
<br> 如果此處未設置任何值，則錯誤將被記錄到Web伺服器的錯誤日誌中。";

$ini['log_errors'] = "是否在日誌檔案裡記錄錯誤，具體在哪裡記錄取決於error_log指令。
<br> 強烈建議你在最終發佈的web站點時使用日誌記錄錯誤而不是直接輸出，
<br> 這樣可以讓你既知道那裡出了問題，又不會暴露敏感信息。";

$ini['log_errors_max_len'] = "設置錯誤日誌中附加的與錯誤信息相關聯的錯誤源的最大長度。
<br> 這裡設置的值對顯示的和記錄的錯誤以及\$php_errormsg都有效。
<br> 設為 0 可以允許無限長度。";

$ini['ignore_repeated_errors'] = "記錄錯誤日誌時是否忽略重複的錯誤信息。
<br> 錯誤信息必須出現在同一檔案的同一行才被被視為重複。";

$ini['ignore_repeated_source'] = "是否在忽略重複的錯誤信息時忽略重複的錯誤源。";

$ini['SMTP'] = "mail()函數中用來發送郵件的SMTP伺服器的主機名稱或者IP地址。僅用於win32。";

$ini['smtp_port'] = "SMTP伺服器的端口號。僅用於win32。";

$ini['sendmail_from'] = "發送郵件時使用的\"From:\"頭中的郵件地址。僅用於win32
<br> 該選項還同時設置了\"Return-Path:\"頭。";

$ini['sendmail_path'] = "僅用於unix，也可支持參數(預設的是'sendmail -t -i')
<br> sendmail程序的路徑，通常為「/usr/sbin/sendmail或/usr/lib/sendmail」。
<br> configure腳本會嘗試找到該程序並設定為預設值，但是如果失敗的話，可以在這裡設定。
<br> 不使用sendmail的系統應將此指令設定為sendmail替代程序(如果有的話)。
<br> 例如，Qmail用戶通常可以設為「/var/qmail/bin/sendmail」或「/var/qmail/bin/qmail-inject」。
<br> qmail-inject 不需要任何選項就能正確處理郵件。";

$ini['mail.force_extra_parameters'] = "作為額外的參數傳遞給sendmail庫的強制指定的參數附加值。
<br> 這些參數總是會替換掉mail()的第5個參數，即使在安全模式下也是如此。";

$ini['default_socket_timeout'] = "預設socket超時(秒)";

$ini['max_execution_time'] = 'This sets the maximum time in seconds a script is allowed to run before it is terminated by the parser.
<br> This helps prevent poorly written scripts from tying up the server.
<br> The default setting is 30. When running PHP from the command line the default setting is 0.
<br> The maximum execution time is not affected by system calls, stream operations etc.
<br> Please see the set_time_limit() function for more details.';

$ini['memory_limit'] = 'This sets the maximum amount of memory in bytes that a script is allowed to allocate.
<br> This helps prevent poorly written scripts for eating up all available memory on a server.
<br> Note that to have no memory limit, set this directive to -1.';

$ini['max_input_time'] = 'This sets the maximum time in seconds a script is allowed to parse input data, like POST and GET.
<br> Timing begins at the moment PHP is invoked at the server and ends when execution begins.';

$ini['max_input_vars'] ='How many input variables may be accepted (limit is applied to $_GET, $_POST and $_COOKIE superglobal separately).
<br> Use of this directive mitigates the possibility of denial of service attacks which use hash collisions.
<br> If there are more input variables than specified by this directive, an E_WARNING is issued,
<br> and further input variables are truncated from the request.';



$ini['max_input_nesting_level'] = "輸入變數的最大嵌套深度(尚無更多解釋文檔)";

$ini['post_max_size'] = 'Sets max size of post data allowed. This setting also affects file upload.
<br> To upload large files, this value must be larger than upload_max_filesize.
<br> If memory limit is enabled by your configure script, memory_limit also affects file uploading.
<br> Generally speaking, memory_limit should be larger than post_max_size.
<br> If the size of post data is greater than post_max_size, the $_POST and $_FILES superglobals are empty.';

                                                                                                                                                                                                                                                                                                            $ini['realpath_cache_size'] = "指定PHP使用的realpath(規範化的絕對路徑名)緩衝區大小。
<br> 在PHP打開大量檔案的系統上應當增大該值以提高性能。";

$ini['realpath_cache_ttl'] = "realpath緩衝區中信息的有效期(秒)。
<br> 對檔案很少變動的系統，可以增大該值以提高性能。";

$ini['file_uploads'] = 'Whether or not to allow HTTP file uploads. <br> See also the upload_max_filesize, upload_tmp_dir, and post_max_size directives.';

$ini['max_file_uploads'] = 'The maximum number of files allowed to be uploaded simultaneously.
<br> Starting with PHP 5.3.4, upload fields left blank on submission do not count towards this limit.';


$ini['upload_max_filesize'] = 'The maximum size of an uploaded file.';

$ini['upload_tmp_dir'] = "檔案上傳時存放檔案的臨時目錄(必須是PHP進程用戶可寫的目錄)。
<br> 如果未指定則PHP使用系統預設的臨時目錄。";

$ini['magic_quotes_gpc'] = "是否對輸入的GET/POST/Cookie數據使用自動字符串轉義( '  \"  \  NULL )。
<br> 這裡的設置將自動影響 \$_GEST \$_POST \$_COOKIE 數組的值。
<br> 若將本指令與magic_quotes_sybase指令同時打開，則僅將單引號(')轉義為('')，
<br> 其它特殊字符將不被轉義，即( \"  \  NULL )將保持原樣！！
<br> 建議關閉此特性，並使用自定義的過濾函數。";

$ini['magic_quotes_runtime'] = "是否對運行時從外部資源產生的數據使用自動字符串轉義( '  \"  \  NULL )。
<br> 若打開本指令，則大多數函數從外部資源(資料庫,文本檔案等)返回數據都將被轉義。
<br> 例如：用SQL查詢得到的數據，用exec()函數得到的數據，等等
<br> 若將本指令與magic_quotes_sybase指令同時打開，則僅將單引號(')轉義為('')，
<br> 其它特殊字符將不被轉義，即( \"  \  NULL )將保持原樣！！
<br> 建議關閉此特性，並視具體情況使用自定義的過濾函數。";

$ini['magic_quotes_sybase'] = "是否採用Sybase形式的自動字符串轉義(用 '' 表示 ')";

$ini['short_open_tag'] = 'Tells PHP whether the short form (&lt;? ?&gt;) of PHP\'s open tag should be allowed.
<br> If you want to use PHP in combination with XML, you can disable this option in order to use &lt;?xml ?&gt; inline.
<br> Otherwise, you can print it with PHP, for example: &lt;?php echo \'&lt;?xml version="1.0"?&gt;\'; ?&gt;.
<br> Also, if disabled, you must use the long form of the PHP open tag (&lt;?php ?&gt;).';

$ini['asp_tags'] = "是否允許ASP風格的標記「&lt;% %&gt;」，這也會影響到縮寫形式「&lt;%=」。
<br> PHP6中將刪除此指令";

$ini['arg_separator.output'] = "PHP所產生的URL中用來分隔參數的分隔符。
<br> 另外還可以用「&amp;」或「,」等等。";

$ini['arg_separator.input'] = "PHP解析URL中的變數時使用的分隔符列表。
<br> 字符串中的每一個字符都會被當作分割符。
<br> 另外還可以用「,&」等等。";

$ini['allow_call_time_pass_reference'] = "是否強迫在函數調用時按引用傳遞參數(每次使用此特性都會收到一條警告)。
<br> php反對這種做法，並在PHP6里刪除了該指令(相當於設為Off)，因為它影響到了代碼的整潔。
<br> 鼓勵的方法是在函數聲明裡明確指定哪些參數按引用傳遞。
<br> 我們鼓勵你關閉這一選項，以保證你的腳本在將來版本的語言裡仍能正常工作。";

$ini['auto_globals_jit'] = "是否僅在使用到\$_SERVER和\$_ENV變數時才創建(而不是在腳本一啟動時就自動創建)。
<br> 如果並未在腳本中使用這兩個數組，打開該指令將會獲得性能上的提升。
<br> 要想該指令生效，必須關閉register_globals和register_long_arrays指令。";

$ini['auto_prepend_file'] = "指定在主檔案之前/後自動解析的檔案名。為空表示禁用該特性。
<br> 該檔案就像調用了include()函數被包含進來一樣，因此會使用include_path指令的值。
<br> 注意：如果腳本通過exit()終止，那麼自動後綴將不會發生。";

$ini['auto_append_file'] = "指定在主檔案之前/後自動解析的檔案名。為空表示禁用該特性。
<br> 該檔案就像調用了include()函數被包含進來一樣，因此會使用include_path指令的值。
<br> 注意：如果腳本通過exit()終止，那麼自動後綴將不會發生。";

$ini['variables_order'] = "PHP註冊 Environment, GET, POST, Cookie, Server 變數的順序。
<br> 分別用 E, G, P, C, S 表示，按從左到右註冊，新值覆蓋舊值。
<br> 舉例說，設為「GP」將會導致用POST變數覆蓋同名的GET變數，
<br> 並完全忽略 Environment, Cookie, Server 變數。
<br> 推薦使用「GPC」或「GPCS」，並使用getenv()函數訪問環境變數。";

$ini['register_globals'] = "是否將 E, G, P, C, S 變數註冊為全局變數。
<br> 打開該指令可能會導致嚴重的安全問題，除非你的腳本經過非常仔細的檢查。
<br> 推薦使用預定義的超全局變數：\$_ENV, \$_GET, \$_POST, \$_COOKIE, \$_SERVER
<br> 該指令受variables_order指令的影響。
<br> PHP6中已經刪除此指令。";

$ini['register_argc_argv'] = "是否聲明\$argv和\$argc全局變數(包含用GET方法的信息)。
<br> 建議不要使用這兩個變數，並關掉該指令以提高性能。";

$ini['register_long_arrays'] = "是否啟用舊式的長式數組(HTTP_*_VARS)。
<br> 鼓勵使用短式的預定義超全局數組，並關閉該特性以獲得更好的性能。
<br> PHP6中已經刪除此指令。";

$ini['always_populate_raw_post_data'] = "是否總是生成\$HTTP_RAW_POST_DATA變數(原始POST數據)。
<br> 否則，此變數僅在遇到不能識別的MIME類型的數據時才產生。
<br> 不過，訪問原始POST數據的更好方法是 php://input 。
<br> \$HTTP_RAW_POST_DATA對於enctype=\"multipart/form-data\"的表單數據不可用。";

$ini['unserialize_callback_func'] = "如果解序列化處理器需要實例化一個未定義的類，
<br> 這裡指定的回調函數將以該未定義類的名字作為參數被unserialize()調用，
<br> 以免得到不完整的「__PHP_Incomplete_Class」對象。
<br> 如果這裡沒有指定函數，或指定的函數不包含(或實現)那個未定義的類，將會顯示警告信息。
<br> 所以僅在確實需要實現這樣的回調函數時才設置該指令。
<br> 若要禁止這個特性，只需置空即可。";

$ini['y2k_compliance'] = "是否強制打開2000年適應(可能在非Y2K適應的瀏覽器中導致問題)。";

$ini['zend.ze1_compatibility_mode'] = "是否使用兼容Zend引擎I(PHP 4.x)的模式。PHP6中將刪除該指令(相當於Off)。
<br> 這將影響對象的複製、構造(無屬性的對象會產生FALSE或0)、比較。
<br> 兼容模式下，對像將按值傳遞，而不是預設的按引用傳遞。";

$ini['precision'] = "浮點型數據顯示的有效位數。";

$ini['serialize_precision'] = "將浮點型和雙精度型數據序列化存儲時的精度(有效位數)。
<br> 預設值能夠確保浮點型數據被解序列化程序解碼時不會丟失數據。";

$ini['implicit_flush'] = "是否要求PHP輸出層在每個輸出塊之後自動刷新數據。
<br> 這等效於在每個 print()、echo()、HTML塊 之後自動調用flush()函數。
<br> 打開這個選項對程序執行的性能有嚴重的影響，通常只推薦在調試時使用。
<br> 在CLI SAPI的執行模式下，該指令預設為 On 。";

$ini['output_buffering'] = "輸出緩衝區大小(字節)。建議值為4096~8192。
<br> 輸出緩衝允許你甚至在輸出正文內容之後再發送HTTP頭(包括cookies)。
<br> 其代價是輸出層減慢一點點速度。
<br> 設置輸出緩衝可以減少寫入，有時還能減少網絡數據包的發送。
<br> 這個參數的實際收益很大程度上取決於你使用的是什麼Web伺服器以及什麼樣的腳本。";

$ini['output_handler'] = "將所有腳本的輸出重定向到一個輸出處理函數。
<br> 比如，重定向到mb_output_handler()函數時，字符編碼將被透明地轉換為指定的編碼。
<br> 一旦你在這裡指定了輸出處理程序，輸出緩衝將被自動打開(output_buffering=4096)。
<br> 注意0: 此處僅能使用PHP內置的函數，自定義函數應在腳本中使用ob_start()指定。
<br> 注意1: 可移植腳本不能依賴該指令，而應使用ob_start()函數明確指定輸出處理函數。
<br>        使用這個指令可能會導致某些你不熟悉的腳本出錯。
<br> 注意2: 你不能同時使用「mb_output_handler」和「ob_iconv_handler」兩個輸出處理函數。
<br>        你也不能同時使用「ob_gzhandler」輸出處理函數和zlib.output_compression指令。
<br> 注意3: 如果使用zlib.output_handler指令開啟zlib輸出壓縮，該指令必須為空。";

$ini['include_path'] = "指定一組目錄用於require(), include(), fopen_with_path()函數尋找檔案。
<br> 格式和系統的PATH環境變數類似(UNIX下用冒號分隔，Windows下用分號分隔)：
<br> UNIX: 「/path1:/path2」
<br> Windows: 「\path1;\path2」
<br> 在包含路徑中使用'.'可以允許相對路徑，它代表當前目錄。";

$ini['user_dir'] = "告訴php在使用 /~username 打開腳本時到哪個目錄下去找，僅在非空時有效。
<br> 也就是在用戶目錄之下使用PHP檔案的基本目錄名，例如：「public_html」";

$ini['extension_dir'] = "存放擴展庫(模組)的目錄，也就是PHP用來尋找動態擴展模組的目錄。
<br> Windows下預設為「C:/php5」";

$ini['default_mimetype'] = "";

$ini['default_charset'] = "PHP預設會自動輸出「Content-Type: text/html」 HTTP頭。
<br> 如果將default_charset指令設為「gb2312」，
<br> 那麼將會自動輸出「Content-Type: text/html; charset=gb2312」。
<br> PHP6反對使用default_charset指令，而推薦使用unicode.output_encoding指令。";

$ini['detect_unicode'] = "指示Zend引擎是否通過檢查腳本的BOM(字節順序標記)來檢測腳本是否包含多字節字符。
<br> 建議關閉。PHP6已經取消了此指令而用unicode.script_encoding指令來代替其功能。";

$ini['unicode.semantics'] = "是否啟用Unicode支持。
<br> 如果打開此指令，那麼PHP將變成一個完全的Unicode環境，比如：
<br> 所有字符串和從HTTP接受的變數都將變成Unicode，所有PHP標識符也都可以使用Unicode字符。
<br> 而且，PHP內部將使用Unicode字符串並負責對外圍非Unicode字符進行自動轉換，
<br> 比如：HTTP輸入輸出、流、檔案系統操作等等，甚至連php.ini自身都將按照UTF-8編碼來解析。
<br> 開啟這個指令後，你必須明確指定二進制字符串。PHP將不對二進制字符串的內容做任何假定，
<br> 因此你的程序必須保證能夠恰當的處理二進制字符串。
<br> 如果關閉這個指令，PHP的行為將和以前的行為完全相同：
<br> 字符串不會變成Unicode，檔案和二進制字符串也將向後兼容，php.ini也將按照「as-is」風格解析。
<br> 不管是否打開此指令，所有的函數和操作符都透明的支持Unicode字符串。";

$ini['unicode.fallback_encoding'] = "為其他所有unicode.*_encoding指令設置預設值。
<br> 也就是說如果某個unicode.*_encoding指令未明確設置的話，將使用此處設置的值。";

$ini['unicode.runtime_encoding'] = "運行時編碼指定了PHP引擎內部轉換二進制字符串時使用的編碼。
<br> 此處的設置對於I/O相關操作(比如：寫入標準輸出/讀取檔案系統/解碼HTTP輸入變數)沒有影響。
<br> PHP也允許你明確的對字符串進行轉換：
<br> (binary)\$str  -- 轉化為二進制字符串
<br> (unicode)\$str -- 轉化為Unicode字符串
<br> (string)\$str  -- 如果unicode.semantics為On則轉化為Unicode字符串，否則轉化為二進制字符串
<br> 例如，如果該指令的值為iso-8859-1並且\$uni是一個Unicode字符串，那麼
<br> \$str = (binary)\$uni
<br> 將等到一個使用iso-8859-1編碼的二進制字符串。
<br> 在連接、比較、傳遞參數等操作之前PHP會將相關字符串隱含轉換為Unicode，然後再進行操作。
<br> 比如在將二進制字符串與Unicode進行連接的時候，
<br> PHP將會使用這裡的設置將二進制字符串轉換為Unicode字符串，然後再進行操作。";

$ini['unicode.output_encoding'] = "PHP輸出非二進制字符串使用的編碼。
<br> 自動將'print'和'echo'之類的輸出內容轉換為此處設定的編碼(並不對二進制字符串進行轉換)。
<br> 當向檔案之類的外部資源寫入數據的時候，
<br> 你必須依賴於流編碼特性或者使用Unicode擴展的函數手動的對數據進行編碼。
<br> 在PHP6中反對使用先前的default_charset指令，而推薦使用該指令。
<br> 先前的default_charset指令只是指定了Content-Type頭中的字符集，而並不對實際的輸出做任何轉換。
<br> 而在PHP6中，default_charset指令僅在unicode.semantics為off的時候才有效。
<br> 設置了該指令後將在Content-Type輸出頭的'charset'部分填上該指令的值，
<br> 而不管default_charset指令如何設置。";

$ini['unicode.http_input_encoding'] = "通過HTTP獲取的變數(比如\$_GET和\$_POST)內容的編碼。
<br> 直到2007年4月此功能尚在開發中....";

$ini['unicode.filesystem_encoding'] = "檔案系統的目錄名和檔案名的編碼。
<br> 檔案系統相關的函數(比如opendir())將使用這個編碼接受和返回檔案名和目錄名。
<br> 此處的設置必須與檔案系統實際使用的編碼完全一致。";

$ini['unicode.script_encoding'] = "PHP腳本自身的預設編碼。
<br> 你可以使用任何ICU支持的編碼來寫PHP腳本。
<br> 如果你想針對單獨的腳本檔案設定其編碼，可以在該腳本的開頭使用
<br>   &lt;?php declare(encoding = 'Shift-JIS');?&gt;
<br> 來指定。注意：必須是第一行開頭，全面不要有任何字符(包括空白)。
<br> 該方法只能影響其所在的腳本，不會影響任何被包含的其他腳本。";

$ini['unicode.stream_encoding'] = "";

$ini['unicode.from_error_mode'] = "";

$ini['unicode.from_error_subst_char'] = "";

$ini['auto_detect_line_endings'] = "是否讓PHP自動偵測行結束符(EOL)。
<br> 如果的你腳本必須處理Macintosh檔案，
<br> 或者你運行在Macintosh上，同時又要處理unix或win32檔案，
<br> 打開這個指令可以讓PHP自動偵測EOL，以便fgets()和file()函數可以正常工作。
<br> 但同時也會導致在Unix系統下使用回車符(CR)作為項目分隔符的人遭遇不兼容行為。
<br> 另外，在檢測第一行的EOL習慣時會有很小的性能損失。";

$ini['browscap'] = "只有PWS和IIS需要這個設置
<br> 你可以從[url]http://www.garykeith.com/browsers/downloads.asp[/url]
<br> 得到一個browscap.ini檔案。";

$ini['ignore_user_abort'] = "是否即使在用戶中止請求後也堅持完成整個請求。
<br> 在執行一個長請求的時候應當考慮打開該它，
<br> 因為長請求可能會導致用戶中途中止或瀏覽器超時。";

$ini['user_agent'] = "定義「User-Agent」字符串";

$ini['url_rewriter.tags'] = "雖然此指令屬於PHP核心部分，但是卻用於Session模組的配置";

$ini['extension'] = "在PHP啟動時加載動態擴展。例如：extension=mysqli.so
<br> \"=\"之後只能使用模組檔案的名字，而不能含有路徑信息。
<br> 路徑信息應當只由extension_dir指令提供。
<br> 主意，在windows上，下列擴展已經內置：
;  bcmath ;  calendar ;  com_dotnet ;  ctype ;  session ;  filter ;  ftp ;  hash
;  iconv ;  json ;  odbc ;  pcre ;  Reflection ;  date ;  libxml ;  standard
;  tokenizer ;  zlib ;  SimpleXML ;  dom ;  SPL ;  wddx ;  xml ;  xmlreader ;  xmlwriter";

$ini['doc_root'] = "PHP的「CGI根目錄」。僅在非空時有效。
<br> 在web伺服器的主文檔目錄(比如\"htdocs\")中放置可執行程序/腳本被認為是不安全的，
<br> 比如因為配置錯誤而將腳本作為普通的html顯示。
<br> 因此很多系統管理員都會在主文檔目錄之外專門設置一個只能通過CGI來訪問的目錄，
<br> 該目錄中的內容只會被解析而不會原樣顯示出來。
<br> 如果設置了該項，那麼PHP就只會解釋doc_root目錄下的檔案，
<br> 並確保目錄外的腳本都不會被PHP解釋器執行(user_dir除外)。
<br> 如果編譯PHP時沒有指定FORCE_REDIRECT，並且在非IIS伺服器上以CGI方式運行，
<br> 則必須設置此指令(參見手冊中的安全部分)。
<br> 替代方案是使用的cgi.force_redirect指令。";

$ini['cgi.discard_path'] = "尚無文檔(PHP6新增指令)";

$ini['cgi.fix_pathinfo'] = "是否為CGI提供真正的 PATH_INFO/PATH_TRANSLATED 支持(遵守cgi規範)。
<br> 先前的行為是將PATH_TRANSLATED設為SCRIPT_FILENAME，而不管PATH_INFO是什麼。
<br> 打開此選項將使PHP修正其路徑以遵守CGI規範，否則仍將使用舊式的不合規範的行為。
<br> 鼓勵你打開此指令，並修正腳本以使用 SCRIPT_FILENAME 代替 PATH_TRANSLATED 。
<br> 有關PATH_INFO的更多信息請參見cgi規範。";

$ini['cgi.force_redirect'] = "是否打開cgi強制重定向。強烈建議打開它以為CGI方式運行的php提供安全保護。
<br> 你若自己關閉了它，請自己負責後果。
<br> 注意：在IIS/OmniHTTPD/Xitami上則必須關閉它！";

$ini['cgi.redirect_status_env'] = "如果cgi.force_redirect=On，並且在Apache與Netscape之外的伺服器下運行PHP，
<br> 可能需要設定一個cgi重定向環境變數名，PHP將去尋找它來知道是否可以繼續執行下去。
<br> 設置這個變數會導致安全漏洞，請務必在設置前搞清楚自己在做什麼。";

$ini['cgi.rfc2616_headers'] = "指定PHP在發送HTTP響應代碼時使用何種報頭。
<br> 0 表示發送一個「Status: 」報頭，Apache和其它web伺服器都支持。
<br> 若設為1，則PHP使用RFC2616標準的頭。
<br> 除非你知道自己在做什麼，否則保持其預設值 0";

$ini['cgi.nph'] = "在CGI模式下是否強制對所有請求都發送\"Status: 200\"狀態碼。";

$ini['cgi.check_shebang_line'] = "CGI PHP是否檢查腳本頂部以 #! 開始的行。
<br> 如果腳本想要既能夠單獨運行又能夠在PHP CGI模式下運行，那麼這個起始行就是必須的。
<br> 如果打開該指令，那麼CGI模式的PHP將跳過這一行。";

$ini['fastcgi.impersonate'] = "IIS中的FastCGI支持模仿客戶端安全令牌的能力。
<br> 這使得IIS能夠定義運行時所基於的請求的安全上下文。
<br> Apache中的mod_fastcgi不支持此特性(03/17/2002)
<br> 如果在IIS中運行則設為On，預設為Off。";

$ini['fastcgi.logging'] = "是否記錄通過FastCGI進行的連接。";

$ini['async_send'] = "是否異步發送。";

$ini['from'] = "定義匿名ftp的密碼(一個email地址)";

$ini['pcre.backtrack_limit'] = "PCRE的最大回溯(backtracking)步數。";

$ini['pcre.recursion_limit'] = "PCRE的最大遞歸(recursion)深度。
<br> 如果你將該值設的非常高，將可能耗盡進程的棧空間，導致PHP崩潰。";

$ini['session.save_handler'] = "存儲和檢索與會話關聯的數據的處理器名字。預設為檔案(\"files\")。
<br> 如果想要使用自定義的處理器(如基於資料庫的處理器)，可用\"user\"。
<br> 設為\"memcache\"則可以使用memcache作為會話處理器(需要指定\"--enable-memcache-session\"編譯選項)。
<br> 還有一個使用PostgreSQL的處理器：[url]http://sourceforge.net/projects/phpform-ext/[/url]
";

$ini['session.save_path'] = "傳遞給存儲處理器的參數。對於files處理器，此值是創建會話數據檔案的路徑。
<br> Windows下預設為臨時檔案夾路徑。
<br> 你可以使用\"N;[MODE;]/path\"這樣模式定義該路徑(N是一個整數)。
<br> N表示使用N層深度的子目錄，而不是將所有數據檔案都保存在一個目錄下。
<br> [MODE;]可選，必須使用8進制數，預設\"600\"，表示檔案的訪問權限。
<br> 這是一個提高大量會話性能的好主意。
<br> 注意0: \"N;[MODE;]/path\"兩邊的雙引號不能省略。
<br> 注意1: [MODE;]並不會改寫進程的umask。
<br> 注意2: php不會自動創建這些檔案夾結構。請使用ext/session目錄下的mod_files.sh腳本創建。
<br> 注意3: 如果該檔案夾可以被不安全的用戶訪問(比如預設的\"/tmp\")，那麼將會帶來安全漏洞。
<br> 注意4: 當N>0時自動垃圾回收將會失效，具體參見下面有關垃圾搜集的部分。
<br> [安全提示]建議針對每個不同的虛擬主機分別設置各自不同的目錄。
<br> 對於\"memcache\"處理器，需要定義一個逗號分隔的伺服器URL用來存儲會話數據。
<br> 比如：\"tcp://host1:11211, tcp://host2:11211\"
<br> 每個URL都可以包含傳遞給那個伺服器的參數，可用的參數與 Memcache::addServer() 方法相同。
<br> 例如：\"tcp://host1:11211?persistent=1&weight=1&timeout=1&retry_interval=15\"";

$ini['session.name'] = "用在cookie裡的會話ID標識名，只能包含字母和數字。";

$ini['session.auto_start'] = "在客戶訪問任何頁面時都自動初始化會話，預設禁止。
<br> 因為類定義必須在會話啟動之前被載入，所以若打開這個選項，你就不能在會話中存放對象。";

$ini['session.serialize_handler'] = "用來序列化/解序列化數據的處理器，php是標準序列化/解序列化處理器。
<br> 另外還可以使用\"php_binary\"。當啟用了WDDX支持以後，將只能使用\"wddx\"。";

$ini['session.gc_probability'] = "";

$ini['session.gc_divisor'] = "定義在每次初始化會話時，啟動垃圾回收程序的概率。
<br> 這個收集概率計算公式如下：session.gc_probability/session.gc_divisor
<br> 對會話頁面訪問越頻繁，概率就應當越小。建議值為1/1000~5000。";

$ini['session.gc_maxlifetime'] = "超過此參數所指的秒數後，保存的數據將被視為'垃圾'並由垃圾回收程序清理。
<br> 判斷標準是最後訪問數據的時間(對於FAT檔案系統是最後刷新數據的時間)。
<br> 如果多個腳本共享同一個session.save_path目錄但session.gc_maxlifetime不同，
<br> 那麼將以所有session.gc_maxlifetime指令中的最小值為準。
<br> 如果使用多層子目錄來存儲數據檔案，垃圾回收程序不會自動啟動。
<br> 你必須使用一個你自己編寫的shell腳本、cron項或者其他辦法來執行垃圾搜集。
<br> 比如，下面的腳本相當於設置了\"session.gc_maxlifetime=1440\" (24分鐘)：
<br> cd /path/to/sessions; find -cmin +24 | xargs rm";

$ini['session.referer_check'] = "如果請求頭中的\"Referer\"字段不包含此處指定的字符串則會話ID將被視為無效。
<br> 注意：如果請求頭中根本不存在\"Referer\"字段的話，會話ID將仍將被視為有效。
<br> 預設為空，即不做檢查(全部視為有效)。";

$ini['session.entropy_file'] = "附加的用於創建會話ID的外部高熵值資源(檔案)，
<br> 例如UNIX系統上的\"/dev/random\"或\"/dev/urandom\"";

$ini['session.entropy_length'] = "從高熵值資源中讀取的字節數(建議值：16)。";

$ini['session.use_cookies'] = "是否使用cookie在客戶端保存會話ID";

$ini['session.use_only_cookies'] = "是否僅僅使用cookie在客戶端保存會話ID。PHP6的預設值為On。
<br> 打開這個選項可以避免使用URL傳遞會話帶來的安全問題。
<br> 但是禁用Cookie的客戶端將使會話無法工作。";

$ini['session.cookie_lifetime'] = "傳遞會話ID的Cookie有效期(秒)，0 表示僅在瀏覽器打開期間有效。
<br> [提示]如果你不能保證伺服器時間和客戶端時間嚴格一致請不要改變此預設值！";

$ini['session.cookie_path'] = "傳遞會話ID的Cookie作用路徑。";

$ini['session.cookie_domain'] = "傳遞會話ID的Cookie作用域。
<br> 預設為空表示表示根據cookie規範生成的主機名。";

$ini['session.cookie_secure'] = "是否僅僅通過安全連接(https)發送cookie。";

$ini['session.cookie_httponly'] = "是否在cookie中添加httpOnly標誌(僅允許HTTP協議訪問)，
<br> 這將導致客戶端腳本(JavaScript等)無法訪問該cookie。
<br> 打開該指令可以有效預防通過XSS攻擊劫持會話ID。";

$ini['session.cache_limiter'] = "設為{nocache|private|public}以指定會話頁面的緩存控制模式，
<br> 或者設為空以阻止在http應答頭中發送禁用緩存的命令。";

$ini['session.cache_expire'] = "指定會話頁面在客戶端cache中的有效期限(分鐘)
<br> session.cache_limiter=nocache時，此處設置無效。";

$ini['session.use_trans_sid'] = "是否使用明碼在URL中顯示SID(會話ID)。
<br> 預設是禁止的，因為它會給你的用戶帶來安全危險：
<br> 1- 用戶可能將包含有效sid的URL通過email/irc/QQ/MSN...途徑告訴給其他人。
<br> 2- 包含有效sid的URL可能會被保存在公用電腦上。
<br> 3- 用戶可能保存帶有固定不變sid的URL在他們的收藏夾或者瀏覽歷史紀錄裡面。
<br> 基於URL的會話管理總是比基於Cookie的會話管理有更多的風險，所以應當禁用。";

$ini['session.bug_compat_42'] = "";

$ini['session.bug_compat_warn'] = "PHP4.2之前的版本有一個未註明的\"BUG\"：
<br> 即使在register_globals=Off的情況下也允許初始化全局session變數，
<br> 如果你在PHP4.3之後的版本中使用這個特性，會顯示一條警告。
<br> 建議關閉該\"BUG\"並顯示警告。PHP6刪除了這兩個指令，相當於全部設為Off。";

$ini['session.hash_function'] = "生成SID的散列算法。SHA-1的安全性更高一些
<br> 0: MD5   (128 bits)
<br> 1: SHA-1 (160 bits)
<br> 建議使用SHA-1。";

$ini['session.hash_bits_per_character'] = "指定在SID字符串中的每個字符內保存多少bit，
<br> 這些二進制數是hash函數的運算結果。
<br> 4: 0-9, a-f
<br> 5: 0-9, a-v
<br> 6: 0-9, a-z, A-Z, \"-\", \",\"
<br> 建議值為 5";

$ini['url_rewriter.tags'] = "此指令屬於PHP核心部分，並不屬於Session模組。
<br> 指定重寫哪些HTML標籤來包含SID(僅當session.use_trans_sid=On時有效)
<br> form和fieldset比較特殊：
<br> 如果你包含他們，URL重寫器將添加一個隱藏的\"&lt;input&gt;\"，它包含了本應當額外追加到URL上的信息。
<br> 如果要符合XHTML標準，請去掉form項並在表單字段前後加上&lt;fieldset&gt;標記。
<br> 注意：所有合法的項都需要一個等號(即使後面沒有值)。
<br> 推薦值為\"a=href,area=href,frame=src,input=src,form=fakeentry\"。";

$ini['session.encode_sources'] = "PHP6中有爭議的指令，尚未決定是否採用該指令。也尚無相關文檔。";

$ini['apc.enabled'] = "是否啟用APC，如果APC被靜態編譯進PHP又想禁用它，這是唯一的辦法。";

$ini['apc.enable_cli'] = "是否為CLI版本啟用APC功能，僅用於測試和調試目的才打開此指令。";

$ini['apc.cache_by_default'] = "是否預設對所有檔案啟用緩衝。
<br> 若設為Off並與以加號開頭的apc.filters指令一起用，則檔案僅在匹配過濾器時才被緩存。";

$ini['apc.file_update_protection'] = "當你在一個運行中的伺服器上修改檔案時，你應當執行原子操作。
<br> 也就是先寫進一個臨時檔案，然後將該檔案重命名(mv)到最終的名字。
<br> 文本編輯器以及 cp, tar 等程序卻並不是這樣操作的，從而導致有可能緩衝了殘缺的檔案。
<br> 預設值 2 表示在訪問檔案時如果發現修改時間距離訪問時間小於 2 秒則不做緩衝。
<br> 那個不幸的訪問者可能得到殘缺的內容，但是這種壞影響卻不會通過緩存擴大化。
<br> 如果你能確保所有的更新操作都是原子操作，那麼可以用 0 關閉此特性。
<br> 如果你的系統由於大量的IO操作導致更新緩慢，你就需要增大此值。";

$ini['apc.filters'] = "一個以逗號分隔的POSIX擴展正則表達式列表。
<br> 如果源檔案名與任意一個模式匹配，則該檔案不被緩存。
<br> 注意，用來匹配的檔案名是傳遞給include/require的檔案名，而不是絕對路徑。
<br> 如果正則表達式的第一個字符是" + "則意味著任何匹配表達式的檔案會被緩存，
<br> 如果第一個字符是" - "則任何匹配項都不會被緩存。" - "是預設值，可以省略掉。";

$ini['apc.ttl'] = "緩存條目在緩衝區中允許逗留的秒數。0 表示永不超時。建議值為7200~86400。
<br> 設為 0 意味著緩衝區有可能被舊的緩存條目填滿，從而導致無法緩存新條目。";

$ini['apc.user_ttl'] = "類似於apc.ttl，只是針對每個用戶而言，建議值為7200~86400。
<br> 設為 0 意味著緩衝區有可能被舊的緩存條目填滿，從而導致無法緩存新條目。";

$ini['apc.gc_ttl'] = "緩存條目在垃圾回收表中能夠存在的秒數。
<br> 此值提供了一個安全措施，即使一個伺服器進程在執行緩存的源檔案時崩潰，
<br> 而且該源檔案已經被修改，為舊版本分配的內存也不會被回收，直到達到此TTL值為止。
<br> 設為零將禁用此特性。";

$ini['apc.include_once_override'] = "優化include_once()和require_once()函數以避免執行額外的系統調用。";

$ini['apc.max_file_size'] = "禁止大於此尺寸的檔案被緩存。";

$ini['apc.mmap_file_mask'] = "如果使用--enable-mmap(預設啟用)為APC編譯了MMAP支持，
<br> 這裡的值就是傳遞給mmap模組的mktemp風格的檔案掩碼(建議值為\"/tmp/apc.XXXXXX\")。
<br> 該掩碼用於決定內存映射區域是否要被file-backed或者shared memory backed。
<br> 對於直接的file-backed內存映射，要設置成\"/tmp/apc.XXXXXX\"的樣子(恰好6個X)。
<br> 要使用POSIX風格的shm_open/mmap就需要設置成\"/apc.shm.XXXXXX\"的樣子。
<br> 你還可以設為\"/dev/zero\"來為匿名映射的內存使用內核的\"/dev/zero\"接口。
<br> 不定義此指令則表示強制使用匿名映射。";

$ini['apc.num_files_hint'] = "Web伺服器上可能被包含或被請求的不同腳本源代碼檔案的大致數量(建議值為1024~4096)。
<br> 如果你不能確定，則設為 0 ；此設定主要用於擁有數千個源檔案的站點。";

$ini['apc.optimization'] = "優化級別(建議值為 0 ) 。反對使用該指令。將來可能會被刪除。
<br> 正整數值表示啟用優化器，值越高則使用越激進的優化。
<br> 更高的值可能有非常有限的速度提升，但目前尚在試驗中。";

$ini['apc.report_autofilter'] = "是否記錄所有由於early/late binding原因而自動未被緩存的腳本。";

$ini['apc.shm_segments'] = "為編譯器緩衝區分配的共享內存塊數量(建議值為1)。
<br> 如果APC耗盡了共享內存，並且已將apc.shm_size指令設為系統允許的最大值，可以嘗試增大此值。
<br> 在mmap模式下設置為 1 之外的其它值是無效的，因為經過mmap的共享內存段的大小是沒有限制的。";

$ini['apc.shm_size'] = "每個共享內存塊的大小(以MB為單位，建議值為128~256)。
<br> 有些系統(包括大多數BSD變種)預設的共享內存塊尺寸很小。";

$ini['apc.slam_defense'] = "在非常繁忙的伺服器上，無論是啟動服務還是修改檔案，
<br> 都可能由於多個進程企圖同時緩存一個檔案而導致競爭條件。
<br> 這個指令用於設置進程在處理未被緩存的檔案時跳過緩存步驟的百分率。
<br> 比如設為75表示在遇到未被緩存的檔案時有75%的概率不進行緩存，從而減少碰撞幾率。
<br> 反對使用該指令，鼓勵設為 0 來禁用這個特性。建議該用apc.write_lock指令。";

$ini['apc.stat'] = "是否啟用腳本更新檢查。
<br> 改變這個指令值要非常小心。
<br> 預設值 On 表示APC在每次請求腳本時都檢查腳本是否被更新，
<br> 如果被更新則自動重新編譯和緩存編譯後的內容。但這樣做對性能有不利影響。
<br> 如果設為 Off 則表示不進行檢查，從而使性能得到大幅提高。
<br> 但是為了使更新的內容生效，你必須重啟Web伺服器。
<br> 這個指令對於include/require的檔案同樣有效。但是需要注意的是，
<br> 如果你使用的是相對路徑，APC就必須在每一次include/require時都進行檢查以定位檔案。
<br> 而使用絕對路徑則可以跳過檢查，所以鼓勵你使用絕對路徑進行include/require操作。";

$ini['apc.user_entries_hint'] = "類似於num_files_hint指令，只是針對每個不同用戶而言。
<br> 如果你不能確定，則設為 0 。";

$ini['apc.write_lock'] = "是否啟用寫入鎖。
<br> 在非常繁忙的伺服器上，無論是啟動服務還是修改檔案，
<br> 都可能由於多個進程企圖同時緩存一個檔案而導致競爭條件。
<br> 啟用該指令可以避免競爭條件的出現。";

$ini['apc.rfc1867'] = "打開該指令後，對於每個恰好在file字段之前含有APC_UPLOAD_PROGRESS字段的上傳檔案，
<br> APC都將自動創建一個upload_&lt;key&gt;的用戶緩存條目(&lt;key&gt;就是APC_UPLOAD_PROGRESS字段值)。
<br> 需要注意的是，檔案上傳跟蹤在這裡並不是線程安全的，
<br> 所以如果老檔案尚未上載完畢且新檔案已經開始上載，那麼將丟失對老檔案的跟蹤。";

$ini['apc.rfc1867_prefix'] = "用於rfc1867上傳檔案的緩衝項條目名稱前綴";

$ini['apc.rfc1867_name'] = "需要由APC處理的上傳檔案的rfc1867隱含表單項名稱";

$ini['apc.rfc1867_freq'] = "用戶rfc1867上傳檔案緩存項的更新頻率。
<br> 取值可以是總檔案大小的百分比，或者以'K','M','G'結尾的絕對尺寸。
<br> 0 表示盡可能快的更新，不過這樣可能會導致運行速度下降。";

$ini['apc.localcache'] = "是否使用非鎖定本地進程shadow-cache ，它可以減少了向緩衝區寫入時鎖之間的競爭。";

$ini['apc.localcache.size'] = "本地進程的shadow-cache，應當設為一個足夠大的值，大約相當於num_files_hint的一半。";

$ini['apc.stat_ctime'] = "尚無文檔";

$ini['bcmath.scale'] = "用於所有bcmath函數的10十進制數的個數";

$ini['gd.jpeg_ignore_warning'] = "是否忽略jpeg解碼器的警告信息(比如無法識別圖片格式)。
<br> 有image/jpeg與image/pjpeg兩種MIME類型，GD庫只能識別前一種傳統格式。
<br> 參見：[url]http://twpug.net/modules/newbb/v[/url] ... d=1867&forum=14
<br> [url]http://bugs.php.net/bug.php?id=29878[/url]
<br> [url]http://www.faqs.org/faqs/jpeg-faq/part1/section-11.html[/url]";

$ini['filter.default'] = "使用指定的過濾器過濾\$_GET,\$_POST,\$_COOKIE,\$_REQUEST數據，
<br> 原始數據可以通過input_get()函數訪問。
<br> \"unsafe_raw\"表示不做任何過濾。";

$ini['filter.default_flags'] = "filter_data()函數的預設標誌。";

$ini['mbstring.language'] = "預設的NLS(本地語言設置)，可設置值如下：
<br> 預設值\"neutral\"表示中立，相當於未知。
<br> \"zh-cn\"或\"Simplified Chinese\"表示簡體中文
<br> \"zh-tw\"或\"Traditional Chinese\"表示繁體中文
<br> \"uni\"或\"universal\"表示Unicode
<br> 該指令自動定義了隨後的mbstring.internal_encoding指令預設值，
<br> 並且mbstring.internal_encoding指令必須放置在該指令之後。";

$ini['mbstring.internal_encoding'] = "本指令必須放置在mbstring.language指令之後。
<br> 預設的內部編碼，未設置時取決於mbstring.language指令的值：
<br> \"neutral\" 對應 \"ISO-8859-1\"
<br> \"zh-cn\"   對應 \"EUC-CN\" (等價於\"GB2312\")
<br> \"zh-tw\"   對應 \"EUC-TW\" (等價於\"BIG5\")
<br> \"uni\"     對應 \"UTF-8\"
<br> 提醒：對於簡體中文還可以強制設置為\"CP936\" (等價於\"GBK\")
<br> 注意：可能 SJIS, BIG5, GBK 不適合作為內部編碼，不過\"GB2312\"肯定沒問題。
<br> 建議手動強制指定";

$ini['mbstring.encoding_translation'] = "是否對進入的HTTP請求按照mbstring.internal_encoding指令進行透明的編碼轉換，
<br> 也就是自動檢測輸入字符的編碼並將其透明的轉化為內部編碼。
<br> 可移植的庫或者程序千萬不要依賴於自動編碼轉換。";

$ini['mbstring.http_input'] = "預設的HTTP輸入編碼，\"pass\"表示跳過(不做轉換)
<br> \"aotu\"的含義與mbstring.detect_order指令中的解釋一樣。
<br> 可以設置為一個單獨的值，也可以設置為一個逗號分隔的列表。";

$ini['mbstring.http_output'] = "預設的HTTP輸出編碼，\"pass\"表示跳過(不做轉換)
<br> \"aotu\"的含義與mbstring.detect_order指令中的解釋一樣。
<br> 可以設置為一個單獨的值，也可以設置為一個逗號分隔的列表。
<br> 必須將output_handler指令設置為\"mb_output_handler\"才可以。";

$ini['mbstring.detect_order'] = "預設的編碼檢測順序，\"pass\"表示跳過(不做轉換)。
<br> 預設值(\"auto\")隨mbstring.language指令的不同而變化：
<br> \"neutral\"和\"universal\" 對應 \"ASCII, UTF-8\"
<br> \"Simplified Chinese\"   對應 \"ASCII, UTF-8, EUC-CN, CP936\"
<br> \"Traditional Chinese\"  對應 \"ASCII, UTF-8, EUC-TW, BIG-5\"
<br> 建議在可控環境下手動強制指定一個單一值";

$ini['mbstring.func_overload'] = "自動使用 mb_* 函數重載相應的單字節字符串函數。
<br> 比如：mail(), ereg() 將被自動替換為mb_send_mail(), mb_ereg()
<br> 可用 0,1,2,4 進行位組合。比如7表示替換所有。具體替換說明如下：
<br> 0: 無替換
<br> 1: mail() → mb_send_mail()
<br> 2: strlen() → mb_strlen() <br> substr() → mb_substr()
<br>    strpos() → mb_strpos() <br> strrpos() → mb_strrpos()
<br>    strtolower() → mb_strtolower() <br> strtoupper() → mb_strtoupper()
<br>    substr_count() → mb_substr_count()
<br> 4: ereg() → mb_ereg() <br> eregi() → mb_eregi()
<br>    ereg_replace() → mb_ereg_replace() <br> eregi_replace() → mb_eregi_replace()
<br>    split() → mb_split()";

$ini['mbstring.script_encoding'] = "腳本所使用的編碼";

$ini['mbstring.strict_detection'] = "是否使用嚴謹的編碼檢測";

$ini['mbstring.substitute_character'] = "當某個字符無法解碼時，就是用這個字符替代。
<br> 若設為一個整數則表示對應的Unicode值，不設置任何值表示不顯示這個錯誤字符。
<br> 建議設為\"□\"";

$ini['mcrypt.algorithms_dir'] = "預設的加密算法模組所在目錄。通常是\"/usr/local/lib/libmcrypt\"。
<br> 目前尚無詳細說明文檔，此處的解釋可能是錯誤的。";

$ini['mcrypt.modes_dir'] = "預設的加密模式模組所在目錄。通常是\"/usr/local/lib/libmcrypt\"。
<br> 目前尚無說明文檔，此處的解釋可能是錯誤的。";

$ini['memcache.allow_failover'] = 'Whether to transparently failover to other servers on errors.';

$ini['memcache.chunk_size'] = 'Data will be transferred in chunks of this size, setting the value lower requires more network writes.
<br> Try increasing this value to 32768 if noticing otherwise inexplicable slowdowns.';

$ini['memcache.default_port'] = 'The default TCP port number to use when connecting to the memcached server if no other port is specified.';

$ini['memcache.max_failover_attempts'] = 'Defines how many servers to try when setting and getting data. Used only in conjunction with memcache.allow_failover.';

$ini['memcache.hash_strategy'] = 'Controls which strategy to use when mapping keys to servers.
<br> Set this value to consistent to enable consistent hashing which allows servers to be added or removed from the pool without causing keys to be remapped.
<br> Setting this value to standard results in the old strategy being used.';

$ini['memcache.hash_function'] = 'Controls which hash function to apply when mapping keys to servers, crc32 uses the standard CRC32 hash while fnv uses FNV-1a.';

$ini['zlib.output_compression'] = "是否使用zlib庫透明地壓縮腳本輸出結果。
<br> 該指令的值可以設置為：Off、On、字節數(壓縮緩衝區大小，預設為4096)。
<br> 如果打開該指令，當瀏覽器發送\"Accept-Encoding: gzip(deflate)\"頭時，
<br> \"Content-Encoding: gzip(deflate)\"和\"Vary: Accept-Encoding\"頭將加入到應答頭當中。
<br> 你可以在應答頭輸出之前用ini_set()函數在腳本中啟用或禁止這個特性。
<br> 如果輸出一個\"Content-Type: image/??\"這樣的應答頭，壓縮將不會啟用(為了防止Netscape的bug)。
<br> 你可以在輸出\"Content-Type: image/??\"之後使用\"ini_set('zlib.output_compression', 'On')\"重新打開這個特性。
<br> 注意1: 壓縮率會受壓縮緩衝區大小的影響，如果你想得到更好的壓縮質量，請指定一個較大的壓縮緩衝區。
<br> 注意2: 如果啟用了zlib輸出壓縮，output_handler指令必須為空，同時必須設置zlib.output_handler指令的值。";

$ini['zlib.output_compression_level'] = "壓縮級別，可用值為 0~9 ，0表示不壓縮。值越高效果越好，但CPU佔用越多，建議值為1~5。
<br> 預設值 -1 表示使用zlib內部的預設值(6)。";

$ini['zlib.output_handler'] = "在打開zlib.output_compression指令的情況下，你只能在這裡指定輸出處理器。
<br> 可以使用的處理器有\"zlib.inflate\"(解壓)或\"zlib.deflate\"(壓縮)。
<br> 如果啟用該指令則必須將output_handler指令設為空。";

$ini['dbx.colnames_case'] = "字段名可以按照\"unchanged\"或\"uppercase\",\"lowercase\"方式返回。";

$ini['mysqli.max_links'] = "每個進程中允許的最大連接數(持久和非持久)。-1 代表無限制";

$ini['mysqli.default_port'] = "mysqli_connect()連接到MySQL資料庫時使用的預設TCP端口。
<br> 如果沒有在這裡指定預設值，將按如下順序尋找：
<br> (1)\$MYSQL_TCP_PORT環境變數
<br> (2)/etc/services檔案中的mysql-tcp項(unix)
<br> (3)編譯時指定的MYSQL_PORT常量
<br> 注意：Win32下，只使用MYSQL_PORT常量。";

$ini['mysqli.default_socket'] = "mysqli_connect()連接到本機MySQL伺服器時所使用的預設套接字名。
<br> 若未指定則使用內置的MqSQL預設值。";

$ini['mysqli.default_host'] = "mysqli_connect()連接到MySQL資料庫時使用的預設主機。安全模式下無效。";

$ini['mysqli.default_user'] = "mysqli_connect()連接到MySQL資料庫時使用的預設用戶名。安全模式下無效。";

$ini['mysqli.default_pw'] = "mysqli_connect()連接到MySQL資料庫時使用的預設密碼。安全模式下無效。
<br> 在配置檔案中保存密碼是個壞主意，任何使用PHP權限的用戶都可以運行
<br> 'echo cfg_get_var(\"mysql.default_password\")'來顯示密碼!
<br> 而且任何對該配置檔案有讀權限的用戶也能看到密碼。";

$ini['mysqli.reconnect'] = "是否允許重新連接";

$ini['pgsql.allow_persistent'] = "是否允許持久連接";

$ini['pgsql.max_persistent'] = "每個進程中允許的最大持久連接數。-1 代表無限制。";

$ini['pgsql.max_links'] = "每個進程中允許的最大連接數(持久和非持久)。-1 代表無限制。";

$ini['pgsql.auto_reset_persistent'] = "自動復位在pg_pconnect()上中斷了的持久連接，檢測需要一些額外開銷。";

$ini['pgsql.ignore_notice'] = "是否忽略PostgreSQL後端的提醒消息。
<br> 記錄後端的提醒消息需要一些很小的額外開銷。";

$ini['pgsql.log_notice'] = "是否在日誌中記錄PostgreSQL後端的提醒消息。
<br> 僅在pgsql.ignore_notice=Off時，才可以記錄。";
