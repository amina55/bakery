<html>
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Order</title>
    <style>
        p, label {
            font-size: 15px;
        }
    </style>
</head>

<body>

<div class="centralized-text text-center">
    <h3>JUST BAKED</h3>

    <p>RAWALPORA COLONY CHOWK</p>
    <p>SRINAGAE 10005</p>
    <p>PH NO. : 2432390</p>
    <p>TIN NO. : 01ANAPL8026G1ZH</p>

    <p>-------------------------------------------------</p>

    <div class="col-xs-12">
        <label class="col-xs-6"> Date : {{ date('d-m-Y', strtotime($order->created_at)) }} </label>
        <label class="col-xs-6"> Time : {{ date('h : m', strtotime($order->created_at)) }} </label>
    </div>
    <div class="col-xs-12">
        <label class="col-xs-6"> Order No : {{ $order->order_no }} </label>
        <label class="col-xs-6"> User Name : {{ $order->user_name }} </label>
    </div>

    <p>-------------------------------------------------</p>

    <div class="col-xs-12">
        <label class="col-xs-5"> Dish Name </label>
        <label class="col-xs-2"> Qty. </label>
        <label class="col-xs-2"> Rate </label>
        <label class="col-xs-3"> Amount </label>
    </div>

    <p>-------------------------------------------------</p>


    @foreach($orderItems as $orderItem)

        <div class="col-xs-12">
            <label class="col-xs-5"> {{ $orderItem->product->name }} {{--( {{ $orderItem->stock->multiplier }} {{$orderItem->product->unit->name}})--}} </label>
            <label class="col-xs-2"> {{ $orderItem->quantity }} </label>
            <label class="col-xs-2"> {{ $orderItem->rate * $orderItem->weight }} </label>
            <label class="col-xs-3"> {{ $orderItem->total_amount }} </label>
        </div>
    @endforeach
    <p>-------------------------------------------------</p>

    <label class="col-xs-12"> Total Amount: {{ $order->total_amount }} </label>
    <label class="col-xs-12"> Total Tax: {{ $order->total_tax }} </label>
    <label class="col-xs-12"> Total Discount: {{ $order->discount }} </label>
    <label class="col-xs-12 bold"> Payable Amount : {{ $order->payable_amount }} </label>
    <label class="col-xs-12 bold"> Advance Paid Amount : {{ $order->advance_paid }} </label>

</div>


</body>
</html>