@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <a href="{{ route('order.create') }}" class="btn btn-large style-btn" >Add New Order</a>
            </div>
            <br><br><br>

            <form action="{{ route('order.index') }}" method="get" class="form-horizontal">

                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="col-sm-2"> Order Date </label>
                        <div class="col-sm-4">
                            <input placeholder="Order Date" class="date-format form-control" type="text" name="order_date" value="{{ ($orderDate) ? $orderDate : '' }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="col-sm-2 mt10"> Order No.</label>

                        <div class="col-sm-4">
                            <input type="text" id="order_no" name="order_no" class="form-control" value="{{ ($orderNo) ? $orderNo : '' }}">
                        </div>
                        <div class="col-sm-2">
                            <input class="btn btn-large style-btn" type="submit" value="Search">
                        </div>
                    </div>
                    <br><br>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="visible-block sorted-records-wrapper sorted-records">
                @include('bakery.order.list')
            </div>
        </div>
    </div>
@endsection