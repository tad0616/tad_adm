<?php

namespace XoopsModules\Tad_adm;

/**
 * 單一檔案升級流程（upgrade.json），取代 go.txt 與 ssh.txt。
 *
 * 流程檔只描述「要做什麼」，由本類別決定如何執行：
 *   - PHP 直接執行（run_php）
 *   - 轉成 /bin/sh 腳本，交由 SSH 執行（to_shell）
 *
 * 支援操作：copy、mkdir、delete、chmod、chmod_except、write、prune_index_html
 * 路徑變數：{ROOT} {VAR} {LIB} {WORK} {NEW_FILE} {SN} {NOW}
 * 所有路徑必須位於 ROOT、VAR、LIB 之內，且不得含有「..」。
 */
class UpgradeManifest
{
    public const OPS = ['copy', 'mkdir', 'delete', 'chmod', 'chmod_except', 'write', 'prune_index_html'];

    /**
     * 讀取並驗證流程檔，回傳已展開變數的步驟清單。
     *
     * @param array $ctx ROOT、VAR、LIB、WORK、NEW_FILE、SN
     *
     * @throws \RuntimeException
     */
    public static function load(string $file, array $ctx): array
    {
        $json = is_file($file) ? file_get_contents($file) : false;
        if (false === $json) {
            throw new \RuntimeException("cannot read $file");
        }
        $data = json_decode(preg_replace('/^\xEF\xBB\xBF/', '', $json), true);
        if (!is_array($data) || 1 !== (int) ($data['version'] ?? 0) || !isset($data['steps']) || !is_array($data['steps'])) {
            throw new \RuntimeException('invalid JSON or unsupported version');
        }

        $vars = [
            'ROOT'     => self::norm($ctx['ROOT']),
            'VAR'      => self::norm($ctx['VAR']),
            'LIB'      => self::norm($ctx['LIB']),
            'WORK'     => self::norm($ctx['WORK']),
            'NEW_FILE' => self::norm($ctx['NEW_FILE']),
            'SN'       => (string) (int) ($ctx['SN'] ?? 0),
            'NOW'      => date('Y-m-d H:i:s'),
        ];
        $roots = [$vars['ROOT'], $vars['VAR'], $vars['LIB']];

        $steps = [];
        foreach (array_values($data['steps']) as $i => $s) {
            $n = $i + 1;
            if (!is_array($s) || !in_array($s['op'] ?? '', self::OPS, true)) {
                throw new \RuntimeException("step $n: unsupported op");
            }
            $step = ['n' => $n, 'op' => $s['op'], 'optional' => !empty($s['optional'])];

            switch ($s['op']) {
                case 'copy':
                    [$from] = self::resolve($s['from'] ?? '', $vars, $roots, $n);
                    [$to, $to_slash] = self::resolve($s['to'] ?? '', $vars, $roots, $n);
                    if (is_dir($from)) {
                        $step['kind'] = 'dir';
                    } elseif (is_file($from)) {
                        $step['kind'] = 'file';
                        if ($to_slash || is_dir($to)) {
                            $to .= '/' . basename($from);
                        }
                    } else {
                        throw new \RuntimeException("step $n: source not found: $from");
                    }
                    $step['from'] = $from;
                    $step['to']   = $to;
                    break;

                case 'mkdir':
                    [$step['path']] = self::resolve($s['path'] ?? '', $vars, $roots, $n);
                    break;

                case 'delete':
                    [$step['path']] = self::resolve($s['path'] ?? '', $vars, $roots, $n);
                    if (in_array($step['path'], $roots, true)) {
                        throw new \RuntimeException("step $n: refusing to delete a root directory");
                    }
                    break;

                case 'chmod':
                case 'chmod_except':
                    [$step['path']] = self::resolve($s['path'] ?? '', $vars, $roots, $n);
                    $both = $s['mode'] ?? null;
                    $step['file']      = self::mode($s['file'] ?? $both, $n);
                    $step['dir']       = self::mode($s['dir'] ?? $both, $n);
                    $step['recursive'] = !empty($s['recursive']);
                    if ('chmod_except' === $s['op']) {
                        if (!$step['recursive'] || empty($s['exclude']) || !is_array($s['exclude']) || in_array('.', explode('/', $step['path']), true)) {
                            throw new \RuntimeException("step $n: recursive chmod_except requires excluded paths");
                        }
                        $step['exclude'] = [];
                        foreach ($s['exclude'] as $raw) {
                            [$excluded] = self::resolve($raw, $vars, $roots, $n);
                            if (in_array('.', explode('/', $excluded), true)) {
                                throw new \RuntimeException("step $n: invalid excluded path");
                            }
                            $step['exclude'][] = $excluded;
                        }
                    }
                    break;

                case 'prune_index_html':
                    if (empty($s['paths']) || !is_array($s['paths'])) {
                        throw new \RuntimeException("step $n: paths must be a non-empty array");
                    }
                    $step['paths'] = [];
                    foreach ($s['paths'] as $raw) {
                        [$step['paths'][]] = self::resolve($raw, $vars, $roots, $n);
                    }
                    break;

                case 'write':
                    [$step['path']] = self::resolve($s['path'] ?? '', $vars, $roots, $n);
                    $content = (string) ($s['content'] ?? '');
                    $step['content'] = preg_replace_callback('/\{([A-Z_]+)\}/', static fn($m) => $vars[$m[1]] ?? $m[0], $content);
                    break;
            }
            $steps[] = $step;
        }

        return $steps;
    }

