<?php

namespace  Ch17\BlueLogs\Facades;

use Illuminate\Support\Facades\Facade;

class Log extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ch17\BlueLogs\Services\Logger::class;
    }
}
