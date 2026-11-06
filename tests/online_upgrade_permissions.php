<?php

namespace Xmf {
    class Request
    {
        public static $forceSsh = 0;
        public static $progressToken = '';
        public static $templateMode = '';

        public static function getInt($name)
        {
            return 'force_ssh' === $name ? self::$forceSsh : 0;
        }

        public static function getString($name)
        {
            if ('upgrade_progress_token' === $name) {
                return self::$progressToken;
            }
            return 'tad_adm_tpl' === $name ? self::$templateMode : '';
        }
    }
}

namespace XoopsModules\Tadtools {
    class Utility
    {
        public static $queries = [];
        public static $sshMock;

        public static function query($sql, $types, $values)
        {
            self::$queries[] = [$sql, $values];
            return true;
        }

        public static function ssh_login($host, $port, $user, $password)
        {
            return self::$sshMock;
        }

        public static function mk_dir($path)
        {
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
        }

        public static function delete_directory($path)
        {
            foreach (scandir($path) as $entry) {
                if ('.' === $entry || '..' === $entry) {
                    continue;
                }
                $child = $path . '/' . $entry;
                if (is_dir($child)) {
                    self::delete_directory($child);
                } else {
                    unlink($child);
                }
            }
            return rmdir($path);
        }
    }
}

namespace XoopsModules\Tad_adm {
    function session_start()
    {
        global $forceSessionRestoreFailure;
        return empty($forceSessionRestoreFailure) ? \session_start() : false;
    }

    function is_writable($path)
    {
        global $unwritablePaths;
        if (in_array(str_replace('\\', '/', rtrim($path, '/\\')), $unwritablePaths ?? [], true)) {
            return false;
        }
        return \is_writable($path);
    }
}

namespace {
    use XoopsModules\Tad_adm\OnlineUpgrade;
    use XoopsModules\Tad_adm\UpgradeManifest;

    require_once dirname(__DIR__) . '/class/DunZip2.php';
    require_once dirname(__DIR__) . '/class/UpgradeManifest.php';
    require_once dirname(__DIR__) . '/class/UpgradeProgress.php';
    require_once dirname(__DIR__) . '/class/OnlineUpgrade.php';

    class Redirect extends \RuntimeException {}

    function redirect_header($url, $time, $message)
    {
        global $xoopsConfig, $lastRedirect;
        $lastRedirect = ['url' => $url, 'time' => $time, 'ajax' => $xoopsConfig['redirect_message_ajax'] ?? false];
        if (!empty($xoopsConfig['redirect_message_ajax'])) {
            $_SESSION['redirect_message'] = $message;
        }
        throw new Redirect($message);
    }

    function check($condition, $message)
    {
        if (!$condition) {
            throw new \RuntimeException($message);
        }
    }

    class FakeSsh
    {
        public $status;
        public $output;
        public $command;
        public $timeout;
        public $keepAlive;
        public $timedOut = false;
        public $exception = false;
        public $deletePath = '';

        public function __construct($status, $output)
        {
            $this->status = $status;
            $this->output = $output;
        }

        public function exec($command, $callback = null)
        {
            $this->command = $command;
            if ($this->exception) {
                throw new \RuntimeException('connection closed');
            }
            if ($this->deletePath !== '' && $this->status === 0) {
                \XoopsModules\Tadtools\Utility::delete_directory($this->deletePath);
            }
            if ($callback && false !== $this->output) {
                $middle = intdiv(strlen($this->output), 2);
                $callback(substr($this->output, 0, $middle));
                $callback(substr($this->output, $middle));
                return true;
            }
            return $this->output;
        }

        public function getExitStatus()
        {
            return $this->status;
        }

        public function setTimeout($timeout)
        {
            $this->timeout = $timeout;
        }

        public function setKeepAlive($interval)
        {
            $this->keepAlive = $interval;
        }

        public function isTimeout()
        {
            return $this->timedOut;
        }
    }

    class FakeTemplate
    {
        public $values = [];

        public function assign($key, $value)
        {
            $this->values[$key] = $value;
        }
    }