    /** 失敗時是否只算警告（chmod、delete 或標示 optional 的步驟） */
    public static function is_soft(array $step): bool
    {
        return $step['optional'] || in_array($step['op'], ['chmod', 'chmod_except', 'delete', 'prune_index_html'], true);
    }

    /**
     * 唯讀預檢：找出 PHP 無法寫入的目標（只檢查失敗會中止升級的步驟）。
     *
     * @return array count、paths（前 10 個）、seen、user、root
     */
    public static function preflight(array $steps, string $root): array
    {
        $result = ['count' => 0, 'paths' => [], 'seen' => [], 'user' => self::php_user(), 'root' => $root];
        foreach ($steps as $step) {
            if (self::is_soft($step)) {
                continue;
            }
            if ('copy' === $step['op']) {
                self::scan_copy($step['from'], $step['to'], $result);
            } elseif ('mkdir' === $step['op']) {
                self::scan_target($step['path'], $result);
            } elseif ('write' === $step['op']) {
                if (file_exists($step['path'])) {
                    if (!is_writable($step['path'])) {
                        self::add($step['path'], $result);
                    }
                } else {
                    self::scan_target($step['path'], $result);
                }
            }
        }

        return $result;
    }

    /**
     * 以 PHP 直接執行。
     *
     * @return array errors（失敗路徑）、warnings（說明字串陣列，每項為 [步驟, 操作, 數量, 範例]）
     */
    public static function run_php(array $steps, ?callable $progress = null): array
    {
        $report = ['errors' => [], 'warnings' => []];
        foreach ($steps as $step) {
            if ($progress) {
                $progress($step);
            }
            $fails = [];
            switch ($step['op']) {
                case 'copy':
                    'dir' === $step['kind'] ? self::copy_tree($step['from'], $step['to'], $fails) : self::copy_file($step['from'], $step['to'], $fails);
                    break;
                case 'mkdir':
                    if (!is_dir($step['path']) && !@mkdir($step['path'], 0755, true) && !is_dir($step['path'])) {
                        $fails[] = $step['path'];
                    }
                    break;
                case 'delete':
                    self::remove($step['path'], $fails);
                    break;
                case 'chmod':
                case 'chmod_except':
                    if (file_exists($step['path'])) {
                        self::chmod_tree($step['path'], $step['file'], $step['dir'], $step['recursive'], $fails, $step['exclude'] ?? []);
                    }
                    break;
                case 'prune_index_html':
                    foreach ($step['paths'] as $dir) {
                        self::prune_index($dir, $fails);
                    }
                    break;
                case 'write':
                    if (!is_dir(dirname($step['path'])) && !@mkdir(dirname($step['path']), 0755, true)) {
                        $fails[] = $step['path'];
                    } elseif (false === @file_put_contents($step['path'], $step['content'])) {
                        $fails[] = $step['path'];
                    }
                    break;
            }
            if ($fails) {
                if (self::is_soft($step)) {
                    $report['warnings'][] = [$step['n'], $step['op'], count($fails), $fails[0]];
                } else {
                    $report['errors'] = array_merge($report['errors'], $fails);
                    break;
                }
            }
        }

        return $report;
    }

