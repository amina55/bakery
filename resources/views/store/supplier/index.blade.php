@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-large" >Add Raw supplier</a>
        </div>
        <div class="row">
            <div class="visible-block sorted-records-wrapper sorted-records">
                @include('store.supplier.list')
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="createNewSupplierModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create New supplier</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection