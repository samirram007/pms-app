<td>{{ $data['sales_invoice']['invoice_no'] }}</td>
<td><span
        class="d-none">{{ $data['sales_invoice']['invoice_date'] }}</span>{{ date('d-M-Y', strtotime($data['sales_invoice']['invoice_date'])) }}
</td>
<td>{{ $data['patient']['name'] }}</td>
<td>{{ $data['test_package']['name'] }}</td>
<td>{{ $data['test']['name'] }}</td>
<td>{{ $data['test']['test_category']['name'] }}</td>
<td class="text-right " style="overflow: inherit;">
    @php
        if ($data->status == 'pending') {
            $status_color = 'warning';
        } elseif ($data->status == 'inprogress') {
            $status_color = 'info';
        } elseif ($data->status == 'completed') {
            $status_color = 'success';
        } elseif ($data->status == 'cancelled') {
            $status_color = 'danger';
        } elseif ($data->status == 'delivered') {
            $status_color = 'dark';
        }
    @endphp
    <div class="dropdown d-inline-flex">
        <button class="btn btn-outline-link dropdown-toggle" type="button" data-toggle="dropdown"> <span
                class="badge badge-{{ $status_color }}">{{ ucfirst($data->status) }}</span>
            <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" style="z-index: 1000">
            @foreach ($test_status as $status)
                <li><a class="dropdown-item" href="javascript:void(0)"
                        onclick="ChangeStatus('{{ $data->id }}','{{ $status }}');">{{ ucfirst($status) }}</a>
                </li>
                {{-- <li><a href="{{ route('employee.test_queue.update_status', [$data->id, $status]) }}">{{ $status }}</a></li> --}}
            @endforeach
            {{-- <li>
                {{ route('employee.test_queue.update_status', [$data->id, $status]) }}
                    <a href="{{ route('admin.office.users', $data->officeId) }}" data-param=""
                        data-url="{{ route('admin.office.users', $data->officeId) }}"
                        title="Edit" class="btn btn-link  px-2  "> USERS </a>

                </li> --}}

        </ul>
    </div>
</td>



<td>
    {{-- @dd($data['report_file1']) --}}
    @if ($data['report_file1'] && $data->status == 'completed')
        <a class="badge badge-info" href="{{ asset('uploads/test_queue/' . $data['report_file1']) }}"
            target="_blank">Download</a>
    @else
        @if ($data->code != null || $data->code != '')
            <a target="_blank" class="badge badge-info"
                href="{{ route('employee.test_queue.getpdf', $data->id) }}">Download</a>
        @else
            @if ($data->status == 'inprogress')
                <form id="pdf_upload{{ $data->id }}">
                    <input type="file" class="" name="pdf_file" accept="application/pdf">
                    <input type="text" class="sr-only" name="test_queue_id" value="{{ $data->id }}">
                    <span class="badge badge-danger" onclick="upload_report_pdf({{ $data->id }});">Upload</span>
                </form>
            @else
                <span class="badge badge-danger">Pending</span>
            @endif
        @endif
    @endif


</td>
<td>

    @if ($data->report_date == null && $data->status == 'inprogress')
        <a href="{{ route('employee.test_queue.edit', $data->id) }}" class="badge badge-primary">Report</a>
    @endif
    <a href="{{ route('employee.money_receipt', Crypt::encryptString($data['sales_invoice']['id'])) }}" target="_blank"
        class="badge badge-info">Money Receipt</a>


</td>
