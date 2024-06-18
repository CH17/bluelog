<?php

namespace Ch17\BlueLog;

class LogLevels
{
    const DEBUG = 100;
    const INFO = 200;
    const NOTICE = 250;
    const WARNING = 300;
    const ERROR = 400;
    const CRITICAL = 500;
    const ALERT = 550;
    const EMERGENCY = 600;

    public static function getLevelInt($level)
    {
        $levels = [
            'debug' => self::DEBUG,
            'info' => self::INFO,
            'notice' => self::NOTICE,
            'warning' => self::WARNING,
            'error' => self::ERROR,
            'critical' => self::CRITICAL,
            'alert' => self::ALERT,
            'emergency' => self::EMERGENCY,
        ];

        return $levels[strtolower($level)] ?? null;
    }

    public static function getLevelName($level)
    {
        $levels = [
            self::DEBUG => 'debug',
            self::INFO => 'info',
            self::NOTICE => 'notice',
            self::WARNING => 'warning',
            self::ERROR => 'error',
            self::CRITICAL => 'critical',
            self::ALERT => 'alert',
            self::EMERGENCY => 'emergency',
        ];

        return $levels[$level] ?? 'unknown';
    }
}
