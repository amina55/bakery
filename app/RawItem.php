<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawItem extends Model
{
    //protected $table = 'raw_items';

    protected $guarded = ['id'];

   /* public static function getRawItems($whereClauses, $paramsToFetch, $fetchSingle= true)
    {
        $query = self::where($whereClauses);
        if($fetchSingle) {
            $result = $query->first($paramsToFetch);
        } else {
            $result = $query->get($paramsToFetch);
        }
        return $result;
    }*/

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public static function getRawItems()
    {
        return self::where('status', 1)->get();
    }

    public static function increaseQuantity($itemId, $quantity)
    {
        return self::where('id', $itemId)->increment('stock', $quantity);
    }

}
