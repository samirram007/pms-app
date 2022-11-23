<table id="table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>SL</th>

            <th>Booking No</th>
            <th>Booking Date</th>
            <th>Booking Amount(₹)</th>
            <th>Discount(₹)</th>
            <th>Net Payble(₹)</th>
            <th>Advance(₹)</th>
            <th>Due(₹)</th>
            <th>Current(₹)</th>
            <th>Return(₹)</th>
            <th>Payback(₹)</th>
            <th>Collection(₹)</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($collection_report as $key=> $data)
            <tr>
                <td>{{ ++$key }}</td>

                <td>{{ $data['invoice_no'] }}</td>
                <td>{{ date('d-M-Y',strtotime($data['invoice_date'])) }}</td>
                <td>{{ number_format($data['item_total'],2,'.','')}}</td>
                <td>{{ number_format($data['discount_amount'],2,'.','')}}</td>
                <td>{{ number_format($data['total_amount'],2,'.','')}}</td>
                <td> {{ number_format($data['sales_invoice_advance_payments'],2,'.','') }}</td>
                <td> {{ number_format($data['sales_invoice_due_payments'],2,'.','') }}</td>
                <td> {{ number_format($data['sales_invoice_payments'],2,'.','') }}</td>
                <td> {{ number_format($data['sales_return'],2,'.','') }}</td>
                <td> {{ number_format($data['sales_payback'],2,'.','') }}</td>
                <td> {{ number_format($data['total_collection'],2,'.','') }}</td>

            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total: </th>
            <th>{{ number_format($total_collection_report['item_total'],2,'.','') }}</th>
            <th>{{ number_format($total_collection_report['discount_amount'],2,'.','') }}</th>
            <th>{{ number_format($total_collection_report['total_amount'],2,'.','') }}</th>
            <th>{{ number_format($total_collection_report['sales_invoice_advance_payments'],2,'.','') }}</th>
            <th>{{ number_format($total_collection_report['sales_invoice_due_payments'],2,'.','') }}</th>
            <th>{{ number_format($total_collection_report['sales_invoice_payments'],2,'.','') }}</th>
            <th>{{ number_format($total_collection_report['sales_return'],2,'.','') }}</th>
            <th>{{ number_format($total_collection_report['sales_payback'],2,'.','') }}</th>
            <th>{{ number_format($total_collection_report['total_collection'],2,'.','') }}</th>

            </tr>
    </tfoot>
</table>
