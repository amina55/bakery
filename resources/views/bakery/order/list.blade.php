<div class="table-responsive">
    <table class="table table-striped data-tables">
        <thead>
        <tr>
            <th> Order No. </th>
            <th> Total Amount </th>
            <th> Paid Amount </th>
            <th> Date </th>
            <th> {{ trans('content.actions') }} </th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->order_no }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>{{ $order->paid_amount }}</td>
                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>

                <td class="centralized-text">
                    <a href="{{ route('order.show', [$order->id]) }}" target="_blank" class="no-text-decoration" title="{{ trans('content.edit_item') }}">
                        <i class="fa fa-lg fa-print"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

