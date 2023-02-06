@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10">
                        <h2 class="text-dark h4 m-0">Test List</h2>
<ol class="breadcrumb border-0 small">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item active">Test List</li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-2 d-flex justify-content-end align-items-start">
                        <a href="{{ route('admin.test.create') }}" style="width:8rem;" class=" position-absolute load-popup  btn btn-rounded btn-primary "> ADD TEST</a>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3  bg-light shadow min-vh-100">
                <div class="header-marge-panel ">

                </div>

                <div id="searchPanel" class="searchPanel">
                    <div id="data-grid" class="data-tab-custom rounded">

                       @include('admin.test.partials.index_table')



                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
