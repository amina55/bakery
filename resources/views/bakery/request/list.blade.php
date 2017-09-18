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
                <td>{{ date('d-m-Y', strtotime($request->demanded_date))}}</td>
                <td>{{ $request->status }}</td>

                <td class="centralized-text">
                    <a  class="no-text-decoration edit_request" title="Edit Request" data-toggle="modal" data-target="#editRequestModal"
                       data-id="{{ $request->id }}" data-stock="{{ $request->stock_id }}" data-quantity="{{ $request->quantity }}" data-date="{{ $request->demand_date }}">
                        <i class="fa fa-lg fa-pencil"></i>
                    </a>
                    <a href="{{ route('bakery_request.destroy', [$request->id]) }}" class="no-text-decoration" title="Delete Request">
                        <i class="fa fa-lg fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

