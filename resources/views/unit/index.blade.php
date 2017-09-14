@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            
            <button class="btn btn-large style-btn" data-toggle="modal" data-target="#createNewUnitModal">
                Add New Unit
            </button>
        </div>
        <div class="row">
            <div class="visible-block sorted-records-wrapper sorted-records">
                @include('unit.list')
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="createNewUnitModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <form class="form-horizontal" action="{{ route('unit.store') }}" method="post">
                {{ csrf_field() }}

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create New Unit</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" class="form-control" name="name" required value="{{ old('name') ? old('name') : '' }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('short_key') ? ' has-error' : '' }}">
                            <label for="short_key" class="col-md-4 control-label">Short Key</label>

                            <div class="col-md-6">
                                <input type="text" id="short_key" class="form-control" name="short_key" value="{{ old('short_key') ? old('short_key') : ''}}" required>
                                @if ($errors->has('short_key'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('short_key') }}</strong>
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