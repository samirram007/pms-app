@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Create Booking </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('employee.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('employee.sales_order.index') }}"
                                    class="text-active">Booking
                                    List</a></li>
                            <li class="breadcrumb-item active"> New Booking</li>
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


                                <div class="card-body">

                                    <div class="row   border-bottom pb-2 mb-2">
                                        <div class="col-md-6">
                                            <form id="search_form">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <select class="form-select px-2" name="search_type" id="search_type">
                                                        <option value="test">Test</option>
                                                        <option value="package">Package</option>
                                                    </select>
                                                    <input type="text" class="form-control" name="search_text" id="search_text"
                                                        aria-label="Text input with segmented dropdown button"
                                                        placeholder="Search">
                                                    {{-- <button type="submit" class="btn btn-outline-secondary rounded-0 px-1" type="button"
                                                        id="button-addon2"><span class="iconify" data-icon="carbon:search"
                                                            data-width="15" data-height="15"></span></button> --}}
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button  class="btn btn-link rounded-0 p-0 position-relative">
                                                <div id="item_count" class="position-absolute bg-danger text-light rounded-circle shadow-md font-weight-bold"
                                                    style="padding:7px 9px; right: 0.6rem;
                                                    top: -0.6rem;">{{ $item_count }}</div>
                                                <span class="iconify" data-icon="cil:list" data-width="25"
                                                    data-height="25"></span>
                                            </button>

                                        </div>
                                    </div>


                                    <div class="row">
                                       <div id="search_result" class="w-100">

                                       </div>
                                    </div>





                        </div>
                    </div>
                </div>
        </section>
        <script>
            $(document).ready(function () {
                search();
                $('#search_text').on('keyup', function () {
                   search();
                });
                $('#search_type').on('change', function () {
                    search();
                });
            });
            function search(){
                var search_type = $('#search_type').val();
                    var search_text = $('#search_text').val();
                    var url = "{{ route('employee.test_search.index') }}";
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: {
                            search_type: search_type,
                            search_text: search_text
                        },
                        success: function (data) {
                            $('#search_result').html(data.view);
                        }
                    });
            }
        </script>
    </div>
@endsection

