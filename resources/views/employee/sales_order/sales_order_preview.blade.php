@extends('layouts.main')
@section('content')

    <style>
        .cancel{
  text-decoration: line-through;
}
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h4 class="text-dark py-2"> [Preview]</h4>

                    </div><!-- /.col -->
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right border-0  ">
                            <li class="breadcrumb-item d-flex  align-items-center"><a
                                    href="{{ route('employee.sales_order.create') }}" class=" "><span class="iconify"
                                        data-icon="ant-design:arrow-left-outlined" style="color: rgb(34, 130, 255);"
                                        data-width="20" data-height="20" data-rotate="180deg"
                                        data-flip="horizontal,vertical"></span> <span class="sr-only"> Back to booking</span></a>
                            </li>
                            <li class="breadcrumb-item align-content-center"><a href="{{ route('employee.patient.index') }}"
                                    class="">Patient</a></li>

                            <li class="breadcrumb-item active  align-content-center"> Preview</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card  min-vh-100">
                <div class="row">
                    {{-- @dd($collections) --}}
                    @php
                        $object = json_decode(json_encode($cart), false);
                    @endphp
                    {{-- @dd($object) --}}
                    {{-- @foreach ($object as $c)
        {{$c->name}}
    @endforeach --}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">


                            <div class="card-body">


                                <div class="row    pb-2 mb-2">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div id="search_result" class="w-100 pr-4">
                                                @if ($collections->count() > 0)
                                                    <div id="searchPanel" class="searchPanel ">
                                                        <div id="data-grid" class="data-tab-custom rounded">
                                                            {{-- create cart view here --}}
                                                            @foreach ($collections as $collection)
                                                                <div class="row bg-light mb-2 shadow">
                                                                    <div
                                                                        class="col-md-3 d-flex flex-column align-items-center justify-content-center ">

                                                                        @if ($collection->is_package == 1)
                                                                            <span class="iconify" data-icon="tabler:package"
                                                                                style="color: rgba(158, 126, 39, 0.603);"
                                                                                data-width="100" data-height="100"></span>
                                                                        @else
                                                                            <span class="iconify"
                                                                                data-icon="twemoji:test-tube"
                                                                                style="color: #f22;" data-width="100"
                                                                                data-height="100" data-rotate="180deg"
                                                                                data-flip="horizontal,vertical"></span>
                                                                        @endif
                                                                        <div> <a href="{{ route('employee.sales_order.delete_from_order_preview', $collection->id) }}"
                                                                                class="btn btn-link item-delete ">REMOVE
                                                                                THIS TEST</a> </div>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <div class="card ">
                                                                            <div class="card-body ">

                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <h3 class="card-title">
                                                                                            {{ $collection->name }}</h3>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-md-6 d-flex justify-content-between">
                                                                                        <div class="badge badge-outline-secondary"
                                                                                            style="max-height: 1.7rem;">
                                                                                            {{ 'qty: 1' }}</div>



                                                                                        <div class=" text-right">
                                                                                            @if($collection->discount_amount!=0)
                                                                                            ₹{{ number_format($collection->discounted_amount,2,'.','') }}
                                                                                            <div class="cancel text-gray"><em><small>₹{{ number_format($collection->amount,2,'.','') }}  price</small></em></div>

                                                                                            @else
                                                                                            ₹{{ number_format($collection->amount,2,'.','') }}
                                                                                            <em><small> price</small></em>
                                                                                            @endif

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-12 text-info text-xs pt-0">

                                                                                        @if ($collection['test_group']['id'] > 0)
                                                                                            <small> Department of
                                                                                                {{ $collection['test_group']['name'] }}
                                                                                            </small>
                                                                                        @elseif($collection->is_package == 1)
                                                                                            <small>
                                                                                                {{ 'Tests in package : ' }}
                                                                                            </small>
                                                                                            @foreach ($collection->test_packages as $package)
                                                                                                <small
                                                                                                    class="badge badge-outline-secondary">
                                                                                                    {{ $package['test']['name'] }}
                                                                                                </small>
                                                                                            @endforeach
                                                                                        @endif



                                                                                        {{-- @php
                                                                                          $collection->test_packages ->each(function($test_package) {
                                                                                                    echo '<small>'.$test_package['test']['name'].'</small>';
                                                                                                  });
                                                                                        //   ->each(function($test_package) {
                                                                                        //     echo '<small>'.$test_package->name.'</small>';
                                                                                        //   });
                                                                                        @endphp --}}


                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body ">
                                                                                <div class="row">
                                                                                    <div class="col-md-5">
                                                                                        <div class="input-group">
                                                                                            <span
                                                                                                class="input-group-text">Test
                                                                                                Date: </span>
                                                                                            <input type="date"
                                                                                                id="test_date_{{ $collection->id }}"
                                                                                                onchange="change_test_date({{ $collection->id }},this.value,{{ $collection->test_duration }})"
                                                                                                value="{{ $collection->test_date }}"
                                                                                                min="{{ date('Y-m-d') }}"
                                                                                                max="{{ date('Y-m-d', strtotime('+15 days')) }}"
                                                                                                class="form-control  rounded shadow-sm">
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-7">
                                                                                        <div class="input-group">
                                                                                            <span
                                                                                                class="input-group-text">Reporting
                                                                                                On: </span>
                                                                                            <input type="date"
                                                                                                id="report_date_{{ $collection->id }}"
                                                                                                value="{{ $collection->report_date }}"
                                                                                                min="{{ date('Y-m-d') }}"
                                                                                                max="{{ $collection->test_duration == 0 ? date('Y-m-d', strtotime('+15 days')) : date('Y-m-d', strtotime('+' . ($collection->test_duration + 15) . ' days')) }}"
                                                                                                class="form-control rounded shadow-sm">
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="card-title mt-1   ">
                                                        <div class="row  border-top border-info  ">
                                                            <div class="col-md-12 p-3">

                                                                <div
                                                                    class="form-group text-right d-flex justify-content-between">
                                                                    <label>Count : {{ $sales_order['item_count'] }}
                                                                    </label>
                                                                    <label>Item Total : ₹
                                                                        {{ number_format($sales_order['total_amount'],2,'.','') }}
                                                                    </label>

                                                                </div>





                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="{{ route('employee.sales_order.create') }}" class=" ">
                                                        <div class="alert alert-info w-100 d-flex justify-content-between">
                                                            <p> <span class="iconify"
                                                                    data-icon="ant-design:arrow-left-outlined"
                                                                    style="color: rgb(34, 130, 255);" data-width="20"
                                                                    data-height="20" data-rotate="180deg"
                                                                    data-flip="horizontal,vertical"></span> Back to booking
                                                            </p><strong>No test selected!</strong>
                                                        </div>
                                                    </a>
                                                @endif

                                            </div>
                                            <div class="patient_panel d-none">
                                                <div class="card-title mt-1 ">
                                                    <div class="row">
                                                        <div class="col-md-12 px-3">
                                                            <form class="form-inline">
                                                                <div class="form-group mb-2">
                                                                    <label for="staticEmail2" class="sr-only">Enter coupon
                                                                        code</label>
                                                                    <input type="text" readonly
                                                                        class="form-control-plaintext" id="staticEmail2"
                                                                        value="Enter coupon code">
                                                                </div>
                                                                <div class="form-group mx-sm-3 mb-2">
                                                                    <label for="coupon_code" class="sr-only">Coupon
                                                                        Code</label>
                                                                    <input type="text" class="form-control"
                                                                        id="coupon_code" placeholder="Coupon Code">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary mb-2">Apply
                                                                    Coupon</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right   " style="min-height:70vh; ">
                                        @if ($sales_order['patient'] != null)
                                            @php
                                                $patient = $sales_order['patient'];
                                                $associate = $sales_order['associate'];
                                                $referral_doctor = $sales_order['referral_doctor'];
                                            @endphp
                                            <div id="patient_information" class="row  " style=" min-height:20vh">

                                                <div class="col-sm-12 text-right">
                                                    <input type="hidden" name="patient_id" id="patient_id"
                                                        value="{{ $patient->id }}">
                                                    <input type="hidden" name="referral_doctor_id"
                                                        id="referral_doctor_id" value="{{ $patient->referral_doctor }}">
                                                    <input type="hidden" name="associate_id" id="associate_id"
                                                        value="{{ $patient->associate_id }}">

                                                    <a href="{{ route('employee.patient.edit', $patient->id) }}"
                                                        class="badge badge-outline-info text-info">
                                                        <i class="fa fa-user-plus"></i>
                                                        change patient information
                                                    </a>
                                                    <div class="text-center mb-4">
                                                        <img alt="profile" class="img-lg rounded-circle mb-3 shadow"
                                                            src="{{ !empty($patient->image) ? url('upload/user_images/' . $patient->image) : url('upload/no_image.jpg') }}">
                                                        <img src="">
                                                        <div class="mb-3">
                                                            <h3>{{ $patient->name }}</h3>

                                                        </div>
                                                        <p class="w-75 mx-auto mb-3">ContactNo: {{ $patient->contact_no }}
                                                        </p>
                                                        <p class="w-75 mx-auto mb-3">Dob:
                                                            {{ $patient->dob != null ? date('d-M-Y', strtotime($patient->dob)) : '' }}
                                                        </p>
                                                        <p class="w-75 mx-auto mb-3">Doctor:
                                                            {{ !empty($referral_doctor->name)  ? $referral_doctor->name : 'UNKNOWN' }}
                                                        </p>
                                                        <p class="w-75 mx-auto mb-3">Referrer:
                                                            {{ !empty($associate->name) ? $associate->name : 'UNKNOWN' }}
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div id="patient_information">
                                                <input type="hidden" name="patient_id" id="patient_id" value="0">
                                                <input type="hidden" name="referral_doctor_id" id="referral_doctor_id"
                                                    value="0">
                                                <input type="hidden" name="associate_id" id="associate_id"
                                                    value="0">
                                            </div>
                                        @endif
                                        <div class="row  rounded border-bottom p-2 my-2 shadow"
                                            style="background:#e4cfdb0a; border:1px solid rgba(88, 80, 80, 0.123) ; min-height:50vh">
                                            <div class="col-sm-12 text-right badge">
                                                Payment Status: <div class="badge badge-danger"><span
                                                        class="text-success-lg ">Unpaid</span></div>
                                                        <div class="text-right my-4 d-flex justify-content-between h5">
                                                            <hr>

                                                                {{-- @dd($sales_order['discount_type_id']) --}}
                                                                <div class="col-md-12 ">
                                                                    <form class="form-inline-md">

                                                                        <div class="input-group mb-3">
                                                                            {{-- <div class="input-group-prepend border-0">
                                                                              <label class="input-group-text" for="discount_type_id">Discount:</label>
                                                                            </div> --}}

                                                                                <select name="discount_type_id"
                                                                                id="discount_type_id"
                                                                                class="custom-select ">
                                                                                <option value="">Select Discount
                                                                                </option>
                                                                                @foreach ($discount_types as $discount_type)
                                                                                    <option value="{{ $discount_type->id }}"
                                                                                        {{ $discount_type->id == $sales_order['discount_type_id'] ? 'selected' : '' }}>
                                                                                        {{ $discount_type->name }}
                                                                                    </option>
                                                                                @endforeach

                                                                            </select>
                                                                            <div class="input-group-append">
                                                                                <button type="button"
                                                                                    class="badge badge-outline-primary ml-2 mb-2 apply-discount">Apply Discount
                                                                                    </button>
                                                                              </div>

                                                                          </div>



                                                                    </form>
                                                                </div>
                                                                @if ($sales_order['discount_type_id'] != 0)

                                                                <div class="form-group mb-2 d-none">
                                                                    <small class="float-left">Applied Discount :
                                                                        {{ $sales_order['discount_type']->name }} <span class="badge badge-outline-info">change</span></small>
                                                                </div>
                                                            @endif
                                                        </div>
                                                <div class="container-fluid mt-5 w-100 text-weight-bold text-800">

                                                    @php
                                                        $sub_total = $sales_order['total_amount'];
                                                        $discount = $sales_order['discount_amount'];
                                                        $total = $sales_order['discounted_amount'];
                                                        $total_due = $sub_total - $discount;
                                                    @endphp
                                                    <p class="text-right mb-2 d-flex justify-content-between h5">
                                                        <span> SubTotal <span>:</span></span>
                                                        <span> ₹ {{ number_format($sub_total, 2, '.', '') }} </span>
                                                    </p>
                                                    <p class="text-right d-flex justify-content-between h5">
                                                        @if ($sales_order['discount_type'] != null)
                                                            <span class="text-success"> Discount
                                                                ({{ $sales_order['discount_type']->name }})<span>: </span></span>
                                                            <span>₹ {{ number_format($discount, 2, '.', '') }}</span>
                                                        @endif
                                                    </p>
                                                    <h4 class="text-right mb-5 d-flex justify-content-between">
                                                        <span>Total<span>:</span></span>
                                                        <span>₹ {{ number_format($total, 2, '.', '') }}</span>
                                                    </h4>
                                                    <hr>
                                                    @if ($total > 0)
                                                        <div
                                                            class="container-fluid mt-1 w-100 text-center justify-align-center">
                                                            <a href="javascript:"
                                                                class="generate_invoice btn btn-info  rounded btn-lg  px-5  mt-1">
                                                                  Invoice</a>
                                                            {{-- @if($sub_total>0 && $total>0)
                                                            <a href="javascript:"
                                                                class="pay-now btn btn-outline-warning text-dark rounded btn-lg  px-5  mt-1 w-75">
                                                                <span class="iconify" data-icon="cib:samsung-pay"
                                                                    style="color: #0a1f2eb8;" data-width="35"
                                                                    data-height="35"></span> Now</a>
                                                            @elseif ($sub_total>0 && $total==0)
                                                            <a href="javascript:"
                                                                class="generate_invoice btn btn-outline-warning text-dark rounded btn-lg  px-5  mt-1 w-75">
                                                                  Generate Invoice</a>

                                                            @endif --}}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>








                            </div>
                        </div>
                    </div>
        </section>
        <style>
            .input-group-text {
                display: flex;
                align-items: center;
                padding: 0.5rem 0.375rem 0.5rem 0;
                margin-bottom: 0;
                font-size: 0.875rem;
                font-weight: 400;
                line-height: 1;
                color: #495057;
                text-align: center;
                white-space: nowrap;
                background-color: #e9ecef00;
                border: 1px solid #ced4da00;
                border-radius: 2px;
            }
        </style>
        <script>
            $(document).ready(function() {

                $('#search_text').on('keyup', function() {
                    search();
                });
                $('#search_type').on('change', function() {
                    search();
                });

                $('.generate_invoice').on('click', function() {
                    //  var success_url = "{{ route('employee.sales_invoice.edit',0) }}" ;
                     var success_url = "{{ route('employee.sales_invoice.index') }}";
                    if ($('#patient_id').val() == 0) {
                        // alert('Please select patient');
                        Swal.fire({
                            title: 'Please select patient',
                            text: "Please select patient",
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('employee.patient.index') }}";

                            }
                        })
                    } else {
                        $.ajax({
                        url: "{{ route('employee.sales_order.generate_invoice') }}",
                        type: "GET",
                        success: function(data) {
                            if(data.status=='success'){

                                Swal.fire({
                                    title: 'Invoice Generated',
                                    text: "Invoice Generated",
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = success_url
                                    }
                                })
                            }
                           // window.location.href = "{{ route('employee.sales_invoice.index') }}";



                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                       // window.location.href = "{{ route('employee.sales_order.generate_invoice') }}";

                    }
                });
                $('.apply-discount').on('click', function(e) {
                    var dicount_type_id = $('#discount_type_id').val();

                    if (dicount_type_id == 0 || dicount_type_id == null) {
                        //alert('Please select discount type');
                        Swal.fire({
                            title: 'Please select discount',
                            text: "Please select discount ",
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        });
                        return false;
                    }
                    // alert(dicount_type_id);
                    $.ajax({
                        url: "{{ route('employee.sales_order.discount_apply') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            discount_type_id: dicount_type_id,
                        },
                        success: function(data) {

                            window.location.href =
                                "{{ route('employee.sales_order.sales_order_preview') }}";


                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
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
            //change test date
            function change_test_date(test_id, test_date, test_duration) {
                //console.log(test_duration);
                var url = "{{ route('employee.sales_order.change_test_date') }}";
                $.ajax({
                    url: url,
                    type: 'GET',
                    data: {
                        test_id: test_id,
                        test_date: test_date,
                        test_duration: test_duration
                    },
                    success: function(data) {
                        //$('#test_date_' + test_id).html(data.view);
                        console.log(data);

                        $('#report_date_' + test_id).val(data.report_date);
                        console.log(test_duration);
                        console.log(data);

                    }
                });
            }
        </script>
    </div>
@endsection
