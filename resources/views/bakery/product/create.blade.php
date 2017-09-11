@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('content.create_item') }}
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ ($item) ? route('item.update', $item) : route('item.store') }}">
                            {{ csrf_field() }}
                            {{ ($item) ? method_field('PUT') : '' }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : (($item) ? $item->name : '') }}" {{ ($item) ? 'disabled' : '' }} required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" rows="5" required>{{ old('description') ? old('description') : (($item) ? $item->description : '') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                                <label for="stock" class="col-md-4 control-label">Stock</label>

                                <div class="col-md-6">
                                    <input id="stock" type="number" class="form-control" name="stock" min="0" value="{{ old('stock') ? old('stock') : (($item) ? $item->stock : '') }}" {{ ($item) ? 'disabled' : '' }} required>

                                    @if ($errors->has('stock'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                                <label for="unit" class="col-md-4 control-label">Unit</label>

                                <div class="col-md-6">
                                    <input id="unit" type="text" class="form-control" name="unit" value="{{ old('unit') ? old('unit') : (($item) ? $item->unit : '') }}" required>

                                    @if ($errors->has('unit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    @if($item)
                                        <button type="submit" class="btn btn-primary" name="update"> Update </button>
                                    @else
                                        <button type="submit" class="btn btn-success" name="add_and_create_new"> Add & Create New </button>
                                        <button type="submit" class="btn btn-primary" name="add"> Add </button>
                                    @endif
                                    <a type="button" href="{{ route('item.index') }}" class="btn btn-default"> Cancel </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
