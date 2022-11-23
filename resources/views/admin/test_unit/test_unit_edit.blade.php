@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Edit Test Unit </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('admin.test_unit.index') }}" class="text-active">Test Unit List</a></li>
                            <li class="breadcrumb-item active">  Edit Test Unit</li>
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

                            <form action="{{ route('admin.test_unit.update', $editData->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row   border-bottom pb-2 mb-2">

                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn btn-outline-info"><span class="iconify" data-icon="mdi:content-save-all-outline" data-width="15" data-height="15"></span> Save</button>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Test Unit Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $editData->name }}"  placeholder="Enter Test Unit Name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group  ">

                                                <label for="code">Code</label>
                                                <input type="text" class="form-control" id="code" name="code"
                                                    value="{{ $editData->code }}"  placeholder="Enter Code">
                                                </div>
                                        </div>


                                    </div>
                            </form>

                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection
