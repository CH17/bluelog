<?php

namespace Ch17\BlueLog\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'channel',
        'level',
        'level_name',
        'message',
        'context',
        'extras',
        'created_at',
    ];

    protected $casts = [
        'context' => 'array',
        'extras' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s.u',
    ];

    public $timestamps = false;
}