    $base = sys_get_temp_dir() . '/tad_adm_test_' . bin2hex(random_bytes(8));
    mkdir($base . '/site/uploads', 0755, true);
    mkdir($base . '/site/modules/demo', 0755, true);
    mkdir($base . '/source/uploads/tad_modules/file', 0755, true);
    define('XOOPS_ROOT_PATH', $base . '/site');
    define('XOOPS_VAR_PATH', XOOPS_ROOT_PATH);
    define('XOOPS_PATH', XOOPS_ROOT_PATH);
    define('XOOPS_VERSION', 'XOOPS 2.7.4');
    define('XOOPS_URL', 'http://example.test');
    define('_MA_TADADM_INVALID_PACKAGE_DIR', 'invalid %s');
    define('_MA_TADADM_STAGING_WRITE_FAIL', 'staging %1$s %2$s');
    define('_MA_TADADM_DL_FAIL', 'download %s');
    define('_MA_TADADM_WRITE_FAIL', 'write %1$s %2$s');
    define('_MA_TADADM_EXTRACT_FAIL', 'extract %s');
    define('_MA_TADADM_SESSION_RESTORE_FAIL', 'session restore failed');
    define('_MA_TADADM_COPY_FAIL', 'copy %1$d %2$s');
    define('_MA_TADADM_SSH_STEPS_FAIL', 'ssh %s');
    define('_MA_TADADM_UPGRADE_TIME_LIMIT_FAIL', 'time limit failed');
    define('_MA_TADADM_SSH_INCOMPLETE', 'ssh incomplete; possible partial upgrade');
    define('_MA_TADADM_MV_FAIL', 'move %s');
    define('_MA_TADADM_PREFLIGHT_FAIL', 'preflight %1$s %2$d %3$s %4$s');
    define('_MA_TADADM_THEME_DELETE_PREFLIGHT', 'delete preflight %1$s %2$d %3$s %4$s');
    define('_MA_TADADM_THEME_DELETE_FAIL', 'theme delete failed');
    define('_MA_TADADM_THEME_DELETE_SSH_FAIL', 'theme SSH delete failed; possible partial deletion: %s');
    define('_MA_TADADM_THEME_DELETE_OK', 'theme delete succeeded');
    define('_MA_TADADM_PREFLIGHT_SHOWN', 'shown %d');
    define('_MA_TADADM_SCRIPT_NOT_FOUND', 'missing script %s');
    define('_MA_TADADM_MANIFEST_INVALID', 'invalid manifest %s');
    define('_MA_TADADM_UPGRADE_WARN', 'warning %s');
    define('_MA_TADADM_WARN_STEP', 'step %1$d %2$s %3$d %4$s');
    define('_MA_TADADM_SSH_WARN_STEP', 'step %1$d (%2$s) target %3$s');
    define('_MA_TADADM_SSH_WARN_OUTPUT', 'SSH output:');
    define('_MA_TADADM_WARN_BLOCKED', 'blocked %d');
    define('_MA_TADADM_WARN_CHMOD', 'chmod %d');
    define('_MA_TADADM_WARN_DELETE', 'delete %d');
    define('_MA_TADADM_PROGRESS_PREPARE', 'Preparing');
    define('_MA_TADADM_PROGRESS_DOWNLOAD', 'Downloading: %s');
    define('_MA_TADADM_PROGRESS_COUNT', 'Reporting');
    define('_MA_TADADM_PROGRESS_SAVE', 'Saving: %s');
    define('_MA_TADADM_PROGRESS_STAGING', 'Preparing extraction');
    define('_MA_TADADM_PROGRESS_EXTRACT', 'Extracting: %s');
    define('_MA_TADADM_PROGRESS_CHECK', 'Checking');
    define('_MA_TADADM_PROGRESS_COPY', 'Copying to: %s');
    define('_MA_TADADM_PROGRESS_STEP', 'Running %1$s: %2$s');
    define('_MA_TADADM_PROGRESS_SSH', 'Running SSH');
    define('_MA_TADADM_UPGRADE_FROM_URL', 'Upgrade ready');
    define('_MA_TADADM_UPGRADE_DIR_MISSING', 'Missing %s');
    $_SERVER['PHP_SELF'] = 'main.php';
    $_SESSION = [];
    $inSchoolWeb = false;
    $unwritablePaths = [];
    $xoopsModule = new class {
        public function dirname() { return 'tad_adm'; }
    };
    $source = 'file:///' . ltrim(str_replace('\\', '/', $base . '/source'), '/');
    $xoopsModuleConfig = ['source' => $source];
    $xoopsConfig = ['sitename' => 'test', 'theme_set' => 'test', 'language' => 'english', 'redirect_message_ajax' => 1];
    $xoopsTpl = new FakeTemplate();
    $xoopsDB = new class {
        public function prefix($table) { return 'xoops_' . $table; }
    };
    $archive = $base . '/source/uploads/tad_modules/file/demo.zip';

