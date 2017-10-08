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
        return self::where('status', 1)->with('stock.product')->get();
    }

    public static function orderToKitchen($orderItem)
    {
        return self::create([
            ''
        ]);
    }
}
