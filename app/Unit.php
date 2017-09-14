<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];


    public static function getId($key)
    {
        $unit = self::where('short_key', $key)->first(['id']);
        return ($unit) ? $unit->id : null;
    }

    public static function getActive()
    {
        return self::where('status', 1)->get();
    }
}
