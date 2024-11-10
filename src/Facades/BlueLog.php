<?php

namespace  Ch17\BlueLog\Facades;

use Illuminate\Support\Facades\Facade;

class BlueLog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ch17\BlueLog\Services\BlueLogger::class;
    }
}
