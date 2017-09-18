@extends('layouts.app')

@section('content')

    <script>
        $(document).ready(function() {
            var total_rows = 2;
            var total_amount = 0;
            var total_tax = 0;
            var payable_amount = 0;
            var stock_items = $('#stock_items').val();
            stock_items = JSON.parse(stock_items);
            var units = [];
            var rates = [];

            for(var j=0; j < stock_items.length; j++) {
                units[stock_items[j].id] = stock_items[j].multiplier +' '+ stock_items[j].product.unit.name;
                rates[stock_items[j].id] = stock_items[j].price;
            }

            $('body').on('change', '[id^="stock_item"]', function(){
                var product = $(this).val();
                var id = $(this).attr('id');

                var unitId = id.replace('stock_item', 'unit');
                $('#'+unitId).html(units[product]);

                var rateId = id.replace('stock_item', 'rate');
                $('#'+rateId).html(rates[product]);
            });

            $('.add_new_row').click(function () {

                var appendChild = '<tr><td><select id="stock_item'+total_rows+'" name="stock_item'+total_rows+'" class="form-control">'+
                    '<option value="">--- select an item ---</option> ';

                for (var i = 0; i < stock_items.length; i++) {
                    appendChild += '<option value="'+ stock_items[i].id +'">'+ stock_items[i].product.name +'</option>';
                }

                appendChild += '</select></td><td> <label id="unit'+total_rows+'"> unit</label> </td> ' +
                    '<td> <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01" id="quantity'+total_rows+'" name="quantity'+total_rows+'"  min="0" class="form-control" type="number"> </td>'+
                    '<td> <label id="rate'+total_rows+'"></label> </td> '+
                    '<td> <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01"  id="discount'+total_rows+'" name="discount'+total_rows+'" min="0" class="form-control" type="number"> </td> ' +
                    '<td> <label id="amount'+total_rows+'"></label> </td>' +
                    '<td>remove </td></tr>';
                $('.bill_items').append(appendChild);

                total_rows++;
                $('#total_rows').val(total_rows);
            });
            $('.calculate_bill').click(function () {
                $('.error-show').html('');
                total_amount = 0;
                var status = true;

                for(var i = 1; i < total_rows; i++) {

                    var item = $('#stock_item'+i).val();
                    var quantity = $('#quantity'+i).val();
                    var rate = $('#rate'+i).html();
                    var discount = $('#discount'+i).val();

                    if(item && quantity && rate) {
                        var amount = quantity * rate - discount;
                        $('#amount'+i).html(amount.toFixed(2));
                        total_amount = total_amount + amount;
                    } else {
                        if(item) {
                            status = false;
                            $('.error-show').html('<div class="alert alert-danger">Please fill all items quantity</div>');
                        }
                    }
                }
                if(status) {
                    $('.total_amount').val(total_amount.toFixed(2));
                    calculateTax();
                    calculatePayable();
                    calculateRemaining();
                }
            });

            $('#total_discount').blur(function () {
                calculatePayable();
                calculateRemaining();
            });

            $('#paid_amount').blur(function () {
                calculateRemaining()
            });
            function calculatePayable() {
                var total_discount = $('#total_discount').val();
                payable_amount = ( total_amount + total_tax ) - ( total_discount / 100 ) * total_amount;
                $('.payable_amount').val(payable_amount.toFixed(2));
            }
            function calculateTax() {

                total_tax =  0.18 * total_amount;
                $('.total_tax').val(total_tax.toFixed(2));

                var cgst_tax =  0.09 * total_amount;
                var sgst_tax =  0.09 * total_amount;

                $('.cgst_tax').val(cgst_tax.toFixed(2));
                $('.sgst_tax').val(sgst_tax.toFixed(2));
            }
            
            function calculateRemaining() {
                var paid_amount = $('#paid_amount').val();
                var remaining = payable_amount - paid_amount;
                $('.remaining').val(remaining.toFixed(2));
            }
        });
    </script>

    <form class="form-horizontal" action=" {{ route('bill.store') }}" method="post">
        {{ csrf_field() }}

        <div class="container">
            <div class="row">
                <div class="error-show"></div>
                <input type="hidden" id="stock_items" name="stock_items" value="{{ $stocks }}">
                <input type="hidden" name="total_rows" id="total_rows" value="1">
                <input type="hidden" name="total_amount" class="total_amount">
                <input type="hidden" name="total_tax" class="total_tax">
                <input type="hidden" name="cgst_tax" class="cgst_tax">
                <input type="hidden" name="sgst_tax" class="sgst_tax">

                <input type="hidden" name="payable_amount" class="payable_amount">
                <input type="hidden" name="remaining" class="remaining">


                <div class="form-group{{ $errors->has('customer_name') ? ' has-error' : '' }}">
                    <label for="customer_name" class="col-md-4 control-label">Customer Name</label>

                    <div class="col-md-3">

                        <input placeholder="Customer Name" class="form-control" type="text" name="customer_name">
                        @if ($errors->has('customer_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('customer_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('care_of') ? ' has-error' : '' }}">
                    <label for="care_of" class="col-md-4 control-label">Care of.</label>

                    <div class="col-md-3">

                        <input placeholder="Customer Care Of." class="form-control" type="text" name="care_of">
                        @if ($errors->has('care_of'))
                            <span class="help-block">
                                <strong>{{ $errors->first('care_of') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Products</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Discount ( Rs. )</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bill_items">
                        <tr>
                            <td>
                                <select id="stock_item1" name="stock_item1" class="form-control" required>
                                    <option  value="">--- select an item ---</option>
                                    @foreach($stocks as $stock)
                                        <option value="{{ $stock->id }}">{{$stock->product->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label id="unit1"></label>
                            </td>
                            <td>
                                <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01" id="quantity1" name="quantity1" type="number" min="0" class="form-control" required>
                            </td>
                            <td>
                                <label id="rate1"></label>
                            </td>
                            <td>
                                <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01"  id="discount1" name="discount1" type="number" min="0" class="form-control">
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

                    <div class="form-group">
                        <label for="total_amount" class="col-md-4 control-label"> Total Amount </label>

                        <div class="col-md-3">
                            <input class="total_amount form-control" name="total_amount" required value="{{ old('total_amount') ? old('total_amount') : 0 }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_tax" class="col-md-4 control-label"> Total Tax (18%)  </label>

                        <div class="col-md-3">
                            <input class="total_tax form-control" name="total_tax" required value="{{ old('total_tax') ? old('total_tax') : 0 }}" disabled>
                        </div>
                        <label for="cgst_tax" class="col-md-1 control-label"> CGST(9%)  </label>
                        <div class="col-md-1">
                            <input class="cgst_tax form-control" required value="{{ old('cgst_tax') ? old('cgst_tax') : 0 }}" disabled>
                        </div>
                        <label for="sgst_tax" class="col-md-1 control-label"> SGST(9%)  </label>
                        <div class="col-md-1">
                            <input class="sgst_tax form-control" required value="{{ old('sgst_tax') ? old('sgst_tax') : 0 }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_discount" class="col-md-4 control-label"> Total Discount ( % ) </label>

                        <div class="col-md-3">
                            <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0" id="total_discount" name="total_discount" class="form-control" type="number" value="{{ old('total_discount') ? old('total_discount') : 0 }}" onblur="calculatePayable()">
                            @if ($errors->has('total_discount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('total_discount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="payable_amount" class="col-md-4 control-label"> Payable Amount </label>

                        <div class="col-md-3">
                            <input class="payable_amount form-control" name="payable_amount" required value="{{ old('payable_amount') ? old('payable_amount') : 0 }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="paid_amount" class="col-md-4 control-label"> Paid Amount </label>

                        <div class="col-md-3">
                            <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0" id="paid_amount" name="paid_amount" class="form-control" type="number" required value="{{ old('paid_amount') ? old('paid_amount') : 0 }}" onblur="calculateRemaining()"> </div>
                            @if ($errors->has('paid_amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('paid_amount') }}</strong>
                                </span>
                            @endif
                        </div>

                    <div class="form-group">
                        <label for="remaining" class="col-md-4 control-label"> Remaining Amount </label>

                        <div class="col-md-3">
                            <input class="remaining form-control" name="remaining" required value="{{ old('remaining') ? old('remaining') : 0 }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row pull-right">
                    <input type="submit" class="btn btn-primary" value="Save bill">
                    <input type="button" class="btn btn-default" value="Cancel">
                </div>
            </div>
        </div>
    </form>

@endsection