    try {
        $zip = new \PharData($archive);
        $zip->addFromString('demo/nested/file.txt', 'new content');
        $zip->addFromString('demo/empty.txt', '');
        unset($zip);
        $url = $source . '/uploads/tad_modules/file/demo.zip';
        file_put_contents(XOOPS_ROOT_PATH . '/modules/demo/old.txt', 'keep');
        $unwritablePaths = [str_replace('\\', '/', XOOPS_ROOT_PATH . '/modules/demo')];
        OnlineUpgrade::to_do($url, 'demo', 'upgrade_module', 1);
        check($xoopsTpl->values['now_op'] === 'login_form', 'Unwritable module target did not request SSH login');
        check(strpos($xoopsTpl->values['ssh_preflight_message'], '/modules/demo') !== false, 'Target permission problem was not shown');
        check($xoopsTpl->values['dirname'] === 'demo' && $xoopsTpl->values['act'] === 'upgrade_module', 'Module SSH context was lost');
        check(!is_dir(XOOPS_ROOT_PATH . '/uploads/tad_adm'), 'Module upgrade downloaded before target permission check');
        $unwritablePaths = [];
        $xoopsTpl = new FakeTemplate();
        check(OnlineUpgrade::get_new_file($url, 'demo', 'modules', 1, '', 'upgrade_module'), 'PHP copy failed');
        check(file_get_contents(XOOPS_ROOT_PATH . '/modules/demo/nested/file.txt') === 'new content', 'PHP copy did not update nested file');
        check(file_exists(XOOPS_ROOT_PATH . '/modules/demo/empty.txt'), 'Empty file was not extracted');
        check(file_get_contents(XOOPS_ROOT_PATH . '/modules/demo/old.txt') === 'keep', 'Existing unrelated file was removed');

        $unwritablePaths = [str_replace('\\', '/', XOOPS_ROOT_PATH . '/modules/demo/nested/file.txt')];
        $xoopsTpl = new FakeTemplate();
        OnlineUpgrade::to_do($url, 'demo', 'upgrade_module', 1);
        check($xoopsTpl->values['now_op'] === 'login_form', 'Unwritable nested file did not request SSH login');
        check(strpos($xoopsTpl->values['ssh_preflight_message'], 'nested/file.txt') !== false, 'Nested permission problem was not shown');
        check($xoopsTpl->values['file_link'] === $url && $xoopsTpl->values['update_sn'] === 1, 'Nested SSH retry context was lost');
        $unwritablePaths = [];

        unlink(XOOPS_ROOT_PATH . '/modules/demo/nested/file.txt');
        rmdir(XOOPS_ROOT_PATH . '/modules/demo/nested');
        file_put_contents(XOOPS_ROOT_PATH . '/modules/demo/nested', 'conflict');
        $xoopsTpl = new FakeTemplate();
        check(!OnlineUpgrade::get_new_file($url, 'demo', 'modules', 1, '', 'upgrade_module'), 'Expected preflight failure');
        check($xoopsTpl->values['now_op'] === 'login_form', 'Preflight did not request SSH login');
        check(strpos($xoopsTpl->values['ssh_preflight_message'], 'preflight') !== false, 'Preflight details are missing');
        check($xoopsTpl->values['file_link'] === $url && $xoopsTpl->values['act'] === 'upgrade_module', 'Preflight SSH context was lost');
        check(file_get_contents(XOOPS_ROOT_PATH . '/modules/demo/nested') === 'conflict', 'Preflight changed destination');

        $ssh = new FakeSsh(1, 'permission denied');
        try {
            OnlineUpgrade::get_new_file($url, 'demo', 'modules', 1, $ssh, 'upgrade_module');
            throw new \RuntimeException('Expected SSH failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'permission denied') !== false, 'SSH error was not reported');
        }
        check(strpos($ssh->command, 'chown') === false, 'Unexpected ownership change');
        check(file_exists(XOOPS_ROOT_PATH . '/uploads/demo.zip'), 'Failed SSH copy removed package');

        $ssh = new FakeSsh(false, '');
        try {
            OnlineUpgrade::get_new_file($url, 'demo', 'modules', 1, $ssh, 'upgrade_module');
            throw new \RuntimeException('Expected unavailable SSH exit status failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'unavailable') !== false, 'Missing SSH exit status was accepted');
        }

        \Xmf\Request::$forceSsh = 1;
        OnlineUpgrade::do_other($url, 12, 34, 'upgrade_other');
        check($xoopsTpl->values['now_op'] === 'login_form', 'Other package did not request SSH login');
        check($xoopsTpl->values['module_sn'] === 34 && $xoopsTpl->values['act'] === 'upgrade_other', 'Other package SSH context was lost');

        \Xmf\Request::$forceSsh = 0;
        $otherArchive = $base . '/source/uploads/tad_modules/file/other.zip';
        $other = new \PharData($otherArchive);
        $other->addFromString('files/other.txt', 'other content');
        $other->addFromString('go.txt', 'full_copy("XOOPS_ROOT_PATH/uploads/tad_adm/MODULE_SN/files", "XOOPS_ROOT_PATH/modules/demo")' . "\n");
        $other->addFromString('ssh.txt', 'cp -R XOOPS_ROOT_PATH/uploads/tad_adm/MODULE_SN/files/. XOOPS_ROOT_PATH/modules/demo/' . "\n");
        unset($other);
        $otherUrl = $source . '/uploads/tad_modules/file/other.zip';
        check(OnlineUpgrade::do_other($otherUrl, 12, 34, 'upgrade_other'), 'Other package PHP operation failed');
        check(file_get_contents(XOOPS_ROOT_PATH . '/modules/demo/other.txt') === 'other content', 'Other package did not copy files');

        $otherSsh = new FakeSsh(1, 'other permission denied');
        try {
            OnlineUpgrade::do_other($otherUrl, 12, 34, 'upgrade_other', $otherSsh);
            throw new \RuntimeException('Expected other package SSH failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'other permission denied') !== false, 'Other package SSH error was not reported');
        }

        $manifestArchive = $base . '/source/uploads/tad_modules/file/manifest.zip';
        $manifestZip = new \PharData($manifestArchive);
        $manifestZip->addFromString('files/manifest.txt', 'manifest content');
        $manifestZip->addFromString('upgrade.json', json_encode(['version' => 1, 'steps' => [
            ['op' => 'copy', 'from' => '{WORK}/files', 'to' => '{ROOT}/modules/demo'],
        ]]));
        unset($manifestZip);
        $manifestUrl = $source . '/uploads/tad_modules/file/manifest.zip';
        check(OnlineUpgrade::do_other($manifestUrl, 12, 35, 'install_other'), 'Manifest package PHP operation failed');
        check(file_get_contents(XOOPS_ROOT_PATH . '/modules/demo/manifest.txt') === 'manifest content', 'Manifest package did not copy files');
        $otherSsh = new FakeSsh(1, 'manifest permission denied');
        try {
            OnlineUpgrade::do_other($manifestUrl, 12, 35, 'install_other', $otherSsh);
            throw new \RuntimeException('Expected manifest SSH failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'manifest permission denied') !== false, 'Manifest SSH error was not reported');
        }

        $conflictArchive = $base . '/source/uploads/tad_modules/file/conflict.zip';
        $conflictZip = new \PharData($conflictArchive);
        $conflictZip->addFromString('files/item.txt', 'item');
        $conflictZip->addFromString('upgrade.json', json_encode(['version' => 1, 'steps' => [
            ['op' => 'copy', 'from' => '{WORK}/files', 'to' => '{ROOT}/modules/demo/nested'],
        ]]));
        unset($conflictZip);
        try {
            OnlineUpgrade::do_other($source . '/uploads/tad_modules/file/conflict.zip', 12, 36, 'upgrade_other');
            throw new \RuntimeException('Expected other package preflight failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'force_ssh=1') !== false && strpos($e->getMessage(), 'module_sn=36') !== false, 'Other package retry context was lost');
        }

        file_put_contents($base . '/source/uploads/tad_modules/file/bad.zip', 'invalid zip');
        try {
            OnlineUpgrade::get_new_file($source . '/uploads/tad_modules/file/bad.zip', 'demo', 'modules', 1, '', 'upgrade_module');
            throw new \RuntimeException('Expected extraction failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'extract') !== false, 'Invalid archive was not rejected');
        }

        // The failed extraction removes the old staging directory; restore it for preflight testing.
        mkdir(XOOPS_ROOT_PATH . '/uploads/tad_adm/demo/nested', 0755, true);
        file_put_contents(XOOPS_ROOT_PATH . '/uploads/tad_adm/demo/nested/file.txt', 'source');
        $step = ['n' => 1, 'op' => 'copy', 'optional' => false, 'kind' => 'dir', 'from' => XOOPS_ROOT_PATH . '/uploads/tad_adm/demo', 'to' => XOOPS_ROOT_PATH . '/modules/demo'];
        check(UpgradeManifest::preflight([$step], XOOPS_ROOT_PATH)['count'] > 0, 'Directory/file conflict not detected');
        $marker = XOOPS_ROOT_PATH . '/marker.txt';
        file_put_contents($marker, 'preserve');
        $steps = [
            ['n' => 1, 'op' => 'copy', 'optional' => false, 'kind' => 'file', 'from' => XOOPS_ROOT_PATH . '/missing', 'to' => XOOPS_ROOT_PATH . '/copy'],
            ['n' => 2, 'op' => 'delete', 'optional' => false, 'path' => $marker],
        ];
        check(count(UpgradeManifest::run_php($steps)['errors']) === 1, 'Copy failure was not reported');
        check(is_file($marker), 'Cleanup ran after a required copy failed');
        check(strpos(UpgradeManifest::to_shell($steps), 'exit 1;') !== false, 'SSH script does not stop after a required copy fails');
        mkdir(XOOPS_ROOT_PATH . '/themes/demo/sub', 0755, true);
        file_put_contents(XOOPS_ROOT_PATH . '/themes/demo/sub/file.txt', 'theme');
        $unwritablePaths = [str_replace('\\', '/', XOOPS_ROOT_PATH . '/themes/demo/sub')];
        $xoopsTpl = new FakeTemplate();
        $queriesBefore = count(\XoopsModules\Tadtools\Utility::$queries);
        OnlineUpgrade::to_do('', 'demo', 'delete_theme');
        check($xoopsTpl->values['now_op'] === 'login_form', 'Nested theme permissions did not show SSH login');
        check($xoopsTpl->values['action'] === 'main.php' && $xoopsTpl->values['dirname'] === 'demo' && $xoopsTpl->values['act'] === 'delete_theme', 'Theme SSH retry context lost');
        check(strpos(str_replace('\\', '/', $xoopsTpl->values['ssh_preflight_message']), '/themes/demo/sub') !== false, 'Theme permission details missing');
        check(is_file(XOOPS_ROOT_PATH . '/themes/demo/sub/file.txt') && count(\XoopsModules\Tadtools\Utility::$queries) === $queriesBefore, 'Theme preflight changed files or configuration');
        $unwritablePaths = [str_replace('\\', '/', XOOPS_ROOT_PATH . '/themes')];
        $xoopsTpl = new FakeTemplate();
        OnlineUpgrade::to_do('', 'demo', 'delete_theme');
        check($xoopsTpl->values['now_op'] === 'login_form' && strpos($xoopsTpl->values['ssh_preflight_message'], '/themes') !== false, 'Unwritable themes parent did not show the SSH reason');
        $unwritablePaths = [];
        \Xmf\Request::$forceSsh = 1;
        $xoopsTpl = new FakeTemplate();
        OnlineUpgrade::to_do('', 'demo', 'delete_theme');
        check($xoopsTpl->values['now_op'] === 'login_form' && $xoopsTpl->values['dirname'] === 'demo', 'Forced SSH did not preserve the theme');
        \Xmf\Request::$forceSsh = 0;
        $themeSsh = new FakeSsh(1, 'theme permission denied');
        try {
            OnlineUpgrade::next_to_do('', 'demo', 'themes', '', 'delete_theme', $themeSsh);
            throw new \RuntimeException('Expected theme SSH deletion failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'theme permission denied') !== false, 'Theme SSH failure was not reported');
            check(!$lastRedirect['ajax'] && $lastRedirect['time'] >= 30, 'Theme SSH failure was not displayed persistently');
        }
        check(is_file(XOOPS_ROOT_PATH . '/themes/demo/sub/file.txt'), 'Failed SSH deletion changed the theme');
        check(count(\XoopsModules\Tadtools\Utility::$queries) === $queriesBefore, 'Failed SSH deletion changed theme configuration');
        $xoopsConfig['redirect_message_ajax'] = 1;
        $ssh = new FakeSsh(0, '');
        $ssh->deletePath = XOOPS_ROOT_PATH . '/themes/demo';
        \XoopsModules\Tadtools\Utility::$sshMock = $ssh;
        $xoopsModuleConfig['ssh_port'] = 22;
        $xoopsConfig['theme_set_allowed'] = ['demo', 'test'];
        try {
            OnlineUpgrade::ssh_login('127.0.0.1', 'user', 'password', '', 'demo', 'delete_theme');
            throw new \RuntimeException('Expected theme success redirect');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'theme delete succeeded') !== false, 'SSH theme deletion did not report success');
        }
        check(!file_exists(XOOPS_ROOT_PATH . '/themes/demo'), 'Theme was not removed');
        check(count(\XoopsModules\Tadtools\Utility::$queries) === $queriesBefore + 2, 'Deleted theme configuration not updated');
        mkdir(XOOPS_ROOT_PATH . '/themes/test');
        try {
            OnlineUpgrade::to_do('', 'test', 'delete_theme');
            throw new \RuntimeException('Expected default theme deletion rejection');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'theme delete failed') !== false, 'Default theme deletion was not rejected');
        }
        check(is_dir(XOOPS_ROOT_PATH . '/themes/test'), 'Default theme was deleted');
        mkdir(XOOPS_ROOT_PATH . '/themes/demo');
        $inSchoolWeb = true;
        try {
            OnlineUpgrade::to_do('', 'demo', 'delete_theme');
            throw new \RuntimeException('Expected shared site theme deletion rejection');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'theme delete failed') !== false, 'Shared site deletion was not rejected');
        }
        try {
            OnlineUpgrade::next_to_do('', 'demo', 'themes', '', 'delete_theme', $ssh);
            throw new \RuntimeException('Expected shared site SSH deletion rejection');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'theme delete failed') !== false, 'Shared site SSH deletion was not rejected');
        }
        check(is_dir(XOOPS_ROOT_PATH . '/themes/demo'), 'Shared site theme was deleted');
        $inSchoolWeb = false;
        try {
            OnlineUpgrade::to_do('', 'demo', 'delete_theme');
            throw new \RuntimeException('Expected PHP theme success redirect');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'theme delete succeeded') !== false, 'PHP theme deletion did not report success');
        }
        check(!file_exists(XOOPS_ROOT_PATH . '/themes/demo'), 'PHP theme deletion failed');
        check(!OnlineUpgrade::delete_theme('..'), 'Invalid theme name was accepted');

        \Xmf\Request::$templateMode = 'clean';
        mkdir(XOOPS_ROOT_PATH . '/themes/demo/sub', 0755, true);
        file_put_contents(XOOPS_ROOT_PATH . '/themes/demo/sub/file.txt', 'theme');
        $unwritablePaths = [str_replace('\\', '/', XOOPS_ROOT_PATH . '/themes/demo/sub')];
        $xoopsTpl = new FakeTemplate();
        OnlineUpgrade::to_do('', 'demo', 'delete_theme');
        check($xoopsTpl->values['now_op'] === 'login_form', 'Clean theme deletion did not show SSH login');
        $unwritablePaths = [];
        $xoopsTpl = new FakeTemplate();
        OnlineUpgrade::ssh_login('127.0.0.1', 'user', 'password', '', 'demo', 'delete_theme');
        check($xoopsTpl->values['now_op'] === 'theme_delete_complete' && $xoopsTpl->values['deleted_theme'] === 'demo', 'SSH deletion did not show clean completion');
        check(!file_exists(XOOPS_ROOT_PATH . '/themes/demo'), 'Clean SSH deletion did not remove the theme');
        mkdir(XOOPS_ROOT_PATH . '/themes/demo');
        $xoopsTpl = new FakeTemplate();
        OnlineUpgrade::to_do('', 'demo', 'delete_theme');
        check($xoopsTpl->values['now_op'] === 'theme_delete_complete' && $xoopsTpl->values['deleted_theme'] === 'demo', 'PHP deletion did not show clean completion');
        check(!file_exists(XOOPS_ROOT_PATH . '/themes/demo'), 'Clean PHP deletion did not remove the theme');
        \Xmf\Request::$templateMode = '';

        $coreArchive = $base . '/source/uploads/tad_modules/file/core.zip';
        $coreZip = new \PharData($coreArchive);
        $coreZip->addFromString('payload/index.php', 'upgrade');
        $coreZip->addFromString('upgrade.json', json_encode(['version' => 1, 'steps' => [
            ['op' => 'copy', 'from' => '{WORK}/payload', 'to' => '{ROOT}/upgrade'],
        ]]));
        unset($coreZip);
        session_id(bin2hex(random_bytes(16)));
        session_start();
        $sessionId = session_id();
        \Xmf\Request::$progressToken = bin2hex(random_bytes(16));
        $statusPath = \XoopsModules\Tad_adm\UpgradeProgress::path(\Xmf\Request::$progressToken, $sessionId);
        mkdir(XOOPS_ROOT_PATH . '/upgrade');
        file_put_contents(XOOPS_ROOT_PATH . '/upgrade/index.php', 'original');
        $unwritablePaths = [str_replace('\\', '/', XOOPS_ROOT_PATH . '/upgrade/index.php')];
        $coreUrl = $source . '/uploads/tad_modules/file/core.zip';
        $unwritablePaths = [str_replace('\\', '/', XOOPS_ROOT_PATH . '/uploads')];
        $stagingSsh = new FakeSsh(0, '');
        try {
            OnlineUpgrade::get_upgrade_file($coreUrl, 'upgrade', 1, $stagingSsh);
            throw new \RuntimeException('Expected inaccessible core staging redirect');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'staging') !== false, 'Core staging failure was not reported');
        }
        check($stagingSsh->command === null, 'Core staging attempted an SSH chmod');
        $unwritablePaths = [str_replace('\\', '/', XOOPS_ROOT_PATH . '/upgrade/index.php')];
        $xoopsTpl = new FakeTemplate();
        check(!OnlineUpgrade::get_upgrade_file($coreUrl, 'upgrade', 1, ''), 'Core manifest preflight did not stop');
        check($xoopsTpl->values['now_op'] === 'login_form', 'Core manifest preflight did not show SSH login');
        check(strpos(str_replace('\\', '/', $xoopsTpl->values['ssh_preflight_message']), '/upgrade/index.php') !== false, 'Core manifest preflight path missing');
        check($xoopsTpl->values['file_link'] === $coreUrl && $xoopsTpl->values['act'] === 'upgrade', 'Core manifest retry context lost');
        check(session_status() === PHP_SESSION_ACTIVE, 'Session not restored before SSH form');
        check(file_get_contents(XOOPS_ROOT_PATH . '/upgrade/index.php') === 'original', 'Core manifest preflight modified target');

        $legacyArchive = $base . '/source/uploads/tad_modules/file/core-legacy.zip';
        $legacyZip = new \PharData($legacyArchive);
        $legacyZip->addFromString('payload/index.php', 'legacy upgrade');
        $legacyZip->addFromString('go.txt', 'full_copy("XOOPS_ROOT_PATH/uploads/tad_adm/upgrade/payload", "XOOPS_ROOT_PATH/upgrade")' . "\n");
        $legacyZip->addFromString('ssh.txt', 'cp -R XOOPS_ROOT_PATH/uploads/tad_adm/upgrade/payload/. XOOPS_ROOT_PATH/upgrade/' . "\n");
        unset($legacyZip);
        $legacyUrl = $source . '/uploads/tad_modules/file/core-legacy.zip';
        $xoopsTpl = new FakeTemplate();
        check(!OnlineUpgrade::get_upgrade_file($legacyUrl, 'upgrade', 1, ''), 'Core legacy preflight did not stop');
        check($xoopsTpl->values['now_op'] === 'login_form', 'Core legacy preflight did not show SSH login');
        check(strpos(str_replace('\\', '/', $xoopsTpl->values['ssh_preflight_message']), '/upgrade/index.php') !== false, 'Core legacy preflight path missing');
        check($xoopsTpl->values['file_link'] === $legacyUrl && $xoopsTpl->values['act'] === 'upgrade', 'Core legacy retry context lost');
        check(file_get_contents(XOOPS_ROOT_PATH . '/upgrade/index.php') === 'original', 'Core legacy preflight modified target');
        $unwritablePaths = [];

        $invalidArchive = $base . '/source/uploads/tad_modules/file/invalid-manifest.zip';
        $invalidZip = new \PharData($invalidArchive);
        $invalidZip->addFromString('upgrade.json', '{invalid');
        unset($invalidZip);
        try {
            OnlineUpgrade::get_upgrade_file($source . '/uploads/tad_modules/file/invalid-manifest.zip', 'upgrade', 1, '');
            throw new \RuntimeException('Expected invalid manifest redirect');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'invalid manifest') !== false, 'Invalid manifest reason missing');
            check(!$lastRedirect['ajax'] && $lastRedirect['time'] >= 30, 'Core error did not use visible redirect page');
            check(session_status() === PHP_SESSION_ACTIVE, 'Session not restored before error redirect');
        }
        $xoopsConfig['redirect_message_ajax'] = 1;
        \Xmf\Request::$progressToken = '';
        try {
            OnlineUpgrade::get_upgrade_file($source . '/uploads/tad_modules/file/invalid-manifest.zip', 'upgrade', 1, '');
            throw new \RuntimeException('Expected invalid manifest redirect without progress token');
        } catch (Redirect $e) {
            check(!$lastRedirect['ajax'] && $lastRedirect['time'] >= 30, 'Core error without progress token did not use visible redirect page');
        }
        \Xmf\Request::$progressToken = bin2hex(random_bytes(16));
        $statusPath = \XoopsModules\Tad_adm\UpgradeProgress::path(\Xmf\Request::$progressToken, $sessionId);
        $xoopsConfig['redirect_message_ajax'] = 1;
        $forceSessionRestoreFailure = true;
        try {
            OnlineUpgrade::get_upgrade_file($source . '/uploads/tad_modules/file/invalid-manifest.zip', 'upgrade', 1, '');
            throw new \RuntimeException('Expected session restoration failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'invalid manifest') !== false && strpos($e->getMessage(), 'session restore failed') !== false, 'Session restoration failure was not displayed with the original error');
            check(!$lastRedirect['ajax'] && $lastRedirect['time'] >= 30, 'Session restoration failure did not use visible redirect page');
        }
        $forceSessionRestoreFailure = false;
        check(\XoopsModules\Tad_adm\UpgradeProgress::resumeSession(), 'Session could not be restored after simulated failure');
        $xoopsConfig['redirect_message_ajax'] = 1;
        file_put_contents($base . '/source/uploads/tad_modules/file/empty.zip', '');
        try {
            OnlineUpgrade::get_upgrade_file($source . '/uploads/tad_modules/file/empty.zip', 'upgrade', 1, '');
            throw new \RuntimeException('Expected download failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'download') !== false, 'Download failure reason missing');
            check(!$lastRedirect['ajax'] && $lastRedirect['time'] >= 30, 'Download failure did not use visible redirect page');
            check(session_status() === PHP_SESSION_ACTIVE, 'Session not restored before download error redirect');
        }
        $xoopsConfig['redirect_message_ajax'] = 1;
        $xoopsTpl = new FakeTemplate();
        check(!OnlineUpgrade::get_upgrade_file($coreUrl, 'upgrade', 1, ''), 'Core upgrade did not show handoff');
        check($xoopsTpl->values['now_op'] === 'upgrade_handoff', 'Core upgrade handoff not shown');
        check($xoopsTpl->values['upgrade_handoff_url'] === XOOPS_URL . '/upgrade/', 'Handoff URL incorrect');
        check($xoopsTpl->values['upgrade_handoff_message'] === 'Upgrade ready' && $xoopsTpl->values['upgrade_handoff_delay'] === 3, 'Normal handoff message or delay incorrect');
        check(session_status() === PHP_SESSION_ACTIVE, 'Session not restored before success handoff');
        check(file_get_contents(XOOPS_ROOT_PATH . '/upgrade/index.php') === 'upgrade', 'Core upgrade files were not copied');
        $status = \XoopsModules\Tad_adm\UpgradeProgress::read($statusPath);
        check(isset($status['message']) && strpos(str_replace('\\', '/', $status['message']), '/upgrade') !== false && strpos($status['message'], 'Copying to:') === 0, 'Actual core copy destination was not reported');
        $coreSsh = new FakeSsh(0, "TAD_ADM_PROGRESS 1\n\nTAD_ADM_EXIT 0\n");
        $xoopsTpl = new FakeTemplate();
        check(!OnlineUpgrade::get_upgrade_file($coreUrl, 'upgrade', 1, $coreSsh), 'SSH core upgrade did not show handoff');
        check($xoopsTpl->values['now_op'] === 'upgrade_handoff', 'SSH core upgrade handoff not shown');
        check($coreSsh->timeout === 0 && $coreSsh->keepAlive === 15, 'SSH core upgrade did not disable the short timeout and enable keepalive');
        check(strpos($coreSsh->command, 'TAD_ADM_EXIT') !== false, 'SSH script completion marker missing');
        $status = \XoopsModules\Tad_adm\UpgradeProgress::read($statusPath);
        check(isset($status['message']) && strpos($status['message'], 'Copying to:') === 0, 'SSH copy marker did not report destination');
        foreach ([
            new FakeSsh(false, "TAD_ADM_PROGRESS 1\n"),
            new FakeSsh(0, "TAD_ADM_PROGRESS 1\n"),
            new FakeSsh(1, "TAD_ADM_PROGRESS 1\nTAD_ADM_FAIL step 1 copy\n\nTAD_ADM_EXIT 1\n"),
            new FakeSsh(0, "TAD_ADM_PROGRESS 1\n\nTAD_ADM_EXIT 1\n"),
        ] as $failedSsh) {
            try {
                OnlineUpgrade::get_upgrade_file($coreUrl, 'upgrade', 1, $failedSsh);
                throw new \RuntimeException('Expected incomplete SSH upgrade failure');
            } catch (Redirect $e) {
                check(strpos($e->getMessage(), 'ssh incomplete') !== false, 'Incomplete SSH upgrade was accepted');
                check(!$lastRedirect['ajax'] && $lastRedirect['time'] >= 30, 'Incomplete SSH warning was not shown on a visible page');
            }
        }
        $timedOutSsh = new FakeSsh(0, "TAD_ADM_PROGRESS 1\n\nTAD_ADM_EXIT 0\n");
        $timedOutSsh->timedOut = true;
        try {
            OnlineUpgrade::get_upgrade_file($coreUrl, 'upgrade', 1, $timedOutSsh);
            throw new \RuntimeException('Expected SSH timeout failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'ssh incomplete') !== false, 'Timed-out SSH upgrade was accepted');
        }
        $closedSsh = new FakeSsh(false, '');
        $closedSsh->exception = true;
        try {
            OnlineUpgrade::get_upgrade_file($coreUrl, 'upgrade', 1, $closedSsh);
            throw new \RuntimeException('Expected SSH connection failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'ssh incomplete') !== false && strpos($e->getMessage(), 'connection closed') !== false, 'SSH connection failure was not displayed');
        }
        $legacySsh = new FakeSsh(0, "\nTAD_ADM_EXIT 0\n");
        $xoopsTpl = new FakeTemplate();
        check(!OnlineUpgrade::get_upgrade_file($legacyUrl, 'upgrade', 1, $legacySsh), 'Legacy SSH core upgrade did not show handoff');
        check($xoopsTpl->values['now_op'] === 'upgrade_handoff', 'Legacy SSH core upgrade handoff not shown');
        $legacySsh = new FakeSsh(0, '');
        try {
            OnlineUpgrade::get_upgrade_file($legacyUrl, 'upgrade', 1, $legacySsh);
            throw new \RuntimeException('Expected incomplete legacy SSH upgrade failure');
        } catch (Redirect $e) {
            check(strpos($e->getMessage(), 'ssh incomplete') !== false, 'Incomplete legacy SSH upgrade was accepted');
        }
        $warningArchive = $base . '/source/uploads/tad_modules/file/core-warning.zip';
        $warningZip = new \PharData($warningArchive);
        $warningZip->addFromString('payload/index.php', 'upgrade');
        $warningZip->addFromString('upgrade.json', json_encode(['version' => 1, 'steps' => [
            ['op' => 'copy', 'from' => '{WORK}/payload', 'to' => '{ROOT}/upgrade'],
            ['op' => 'delete', 'path' => '{ROOT}/uploads/problem<file>'],
        ]]));
        unset($warningZip);
        $warningSsh = new FakeSsh(0, "TAD_ADM_PROGRESS 2\nrm: <file>: Permission denied\nTAD_ADM_WARN step 2 delete\n\nTAD_ADM_EXIT 0\n");
        $xoopsTpl = new FakeTemplate();
        check(!OnlineUpgrade::get_upgrade_file($source . '/uploads/tad_modules/file/core-warning.zip', 'upgrade', 1, $warningSsh), 'Warning handoff was not shown');
        $warning = $xoopsTpl->values['upgrade_handoff_warning'];
        check(strpos($warning, 'step 2 (delete)') !== false && strpos($warning, 'uploads/problem&lt;file&gt;') !== false, 'Warning did not identify escaped operation and target');
        check(strpos($warning, 'rm: &lt;file&gt;: Permission denied') !== false && strpos($warning, 'TAD_ADM_PROGRESS') === false, 'SSH failure details were not safely presented');
        check($xoopsTpl->values['upgrade_handoff_delay'] === 0, 'Warning handoff must wait for manual navigation');
        $forceSessionRestoreFailure = true;
        $xoopsTpl = new FakeTemplate();
        check(!OnlineUpgrade::get_upgrade_file($coreUrl, 'upgrade', 1, ''), 'Session failure handoff was not shown');
        check($xoopsTpl->values['upgrade_handoff_session_error'] === 'session restore failed' && $xoopsTpl->values['upgrade_handoff_delay'] === 0, 'Session failure did not prevent automatic navigation');
        $forceSessionRestoreFailure = false;
        check(\XoopsModules\Tad_adm\UpgradeProgress::resumeSession(), 'Session could not be restored after handoff test');
        echo "Package copy, preflight, SSH failure, legacy/manifest packages and theme deletion tests passed.\n";
    } finally {
        \XoopsModules\Tadtools\Utility::delete_directory($base);
    }
}
