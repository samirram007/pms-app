<table id="table" class="table table-striped table-bordered">
    <thead>
        <tr>
            {{-- <th>SL</th> --}}
            <th>Image</th>
            <th>Name</th>
            <th>Code</th>
            <th>Doctor</th>
            <th>Lab</th>
            <th>Email</th>
            <th>ContactNo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody >
        @foreach ($collections as $key=> $data)
        <tr>
            {{-- <td>{{ $key+1 }}</td> --}}
                <td><img
                    style="width: 50px; height:50px; border:1px solid #000000;"
                    src="{{ !empty($data->image) ? url('upload/user_images/' . $data->image) : url('upload/no_image.jpg') }}"
                    alt=""></td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->code }}</td>
                <td>{{ $data->doctor_name }}</td>
                <td>{{ $data['lab_centre']['name'] }}</td>
                <td>{{ $data->email }}</td>
                <td class="text-wrap text-truncate">{{ $data->contact_no }}</td>
                <td class="text-right">
                    <div class="dropdown">
                        <button class="dropdown-toggle   " type="button"
                            data-toggle="dropdown">Choose
                            <span class="caret  "></span></button>
                        <ul class="dropdown-menu dropdown-right">
                            {{-- <li> <a href="{{ route('admin.test.show', $data->id) }}"
                                    class="btn btn-link"> VIEW</a></li> --}}
                            <li><a href="{{ route('employee.patient.select', $data->id) }}"
                                    class="btn btn-link"> SELECT</a></li>
                            <li><a href="{{ route('employee.patient.edit', $data->id) }}"
                                    class="btn btn-link"> EDIT</a></li>
                            <li><a href="{{ route('employee.patient.delete', $data->id) }}"
                                    class="btn btn-link delete"> DELETE</a></li>
                            {{-- <li><a href="{{ route('admin.test_report.config', $data->id) }}"
                                    class="btn btn-link "> REPORT SETTINGS</a></li> --}}
                        </ul>
                    </div>




                </td>
                {{-- <td>
                    <a href="{{ route('employee.patient.select', $data->id) }}"
                        class="btn btn-outline-info">
                          Select</a>

                    <a href="{{ route('employee.patient.edit', $data->id) }}"
                        class="btn btn-outline-info"><span class="iconify" data-icon="mdi:circle-edit-outline" data-width="15" data-height="15"></span> Edit</a>
                    <a href="{{ route('employee.patient.delete', $data->id) }}"
                        class="btn btn-outline-info delete"> Delete</a>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
<script>
        $(document).ready( function () {
                    $('#table').DataTable({
                        responsive: true,
                        searching: false,
                        paging: false,
                        info: false,
                        select: true,
                    });

            } );
</script>
