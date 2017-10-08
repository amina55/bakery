<?php

namespace App\Http\Controllers\Bakery;

use App\BakeryRequest;
use App\Category;
use App\Customer;
use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderNo = $request->get('order_no', 0);
        $orderDate = $request->get('order_date', 0);
        $orders = Order::getOrder($orderNo, $orderDate);

        return view('bakery.order.index', ['orders' => $orders, 'orderDate' => $orderDate, 'orderNo' => $orderNo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::getProduct();
        $categories = Category::getCategory();
        $customers = Customer::getCustomer();
        return view('bakery.order.create',
            ['products' => $products, 'categories' => $categories, 'customers' => $customers]);
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
        $customerId = $inputs['customer_type'].'_customer_name';
        $customerName = $inputs[$customerId] ? $inputs[$customerId] :'';
        $gstinNo = '';
        if($inputs['customer_type'] == 'b2b') {
            $customer = Customer::getCustomerById($customerName);
            $customerName = $customer->name;
            $gstinNo = $customer->gstin_no;
        }

        $order = Order::create([
            'order_no' => strtotime('now'),
            'total_amount' => $inputs['total_amount'],
            'total_tax' => $inputs['total_tax'],
            'cgst_tax' => $inputs['cgst_tax'],
            'sgst_tax' => $inputs['cgst_tax'],
            'discount' => $inputs['total_discount'],
            'payable_amount' => $inputs['payable_amount'],
            'paid_amount' => $inputs['paid_amount'],
            'advance_paid' => $inputs['paid_amount'],
            'customer_name' => $customerName,
            'phone_no' => $inputs['phone_no'],
            'address' => $inputs['address'],
            'payment_type' => $inputs['payment_type'],
            'care_of' => $inputs['care_of'] ? $inputs['care_of'] : '',
            'customer_gstin_no' => $gstinNo,
            'user_name' => Auth::user()->name,
            'delivery_date' => date('Y-m-d', strtotime($inputs['delivery_date'])),
        ]);

        for($i = 1; $i <= $inputs['total_rows']; $i++) {
            if(!empty($inputs['product_id'.$i]) &&  !empty($inputs['quantity'.$i]))
            {
                $productId = $inputs['product_id'.$i];
                $product = Product::where('id', $productId)->first(['id', 'price']);
                $price = ($product) ? $product->price : 0;
                $quantity = $inputs['quantity'.$i];
                $discount = !empty($inputs['discount'.$i]) ? $inputs['discount'.$i] : 0;
                $weight = $inputs['weight'.$i];

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'category_id' => $inputs['category_id'.$i],
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'rate' => $price,
                    'weight' => $weight,
                    'total_amount' => $quantity * $price * $weight,
                    'discount_amount' => $discount,
                    'discount_percentage' => 0,
                    'payable_amount' => $quantity * $weight * $price - $discount,
                ]);
                //BakeryRequest::orderToKitchen($orderItem);
            }
        }
        return redirect()->route('order.show', $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orderItems = OrderItem::getOrderItems($order->id);
        return view('bakery.order.show', ['order' => $order, 'orderItems' => $orderItems]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
