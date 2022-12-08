<table id="table" class="table table-striped table-bordered">
    <thead>
        <tr>
            {{-- <th>ID</th> --}}
            <th>Booking No</th>
            <th>Booking Date</th>
            <th>Patient</th>
            <th>Amount</th>
            {{-- <th>Created By</th> --}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collections as $key => $data)
            <tr>
                {{-- <td>{{ $key + 1 }}</td> --}}
                <td>{{ $data->invoice_no }}</td>
                <td><span
                        class="d-none">{{ $data->invoice_date }}</span>{{ date('d-M-Y', strtotime($data->invoice_date)) }}
                </td>
                <td>{{ $data['patient']['name'] }}</td>
                <th class="text-right">{{ $data->total_amount }}</th>
                {{-- <td>{{ $data['created_by_user']['name'] }}</td> --}}
                <td class="text-right">
                    <div class="dropdown">
                        <button class="btn btn-outline-link dropdown-toggle" type="button"
                            data-toggle="dropdown">SELECT
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li> <a href="{{ route('patient.money_receipt', Crypt::encryptString($data->id)) }}"
                                target="_blank" class="btn btn-link"> Money receipt</a></li>

                                    <li>
                                        <a href="javascript:" data-param="{{$data->id}}"
                                            data-url="{{ route('patient.test_report') }}"
                                            data-size="md" title="Test Report"
                                            class="load-popup  btn  btn-link    "> {{ __('Test Report') }}</a>
                                    </li>
                        </ul>
                    </div>




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
