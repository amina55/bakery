@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="visible-block sorted-records-wrapper sorted-records">
                @include('kitchen.stock.list')
            </div>
        </div>
    </div>
@endsection