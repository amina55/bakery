@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <a href="{{ route('bill.create') }}" class="btn btn-large style-btn" >Add New Bill</a>
            </div>
            <br><br><br>

            <form action="{{ route('bill.index') }}" method="get" class="form-horizontal">

                <div class="form-group">
                    <div class="mt10 col-sm-12">
                        <label class="col-sm-2 mt10"> Bill Date </label>
                        <div class="col-sm-4">
                            <input placeholder="Bill Date" class="date-format form-control" type="text" name="bill_date" value="{{ ($billDate) ? $billDate : '' }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="mt20 col-sm-12">
                        <label class="col-sm-2 mt10"> Bill No.</label>

                        <div class="col-sm-4">
                            <input type="text" id="bill_no" name="bill_no" class="form-control" value="{{ ($billNo) ? $billNo : '' }}">
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
                @include('bakery.bill.list')
            </div>
        </div>
    </div>
@endsection