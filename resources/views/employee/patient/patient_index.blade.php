@extends('layouts.main')
@section('content')
<style>
    [contenteditable][placeholder]:empty:before {
  content: attr(placeholder);
  position: absolute;
  color: gray;
  background-color: transparent;
}
</style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark">Patient List</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('employee.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item active">Patient List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3  bg-light shadow min-vh-100">
                <div class="row   ">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="row d-flex justify-center    ">
                                    <div class="col-md-6 text-left d-flex border border-dark rounded">
                                       <div contenteditable="true" class="search form-control border-none " id="search" name="search"
                                       aria-placeholder="Enter your search here.."
                                       placeholder="Enter your search here.."
                                       oninput="if(this.innerHTML.trim()==='<br>')this.innerHTML=''" onkeyup="searchPatient();" ></div>
                                       <a href="javascript:void(0)" onclick="searchPatient();"
                                       class=" float-right btn btn-rounded btn-link ">
                                       Search</a>
                                       <span class="border-left border-info py-2"></span>
                                       <a href="{{ route('employee.patient.create') }}"
                                            class="load-popup float-right btn  btn-link ">
                                             New</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="searchPanel" class="searchPanel">
                    <div id="data-grid" class="data-tab-custom rounded">


                        <div class="responsive" id="search_result">

                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>

            //     $(document).ready( function () {
            //         $('#table').DataTable({
            //             responsive: true,
            //             searching: false,
            //             paging: false,
            //             info: false,
            //             select: true,
            //         });

            // } );
            searchPatient();
            function searchPatient(){
                var search = $('.search').text();
                $.ajax({
                    url: "{{ route('employee.patient.search') }}",
                    type: "GET",
                    data: {
                        search: search,
                    },
                    success: function (data) {
                        $('#search_result').html(data.html);
                    }
                });
            }

    </script>
@endsection
