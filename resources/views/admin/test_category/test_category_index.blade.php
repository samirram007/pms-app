@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="text-dark">Test Category List</h4>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right border-0">
                        <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                class="text-active">Dashboard</a></li>
                        <li class="breadcrumb-item active">Test category list</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="rounded card p-3  bg-light shadow min-vh-100">
            <div class="row   ">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="row   border-bottom pb-2 mb-2">

                                <div class="col-sm-12 text-right">
                                    <a href="javascript:void(0)" data-url="{{ route('admin.test_category.create') }}"
                                        data-param="" class="load-popup float-right btn btn-rounded btn-outline-info ">
                                        <span class="iconify" data-icon="mdi:thermometer-plus" data-width="15"
                                            data-height="15">
                                        </span> add test category</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="searchPanel" class="searchPanel">
                <div id="data-grid" class="data-tab-custom rounded">


                    <div class="table-responsive">

                        <table id="table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Test Group</th>
                                    <th>Has Method</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collections as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->image }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data['test_group']['name'] }}</td>
                                    <td class="text-wrap text-truncate"> {{ $data->has_method==1? 'YES':'NO' }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.test_category.show', $data->id) }}"
                                            class="btn btn-outline-info"> <span class="iconify"
                                                data-icon="mdi:view-dashboard" data-width="15" data-height="15"
                                                data-rotate="180deg"></span> View</a>

                                        <a href="{{ route('admin.test_category.edit', $data->id) }}"
                                            class="btn btn-outline-info"><span class="iconify"
                                                data-icon="mdi:circle-edit-outline" data-width="15"
                                                data-height="15"></span> Edit</a>
                                        <a href="{{ route('admin.test_category.delete', $data->id) }}"
                                            class="btn btn-outline-info delete"><span class="iconify"
                                                data-icon="mdi:delete-sweep-outline" data-width="15"
                                                data-height="15"></span> Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready( function () {
                    $('#table').DataTable();
            } );

</script>
@endsection