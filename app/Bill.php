<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $guarded = ['id'];

    public static function getBill($billNo = '', $billDate = '')
    {
        $billQuery = self::where('status', 1);
        if($billDate) {
            $billQuery = $billQuery->where('created_at', 'like',  date('Y-m-d', strtotime($billDate)).'%');
        }
        if($billNo) {
            $billQuery = $billQuery->where('bill_no', $billNo);
        }
        return $billQuery->get();
    }
}
