<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public static function getInvoice($supplierID = '', $invoiceDate = '')
    {
        $invoiceQuery = self::where('status', 1)->with('supplier');
        if($invoiceDate) {
            $invoiceQuery = $invoiceQuery->where('date', date('Y-m-d', strtotime($invoiceDate)));
        }
        if($supplierID) {
            $invoiceQuery = $invoiceQuery->where('supplier_id', $supplierID);
        }
        return $invoiceQuery->get();
    }
}
