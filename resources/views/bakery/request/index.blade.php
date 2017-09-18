@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <button class="btn btn-large style-btn" data-toggle="modal" data-target="#createNewRequestModal">
                Add New Request
            </button>
        </div>
        <div class="row">
            <div class="visible-block sorted-records-wrapper sorted-records">
                @include('bakery.request.list')
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="createNewRequestModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <form class="form-horizontal" action="{{ route('bakery_request.store') }}" method="post">
                {{ csrf_field() }}

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Request</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group{{ $errors->has('stock_id') ? ' has-error' : '' }}">
                            <label for="stock_id" class="col-md-4 control-label">Product</label>

                            <div class="col-md-6">
                                <select id="stock_id" name="stock_id" class="form-control" required>
                                    <option value=""> --- select a product --- </option>
                                    @foreach($stocks as $stock)
                                        <option value="{{ $stock->id }}"> {{ $stock ->product->name }} ( {{ $stock->multiplier }} {{ ($stock->product->unit) ? $stock->product->unit->name : '' }} )</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('stock_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stock_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="quantity" class="col-md-4 control-label">Quantity</label>

                            <div class="col-md-6">
                                <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" id="quantity" class="form-control" name="quantity" value="{{ old('quantity') ? old('quantity') : ''}}" required>
                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('demand_date') ? ' has-error' : '' }}">
                            <label for="demand_date" class="col-md-4 control-label">Demand Date</label>

                            <div class="col-md-6">
                                <input type="text" id="demand_date" placeholder="Demand Date" class="date-from-now form-control" name="demand_date" value="{{ old('demand_date') ? old('demand_date') : ''}}" required>
                                @if ($errors->has('demand_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('demand_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('request_to') ? ' has-error' : '' }}">
                        <label for="request_to" class="col-md-4 control-label">Request To</label>

                        <div class="col-md-6">
                            <select id="request_to" name="request_to" class="form-control" required>
                                <option value="kitchen"> Kitchen </option>
                                <option value="store"> Store </option>
                            </select>
                            @if ($errors->has('request_to'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('request_to') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Save">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('.date-from-now').datepicker({
            minDate: new Date()
        });
    </script>

@endsection