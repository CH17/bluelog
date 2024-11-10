<?php

namespace Ch17\BlueLog;

use Ch17\BlueLog\Console\PurgeLogsCommand;
use Ch17\BlueLog\Services\BlueLogger;
use Illuminate\Support\ServiceProvider;

class BlueLogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Database/Migrations' => database_path('migrations'),
        ], 'blue-log-migrations');

        $this->publishes([
            __DIR__.'/Config/bluelog.php' => config_path('bluelog.php'),
        ], 'blue-log-config');

        if ($this->app->runningInConsole()) {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('BlueLog', \Ch17\BlueLog\Facades\BlueLog::class);
        }
    }

    public function register()
    {
        $this->app->singleton(BlueLogger::class, function ($app) {
            return new BlueLogger();
        });

        $this->commands([PurgeLogsCommand::class]);
    }
}
