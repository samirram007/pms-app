<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PMS</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('skydash/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('skydash/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('skydash/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('skydash/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('skydash/vendors/flag-icon-css/css/flag-icon.min.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  {{-- bootstrap cdn  --}}

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"  >

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" ></script>

  <link rel="stylesheet" href="{{asset('skydash/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('skydash/vendors/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">



  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('skydash/css/vertical-layout-light/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/skydash.css')}}">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('skydash/images/logo-dark.png')}}" />
  <style>
     .navbar {
            box-shadow: none !important;
            height: 5rem;
        }

        .navbar .navbar-brand-wrapper,
        .navbar .navbar-menu-wrapper {
            background: rgba(255, 255, 255, 0) !important;
        }

        .card {
            background: rgba(0, 0, 0, 0);
        }
.btn{
  padding: 10px 25px!important;
}

  </style>
</head>
<body class="bg-light">
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->

    @include('employee.layouts.navbar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      {{-- @include('job.layouts.themebar') --}}
     {{-- @include('job.layouts.rightbar') --}}

     @include('employee.layouts.sidebar')
      <!-- partial -->
      <div class="main-panel bg-light" data-aos="fade-right"
      data-aos-delay="500"
      data-aos-offset="300"
      data-aos-easing="ease-in-sine">
        @include('flash-message')
        {{-- <div class="bg-primary position-absolute w-100" style="height: 15rem;">
          </div> --}}
        {{-- <div class="content-wrapper mt-4" style="z-index: 1000;">
           --}}
            @yield('content')


        {{-- </div> --}}
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
      </div>

      <!-- main-panel ends -->
    </div>

    <!-- page-body-wrapper ends -->
  </div>

  @include('employee.layouts.footer')
  <!-- container-scroller -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" ></script>
  <script src="{{asset('skydash/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
  <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
  <!-- plugins:js -->
  <script src="{{asset('skydash/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('skydash/vendors/chart.js/Chart.min.js')}}"></script>
  {{-- <script src="{{asset('skydash/vendors/datatables.net/jquery.dataTables.js')}}"></script> --}}




  <script src="{{asset('skydash/vendors/select2/select2.min.js')}}"></script>


  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('skydash/js/off-canvas.js')}}"></script>
  <script src="{{asset('skydash/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('skydash/js/template.js')}}"></script>
  <script src="{{asset('skydash/js/settings.js')}}"></script>
  <script src="{{asset('skydash/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  {{-- <script src="{{asset('skydash/js/dashboard.js')}}"></script> --}}
  <script src="{{asset('skydash/js/Chart.roundedBarCharts.js')}}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>

        $(function() {
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                console.log(link);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href=link
                      Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
            $(document).on('click', '.item-delete', function(e) {
                e.preventDefault();
                var link = $(this).attr("href");
                console.log(link);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href=link
                      Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
    <script>
        @if (Session::has('message'))
            var type="{{ Session::get('alert-type', 'info') }}"
            switch(type){
            case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
            case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
            case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
            case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;

            }
        @endif
    </script>
  <!-- End custom js for this page-->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    //AOS.init();
    //window.AOS = require('AOS');
    AOS.init();
  </script>
</body>

</html>

