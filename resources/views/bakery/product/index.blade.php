@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <button class="btn btn-large style-btn" data-toggle="modal" data-target="#createNewCategoryModal">
                Add New Category
            </button>
        </div>
        <div class="row">
            {{--<div class="visible-mobile mobile-table sorted-records-wrapper sorted-records">
                @include('store.category.list')
            </div>--}}

            <div class="visible-block sorted-records-wrapper sorted-records">
                @include('bakery.category.list')
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="createNewCategoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <form class="form-horizontal" action="{{ route('category.store') }}" method="post">
                {{ csrf_field() }}

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create New Category</h4>
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

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea rows="3" id="description" class="form-control" name="description" required>{{ old('description') ? old('description') : ''}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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