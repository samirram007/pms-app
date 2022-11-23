@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark">Collection Report</h4>

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
                                    <div class="col-sm-3">
                                        <label for="lab_centre">
                                            Lab Centre :
                                        </label>
                                        <select class="form-control" name="lab_centre_id" id="lab_centre_id">
                                            @foreach ($lab_centres as $lab_centre)
                                            <option value="{{ $lab_centre->id}}">{{ $lab_centre->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-sm-3 ">
    <label for="from_date">
        From Date :
    </label>
    <input class="form-control" type="date" id="from_date" name="from_date" value="{{date('Y-m-d')}}">
</div>

    <div class="col-sm-3 ">
        <label for="to_date">
            To Date :
        </label>
    <input class="form-control" type="date" id="to_date" name="to_date" value="{{date('Y-m-d')}}">
</div>
                                    <div class="col-sm-12 text-left">
                                        <a id="search" href="javascript:void(0)"
                                            class="search btn btn-rounded btn-outline-info my-4 ">
                                            <span class="iconify" data-icon="et:search" style="color: rgb(9, 62, 122);" data-width="20" data-height="20"></span>
                                              Search</a>

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

                $(document).ready( function () {
                    $('#table').DataTable();
            } );

    </script>
    <script>
        $(document).ready(function () {

        $("#search").on('click', function () {
            var lab_centre_id = $("#lab_centre_id").val();
            var from_date = $("#from_date").val();
            var to_date = $("#to_date").val();

            if (lab_centre_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.report.collection.search') }}",
                    data: {
                        lab_centre_id: lab_centre_id,
                        from_date: from_date,
                        to_date: to_date
                    },
                    success: function (data) {
                        // console.log(data);
                        $('#response_body').html(data.body);
                    }
                });
            } else {
                $('#response_body').html('');
            }
        });
        });

    </script>
@endsection
