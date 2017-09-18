<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BakeryStock extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public static function getStock()
    {
        return self::where('status', 1)->with('product.unit')->get();
    }

    public static function decreaseQuantity($stockId, $quantity)
    {
        self::where('id', $stockId)->decrement('quantity', $quantity);
    }
}
