<?php

namespace Ch17\BlueLogs\Services;
use Ch17\BlueLogs\Models\Log;

class Logger
{
    public function log($level, $message)
    {
        Log::create([
            'level' => $level,
            'message' => $message
        ]);
    }
}