    /** 轉成 /bin/sh 腳本（供 SSH 執行），失敗行會輸出 TAD_ADM_FAIL / TAD_ADM_WARN */
    public static function to_shell(array $steps, bool $progress = false): string
    {
        $q  = static fn(string $s): string => "'" . str_replace("'", "'\\''", $s) . "'";
        $sh = "#!/bin/sh\nfail=0\n";
        foreach ($steps as $step) {
            $n = $step['n'];
            if ($progress) {
                $sh .= "printf 'TAD_ADM_PROGRESS %d\\n' " . (int) $n . "\n";
            }
            switch ($step['op']) {
                case 'copy':
                    if ('dir' === $step['kind']) {
                        $cmd = 'mkdir -p ' . $q($step['to']) . ' && cp -a ' . $q($step['from'] . '/.') . ' ' . $q($step['to'] . '/');
                    } else {
                        $cmd = 'mkdir -p ' . $q(dirname($step['to'])) . ' && cp -a ' . $q($step['from']) . ' ' . $q($step['to']);
                    }
                    break;
                case 'mkdir':
                    $cmd = 'mkdir -p ' . $q($step['path']);
                    break;
                case 'delete':
                    $cmd = 'rm -rf -- ' . $q($step['path']);
                    break;
                case 'chmod':
                case 'chmod_except':
                    $p  = $q($step['path']);
                    $fm = sprintf('%04o', $step['file']);
                    $dm = sprintf('%04o', $step['dir']);
                    foreach ($step['exclude'] ?? [] as $excluded) {
                        if (self::within($step['path'], $excluded)) {
                            $cmd = ':';
                            break 2;
                        }
                    }
                    if ($step['recursive']) {
                        $prune = '';
                        if (!empty($step['exclude'])) {
                            $patterns = [];
                            foreach ($step['exclude'] as $excluded) {
                                $pattern = str_replace(['\\', '*', '?', '['], ['\\\\', '\\*', '\\?', '\\['], $excluded);
                                $patterns[] = '-path ' . $q($pattern);
                            }
                            $prune = '\\( ' . implode(' -o ', $patterns) . ' \\) -prune -o ';
                        }
                        if ($fm === $dm) {
                            // Fix directories before descent and report individual chmod failures.
                            $warn = $q("TAD_ADM_WARN step $n chmod");
                            $cmd = "find $p $prune\\( -type d ! -perm $dm \\( -exec chmod $dm {} \\; -o -exec printf '%s\\n' $warn \\; \\) \\) -o \\( -type f ! -perm $fm -exec chmod $fm {} + \\)";
                        } else {
                            $cmd = "{ find $p $prune\\( -type d ! -perm $dm -exec chmod $dm {} + \\) && find $p $prune\\( -type f ! -perm $fm -exec chmod $fm {} + \\) ; }";
                        }
                    } else {
                        $cmd = "if [ -d $p ]; then chmod $dm $p; else chmod $fm $p; fi";
                    }
                    break;
                case 'prune_index_html':
                    $cmds = [];
                    foreach ($step['paths'] as $dir) {
                        $cmds[] = 'if [ -d ' . $q($dir) . ' ]; then find ' . $q($dir) . " -type f -name index.html -size -60c -exec sh -c 'for f; do [ -f \"\${f%/*}/index.php\" ] && rm -f \"\$f\"; done' sh {} + ; fi";
                    }
                    $cmd = '{ ' . implode('; ', $cmds) . '; }';
                    break;
                default: // write
                    $cmd = 'mkdir -p ' . $q(dirname($step['path'])) . " && printf '%s' " . $q($step['content']) . ' > ' . $q($step['path']);
                    break;
            }
            $soft = self::is_soft($step);
            $tag  = $soft ? 'TAD_ADM_WARN' : 'TAD_ADM_FAIL';
            $mark = $soft ? '' : ' exit 1;';
            $sh  .= "$cmd || { echo \"$tag step $n {$step['op']}\";$mark }\n";
        }

        return $sh . "exit \$fail\n";
    }

    /** 解析 SSH 腳本輸出，回傳 [errors, warnings] 兩組行 */
    public static function parse_shell_output(string $output): array
    {
        $errors = $warnings = [];
        foreach (preg_split('/\R/', $output) as $line) {
            if (0 === strpos($line, 'TAD_ADM_FAIL')) {
                $errors[] = $line;
            } elseif (0 === strpos($line, 'TAD_ADM_WARN')) {
                $warnings[] = $line;
            }
        }

        return [$errors, $warnings];
    }

    public static function php_user(): string
    {
        if (function_exists('posix_geteuid') && function_exists('posix_getpwuid')) {
            $info = posix_getpwuid(posix_geteuid());
            if (!empty($info['name'])) {
                return $info['name'];
            }
        }

        return get_current_user();
    }

    private static function norm(string $p): string
    {
        return rtrim(preg_replace('#/+#', '/', str_replace('\\', '/', $p)), '/');
    }

    private static function within(string $path, string $parent): bool
    {
        if (DIRECTORY_SEPARATOR === '\\') {
            $path = strtolower($path);
            $parent = strtolower($parent);
        }
        return $path === $parent || 0 === strpos($path, $parent . '/');
    }

    /** @return array [正規化路徑, 原字串是否以 / 結尾] */
    private static function resolve($raw, array $vars, array $roots, int $n): array
    {
        if (!is_string($raw) || '' === $raw) {
            throw new \RuntimeException("step $n: missing path");
        }
        $p = preg_replace_callback('/\{([A-Z_]+)\}/', static function ($m) use ($vars, $n) {
            if (!isset($vars[$m[1]])) {
                throw new \RuntimeException("step $n: unknown variable {$m[0]}");
            }
            return $vars[$m[1]];
        }, $raw);
        $slash = in_array(substr($p, -1), ['/', '\\'], true);
        $p     = self::norm($p);
        if (in_array('..', explode('/', $p), true)) {
            throw new \RuntimeException("step $n: '..' is not allowed: $raw");
        }
        $win = DIRECTORY_SEPARATOR === '\\';
        foreach ($roots as $root) {
            $a = $win ? strtolower($p) : $p;
            $b = $win ? strtolower($root) : $root;
            if ($a === $b || 0 === strpos($a, $b . '/')) {
                return [$p, $slash];
            }
        }
        throw new \RuntimeException("step $n: path outside allowed roots: $p");
    }

    private static function mode($v, int $n): int
    {
        if (null === $v || !preg_match('/^0?[0-7]{3,4}$/', (string) $v)) {
            throw new \RuntimeException("step $n: invalid chmod mode");
        }

        return octdec((string) $v);
    }

