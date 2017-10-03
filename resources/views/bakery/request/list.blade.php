<div class="table-responsive">
    <table class="table data-tables">
        <thead>
        <tr>
            <th> Name </th>
            <th> Quantity </th>
            <th> Demand Date </th>
            <th> Status </th>

            <th>{{ trans('content.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($requests as $request)
            <?php /*$class = (($request->demanded_date > 5) ? (($request->quantity < 20) ? 'bg-warning' : '') : 'bg-danger') */?>
            <tr class="">
                <td>{{ $request->stock->product->name }} ( {{ $request->stock->multiplier }})</td>
                <td>{{ $request->quantity }}</td>
                <td>{{ date('d-m-Y', strtotime($request->demand_date))}}</td>
                <td>{{ $request->status }}</td>

                <td class="centralized-text">
                    @if($request->status == 'waiting')
                        <a  class="no-text-decoration edit_request" title="Edit Request" data-toggle="modal" data-target="#editRequestModal" data-request="{{ $request->request_to }}"
                            data-id="{{ $request->id }}" data-stock="{{ $request->stock_id }}" data-quantity="{{ $request->quantity }}" data-date="{{ $request->demand_date }}">
                            <i class="fa fa-lg fa-pencil"></i>
                        </a>
                    @endif
                    <a href="{{ route('bakery_request.destroy', [$request->id]) }}" class="no-text-decoration" title="Delete Request">
                        <i class="fa fa-lg fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div id="editRequestModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <form class="form-horizontal" action="{{ route('bakery_request.store') }}" method="post">
        {{ csrf_field() }}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Request</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group{{ $errors->has('stock_id') ? ' has-error' : '' }}">
                        <label for="stock_id" class="col-md-4 control-label">Product</label>

                        <div class="col-md-6">
                            <select id="edit_stock_id" name="stock_id" class="form-control" required>
                                <option value=""> --- select a product --- </option>
                                @foreach($stocks as $stock)
                                    <option value="{{ $stock->id }}"> {{ $stock ->product->name }} ( {{ $stock->multiplier }} {{ ($stock->product->unit) ? $stock->product->unit->name : '' }} )</option>
                                @endforeach
                            </select>
                            @if ($errors->has('stock_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('stock_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                        <label for="quantity" class="col-md-4 control-label">Quantity</label>

                        <div class="col-md-6">
                            <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" id="edit_quantity" class="form-control" name="quantity" value="{{ old('quantity') ? old('quantity') : ''}}" required>
                            @if ($errors->has('quantity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('demand_date') ? ' has-error' : '' }}">
                        <label for="demand_date" class="col-md-4 control-label">Demand Date</label>

                        <div class="col-md-6">
                            <input type="text" id="edit_demand_date" placeholder="Demand Date" class="date-from-now form-control" name="demand_date" value="{{ old('demand_date') ? old('demand_date') : ''}}" required>
                            @if ($errors->has('demand_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('demand_date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('request_to') ? ' has-error' : '' }}">
                    <label for="request_to" class="col-md-4 control-label">Request To</label>

                    <div class="col-md-6">
                        <select id="edit_request_to" name="request_to" class="form-control" required>
                            <option value="kitchen"> Kitchen </option>
                            <option value="store"> Store </option>
                        </select>
                        @if ($errors->has('request_to'))
                            <span class="help-block">
                                <strong>{{ $errors->first('request_to') }}</strong>
                            </span>
                        @endif
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

<script>
    $('.edit_request').click(function () {

        var id = $(this).data('id');
        var quantity = $(this).data('quantity');
        var stockId = $(this).data('stock');
        var demandDate = $(this).data('date');
        var request = $(this).data('request');

        $('#edit_quantity').val(quantity);
        $('#edit_stock_id').val(stockId);
        $('#edit_demand_date').val(demandDate);
        $('#edit_request_to').val(request);
        $('#edit_id').val(id);
    });
</script>

