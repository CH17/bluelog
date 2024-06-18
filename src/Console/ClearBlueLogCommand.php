<?php

namespace Ch17\BlueLog\Console;

use Illuminate\Console\Command;
use Ch17\BlueLog\Models\Log;

class ClearBlueLogCommand extends Command
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
