@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Create Lab Centre </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('admin.lab_centre.index') }}" class="text-active">Lab Centre
                                    List</a></li>
                            <li class="breadcrumb-item active">  Add Lab Centre</li>
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

                            <form action="{{ route('admin.lab_centre.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row   border-bottom pb-2 mb-2">
                                        <div class="col-md-3 col-sm-6">

                                            <div class="form-group">
                                                {{-- <h5>Profile Image <span class="text-danger"></span></h5> --}}
                                                <div class="">
                                                    <input type="file" name="image" id="image"
                                                        class="form-control d-none">
                                                </div>
                                                <div class="controls ">
                                                    <img id="showImage" class=" rounded-circle"
                                                        style="cursor:pointer;width: 75px; height:75px; border:1px solid #000000;"
                                                        src="{{  url('upload/no_image.jpg') }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-6 text-right">
                                            <button type="submit" class="btn btn-outline-info"><span class="iconify" data-icon="mdi:content-save-all-outline" data-width="15" data-height="15"></span> Save</button>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Lab Centre Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                                    placeholder="Enter Lab Centre Name">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Lab Centre Code</label>
                                                <input type="text" class="form-control" id="code" name="code" value="{{old('code')}}"
                                                    placeholder="Enter Test Code">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="date_of_foundation">Date of Foundation</label>
                                                <input type="date" class="form-control" id="date_of_foundation" name="date_of_foundation"
                                                    value="{{ date('Y-m-d', strtotime('-20 years')) }}"
                                                    placeholder="Enter Date of birth">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="license_no">License No</label>
                                                <input type="text" class="form-control" id="license_no" name="license_no" value="{{old('license_no')}}"
                                                    placeholder="Enter License No">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"
                                                    placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contact_no">Mobile no</label>
                                                <input type="text" size="10"  class="form-control" id="contact_no" name="contact_no" value="{{old('contact_no')}}"
                                                    placeholder="Enter Mobile no">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" id="address" name="address" placeholder="Enter Address">{{old('address')}}</textarea>
                                            </div>
                                        </div>

                                    </div>





                            </form>

                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#showImage').click(function() {
                $('#image').click();
            });
            $('#showAadhaarImage').click(function() {
                $('#aadhaar_image').click();
            });
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
        });
    </script>

@endsection
