<?php

namespace Ch17\BlueLogs\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['level', 'message'];
}
