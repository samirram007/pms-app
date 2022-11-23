@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Create Discount </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('admin.discount_type.index') }}" class="text-active">Discount
                                    List</a></li>
                            <li class="breadcrumb-item active">  Add Discount</li>
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

                            <form action="{{ route('admin.discount_type.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row   border-bottom pb-2 mb-2">

                                        <div class="col-md-12 col-sm-6 text-right">
                                            <button type="submit" class="btn btn-outline-info"><span class="iconify" data-icon="mdi:content-save-all-outline" data-width="15" data-height="15"></span> Save</button>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Name </label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                                    placeholder="Enter  Name">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="discount_by">Discount By </label>
                                                <select name="discount_by" id="discount_by" class="form-control">
                                                    @foreach ($discount_by as $data)
                                                        <option value="{{ $data }}">{{ $data }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="discount_for">Discount for </label>
                                                <select name="discount_for" id="discount_for" class="form-control">
                                                    @foreach ($discount_for as $data)
                                                        <option value="{{ $data }}">{{ $data }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="discount">Value</label>
                                                 <input type="number" class="form-control" id="discount" name="discount" value="{{ old('discount') }}"
                                                    placeholder="Enter  Value">
                                            </div>
                                        </div>
                                        {{-- description --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" name="description"
                                                    placeholder="Enter Description">{{ old('description') }}</textarea>
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
