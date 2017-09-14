<div class="table-responsive">
    <table class="table table-striped data-tables">
        <thead>
        <tr>
            <th> Name</th>
            <th> Quantity </th>
            <th> Price </th>
            <th> Unit </th>
            <th>{{ trans('content.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->product->name }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>{{ $stock->price }}</td>
                <td>{{ $stock->multiplier }} {{ ($stock->product->unit) ? $stock->product->unit->name : '' }}</td>

                <td class="centralized-text">
                    <a  class="no-text-decoration edit_stock" title="Edit stock" data-toggle="modal" data-target="#editStockModal"
                       data-id="{{ $stock->id }}" data-price="{{ $stock->price }}">
                        <i class="fa fa-lg fa-pencil"></i>
                    </a>
                    <a href="{{ route('bakery_stock.destroy', [$stock->id]) }}" class="no-text-decoration" title="Delete stock">
                        <i class="fa fa-lg fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div id="editStockModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <form class="form-horizontal" action="{{ route('bakery_stock.store') }}" method="post">
        {{ csrf_field() }}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit stock</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="col-md-6 control-label">You can change only Price</label>

                        <div class="col-md-6">
                            <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0.01" id="edit_price" class="form-control" name="price" required>
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
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

<script>
    $('.edit_stock').click(function () {

        var id = $(this).data('id');
        var price = $(this).data('price');

        $('#edit_price').val(price);
        $('#edit_id').val(id);
    });
</script>

