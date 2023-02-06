@extends('layouts.main')
@section('content')
    {{--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href={{ asset('css/report.css') }} rel="stylesheet" />
    <style>
        #editor {
            position: relative;
            width: calc(100% - 30px);
            height: 80vh;
        }

        .pe-auto {
            cursor: pointer;
            padding-bottom: 1rem;

        }

        .ace_editor div,
        .ace_editor span {
            font-size: 16px !important;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark">Test-Examination Report Configuration Table</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item active">Test-Examination Report Configuration</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3  bg-light shadow min-vh-100">

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.test_report.store_examination') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input value="{{ $test->id }}" class="sr-only" name="test_id" />

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col">
                                    <div class="form-group">
                                        <label for="">Doctors Name</label>
                                        <select class="form-select" name="doctor_id" aria-label="Default select example">
                                            <option selected>Select Doctor</option>
                                            @foreach ($doctors as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col">
                                    <div class="form-group">
                                        <label for="">Upload File</label>
                                        <input type="file" name="file" id="" class="form-control"
                                            style="border: 1px solid black; border-radius: 4px">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn bg-dark">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
                {{-- tab container --}}
                <div class="card">

                    <div class="card-body">
                        <table id="table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Test Id</th>
                                    <th>Doctor Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collections as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->test['name'] }}</td>
                                        <td>{{ $data->doctor['name'] }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                  Select
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a class="dropdown-item" href="#">Action</a></li>
                                                  <li><a class="dropdown-item" href="#">Another action</a></li>
                                                  <li><a class="dropdown-item" href="#">Something else here</a></li>
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
@endsection
