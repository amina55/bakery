<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public static function getCategory()
    {
        return self::where('status', 1)->get();
    }
}
