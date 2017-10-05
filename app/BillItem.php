<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function stock()
    {
        return $this->belongsTo('App\BakeryStock');
    }

    public static function getBillItems($billId)
    {
        return self::where('bill_id', $billId)->where('status', 1)->with(['product', 'stock'])->get();
    }
}
