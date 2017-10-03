<div class="table-responsive">
    <table class="table data-tables">
        <thead>
        <tr>
            <th> Name </th>
            <th> Demand Quantity </th>
            <th> Request Date </th>
            <th> Demand Date </th>
            <th> Status </th>

            <th>{{ trans('content.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($requests as $request)
            <?php /*$class = (($request->demanded_date > 5) ? (($request->quantity < 20) ? 'bg-warning' : '') : 'bg-danger') */?>
            <tr class="">
                <td>
                    <label id="{{ $request->id }}_request">{{ $request->stock->product->name }} ( {{ $request->stock->multiplier }} {{ ($request->stock->product->unit) ? $request->stock->product->unit->name : ''}} )</label>
                </td>
                <td>{{ $request->quantity }}</td>
                <td>{{ date('d-m-Y', strtotime($request->created_at))}}</td>
                <td>{{ date('d-m-Y', strtotime($request->demand_date))}}</td>
                <td>{{ $request->status }}</td>

                <td class="centralized-text">
                    @if($request->status == 'waiting')
                        <a  class="no-text-decoration edit_request" title="Approve Request" data-toggle="modal" data-target="#editRequestModal" data-request="{{ $request->request_to }}"
                            data-id="{{ $request->id }}" data-stock="{{ $request->stock_id }}" data-quantity="{{ $request->quantity }}" data-date="{{ $request->demand_date }}">
                            <i class="fa fa-lg fa-check"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div id="editRequestModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <form class="form-horizontal" action="{{ route('bakery_req.approve') }}" method="post">
        {{ csrf_field() }}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Approve Request</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="request_product" class="col-md-4 control-label">Product</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="request_product" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_quantity" class="col-md-4 control-label">Demand Quantity</label>
                        <div class="col-md-6">
                            <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" id="edit_quantity" class="form-control" disabled>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="approve_quantity" class="col-md-4 control-label">Approved Quantity</label>
                        <div class="col-md-6">
                            <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.1" min="0.1" id="approve_quantity" class="form-control" name="approve_quantity">
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

<script>
    $('.edit_request').click(function () {

        var id = $(this).data('id');
        var quantity = $(this).data('quantity');
        var productName = $('#'+id+'_request').html();

        $('#edit_quantity').val(quantity);
        $('#request_product').val(productName);
        $('#edit_id').val(id);
    });
</script>

