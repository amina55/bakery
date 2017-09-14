<div class="table-responsive">
    <table class="table table-striped data-tables">
        <thead>
        <tr>
            <th> Name</th>
            <th> Price </th>
            <th> Unit </th>

            <th>{{ trans('content.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ ($product->unit) ? $product->unit->name : '' }}</td>

                <td class="centralized-text">
                    <a  class="no-text-decoration edit_product" title="Edit product" data-toggle="modal" data-target="#editProductModal"
                       data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}" data-unit="{{ $product->unit_id }}">
                        <i class="fa fa-lg fa-pencil"></i>
                    </a>
                    <a href="{{ route('product.destroy', [$product->id]) }}" class="no-text-decoration" title="Delete product">
                        <i class="fa fa-lg fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div id="editProductModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <form class="form-horizontal" action="{{ route('product.store') }}" method="post">
        {{ csrf_field() }}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Product</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="category_id" value="{{ $category->id }}">

                        <label for="edit_name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="edit_name" class="form-control" name="name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_price" class="col-md-4 control-label">Price</label>

                        <div class="col-md-6">
                            <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="0" id="edit_price" class="form-control" name="price" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('unit_id') ? ' has-error' : '' }}" >
                        <label for="unit_id" class="col-md-4 control-label">unit</label>

                        <div class="col-md-6">
                            <select id="unit_id" name="unit_id" class="form-control" required>
                                <option  value="">--- select a unit ---</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('unit_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('unit_id') }}</strong>
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
    $('.edit_product').click(function () {

        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        var unit = $(this).data('unit');

        $('#edit_name').val(name);
        $('#edit_price').val(price);
        $('#edit_id').val(id);
        $('select[name^="unit_id"] option[value="'+unit+'"]').attr("selected","selected");


    });
</script>

