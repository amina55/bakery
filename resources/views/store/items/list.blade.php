<div class="table-responsive">
    <table class="table table-striped data-tables">
        <thead>
        <tr>
            <th>{{ trans('content.raw_item') }}</th>
            <th>{{ trans('content.description') }}</th>
            <th>{{ trans('content.stock') }}</th>
            <th>{{ trans('content.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->stock }}</td>

                <td class="centralized-text">
                    <a href="{{ route('item.edit', [$item->id]) }}" class="no-text-decoration" title="{{ trans('content.edit_item') }}">
                        <i class="fa fa-lg fa-pencil"></i>
                    </a>
                    <a href="{{ route('item.destroy', [$item->id]) }}" class="no-text-decoration" title="{{ trans('content.delete_item') }}">
                        <i class="fa fa-lg fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

