<?php

namespace Ch17\BlueLog\Console;

use Illuminate\Console\Command;
use Ch17\BlueLog\Models\Log;

class PurgeLogsCommand extends Command
{
    protected $signature = 'BlueLog:purge {days}';
    protected $description = 'Clear old (x days) logs created by BlueLogs';

    public function handle()
    {
        $days = $this->argument('days');
        // clear logs table command handler

    }
}
