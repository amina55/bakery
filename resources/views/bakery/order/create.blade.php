@extends('layouts.app')

@section('content')

    <script>
        $(document).ready(function () {

            $('#b2b_customers').hide();
            var total_rows = 2;
            var total_amount = 0;
            var total_tax = 0;
            var payable_amount = 0;
            var products = $('#products').val();
            products = JSON.parse(products);

            var categories = $('#categories').val();
            categories = JSON.parse(categories);
            var units = [];
            var rates = [];

            for (var j = 0; j < products.length; j++) {
                units[products[j].id] = products[j].unit.name;
                rates[products[j].id] = products[j].price;
            }

            $('body').on('change', '[id^="category_id"]', function () {
                var categoryId = $(this).val();
                var id = $(this).attr('id');
                var optionsHTML = '<option  value="">--- select an item ---</option>';

                for (var j = 0; j < products.length; j++) {
                    if (categoryId == products[j].category_id) {
                        optionsHTML += '<option value="' + products[j].id + '">' + products[j].name + '</option>';
                    }
                }

                var stockId = id.replace('category_id', 'product_id');
                $('#' + stockId).html(optionsHTML);
            });

            $('body').on('change', '[id^="product_id"]', function () {
                var product = $(this).val();
                var id = $(this).attr('id');

                var unitId = id.replace('product_id', 'unit');
                $('#' + unitId).html(units[product]);

                var rateId = id.replace('product_id', 'rate');
                $('#' + rateId).html(rates[product]);
            });

            $('.add_new_row').click(function () {

                var appendChild = '<tr><td><select id="category_id' + total_rows + '" name="category_id' + total_rows + '" class="form-control" required>' +
                    '<option  value="">--- select a category ---</option>';
                for (var i = 0; i < categories.length; i++) {
                    appendChild += '<option value="' + categories[i].id + '">' + categories[i].name + '</option>';
                }

                appendChild += '</select></td><td><select id="product_id' + total_rows + '" name="product_id' + total_rows + '" class="form-control">' +
                    '<option value="">--- select an item ---</option></select></td>' +
                    '<td><input id="weight' + total_rows + '" name="weight' + total_rows + '" type="number" class="form-control w80 inline-block" pattern="[0-9]+([\.,][0-9]+)?" step="0.1" value="1"> <label id="unit' + total_rows + '"> unit</label> </td> ' +
                    '<td> <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01" id="quantity' + total_rows + '" name="quantity' + total_rows + '"  min="0" class="form-control" type="number"> </td>' +
                    '<td> <label id="rate' + total_rows + '"></label> </td> ' +
                    '<td> <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01"  id="discount' + total_rows + '" name="discount' + total_rows + '" min="0" class="form-control" type="number"> </td> ' +
                    '<td> <label id="amount' + total_rows + '"></label> </td></tr>';
                $('.order_items').append(appendChild);

                total_rows++;
                $('#total_rows').val(total_rows);
            });

            $('body').on('blur', '[id^="weight"]', function () {
                var weight = $(this).val();
                var id = $(this).attr('id');

                var productId = id.replace('weight', 'product_id');
                var product = $('#' + productId).val();
                var price = rates[product];

            });


            $('.calculate_order').click(function () {
                $('.error-show').html('');
                total_amount = 0;
                var status = true;

                for (var i = 1; i < total_rows; i++) {

                    var item = $('#product_id' + i).val();
                    var quantity = $('#quantity' + i).val();
                    var rate = $('#rate' + i).html();
                    var discount = $('#discount' + i).val();
                    var weight = $('#weight' + i).val();

                    if (item && quantity && rate) {
                        var amount = quantity * weight * rate - discount;
                        $('#amount' + i).html(amount.toFixed(2));
                        total_amount = total_amount + amount;
                    } else {
                        if (item) {
                            status = false;
                            $('.error-show').html('<div class="alert alert-danger">Please fill all items quantity</div>');
                        }
                    }
                }
                if (status) {
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

                total_tax = 0.18 * total_amount;
                $('.total_tax').val(total_tax.toFixed(2));

                var cgst_tax = 0.09 * total_amount;
                var sgst_tax = 0.09 * total_amount;

                $('.cgst_tax').val(cgst_tax.toFixed(2));
                $('.sgst_tax').val(sgst_tax.toFixed(2));
            }

            function calculateRemaining() {
                var paid_amount = $('#paid_amount').val();
                var remaining = payable_amount - paid_amount;
                $('.remaining').val(remaining.toFixed(2));
            }

            $('#customer_type').change(function () {
                var orderType = $(this).val();
                if (orderType == 'b2b') {
                    $('#b2b_customers').show();
                    $('#b2c_customers').hide();
                } else {
                    $('#b2b_customers').hide();
                    $('#b2c_customers').show();
                }
            });
        });
    </script>

    <input type="hidden" id="categories" name="categories" value="{{ $categories }}">
    <input type="hidden" id="products" name="products" value="{{ $products }}">

    <form class="form-horizontal" action=" {{ route('order.store') }}" method="post">
        {{ csrf_field() }}

        <div class="container">
            <div class="row">
                <div class="error-show"></div>
                <input type="hidden" name="total_rows" id="total_rows" value="1">
                <input type="hidden" name="total_amount" class="total_amount">
                <input type="hidden" name="total_tax" class="total_tax">
                <input type="hidden" name="cgst_tax" class="cgst_tax">
                <input type="hidden" name="sgst_tax" class="sgst_tax">
                <input type="hidden" name="payable_amount" class="payable_amount">
                <input type="hidden" name="remaining" class="remaining">


                <div class="form-group{{ $errors->has('customer_type') ? ' has-error' : '' }}">
                    <label for="customer_type" class="col-sm-2 control-label">Customer Type</label>

                    <div class="col-sm-3">

                        <select id="customer_type" class="form-control" name="customer_type" required>
                            <option value="b2c"> Business to Customer</option>
                            <option value="b2b"> Business to Business</option>
                        </select>
                        @if ($errors->has('customer_type'))
                            <span class="help-block">
                                <strong>{{ $errors->first('customer_type') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{-- <label for="customer_name" class="col-sm-2 control-label">Customer Name</label>--}}
                    <div class="col-sm-3">

                        <div id="b2b_customers">
                            <select id="customer_name" class="form-control" name="b2b_customer_name">
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="b2c_customers">
                            <input placeholder="Customer Name" class="form-control" type="text"
                                   name="b2c_customer_name">
                        </div>

                        @if ($errors->has('customer_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('customer_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-sm-3">

                        <input placeholder="Customer Care Of." class="form-control" type="text" name="care_of">
                        @if ($errors->has('care_of'))
                            <span class="help-block">
                                <strong>{{ $errors->first('care_of') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">

                    <label for="payment type" class="col-sm-2 control-label">Payment</label>

                    <div class="col-sm-3">

                        <select id="payment type" class="form-control" name="payment type" required>
                            <option value="cash">Via Cash</option>
                            <option value="card">Via Card (debit, credit)</option>
                        </select>
                        @if ($errors->has('payment type'))
                            <span class="help-block">
                                <strong>{{ $errors->first('payment type') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-sm-3">

                        <input placeholder="Order's Delivery Date" class="form-control date-format-min" type="text" name="delivery_date" required>
                        @if ($errors->has('delivery_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('delivery_date') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-sm-3">

                        <input placeholder="Customer Phone No." class="form-control" type="text" name="phone_no" required>
                        @if ($errors->has('phone_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone_no') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group">

                    <label for="address" class="col-sm-2 control-label">Address</label>

                    <div class="col-sm-8">

                        <input placeholder="Customer's Address" class="form-control" type="text" name="address" required>
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Products</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Discount ( Rs. )</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody class="order_items">
                        <tr>
                            <td>
                                <select id="category_id1" name="category_id1" class="form-control" required>
                                    <option value="">--- select a category ---</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="product_id1" name="product_id1" class="form-control" required>
                                    <option value="">--- select an item ---</option>
                                </select>
                            </td>
                            <td>
                                <input id="weight1" name="weight1" type="number" class="form-control w80 inline-block" pattern="[0-9]+([\.,][0-9]+)?" step="0.1" value="1">
                                <label class="inline-block" id="unit1"></label>
                            </td>
                            <td>
                                <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01" id="quantity1" name="quantity1" type="number" min="0" class="form-control" required>
                            </td>
                            <td>
                                <label id="rate1"></label>
                            </td>
                            <td>
                                <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01" id="discount1" name="discount1" type="number" min="0" class="form-control">
                            </td>
                            <td>
                                <label id="amount1"></label>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row pull-right">
                    <input id="add_new_row" class="pull-right add_new_row" type="button" value="Add">
                    <input type="button" class="btn btn-primary calculate_order pull-right" value="Calculate order">
                </div>

                <div class="row">

                    <div class="form-group">
                        <label for="total_amount" class="col-sm-4 control-label"> Total Amount </label>

                        <div class="col-sm-3">
                            <input class="total_amount form-control" name="total_amount" required
                                   value="{{ old('total_amount') ? old('total_amount') : 0 }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_tax" class="col-sm-4 control-label"> Total Tax (18%) </label>

                        <div class="col-sm-3">
                            <input class="total_tax form-control" name="total_tax" required
                                   value="{{ old('total_tax') ? old('total_tax') : 0 }}" disabled>
                        </div>
                        <label for="cgst_tax" class="col-sm-1 control-label"> CGST(9%) </label>
                        <div class="col-sm-1">
                            <input class="cgst_tax form-control" required
                                   value="{{ old('cgst_tax') ? old('cgst_tax') : 0 }}" disabled>
                        </div>
                        <label for="sgst_tax" class="col-sm-1 control-label"> SGST(9%) </label>
                        <div class="col-sm-1">
                            <input class="sgst_tax form-control" required
                                   value="{{ old('sgst_tax') ? old('sgst_tax') : 0 }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_discount" class="col-sm-4 control-label"> Total Discount ( % ) </label>

                        <div class="col-sm-3">
                            <input pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0" id="total_discount"
                                   name="total_discount" class="form-control" type="number"
                                   value="{{ old('total_discount') ? old('total_discount') : 0 }}"
                                   onblur="calculatePayable()">
                            @if ($errors->has('total_discount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('total_discount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="payable_amount" class="col-sm-4 control-label"> Payable Amount </label>

                        <div class="col-sm-3">
                            <input class="payable_amount form-control" name="payable_amount" required
                                   value="{{ old('payable_amount') ? old('payable_amount') : 0 }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="paid_amount" class="col-sm-4 control-label"> Advance Paid Amount </label>

                        <div class="col-sm-3">
                            <input pattern="[0-9]+([\.,][0-9]+)?" step="1" min="1" id="paid_amount" name="paid_amount"
                                   class="form-control" type="number" required
                                   value="{{ old('paid_amount') ? old('paid_amount') : 0 }}"
                                   onblur="calculateRemaining()"></div>
                        @if ($errors->has('paid_amount'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('paid_amount') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="remaining" class="col-sm-4 control-label"> Remaining Amount </label>

                        <div class="col-sm-3">
                            <input class="remaining form-control" name="remaining" required
                                   value="{{ old('remaining') ? old('remaining') : 0 }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row pull-right">
                    <input type="submit" class="btn btn-primary" value="Save order">
                    <input type="button" class="btn btn-default" value="Cancel">
                </div>
            </div>
        </div>
    </form>

@endsection