    /** 刪除已被 index.php 取代、小於 60 位元組的 index.html（與 upd_2.5.10-to-2.5.11 的規則相同） */
    private static function prune_index(string $dir, array &$fails): void
    {
        if (!is_dir($dir) || is_link($dir)) {
            return;
        }
        $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS));
        foreach ($it as $f) {
            if ($f->isFile() && 'index.html' === $f->getFilename() && $f->getSize() < 60 && is_file($f->getPath() . '/index.php')) {
                if (!@unlink($f->getPathname())) {
                    $fails[] = $f->getPathname();
                }
            }
        }
    }

    private static function copy_tree(string $src, string $dst, array &$fails): void
    {
        if (!is_dir($dst) && !@mkdir($dst, 0755, true) && !is_dir($dst)) {
            $fails[] = $dst;
            return;
        }
        $entries = @scandir($src);
        if (false === $entries) {
            $fails[] = $src;
            return;
        }
        foreach ($entries as $item) {
            if ('.' === $item || '..' === $item) {
                continue;
            }
            is_dir("$src/$item") ? self::copy_tree("$src/$item", "$dst/$item", $fails) : self::copy_file("$src/$item", "$dst/$item", $fails);
        }
    }

    private static function copy_file(string $src, string $dst, array &$fails): void
    {
        if (!is_dir(dirname($dst)) && !@mkdir(dirname($dst), 0755, true) && !is_dir(dirname($dst))) {
            $fails[] = $dst;
            return;
        }
        if (!@copy($src, $dst)) {
            $fails[] = $dst;
        }
    }

    private static function remove(string $p, array &$fails): void
    {
        if (is_link($p) || is_file($p)) {
            if (!@unlink($p)) {
                $fails[] = $p;
            }
            return;
        }
        if (!is_dir($p)) {
            return;
        }
        foreach (scandir($p) as $item) {
            if ('.' !== $item && '..' !== $item) {
                self::remove("$p/$item", $fails);
            }
        }
        if (!@rmdir($p)) {
            $fails[] = $p;
        }
    }

    private static function chmod_tree(string $p, int $fm, int $dm, bool $recursive, array &$fails, array $exclude = []): void
    {
        foreach ($exclude as $excluded) {
            if (self::within($p, $excluded)) {
                return;
            }
        }
        if (is_link($p)) {
            return;
        }
        clearstatcache(true, $p);
        $is_dir = is_dir($p);
        $mode = $is_dir ? $dm : $fm;
        $permissions = @fileperms($p);
        if ((DIRECTORY_SEPARATOR === '\\' || false === $permissions || ($permissions & 07777) !== $mode) && !@chmod($p, $mode)) {
            $fails[] = $p;
        }
        if ($is_dir && $recursive) {
            foreach (scandir($p) as $item) {
                if ('.' !== $item && '..' !== $item) {
                    self::chmod_tree("$p/$item", $fm, $dm, true, $fails, $exclude);
                }
            }
        }
    }

    private static function scan_copy(string $src, string $dst, array &$result): void
    {
        if (is_dir($src)) {
            if (!file_exists($dst)) {
                self::scan_target($dst, $result);
                return;
            }
            if (!is_dir($dst) || !is_writable($dst)) {
                self::add($dst, $result);
                return;
            }
            $entries = @scandir($src);
            if (false === $entries) {
                self::add($src, $result);
                return;
            }
            foreach ($entries as $item) {
                if ('.' !== $item && '..' !== $item) {
                    self::scan_copy("$src/$item", "$dst/$item", $result);
                }
            }
        } elseif (is_file($src)) {
            if (file_exists($dst)) {
                if (is_dir($dst) || !is_writable($dst)) {
                    self::add($dst, $result);
                }
            } else {
                self::scan_target(dirname($dst), $result);
            }
        }
    }

    /** 目標尚不存在時，檢查最近的既有上層目錄是否可寫 */
    private static function scan_target(string $path, array &$result): void
    {
        $p = $path;
        while (!file_exists($p) && dirname($p) !== $p) {
            $p = dirname($p);
        }
        if (!is_dir($p) || !is_writable($p)) {
            self::add($p, $result);
        }
    }

    private static function add(string $path, array &$result): void
    {
        if (isset($result['seen'][$path])) {
            return;
        }
        $result['seen'][$path] = true;
        $result['count']++;
        if (count($result['paths']) < 10) {
            $result['paths'][] = $path;
        }
    }
}
