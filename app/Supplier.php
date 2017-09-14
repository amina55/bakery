<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = ['id'];

    public static function getSupppliers()
    {
        return self::where('status', 1)->get();
    }
}
