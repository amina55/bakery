@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <a href="{{ route('invoice.create') }}" class="btn btn-large style-btn" >Add New Invoice</a>
            </div>
            <br><br><br>

            <form action="{{ route('invoice.index') }}" method="get" class="form-horizontal">

                <div class="form-group">
                    <div class="mt10 col-sm-12">
                        <label class="col-sm-2 mt10"> Choose Invoice Date </label>
                        <div class="col-sm-4">
                            <input placeholder="Invoice Date" class="date-format form-control" type="text" name="invoice_date" value="{{ ($invoiceDate) ? $invoiceDate : '' }}">
                        </div>
                       {{-- <label class="col-sm-2 mt10"> Choose Raw Item </label>

                        <div class="col-sm-4">
                            <select id="raw_item_selector" name="raw_item_selector" class="form-control">
                                <option value=""> All </option>
                            @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>--}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="mt20 col-sm-12">
                        <label class="col-sm-2 mt10"> Search By Supplier</label>

                        <div class="col-sm-4">
                            <select id="supplier_id" name="supplier_id" class="form-control">
                                <option value=""> All </option>
                                @foreach($suppliers as $supplier)
                                    <option {{ ($supplierID == $supplier->id) ? 'selected' : '' }} value="{{ $supplier->id }}">{{$supplier->identifier}}</option>
                                @endforeach
                            </select>
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
                @include('store.invoice.list')
            </div>
        </div>
    </div>
@endsection