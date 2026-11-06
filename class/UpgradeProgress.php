<?php

namespace XoopsModules\Tad_adm;

class UpgradeProgress
{
    private static $path;

    public static function path(string $token, string $sessionId): ?string
    {
        if (!preg_match('/^[a-f0-9]{32}$/D', $token) || '' === $sessionId) {
            return null;
        }
        return sys_get_temp_dir() . '/tad_adm_progress_' . hash('sha256', $sessionId . ':' . $token);
    }

    public static function start(string $token): void
    {
        self::$path = self::path($token, session_id());
        if (null === self::$path) {
            return;
        }
        if (session_status() === PHP_SESSION_ACTIVE) {
            if (!session_write_close()) {
                error_log('[tad_adm] Unable to release session for upgrade progress');
            }
        }
        register_shutdown_function(static function (): void {
            if (self::$path && is_file(self::$path) && !@unlink(self::$path)) {
                error_log('[tad_adm] Unable to remove upgrade progress file');
            }
        });
    }

    public static function update(string $message): void
    {
        if (!self::$path) {
            return;
        }
        $handle = @fopen(self::$path, 'c');
        if (!$handle) {
            error_log('[tad_adm] Unable to write upgrade progress file');
            return;
        }
        @chmod(self::$path, 0600);
        $json = json_encode(['message' => $message], JSON_INVALID_UTF8_SUBSTITUTE);
        if (false === $json || !flock($handle, LOCK_EX)) {
            error_log('[tad_adm] Unable to update upgrade progress file');
            fclose($handle);
            return;
        }
        if (!ftruncate($handle, 0) || fwrite($handle, $json) !== strlen($json)) {
            error_log('[tad_adm] Unable to update upgrade progress file');
        }
        flock($handle, LOCK_UN);
        fclose($handle);
    }

    public static function read(string $path): ?array
    {
        $handle = @fopen($path, 'r');
        if (!$handle) {
            return null;
        }
        $content = false;
        if (flock($handle, LOCK_SH)) {
            $content = stream_get_contents($handle);
            flock($handle, LOCK_UN);
        }
        fclose($handle);
        $data = is_string($content) ? json_decode($content, true) : null;
        return is_array($data) && isset($data['message']) && is_string($data['message']) ? $data : null;
    }
}
