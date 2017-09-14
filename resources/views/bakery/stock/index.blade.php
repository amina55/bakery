@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <button class="btn btn-large style-btn" data-toggle="modal" data-target="#createNewStockModal">
                Add New Stock
            </button>
        </div>
        <div class="row">
            <div class="visible-block sorted-records-wrapper sorted-records">
                @include('bakery.stock.list')
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="createNewStockModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <form class="form-horizontal" action="{{ route('bakery_stock.store') }}" method="post">
                {{ csrf_field() }}

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Stock</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
                            <label for="product_id" class="col-md-4 control-label">Product</label>

                            <div class="col-md-6">
                                <select id="product_id" name="product_id" class="form-control" required>
                                    <option value=""> --- select a product --- </option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}"> {{ $product->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('multiplier') ? ' has-error' : '' }}">
                            <label for="multiplier" class="col-md-4 control-label">Multiplier</label>

                            <div class="col-md-6">
                                <div class="col-sm-6">
                                    <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" id="multiplier" class="form-control" name="multiplier" value="{{ old('multiplier') ? old('multiplier') : ''}}" required>
                                </div>
                                <div class="col-sm-6">
                                    <label id="product_unit"></label>
                                </div>
                                @if ($errors->has('multiplier'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('multiplier') }}</strong>
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

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" id="price" class="form-control" name="price" value="{{ old('price') ? old('price') : ''}}" required>
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
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
        
        $('#product_id').change(function () {

            $('#product_unit').html('liter');
        });
    </script>

@endsection