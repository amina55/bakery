<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public static function getOrder($orderNo = '', $orderDate = '')
    {
        $billQuery = self::where('status', 1);
        if($orderDate) {
            $billQuery = $billQuery->where('created_at', 'like',  date('Y-m-d', strtotime($orderDate)).'%');
        }
        if($orderNo) {
            $billQuery = $billQuery->where('order_no', $orderNo);
        }
        return $billQuery->get();
    }
}
