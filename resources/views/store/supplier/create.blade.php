@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('content.create_supplier') }}
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('supplier.store') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="request_type" value="{{ ($supplier) ? 'edit' : 'create' }}">
                            <input type="hidden" name="unique_identifier" value="{{ ($supplier) ? $supplier->identifier : '' }}">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : (($supplier) ? $supplier->name : '') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
                                <label for="identifier" class="col-md-4 control-label">Identifier</label>

                                <div class="col-md-6">
                                    <input id="identifier" type="text" class="form-control" name="identifier" {{ ($supplier) ? 'disabled' : ''}}
                                           value="{{ old('identifier') ? old('identifier') : (($supplier) ? $supplier->identifier : '') }}" required>

                                    @if ($errors->has('identifier'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('identifier') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') ? old('address') : (($supplier) ? $supplier->address : '') }}" required>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                                <label for="phone_no" class="col-md-4 control-label">Phone No.</label>

                                <div class="col-md-6">
                                    <input id="phone_no" type="text" class="form-control" name="phone_no" value="{{ old('phone_no') ? old('phone_no') : (($supplier) ? $supplier->phone_no : '') }}" required>

                                    @if ($errors->has('phone_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    @if($supplier)
                                        <button type="submit" class="btn btn-primary" name="update"> Update </button>
                                    @else
                                        <button type="submit" class="btn btn-success" name="add_and_create_new"> Add & Create New </button>
                                        <button type="submit" class="btn btn-primary" name="add"> Add </button>
                                    @endif
                                    <a type="button" href="{{ route('supplier.index') }}" class="btn btn-default"> Cancel </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
