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

    public static function getProduct($categoryId = '')
    {
        $query = self::where('status', 1);
        if($categoryId) {
            $query->where('category_id', $categoryId);
        }
        return $query->with('unit')->get();
    }
}
