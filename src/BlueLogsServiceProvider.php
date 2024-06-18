<?php

namespace Ch17\BlueLogs;

use Ch17\BlueLogs\Console\BlueLogCommand;
use Ch17\BlueLogs\Services\Logger;
use Illuminate\Support\ServiceProvider;

class BlueLogsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'migrations');

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('BlueLogs', \Ch17\BlueLogs\Facades\Log::class);
    }

    public function register()
    {
        $this->app->singleton(Logger::class, function ($app) {
            return new Logger();
        });

        $this->commands([BlueLogCommand::class]);
    }
}
