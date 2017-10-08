@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3> {{ $category->name }}'s Products</h3>
            <button class="btn btn-large style-btn" data-toggle="modal" data-target="#createNewProductModal">
                Add New Product
            </button>
        </div>
        <div class="row">
            <div class="visible-block sorted-records-wrapper sorted-records">
                @include('bakery.product.list')
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="createNewProductModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <form class="form-horizontal" action="{{ route('product.store') }}" method="post">
                {{ csrf_field() }}

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create New Product</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" class="form-control" name="name" value="{{ old('name') ? old('name') : '' }}" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Price</label>

                            <div class="col-md-6">
                                <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0" id="price" class="form-control" name="price" value="{{ old('price') ? old('price') : ''}}" required>
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('unit_id') ? ' has-error' : '' }}">
                            <label for="unit_id" class="col-md-4 control-label">Unit</label>

                            <div class="col-md-6">
                                <select id="unit_id" name="unit_id" class="form-control" required>
                                    <option  value="">--- select a unit ---</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('unit_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                            <label for="stock" class="col-md-4 control-label">Stock</label>

                            <div class="col-md-6">
                                <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.1" min="0" id="stock" class="form-control" name="stock" value="{{ old('stock') ? old('stock') : 0}}" required>
                                @if ($errors->has('stock'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('stock') }}</strong>
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

@endsection