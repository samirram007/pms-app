@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        @include('employee.partial._header')
        <section class="content">
            <div class="rounded card p-3  bg-light shadow min-vh-100">
                <div class="row   ">
                    <div class="col-md-12">
                        <div class="card card-primary pb-0">
                            <div class="card-body pb-0">
                                <div class="row   pb-2 mb-2">
                                    <div class="col-sm-12 text-right">
                                        <a href="{{ route('employee.sales_order.create') }}" class="load-popup float-right btn btn-rounded btn-outline-info ">Upcoming Test</a>
                                        <a href="{{ route('employee.test_queue.fetch') }}" class="load-popup float-right btn btn-rounded btn-outline-info ">Fetch Test</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row   ">
                    {{-- show Error message --}}

                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row    ">
                                    <div class="col-sm-3">
                                        <label for="lab_centre">
                                            Lab Centre :
                                        </label>
                                        <select class="form-control" name="lab_centre_id" id="lab_centre_id">
                                            @foreach ($lab_centres as $lab_centre)
                                                <option value="{{ $lab_centre->id }}">{{ $lab_centre->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-sm-3 ">
                                        <label for="from_date">
                                            From Date :
                                        </label>
                                        <input class="form-control" type="date" id="from_date" name="from_date"
                                            value="{{ date('Y-m-d',strtotime('- 7 days')) }}">
                                    </div>

                                    <div class="col-sm-3 ">
                                        <label for="to_date">
                                            To Date :
                                        </label>
                                        <input class="form-control" type="date" id="to_date" name="to_date"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-sm-2 ">
                                        <label for="test_status">
                                            Status
                                        </label>
                                       <select name="test_status" id="test_status" class="form-control">
                                        @foreach ($test_status as $status)
                                            <option value="{{ $status }}">{{ $status}}</option>

                                        @endforeach
                                       </select>

                                    </div>
                                    <div class="col-sm-1 text-left">
                                    <a id="search" href="javascript:void(0)"
                                            class="search btn btn-rounded btn-primary my-4 px-4 ">
                                            <span class="iconify" data-icon="et:search" style="color: rgb(247, 247, 247);"
                                                data-width="25" data-height="25"></span></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="searchPanel" class="searchPanel">
                    <div id="data-grid" class="data-tab-custom rounded">


                        <div id="response_body"  class="table-responsive">

                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {

            $("#search").on('click', function() {
                var lab_centre_id = $("#lab_centre_id").val();
                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();
                var test_status=$("test_status").val();

                if (lab_centre_id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('employee.test_queue.search') }}",
                        data: {
                            lab_centre_id: lab_centre_id,
                            from_date: from_date,
                            to_date: to_date,
                            test_status:test_status
                        },
                        success: function(data) {
                            // console.log(data);
                            $('#response_body').html(data.body);
                        }
                    });
                } else {
                    $('#response_body').html('');
                }
            });
            $('#search').trigger('click');
        });
    </script>
@endsection
