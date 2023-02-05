<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_URL')}}</title>
    <link rel="shortcut icon" href="{{asset('images/logo-dark.png')}}" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">


    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/ekko-lightbox/ekko-lightbox.css')}}">
    {{--
    <link rel="stylesheet" href="{{asset('css/skydash.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}" defer></script>
    <script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>

    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        // $.widget.bridge('uibutton', $.ui.button)
    </script>

    <style>
        .main-footer {
            background-color: #fff;
            border-top: 1px solid #dee2e6;
            color: #869099;
            padding: 1rem;
            bottom: 0;
            position: fixed;
            width: 100%;
            z-index: 1030;
        }

        .content-wrapper {
            padding-bottom: 60px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.modal')
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('images/logo-dark.png')}}" alt="PMSLogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        {{-- <div class="content-wrapper"> --}}
            <!-- Content Header (Page header) -->

            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                @yield('content')


                <div class="modal fade" id="modal-popup" data-bs-backdrop="static" role="dialog"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">

                </div>
            </section>
            <!-- /.content -->
            {{--
        </div> --}}
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        {{-- @include('layouts.rightbar') --}}
        <!-- /.control-sidebar -->
    </div>
    @include('layouts.footer')
    <!-- ./wrapper -->

    @include('sweetalert::alert')

    {{-- select2 --}}
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('plugins/popper/popper.js')}}"></script> --}}
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>

    {{-- proper --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    {{-- <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script> --}}
    <!-- JQVMap -->
    {{-- <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script> --}}
    {{-- <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> --}}
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>

    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('dist/js/demo.js')}}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{asset('dist/js/pages/dashboard.js')}}"></script> --}}


    <script type="text/javascript">
        $(function(){

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click", ".load-popup", function(e){


                e.preventDefault;
                var param = $(this).data('param');
                var url = $(this).data('url');
                var size = $(this).data('size');

                $.ajax({
                    url: url,
                    type: "get",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data:{
                        "param":param,
                        "size":size,
                    },
                    success: function(data){
                        // console.log(data);
                        $("#modal-popup").html(data['html']);
                        $("#modal-popup").modal('show');
                    }
                });
            });
        });
    </script>



    <script>
        $('#rems-popup').on('shown.bs.modal', function() {
            $('.cp-datepicker').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                timePickerIncrement: 1,
                opens: "left",
                drops: "auto",
                applyButtonClasses: "btn-info",
                showDropdowns: false,
                minDate: "01/01/2021 12:00 AM",
                // maxDate: "<?= date('d/m/Y') . ' 11:59 PM' ?>", // this is set in the elemet's data-maxDate attribute.
                locale: {
                    "format": 'DD/MM/YYYY'
                }
            });
        });
        // $(document).on("click", ".load-popup", function(e) {
        //     e.preventDefault();


        //     var param = $(this).data('param');
        //     var url = $(this).data('url');
        //     var size = $(this).data('size');
        //     // console.log(param);
        //     //  $(".page-loader").show();
        //     $.ajax({
        //         url: url,
        //         type: "get",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         contentType: "application/json; charset=utf-8",
        //         dataType: "json",
        //         data: {
        //             'param': param,
        //             'size': size
        //         },
        //         success: function(data) {
        //             // console.log(data);
        //             //console.log(ko.toJSON(response));
        //             if (!data.error) {
        //                 $("#rems-popup").html(data['html']);
        //                 $("#rems-popup").modal('show');
        //             } else {
        //                 console.log(data);
        //             }

        //             //  $(".page-loader").hide();
        //         },
        //         error: function(xhr, status, error) {
        //             console.log(xhr);
        //             //$(".page-loader").hide();
        //             //console.log(arguments);
        //             /*  var msg =
        //                   '<div id="inner-message" class="alert alert-error shadow"><button type="button" class="close" data-dismiss="alert">&times;</button>' +
        //                   error + '</div>';
        //               $("#message").html(msg);*/
        //         }

        //     })

        // });
        // $(document).on("click", ".render-popup", function() {
        //     // e.preventDefault();
        //     $("#rems-popup").html('');

        //     var param = $(this).data('param');
        //     var url = $(this).data('url');
        //     //  console.log(param);
        //     //  $(".page-loader").show();
        //     $.ajax({
        //         url: url,
        //         type: "get",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         contentType: "application/json; charset=utf-8",
        //         dataType: "json",
        //         data: {
        //             'param': param
        //         },
        //         success: function(data) {
        //               console.log(data);
        //             //console.log(ko.toJSON(response));
        //             if (!data.error) {
        //                 $("#rems-popup").html(data['html']);
        //                 $("#rems-popup").modal('show');
        //             } else {
        //                 console.log(data);
        //             }

        //             //  $(".page-loader").hide();
        //         },
        //         error: function(xhr, status, error) {
        //             //console.log(xhr);
        //             //$(".page-loader").hide();
        //             //console.log(arguments);
        //             /*  var msg =
        //                   '<div id="inner-message" class="alert alert-error shadow"><button type="button" class="close" data-dismiss="alert">&times;</button>' +
        //                   error + '</div>';
        //               $("#message").html(msg);*/
        //         }

        //     })

        // });
    </script>
    <script>
        $('.dropdown-toggle').dropdown();
    </script>
    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif
    </script>


</body>

</html>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
</head>

<body>
    <h1>Hello, world!</h1>
</body>

</html>