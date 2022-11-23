@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark">Test List</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item active">Test List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3  bg-light shadow min-vh-100">
                <div class="header-marge-panel ">
                    <a href="{{ route('admin.test.create') }}" class="load-popup  btn btn-rounded btn-primary py-1">
                        <span class="iconify" data-icon="mdi:thermometer-plus" data-width="15" data-height="15">
                        </span> ADD TEST</a>

                </div>

                <div id="searchPanel" class="searchPanel">
                    <div id="data-grid" class="data-tab-custom rounded">

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
                                        <td class="text-right">
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
                                                    <li><a href="{{ route('admin.test_report.config', $data->id) }}"
                                                            class="btn btn-link "> REPORT SETTINGS</a></li>
                                                </ul>
                                            </div>




                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </section>
    </div>
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
@endsection
