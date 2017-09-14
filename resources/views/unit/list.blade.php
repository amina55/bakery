<div class="table-responsive">
    <table class="table table-striped data-tables">
        <thead>
        <tr>
            <th> Name</th>
            <th> Short Key </th>
            <th>{{ trans('content.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($units as $unit)
            <tr>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->short_key }}</td>

                <td class="centralized-text">
                    <a  class="no-text-decoration edit_unit" title="Edit unit" data-toggle="modal" data-target="#editunitModal"
                       data-id="{{ $unit->id }}" data-name="{{ $unit->name }}" data-key="{{ $unit->short_key }}">
                        <i class="fa fa-lg fa-pencil"></i>
                    </a>
                    <a href="{{ route('unit.destroy', [$unit->id]) }}" class="no-text-decoration" title="Delete unit">
                        <i class="fa fa-lg fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div id="editunitModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <form class="form-horizontal" action="{{ route('unit.store') }}" method="post">
        {{ csrf_field() }}

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit unit</h4>
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
                        <label for="edit_short_key" class="col-md-4 control-label">Short Key</label>

                        <div class="col-md-6">
                            <input type="text" id="edit_short_key" class="form-control" name="short_key" required>
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
    $('.edit_unit').click(function () {

        var id = $(this).data('id');
        var name = $(this).data('name');
        var short_key = $(this).data('key');

        $('#edit_name').val(name);
        $('#edit_short_key').val(short_key);
        $('#edit_id').val(id);
    });
</script>

