<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public static function getProduct()
    {
        return self::where('status', 1)->get();
    }
}
