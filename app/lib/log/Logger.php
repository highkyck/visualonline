<?php

namespace lib\log;

class Logger
{
    const ERROR = "Error";
    const INFO = "Info";
    const DEBUG = "Debug";

    private static $logPath = '';

    private static $logs = [];

    public static function setPath($path)
    {
        static::$logPath = $path;
    }

    public static function writeLog($file, $content, $level = Logger::INFO)
    {
        if (!\is_string($content)) {
            $content = \json_encode($content);
        }
        static::$logs[$file][] = \gethostname() . " - [" . \date('Y-m-d H:i:s') . "] [{$level}] {$content}" . \PHP_EOL;
    }

    public static function error($file, $content)
    {
        self::writeLog($file, $content, Logger::ERROR);
    }

    public static function info($file, $content)
    {
        self::writeLog($file, $content, Logger::INFO);
    }

    public static function debug($file, $content)
    {
        self::writeLog($file, $content, Logger::DEBUG);
    }

    public static function land()
    {
        if (!empty(static::$logs)) {
            if (!\is_dir(static::$logPath)) {
                \mkdir(static::$logPath, '0777', true);
            }

            foreach (static::$logs as $file => $log) {
                \file_put_contents(static::$logPath . $file, \implode("", $log), \FILE_APPEND);
            }
        }
    }
}