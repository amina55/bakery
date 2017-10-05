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

    <input type="hidden" id="products" value="{{ $products }}">

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

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select id="category_id" name="category_id" class="form-control" required>
                                    <option value=""> --- select a category --- </option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('product_id') ? ' has-error' : '' }}">
                            <label for="product_id" class="col-md-4 control-label">Product</label>

                            <div class="col-md-6">
                                <select id="product_id" name="product_id" class="form-control" required>
                                    <option value=""> --- select a product --- </option>
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

        var products = $('#products').val();
        products = JSON.parse(products);
        var units = [];

        for(var j=0; j < products.length; j++) {
            units[products[j].id] = products[j].unit.name;
        }

        $('#category_id').change(function () {
            var categoryId = $(this).val();
            var optionsHTML = '<option  value="">--- select an item ---</option>';

            for(var j=0; j < products.length; j++)
            {
                if(categoryId == products[j].category_id) {
                    optionsHTML += '<option value="'+ products[j].id +'">'+ products[j].name +'</option>';
                }
            }
            $('#product_id').html(optionsHTML);
            $('#product_unit').html('');

        });

        $('#product_id').change(function () {

            var product = $(this).val();
            $('#product_unit').html(units[product]);
        });
    </script>
@endsection