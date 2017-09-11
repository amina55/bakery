<?php

namespace App\Http\Controllers\Store;

use App\Invoice;
use App\InvoiceItem;
use App\RawItem;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\PaginationServiceProvider;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$suppliers = Supplier::where('status', 'active')->get();
        $items = RawItem::where('status', 'active')->get();*/

        $supplierID = $request->get('supplier_id', 0);
        $invoiceDate = $request->get('invoice_date', 0);
        $suppliers = Supplier::all();

        $invoiceQuery = Invoice::where('total_amount', '>', 0);
        if($invoiceDate) {
            $invoiceQuery = $invoiceQuery->where('date', date('Y-m-d', strtotime($invoiceDate)));
        }
        if($supplierID) {
            $invoiceQuery = $invoiceQuery->where('supplier_id', $supplierID);
        }
        $invoices = $invoiceQuery->get();
        $items = RawItem::all();

        return view('store.invoice.index', ['invoices' => $invoices, 'suppliers' => $suppliers, 'items' => $items, 'supplierID' => $supplierID, 'invoiceDate' => $invoiceDate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $items = RawItem::all();
        return view('store.invoice.create', ['invoice' => null, 'suppliers' => $suppliers, 'items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $route = 'invoice.index';

        $inputs = $request->all();
        $invoice = Invoice::create([
            'supplier_invoice_id' => $inputs['supplier_invoice_id'],
            'total_amount' => $inputs['total_amount'],
            'total_tax' => $inputs['total_tax'],
            'total_discount' => $inputs['total_discount'],
            'payable_amount' => $inputs['payable_amount'],
            'paid_amount' => $inputs['paid_amount'],
            'remaining' => $inputs['remaining'],
            'supplier_id' => $inputs['supplier_id'],
            'date' => date('Y-m-d', strtotime($inputs['invoice_date'])),
        ]);

        for($i = 1; $i <= $inputs['total_rows']; $i++) {
            if(!empty($inputs['raw_item'.$i]) && !empty($inputs['rate'.$i]) && !empty($inputs['quantity'.$i])) {

                $price = $inputs['rate'.$i];
                $quantity = $inputs['quantity'.$i];
                $discount = !empty($inputs['quantity'.$i]) ? $inputs['quantity'.$i] : 0;

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'raw_item_id' => $inputs['raw_item'.$i],
                    'quantity' => $quantity,
                    'price' => $price,
                    'amount' => $quantity * $price,
                    'discount_amount' => $discount,
                    'discount_percentage' => 0,
                    'payable_amount' => $quantity * $price - $discount,
                ]);
            }
        }
        return redirect()->route($route);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $suppliers = Supplier::all();
        $items = RawItem::all();
        return view('store.invoice.create', ['invoice' => $invoice, 'suppliers' => $suppliers, 'items' => $items]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $inputs = $request->all();
        print_r($inputs);

        return redirect()->route('invoice.index');
    }
}
