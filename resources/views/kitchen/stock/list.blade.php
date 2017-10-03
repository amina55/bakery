<div class="table-responsive">
    <table class="table data-tables">
        <thead>
        <tr>
            <th> Name</th>
            <th> Unit </th>
            <th> Quantity </th>
            <th>{{ trans('content.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stocks as $stock)
            <?php $class = (($stock->kitchen_quantity > 2) ? (($stock->kitchen_quantity < 5) ? 'bg-warning' : '') : 'bg-danger') ?>
            <tr class="{{ $class }}">
                <td>{{ $stock->product->name }}</td>
                <td>{{ $stock->multiplier }} {{ ($stock->product->unit) ? $stock->product->unit->name : '' }}</td>
                <td>{{ $stock->kitchen_quantity }}</td>

                <td class="centralized-text">
                    <a  class="no-text-decoration add_stock" title="Add stock" data-toggle="modal" data-target="#editStockModal" data-id="{{ $stock->id }}">
                        <i class="fa fa-lg fa-plus"></i>
                    </a>
                </td>
            </tr>   
        @endforeach
        </tbody>
    </table>
</div>

<div id="editStockModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <form class="form-horizontal" action="{{ route('kitchen_stock.add_quantity') }}" method="post">
        {{ csrf_field() }}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add stock</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="col-md-6 control-label">New Quantity</label>

                        <div class="col-md-6">
                            <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.1" min="0.5" id="kitchen_quantity" class="form-control" name="kitchen_quantity" required>
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
    $('.add_stock').click(function () {

        var id = $(this).data('id');
        $('#edit_id').val(id);
    });
</script>

