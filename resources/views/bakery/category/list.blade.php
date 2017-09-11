<div class="table-responsive">
    <table class="table table-striped data-tables">
        <thead>
        <tr>
            <th> Name</th>
            <th> Description </th>
            <th>{{ trans('content.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>

                <td class="centralized-text">
                    <a  class="no-text-decoration edit_category" title="Edit Category" data-toggle="modal" data-target="#editCategoryModal"
                       data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-description="{{ $category->description }}">
                        <i class="fa fa-lg fa-pencil"></i>
                    </a>
                    <a href="{{ route('category.destroy', [$category->id]) }}" class="no-text-decoration" title="Delete Category">
                        <i class="fa fa-lg fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div id="editCategoryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <form class="form-horizontal" action="{{ route('category.store') }}" method="post">
        {{ csrf_field() }}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="edit_id">
                        <label for="edit_name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="edit_name" class="form-control" name="name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_description" class="col-md-4 control-label">Description</label>

                        <div class="col-md-6">
                            <textarea rows="3" id="edit_description" class="form-control" name="description" required></textarea>
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
    $('.edit_category').click(function () {

        var id = $(this).data('id');
        var name = $(this).data('name');
        var description = $(this).data('description');

        $('#edit_name').val(name);
        $('#edit_description').val(description);
        $('#edit_id').val(id);
    });
</script>

