<?php

namespace Ch17\BlueLog\Services;

use Illuminate\Support\Facades\Config;
use Ch17\BlueLog\Models\Log as LogModel;
use Ch17\BlueLog\LogLevels;
use Carbon\Carbon;

class BlueLogger
{
    protected $logLevel;

    public function __construct()
    {
        $this->logLevel = Config::get('bluelog.log_level', 'debug');
    }

    public function log($channel=null, $level, $message, array $context = [], array $extras = [])
    {
        $levelInt = LogLevels::getLevelInt($level);
        if ($this->shouldLog($levelInt)) {

            LogModel::create([
                'channel' => $channel,
                'level' => $levelInt,
                'level_name' => LogLevels::getLevelName($levelInt),
                'message' => $message,
                'context' => $context,
                'extras' => $extras,
                'user' => $this->getLoggedInUser(),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s.u'),
            ]);
        }
    }

    protected function shouldLog($level)
    {
        $levels = [
            LogLevels::DEBUG => 100,
            LogLevels::INFO => 200,
            LogLevels::NOTICE => 250,
            LogLevels::WARNING => 300,
            LogLevels::ERROR => 400,
            LogLevels::CRITICAL => 500,
            LogLevels::ALERT => 550,
            LogLevels::EMERGENCY => 600,
        ];

        return $levels[$level] >= $levels[LogLevels::getLevelInt($this->logLevel)];
    }

    public function debug($channel, $message, array $context = [], array $extras = [])
    {
        $this->log($channel, 'debug', $message, $context, $extras);
    }

    public function info($channel, $message, array $context = [], array $extras = [])
    {
        $this->log($channel, 'info', $message, $context, $extras);
    }

    public function warning($channel, $message, array $context = [], array $extras = [])
    {
        $this->log($channel, 'warning', $message, $context, $extras);
    }

    public function error($channel, $message, array $context = [], array $extras = [])
    {
        $this->log($channel, 'error', $message, $context, $extras);
    }

    private function getLoggedInUser(){

        if (auth()->check()) {
        $user = auth()->user();
            return [
                'name' => $user->name,
                'email' => $user->email,
            ];
        }

        return null;
    }
}
