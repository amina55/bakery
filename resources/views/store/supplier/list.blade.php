<div class="table-responsive">
    <table class="table table-striped data-tables">
        <thead>
        <tr>
            <th>{{ trans('content.name') }}</th>
            <th>{{ trans('content.identifier') }}</th>
            <th>{{ trans('content.address') }}</th>
            <th>{{ trans('content.phone_no') }}</th>
            <th>{{ trans('content.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->identifier }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->phone_no }}</td>

                <td class="centralized-text">
                    <a href="{{ route('supplier.edit', [$supplier->id]) }}" class="no-text-decoration" title="{{ trans('content.edit_supplier') }}">
                        <i class="fa fa-lg fa-pencil"></i>
                    </a>
                    <a href="{{ route('supplier.destroy', [$supplier->id]) }}" class="no-text-decoration" title="{{ trans('content.delete_supplier') }}">
                        <i class="fa fa-lg fa-trash"></i>
                        {{ method_field('DELETE') }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

