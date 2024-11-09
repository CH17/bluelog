<?php

namespace Ch17\BlueLog;

use Ch17\BlueLog\Console\ClearBlueLogCommand;
use Ch17\BlueLog\Services\BlueLogger;
use Illuminate\Support\ServiceProvider;

class BlueLogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'blue-log-migrations');

         if ($this->app->runningInConsole()) {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('BlueLog', \Ch17\BlueLog\Facades\Log::class);
        }
    }

    public function register()
    {
        $this->app->singleton(BlueLogger::class, function ($app) {
            return new BlueLogger();
        });

        $this->commands([ClearBlueLogCommand::class]);
    }
}
