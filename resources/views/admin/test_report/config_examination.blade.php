@extends('layouts.main')
@section('content')
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}

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
        .ace_editor div, .ace_editor span { font-size: 16px !important; }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark">Test-Examination Report Configuration</h4>

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
                       
                    </div>
                </div>
                {{-- tab container --}}


            </div>


        </section>



    </div>
  
     
   
  
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                lengthChange: false,
                select: true,
                searching: [
                    "Name",
                    "Price",
                    "Description"
                ],
                aling: "center",
                highlight: true,
            });


            loadcode();
            //ctrl + s when editor is focused


        });
  

    </script>
@endsection
