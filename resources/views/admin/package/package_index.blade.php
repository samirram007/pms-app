@extends('layouts.main')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-10">
                    <h4 class="text-dark h4 m-0">Package List</h4>
                    <ol class="breadcrumb   border-0 small">
                        <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                class="text-active">Dashboard</a></li>
                        <li class="breadcrumb-item active">Package List</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-2  d-flex justify-content-end align-items-start">
                    <a href="javascript:void(0)" data-url="{{ route('admin.package.create') }}" data-param=""
                        style="width:8rem;" class=" position-absolute load-popup  btn btn-rounded btn-primary ">New
                        Package</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="rounded card p-3  bg-light shadow min-vh-100">
            <div id="searchPanel" class="searchPanel">
                <div id="data-grid" class="data-tab-custom rounded">


                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Test(s)</th>
                                    <th>Description</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collections as $key=> $data)
                                @php
                                $tests = '';
                                $a=1;
                                @endphp
                                @foreach($data->test_packages as $test)
                                @php
                                $tests .=$a++.'. '.$test['test']['name'].'<br>';
                                @endphp

                                @endforeach

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->amount }}</td>
                                    <td>{!! $tests !!}</td>
                                    <td class="text-wrap text-truncate">{{ $data->description }}</td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-link dropdown-toggle" type="button"
                                                data-toggle="dropdown">SELECT
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li> <a href="{{ route('admin.package.show', $data->id) }}"
                                                        class="btn btn-link"> VIEW</a></li>
                                                <li><a href="{{ route('admin.package.edit', $data->id) }}"
                                                        class="btn btn-link"> EDIT</a></li>
                                                <li><a href="{{ route('admin.package.delete', $data->id) }}"
                                                        class="btn btn-link delete"> DELETE</a></li>
                                                <li><a href="{{ route('admin.test_report.config', $data->id) }}"
                                                        class="btn btn-link "> REPORT SETTINGS</a></li>
                                            </ul>
                                        </div>




                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready( function () {
            $('#table').DataTable();
        });

</script>
@endsection