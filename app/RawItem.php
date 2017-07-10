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
}
