<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BakeryRequest extends Model
{
    protected $guarded = ['id'];

    public function stock()
    {
        return $this->belongsTo('App\BakeryStock');
    }
    public static function getRequests()
    {
        return self::with('stock.product')->get();
    }
}
