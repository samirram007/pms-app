@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Edit Referral Doctor </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('employee.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('employee.referral_doctor.index') }}" class="text-active">Referral Doctor List</a></li>
                            <li class="breadcrumb-item active">  Edit Referral Doctor</li>
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

                            <form action="{{ route('employee.referral_doctor.update', $editData->id) }}" method="post">
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
                                                <label for="name">Referral Doctor Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $editData->name }}"
                                                    placeholder="Enter Referral Doctor Name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="qualification">Qualification</label>
                                                <input type="text" class="form-control" id="qualification"
                                                    name="qualification" placeholder="Enter Qualification"  value="{{ $editData->qualification }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    name="email" placeholder="Enter Email" value="{{ $editData->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contact_no">Contact No</label>
                                                <input type="text" class="form-control" id="contact_no"
                                                    name="contact_no" placeholder="Enter Contact No" value="{{ $editData->contact_no }}">
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
