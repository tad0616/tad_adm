<?php
$ini['allow_url_fopen'] = "whether to allow open remote file";
$ini['date.timezone']   = "TZ environment variable is not set for the default date and time functions for all time zones. Priority
<br> application time zone is:
<br> 1. time zone setting function with date_default_timezone_set () (If you set it)
<br> 2. TZ environment variable (if non-empty words)
<br> 3. the instruction value (if set words)
<br> 4. PHP own speculation (if the operating system supports)
<br> 5. If the above are not successful, then use UTC ";

$ini['display_errors'] = 'This determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user.
<br> You\'re strongly advised to use error logging in place of error displaying on production web sites,
<br> otherwise it may expose some security information to hackers,
<br> such as file path on your web server, database planning or other information.';

$ini['file_uploads'] = 'Whether or not to allow HTTP file uploads. <br> See also the upload_max_filesize, upload_tmp_dir, and post_max_size directives.';

$ini['max_file_uploads'] = 'The maximum number of files allowed to be uploaded simultaneously.
// <br> Starting with PHP 5.3.4, upload fields left blank on submission do not count towards this limit.';
$ini['max_execution_time'] = 'This sets the maximum time in seconds a script is allowed to run before it is terminated by the parser.
<br> This helps prevent poorly written scripts from tying up the server.
<br> The default setting is 30. When running PHP from the command line the default setting is 0.
<br> The maximum execution time is not affected by system calls, stream operations etc.
<br> Please see the set_time_limit() function for more details.';

$ini['max_input_time'] = 'This sets the maximum time in seconds a script is allowed to parse input data, like POST and GET.
<br> Timing begins at the moment PHP is invoked at the server and ends when execution begins.';

$ini['max_input_vars'] = 'How many input variables may be accepted (limit is applied to $_GET, $_POST and $_COOKIE superglobal separately).
<br> Use of this directive mitigates the possibility of denial of service attacks which use hash collisions.
<br> If there are more input variables than specified by this directive, an E_WARNING is issued,
<br> and further input variables are truncated from the request.';

$ini['memory_limit'] = 'This sets the maximum amount of memory in bytes that a script is allowed to allocate.
<br> This helps prevent poorly written scripts for eating up all available memory on a server.
<br> Note that to have no memory limit, set this directive to -1.';

$ini['post_max_size'] = 'Sets max size of post data allowed. This setting also affects file upload.
<br> To upload large files, this value must be larger than upload_max_filesize.
<br> If memory limit is enabled by your configure script, memory_limit also affects file uploading.
<br> Generally speaking, memory_limit should be larger than post_max_size.
<br> If the size of post data is greater than post_max_size, the $_POST and $_FILES superglobals are empty.';

$ini['short_open_tag'] = 'Tells PHP whether the short form (&lt;? ?&gt;) of PHP\'s open tag should be allowed.
<br> If you want to use PHP in combination with XML, you can disable this option in order to use &lt;?xml ?&gt; inline.
<br> Otherwise, you can print it with PHP, for example: &lt;?php echo \'&lt;?xml version="1.0"?&gt;\'; ?&gt;.
<br> Also, if disabled, you must use the long form of the PHP open tag (&lt;?php ?&gt;).';

$ini['upload_max_filesize'] = 'The maximum size of an uploaded file.';
