@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        @include('patient.partial._header')
        <section class="content">
            <div class="rounded card p-3  bg-light shadow min-vh-100">
                <div class="row d-none   ">
                    <div class="col-md-12">
                        <div class="card card-primary pb-0">
                            <div class="card-body pb-0">
                                <div class="row   border-bottom pb-2 mb-2">

                                    <div class="col-sm-12 text-right">
                                        <a href="{{ route('patient.sales_order.create') }}"
                                            class="load-popup float-right btn btn-rounded btn-outline-info ">
                                             New Booking</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row   ">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body py-0">
                                <div class="row    ">
                                    {{-- <div class="col-sm-3">
                                        <label for="lab_centre">
                                            Lab Centre :
                                        </label>
                                        <select class="form-control" name="lab_centre_id" id="lab_centre_id">
                                            @foreach ($lab_centres as $lab_centre)
                                                <option value="{{ $lab_centre->id }}">{{ $lab_centre->name }}</option>
                                            @endforeach

                                        </select>
                                    </div> --}}
                                    <div class="col-sm-3 ">
                                        <label for="from_date">
                                            From Date :
                                        </label>
                                        <input class="form-control" type="date" id="from_date" name="from_date"
                                            value="{{ date('Y-m-d' ,strtotime('- 30 days')) }}">
                                    </div>

                                    <div class="col-sm-3 ">
                                        <label for="to_date">
                                            To Date :
                                        </label>
                                        <input class="form-control" type="date" id="to_date" name="to_date"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-sm-3 text-left">

                                        <div class="p-2">
                                            <a id="search" href="javascript:void(0)"
                                            class="search btn btn-rounded btn-primary my-4 px-4">
                                            <span class="iconify" data-icon="et:search" style="color: rgb(255, 255, 255);"
                                                data-width="25" data-height="25"></span></a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="searchPanel" class="searchPanel">
                    <div id="data-grid" class="data-tab-custom rounded">


                        <div id="response_body" class="table-responsive">

                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {

            $("#search").on('click', function() {
                // var lab_centre_id = $("#lab_centre_id").val();
                var from_date = $("#from_date").val();
                var to_date = $("#to_date").val();

//alert(from_date);
                    $.ajax({
                        type: "GET",
                        url: "{{ route('patient.sales.invoice.search') }}",
                        data: {

                            from_date: from_date,
                            to_date: to_date
                        },
                        success: function(data) {
                            // console.log(data);
                            $('#response_body').html(data.body);
                        }
                    });

            });
            $('#search').trigger('click');
        });
    </script>
@endsection
