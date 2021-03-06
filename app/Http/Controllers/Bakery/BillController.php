<?php

namespace App\Http\Controllers\Bakery;

use App\BakeryStock;
use App\Bill;
use App\BillItem;
use App\Category;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $billNo = $request->get('bill_no', 0);
        $billDate = $request->get('bill_date', 0);
        $bills = Bill::getBill($billNo, $billDate);

        return view('bakery.bill.index', ['bills' => $bills, 'billDate' => $billDate, 'billNo' => $billNo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stocks = BakeryStock::getStock();
        $products = Product::getProduct();
        $categories = Category::getCategory();
        $customers = Customer::getCustomer();
        return view('bakery.bill.create',
            ['products' => $products, 'stocks' => $stocks, 'categories' => $categories, 'customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $customerId = $inputs['bill_type'].'_customer_name';
        $customerName = $inputs[$customerId] ? $inputs[$customerId] :'';
        $gstinNo = '';
        if($inputs['bill_type'] == 'b2b') {
            $customer = Customer::getCustomerById($customerName);
            $customerName = $customer->name;
            $gstinNo = $customer->gstin_no;
        }

        $bill = Bill::create([
            'bill_no' => strtotime('now'),
            'total_amount' => $inputs['total_amount'],
            'total_tax' => $inputs['total_tax'],
            'cgst_tax' => $inputs['cgst_tax'],
            'sgst_tax' => $inputs['cgst_tax'],
            'discount' => $inputs['total_discount'],
            'payable_amount' => $inputs['payable_amount'],
            'paid_amount' => $inputs['paid_amount'],
            'customer_name' => $customerName,
            'care_of' => $inputs['care_of'] ? $inputs['care_of'] : '',
            'customer_gstin_no' => $gstinNo,
            'user_name' => Auth::user()->name,
        ]);

        for($i = 1; $i <= $inputs['total_rows']; $i++) {
            if(!empty($inputs['stock_item'.$i]) &&  !empty($inputs['quantity'.$i]))
            {
                $stockId = $inputs['stock_item'.$i];
                $stock = BakeryStock::where('id', $stockId)->first(['id', 'price', 'product_id']);
                $price = ($stock) ? $stock->price : 0;
                $productId = ($stock) ? $stock->product_id : null;
                $quantity = $inputs['quantity'.$i];
                $discount = !empty($inputs['quantity'.$i]) ? $inputs['quantity'.$i] : 0;

                BillItem::create([
                    'bill_id' => $bill->id,
                    'stock_id' => $stockId,
                    'category_id' => $inputs['category_id'.$i],
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'rate' => $price,
                    'total_amount' => $quantity * $price,
                   /* 'discount_amount' => $discount,
                    'discount_percentage' => 0,
                    'payable_amount' => $quantity * $price - $discount,*/
                ]);

                BakeryStock::decreaseQuantity($stockId, $quantity);
            }
        }
        return redirect()->route('bill.show', $bill->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        $billItems = BillItem::getBillItems($bill->id);
        return view('bakery.bill.show', ['bill' => $bill, 'billItems' => $billItems]);

      //  return redirect()->route('bill.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
