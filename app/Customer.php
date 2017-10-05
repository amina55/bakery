<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];

    public static function getCustomer()
    {
        return self::where('status', 1)->get();
    }

    public static function getCustomerById($id)
    {
        return self::find($id);
    }

}
