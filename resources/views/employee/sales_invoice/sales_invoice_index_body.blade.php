<table id="table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Booking No</th>
            <th>Booking Date</th>
            <th>Patient</th>
            <th>Amount</th>
            <th>Created By</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collections as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->invoice_no }}</td>
                <td><span
                        class="d-none">{{ $data->invoice_date }}</span>{{ date('d-M-Y', strtotime($data->invoice_date)) }}
                </td>
                <td>{{ $data['patient']['name'] }}</td>
                <th class="text-right">{{ $data->total_amount }}</th>
                <td>{{ $data['created_by_user']['name'] }}</td>
                <td><a href="{{ route('employee.money_receipt', Crypt::encryptString($data->id)) }}"
                        target="_blank" class="badge badge-outline-info">
                        <span class="iconify" data-icon="fluent:receipt-money-24-regular"
                            data-width="15" data-height="15"></span> Money receipt</a>

                    <a href="{{ route('employee.sales_invoice.edit', Crypt::encryptString($data->id)) }}"
                        class="badge badge-outline-info"> <span class="iconify"
                            data-icon="codicon:open-preview" data-width="15"
                            data-height="15"></span> View</a>
                    <a href="{{ route('employee.sales_invoice.edit', $data->id) }}"
                        class="badge badge-outline-info d-none"><span class="iconify"
                            data-icon="codicon:open-preview" data-width="15"
                            data-height="15"></span> Edit</a>
                    <a href="{{ route('employee.sales_invoice.delete', $data->id) }}"
                        class="badge badge-outline-info delete"><span class="iconify"
                            data-icon="mdi:delete-sweep-outline" data-width="15"
                            data-height="15"></span> Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
