<table id="table" class="table table-striped table-bordered">
    <thead>
        <tr>
            {{-- <th>ID</th> --}}
            {{-- <th>Image</th> --}}
            <th>Name</th>
            <th>Department</th>

            <th>Price</th>
            <th>Description</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($collections as $data)
            <tr>
                {{-- <td>{{ $data->id }}</td> --}}
                {{-- <td>{{ $data->image }}</td> --}}
                <td>{{ $data->name }}</td>
                <td>{{ $data['test_group']['name'] }}</td>
                <td>{{ $data->amount }}</td>
                <td class="text-wrap text-truncate">{{ $data->description }}</td>
                <td class="text-right p-0">
                    <div class="dropdown">
                        <button class="btn btn-outline-link dropdown-toggle" type="button"
                            data-toggle="dropdown">SELECT
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li> <a href="{{ route('admin.test.show', $data->id) }}"
                                    class="btn btn-link"> VIEW</a></li>
                            <li><a href="{{ route('admin.test.edit', $data->id) }}"
                                    class="btn btn-link"> EDIT</a></li>
                            <li><a href="{{ route('admin.test.delete', $data->id) }}"
                                    class="btn btn-link delete"> DELETE</a></li>
                            <li>
                                @if(in_array($data['test_group']['id'],[2,3]))
                                <a href="{{ route('admin.test_report.config_examination', $data->id) }}"
                                    class="btn btn-link "> REPORT SETTINGS</a>

                                @elseif(in_array($data['test_group']['id'],[1]))
                                <a href="{{ route('admin.test_report.config', $data->id) }}"
                                    class="btn btn-link "> REPORT SETTINGS</a>
                                @endif

                                </li>
                        </ul>
                    </div>




                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            responsive: true,
            lengthChange: false,
            select: true,
            searching: [
                "Name",
                "Price",
                "Description"
            ] ,
            aling: "center",
             highlight: true,
        });
    });
</script>
