<html>
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Bill</title>
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
        <label class="col-xs-6"> Date : {{ date('d-m-Y', strtotime($bill->created_at)) }} </label>
        <label class="col-xs-6"> Time : {{ date('h:m:s', strtotime($bill->created_at)) }} </label>
    </div>
    <div class="col-xs-12">
        <label class="col-xs-6"> Bill No : {{ $bill->bill_no }} </label>
        <label class="col-xs-6"> User Name : {{ $bill->user_name }} </label>
    </div>

    <p>-------------------------------------------------</p>

    <div class="col-xs-12">
        <label class="col-xs-5"> Dish Name </label>
        <label class="col-xs-2"> Qty. </label>
        <label class="col-xs-2"> Rate </label>
        <label class="col-xs-3"> Amount </label>
    </div>

    <p>-------------------------------------------------</p>


    @foreach($billItems as $billItem)

        <div class="col-xs-12">
            <label class="col-xs-5"> {{ $billItem->product->name }} {{--( {{ $billItem->stock->multiplier }} {{$billItem->product->unit->name}})--}} </label>
            <label class="col-xs-2"> {{ $billItem->quantity }} </label>
            <label class="col-xs-2"> {{ $billItem->rate }} </label>
            <label class="col-xs-3"> {{ $billItem->total_amount }} </label>
        </div>
    @endforeach
    <p>-------------------------------------------------</p>

    <label class="col-xs-12"> Total Amount: {{ $bill->total_amount }} </label>
    <label class="col-xs-12"> Total Tax: {{ $bill->total_tax }} </label>
    <label class="col-xs-12"> Total Discount: {{ $bill->discount }} </label>
    <label class="col-xs-12 bold"> Payable Amount : {{ $bill->payable_amount }} </label>
    <label class="col-xs-12 bold"> Paid Amount : {{ $bill->paid_amount }} </label>

</div>


</body>
</html>