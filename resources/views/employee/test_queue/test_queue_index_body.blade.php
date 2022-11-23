
<table id="table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Booking No</th>
            <th>Booking Date</th>
            <th>Patient</th>
            <th>Package</th>
            <th>Test</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($collections as $key => $data)

            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data['sales_invoice']['invoice_no'] }}</td>
                <td><span
                        class="d-none">{{ $data['sales_invoice']['invoice_date'] }}</span>{{ date('d-M-Y', strtotime( $data['sales_invoice']['invoice_date'] )) }}
                </td>
                <td>{{ $data['patient']['name'] }}</td>
                <td>{{ $data['test_package']['name'] }}</td>
                <td>{{ $data['test']['name'] }}</td>
                <td>{{ $data['test']['test_category']['name'] }}</td>
                <td>
                    @if($data->report_date == null)
                        <a href="{{ route('employee.test_queue.edit', $data->id) }}" class="btn btn-primary btn-sm">Report</a>
                    @endif
                    <a href="{{ route('employee.money_receipt', Crypt::encryptString($data['sales_invoice']['id'])) }}"
                        target="_blank" class="badge badge-outline-info">
                        <span class="iconify" data-icon="fluent:receipt-money-24-regular"
                            data-width="15" data-height="15"></span></a>

                  {{--   <a href="{{ route('employee.sales_invoice.edit', Crypt::encryptString($data->id)) }}"
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
                            data-height="15"></span> Delete</a> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#table').DataTable({
        });
    });
</script>
