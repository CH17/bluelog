<?php

namespace Ch17\BlueLogs\Console;

use Illuminate\Console\Command;
use Ch17\BlueLogs\Models\Log;

class BlueLogCommand extends Command
{
    protected $signature = 'log:add {level} {message}';
    protected $description = 'Add a log entry to the logs table';

    public function handle()
    {
        $level = $this->argument('level');
        $message = $this->argument('message');

        Log::create([
            'level' => $level,
            'message' => $message,
        ]);

        $this->info('Log entry added successfully.');
    }
}
