@extends('layouts.main')
@section('content')

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script> --}}
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>This is a simple Bootstrap modal. Click the "Cancel button", "cross icon" or "dark gray area" to
                        close or hide the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
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
                                                <select class="form-select px-2 sr-only" name="search_type"
                                                    id="search_type">
                                                    <option value="test">Test</option>
                                                    {{-- <option value="package">Package</option> --}}
                                                </select>
                                                <input type="text" class="form-control" name="search_text"
                                                    id="search_text" aria-label="Text input with segmented dropdown button"
                                                    placeholder="Search">
                                                {{-- <button type="submit" class="btn btn-outline-secondary rounded-0 px-1" type="button"
                                                        id="button-addon2"><span class="iconify" data-icon="carbon:search"
                                                            data-width="15" data-height="15"></span></button> --}}
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        {{-- <a href="{{ route('employee.sales_order.quick_preview') }}"
                                            class="quick_preview">Quick Preview</a> --}}
                                        <!-- Button HTML (to Trigger Modal) -->
                                        <div id="item_count"
                                                class="   text-dark    font-weight-bold"
                                                style="padding:7px 9px; right: 0.6rem;
                                                    top: -0.6rem;">
                                                {{ 'No. of test selected : '.$item_count }}</div>
                                        {{-- <button type="button" class="quick_preview btn btn-lg btn-link">Quick
                                           View</button> --}}
                                           <a href="javascript:"   data-param="{{$item_count}}"
                                           data-url="{{ route('employee.sales_order.quickview',$item_count) }}"
                                           data-size="md"
                                            title="Edit Area"
                                           class="load-popup float-right btn btn-rounded btn-info mb-2">  Quick
                                           View</a>
                                        <button class="btn btn-link  btn-lg sales_order_preview">
 Details View
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
            $(document).ready(function() {
                search();
                $('#search_text').on('keyup', function() {
                    search();
                });
                $('#search_type').on('change', function() {
                    search();
                });
                //sales_order_preview

                $(document).on('click', '.sales_order_preview', function(e) {
                    e.preventDefault();
                    var item_count = $('#item_count').text();
                    if (item_count == 0) {
                        //alert('Please select atleast one item');
                        Swal.fire({
                            title: 'Please select atleast one item',
                            text: "Please select atleast one item!",
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            return false;

                        })
                    } else {
                        //var link = $(this).attr("href");
                        var link = "{{ route('employee.sales_order.sales_order_preview') }}";
                        window.location.href = link
                        console.log(link);
                    }



                });


            });

            function search() {
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
                    success: function(data) {
                        $('#search_result').html(data.view);
                    }
                });
            }
        </script>
    </div>
    <script>
        // $(document).ready(function() {
        //     $(".quick_preview").click(function() {
        //         $("#myModal").modal('show');
        //     });
        // });
    </script>
@endsection
