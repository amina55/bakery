@extends('layouts.app')

@section('content')

    <script>
        $(document).ready(function() {
            var total_rows = 2;
            var total_amount = 0;
            var total_tax = 0;
            var payable_amount = 0;
            var raw_items = $('#raw_items').val();
            raw_items = JSON.parse(raw_items);
            var units = [];

            for(var j=0; j < raw_items.length; j++) {
                units[raw_items[j].id] = raw_items[j].unit;
            }

            $('.add_new_row').click(function () {

                var appendChild = '<tr><td><select id="raw_item'+total_rows+'" name="raw_item'+total_rows+'" class="form-control">'+
                    '<option value="">--- select an item ---</option> ' +

                    '<option value="1">sugar</option> <option value="2">pepsi</option>'+
                    '<option value="3">baking_powder</option> <option value="4">cream</option> <option value="5">milk</option>'+
                    '<option value="6">salt</option> <option value="9">baking soda</option> <option value="10">sad</option> ' +
                    '</select></td>'+

                    '<td> <label id="unit'+total_rows+'"> unit</label> </td> <td> <input id="quantity'+total_rows+'" name="quantity'+total_rows+'"  min="0" class="form-control" type="number"> </td>'+
                    '<td> <input id="rate'+total_rows+'" name="rate'+total_rows+'"  min="0" class="form-control" type="number"> </td> '+
                    '<td> <input id="discount'+total_rows+'" name="discount'+total_rows+'" min="0" class="form-control" type="number"> </td> ' +
                    '<td> <label id="amount'+total_rows+'"></label> </td>' +
                    '<td>remove </td></tr>';
                $('.invoice_items').append(appendChild);

                total_rows++;
                $('#total_rows').val(total_rows);
            });
            $('.calculate_bill').click(function () {
                $('.error-show').html('');
                total_amount = 0;
                var status = true;

                for(var i = 1; i < total_rows; i++) {

                    var item = $('#raw_item'+i).val();
                    var quantity = $('#quantity'+i).val();
                    var rate = $('#rate'+i).val();
                    var discount = $('#discount'+i).val();

                    if(item && quantity && rate) {
                        var amount = quantity * rate - discount;
                        $('#amount'+i).html(amount);
                        total_amount = total_amount + amount;
                    } else {
                        if(item) {
                            status = false;
                            $('.error-show').html('<div class="alert alert-danger">Please fill all items quantity and rate</div>');
                        }
                    }
                }
                if(status) {
                    $('.total_amount').val(total_amount);
                    calculateTax();
                    calculatePayable();
                }
            });

            $('#total_discount').blur(function () {
                calculatePayable()
            });

            $('#paid_amount').blur(function () {
                calculateRemaining()
            });
            function calculatePayable() {
                var total_discount = $('#total_discount').val();
                payable_amount = ( total_amount + total_tax ) - ( total_discount / 100 ) * total_amount;
                $('.payable_amount').val(payable_amount);
                $('.remaining').val(payable_amount);

            }
            function calculateTax() {
                total_tax =  0.18 * total_amount;
                $('.total_tax').val(total_tax);
            }
            
            function calculateRemaining() {
                var paid_amount = $('#paid_amount').val();
                var remaining = payable_amount - paid_amount;
                $('.remaining').val(remaining);
            }
        });
    </script>

    <form class="form-horizontal" action=" {{ route('invoice.store') }}" method="post">
        {{ csrf_field() }}

        <div class="container">
            <div class="row">
                <div class="error-show"></div>
                <input type="hidden" id="raw_items" name="raw_items" value="{{ $items }}">
                <input type="hidden" name="total_rows" id="total_rows" value="1">
                <input type="hidden" name="total_amount" class="total_amount">
                <input type="hidden" name="total_tax" class="total_tax">
                <input type="hidden" name="payable_amount" class="payable_amount">
                <input type="hidden" name="remaining" class="remaining">


                <div class="form-group{{ $errors->has('supplier_invoice_id') ? ' has-error' : '' }}">
                    <label for="supplier_invoice_id" class="col-md-4 control-label">Supplier Invoice ID</label>

                    <div class="col-md-3">
                        <input id="supplier_invoice_id" class="form-control" name="supplier_invoice_id" required value="{{ old('supplier_invoice_id') ? old('supplier_invoice_id') : '' }}">

                        @if ($errors->has('supplier_invoice_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('supplier_invoice_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                    <label for="supplier_id" class="col-md-4 control-label">Supplier</label>

                    <div class="col-md-3">

                        <select id="supplier_id" name="supplier_id" class="form-control">
                            <option  value="">--- select a supplier ---</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{$supplier->name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('supplier_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('supplier_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('invoice_date') ? ' has-error' : '' }}">
                    <label for="invoice_date" class="col-md-4 control-label">Invoice Date</label>

                    <div class="col-md-3">

                        <input placeholder="Invoice Date" class="date-format form-control" type="text" name="invoice_date" required>
                        @if ($errors->has('invoice_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('invoice_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Raw Items</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Discount</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="invoice_items">
                        <tr>
                            <td>
                                <select id="raw_item1" name="raw_item1" class="form-control" required>
                                    <option  value="">--- select an item ---</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label id="unit1"> unit</label>
                            </td>
                            <td>
                                <input id="quantity1" name="quantity1" type="number" min="0" class="form-control" required>
                            </td>
                            <td>
                                <input id="rate1" name="rate1" type="number" min="0" class="form-control" required>
                            </td>
                            <td>
                                <input id="discount1" name="discount1" type="number" min="0" class="form-control">
                            </td>
                            <td>
                                <label id="amount1"></label>
                            </td>
                            <td>
                                remove
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row pull-right">
                    <input id="add_new_row" class="pull-right add_new_row" type="button" value="Add">
                    <input type="button" class="btn btn-primary calculate_bill pull-right" value="Calculate Bill">
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-2 col-sm-offset-3"> <label> Total Amount </label> </div>
                        <div class="col-sm-2"> <input type="text" class="total_amount form-control" value="0" disabled> </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-2 col-sm-offset-3"> <label> Total Tax (18 %) </label> </div>
                        <div class="col-sm-2"> <input type="text" class="total_tax form-control" value="0" disabled> </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-2 col-sm-offset-3"> <label> Discount (in %) </label> </div>
                        <div class="col-sm-2"> <input id="total_discount" name="total_discount" class="form-control" type="number" value="0" onblur="calculatePayable()"> </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-2 col-sm-offset-3"> <label> Payable Amount </label> </div>
                        <div class="col-sm-2"> <input type="text" class="payable_amount form-control" value="0" disabled> </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-2 col-sm-offset-3"> <label> Paid Amount </label> </div>
                        <div class="col-sm-2"> <input id="paid_amount" name="paid_amount" class="form-control" type="number" value="0" onblur="calculateRemaining()"> </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-2 col-sm-offset-3"> <label> Remaining Amount </label> </div>
                        <div class="col-sm-2"> <input type="text" class="remaining form-control" value="0" disabled> </div>
                    </div>
                </div>

                <div class="row pull-right">
                    <input type="submit" class="btn btn-primary" value="Save Invoice">
                    <input type="button" class="btn btn-default" value="Cancel">

                </div>
            </div>
        </div>
    </form>

@endsection
