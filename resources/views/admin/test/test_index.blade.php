@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <h2 class="text-dark h4 m-0">Test List</h2>
                    <ol class="breadcrumb border-0 small">
                        <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                class="text-active">Dashboard</a></li>
                        <li class="breadcrumb-item active">Test List</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-2 d-flex justify-content-end align-items-start">
                    <a href="javascript:void(0)" data-param="" data-url="{{ route('admin.test.create') }}"
                        title="{{__('ADD TEST')}}" class=" position-absolute load-popup  btn btn-rounded btn-primary "
                        style="width:8rem;">ADD TEST
                    </a>




                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="rounded card p-3  bg-light shadow min-vh-100">
            <div class="header-marge-panel ">

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
                                            <li><a href="javascript:void(0)"
                                                    data-url="{{route('admin.test.edit',$data->id)}}"
                                                    class="load-popup  btn btn-link"> EDIT</a></li>
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