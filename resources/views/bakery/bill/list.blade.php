<div class="table-responsive">
    <table class="table table-striped data-tables">
        <thead>
        <tr>
            <th> Bill No. </th>
            <th> Total Amount </th>
            <th> Total Tax </th>
            <th> Payable Amount </th>
            <th> Date </th>
            <th> {{ trans('content.actions') }} </th>
        </tr>
        </thead>
        <tbody>
        @foreach($bills as $bill)
            <tr>
                <td>{{ $bill->bill_no }}</td>
                <td>{{ $bill->total_amount }}</td>
                <td>{{ $bill->total_tax }}</td>
                <td>{{ $bill->payable_amount }}</td>
                <td>{{ date('d-m-Y', strtotime($bill->created_at)) }}</td>

                <td class="centralized-text">
                    <a {{--href="{{ route('bill.edit', [$bill->id]) }}"--}} class="no-text-decoration" title="{{ trans('content.edit_item') }}">
                        <i class="fa fa-lg fa-pencil"></i>
                    </a>
                   {{-- <a href="{{ route('bill.destroy', [$bill->id]) }}" class="no-text-decoration" title="{{ trans('content.delete_item') }}">
                        <i class="fa fa-lg fa-trash"></i>
                    </a>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

