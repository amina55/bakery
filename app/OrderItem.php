<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = ['id'];
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public static function getOrderItems($orderId)
    {
        return self::where('order_id', $orderId)->where('status', 1)->with('product')->get();
    }
}
