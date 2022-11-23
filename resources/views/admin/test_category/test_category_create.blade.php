@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Create Test Category </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('admin.test_category.index') }}"
                                    class="text-active">Test Category List</a></li>
                            <li class="breadcrumb-item active"> Add Test Category</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3 bg-white shadow min-vh-100">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="{{ route('admin.test_category.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row   border-bottom pb-2 mb-2">

                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn btn-outline-info"><span class="iconify"
                                                    data-icon="mdi:content-save-all-outline" data-width="15"
                                                    data-height="15"></span> Save</button>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Test Category Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Test Category Name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group  ">

                                                <label for="department_id">Test Group</label>

                                                <select class="form-control testgroup_select" name="test_group_id"
                                                    id="test_group_id">

                                                    <option value="" class="text-bold">Select Test Group</option>

                                                    @forelse ($test_group as $tg)
                                                        <option value="{{ $tg['id'] }}">
                                                            {{ $tg['name'] }}
                                                        </option>

                                                    @empty
                                                        <option value="">No record found
                                                        </option>
                                                    @endforelse



                                                </select>


                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group  ">

                                                <label for="has_method">Has Method</label>
                                                <select class="form-control" name="has_method" id="has_method">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes</option>
                                                </select>


                                            </div>
                                        </div>
                                    </div>
                            </form>

                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {
            $('.testgroup_select').select2();
        });
    </script>
@endsection
