<div class="table-responsive">
    <table class="table table-striped data-tables">
        <thead>
        <tr>
            <th> Invoice ID </th>
            <th> Payable Amount </th>
            <th> Paid Amount </th>
            <th> Remaining Amount </th>
            <th> Supplier </th>
            <th> Date </th>
            <th> {{ trans('content.actions') }} </th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->payable_amount }}</td>
                <td>{{ $invoice->paid_amount }}</td>
                <td>{{ $invoice->remaining }}</td>
                <td>{{ $invoice->supplier->name }}</td>
                <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>


                <td class="centralized-text">
                    <a {{--href="{{ route('invoice.edit', [$invoice->id]) }}"--}} class="no-text-decoration" title="{{ trans('content.edit_item') }}">
                        <i class="fa fa-lg fa-pencil"></i>
                    </a>
                   {{-- <a href="{{ route('invoice.destroy', [$invoice->id]) }}" class="no-text-decoration" title="{{ trans('content.delete_item') }}">
                        <i class="fa fa-lg fa-trash"></i>
                    </a>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

