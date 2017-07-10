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
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('item.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

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
                                    <textarea id="description" class="form-control" name="description" rows="5" required></textarea>

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
                                    <input id="stock" type="number" class="form-control" name="stock" min="0" required>

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
                                    <input id="unit" type="text" class="form-control" name="unit" required>

                                    @if ($errors->has('unit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('unit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-success" name="add_and_create_new"> Add & Create New </button>
                                    <button type="submit" class="btn btn-primary" name="add"> Add </button>
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
