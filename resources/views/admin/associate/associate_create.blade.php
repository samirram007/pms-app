@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Create Doctor </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('admin.doctor') }}" class="text-active">Doctor
                                    List</a></li>
                            <li class="breadcrumb-item active">  Add Doctor</li>
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

                            <form action="{{ route('admin.doctor.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row   border-bottom pb-2 mb-2">

                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn btn-outline-info"><span class="iconify" data-icon="mdi:content-save-all-outline" data-width="15" data-height="15"></span> Save</button>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Doctor Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Enter Doctor Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Doctor Alias</label>
                                                <input type="text" class="form-control" id="alias" name="alias"
                                                    placeholder="Enter Doctor Alias">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Doctor Code</label>
                                                <input type="text" class="form-control" id="code" name="code"
                                                    placeholder="Enter Doctor Code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Doctor Description</label>
                                                <textarea class="form-control" id="description" name="description" placeholder="Enter Doctor Description"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cost">Doctor Cost</label>
                                                <input type="text" class="form-control" id="cost" name="cost"
                                                    placeholder="Enter Doctor Cost">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount">Rate</label>
                                                <input type="text" class="form-control" id="amount" name="amount"
                                                    placeholder="Enter Doctor Rate">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="discount">Discount(if any)</label>
                                                <input type="text" class="form-control" id="discount" name="discount"
                                                    placeholder="Enter Doctor Discount">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_duration">Doctor Duration</label>
                                                <input type="text" class="form-control" id="doctor_duration" name="doctor_duration"
                                                    placeholder="Enter Doctor Duration">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group  ">

                                                <label for="doctor_group_id">Doctor Group</label>

                                                <select class="form-control doctorgroup_select" name="doctor_group_id"
                                                    id="doctor_group_id" data-url="{{ route('admin.get-category-by-groupid') }}">
                                                    <option value="" class="text-bold">SELECT GROUP</option>

                                                    @forelse ($doctor_groups as $tg)
                                                        <option value="{{ $tg['id'] }}">
                                                            {{ $tg['name'] }}
                                                        </option>

                                                    @empty
                                                        <option value="" >No record found
                                                        </option>
                                                    @endforelse



                                                </select>


                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group ">

                                                <label for="doctor_category_id">Doctor Category</label>

                                                <select class="form-control doctorcategory_select" name="doctor_category_id"
                                                    id="doctor_category_id">
                                                    <option value="" style=" font-weight: bold"
                                                        data-has-attributes="0">SELECT
                                                        CATEGORY</option>

                                                    @forelse($doctor_categories as $tc)
                                                        @if ($tc['doctor_group_id'] == 1)
                                                            <option value="{{ $tc['id'] }}"
                                                                data-has-attributes="{{ !empty($tc['has_method']) ? '1' : '0' }}">
                                                                {{ !empty($tc['name']) ? $tc['name'] : 'unknown' }}
                                                            </option>
                                                        @endif
                                                    @empty
                                                        <option value="" data-has-attributes="NO">No record found
                                                        </option>
                                                    @endforelse




                                                </select>
                                                {{-- <input type="text" class="form-control" name="DoctorCategoryID" id="DoctorCategoryID" placeholder="DoctorCategoryID" value="{{ $DoctorCategoryID }}"> --}}
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row" id="Attributes" style="display: none;" data-aos="fade-in">
                                        <input type="hidden" id="has_method" name="has_method" value="true">

                                        <div class="col-md-6">
                                            <div class="form-group ">

                                                <label for="inhouse_doctor">Inhouse Doctor ?</label>

                                                <select class="form-control " name="inhouse_doctor" id="inhouse_doctor">
                                                    <option value="1">YES</option>
                                                    <option value="0">NO</option>


                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="Unit">Unit</label>


                                                <select class="form-control " name="doctor_unit_id" id="doctor_unit_id">
                                                    <option value="" class="text-bold">SELECT GROUP</option>
                                                    @forelse ($doctor_units as $tu)
                                                        <option value="{{ $tu['id'] }}">
                                                            {!! $tu['code'] !!}
                                                        </option>

                                                    @empty
                                                        <option value="" data-has-attributes="NO">No record found
                                                        </option>
                                                    @endforelse


                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group  ">
                                                <label for="Specimen">Specimen</label>
                                                <input type="text" class="form-control" name="specimen"
                                                    id="Specimen" placeholder="Specimen" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="DoctorMethod">Doctor Method</label>
                                                <input type="text" class="form-control" name="doctor_method"
                                                    id="doctor_method" placeholder="DoctorMethod" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="doctor_method_description">Method Description</label>
                                                <input type="text" class="form-control" name="doctor_method_description"
                                                    id="doctor_method_description" placeholder="DoctorMethodDescription"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="reference_ange">Reference Range</label>
                                                <input type="text" class="form-control" name="reference_ange"
                                                    id="reference_ange" placeholder="ReferenceRange" value="">
                                            </div>
                                        </div>



                                    </div>


                            </form>

                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script>
        $(document).on("change", "#doctor_group_id", function() {
            // var parent_elm = $(this).parents(".doctor_group_category_container");
            //$('#doctor_category_id').val('').trigger('change');
            var elm = $("#Attributes");
            $(elm).hide();
            var parent_elm = $("#doctor_category_id");
            var doctor_group_id = $(this).val();

            if (doctor_group_id != '') {
                // $(".page-loader").show();
                var url = $(this).data('url');

                $.ajax({
                    url: url,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data: {
                        'doctor_group_id': doctor_group_id
                    },
                    success: function(response) {
                        // alert(doctorgroup_id+url);
                       //  console.log(response);
                        parent_elm.empty();
                        parent_elm.append('<option value="" style=" font-weight: bold" data-has-attributes="0">Select Category</option>');
                        $.each(response, function(key, value) {
                            parent_elm.append('<option value="' + value.id + '" data-has-attributes="' + value.has_method +
                                '">' + value.name + '</option>');
                        });
                        //$('#doctor_category_id').val('').change();
                        // $(parent_elm).html(response['html']);
                        // $(parent_elm).find(".doctorcategory_select").html(response['html']);
                    },
                    error: function(xhr, status, error) {
                         //console.log(response);
                         parent_elm.empty();
                        parent_elm.append('<option value="" style=" font-weight: bold" data-has-attributes="0">Select Category</option>');
                       // $('#doctor_category_id').val('').change();
                        //$(parent_elm).html(response['html']);
                        // $(parent_elm).find(".doctorcategory_select").html(error);
                        // $(".page-loader").hide();
                        //console.log(arguments);
                        // var msg =
                        //     '<div id="inner-message" class="alert alert-error shadow"><button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        //     error + '</div>';
                        // $("#message").html(msg);
                    }
                });
            } else {
                parent_elm.empty();
                        parent_elm.append('<option value="" style=" font-weight: bold" data-has-attributes="0">Select Category</option>');

            }
           // $('#doctor_category_id').change();

        });

        $(document).on("change", "#doctor_category_id", function() {
           // console.log('doctor_category_id');
            var parent_elm = $("#Attributes");

            var DoctorCategoryID = $(this).val();
            console.log(DoctorCategoryID);
            if (this.selectedOptions[0].getAttribute('data-has-attributes') == '0') {
                // alert('NO');
                $(parent_elm).hide();
            } else {
                //alert('YES');
                $(parent_elm).show();
            }
            $("#has_method").val(this.selectedOptions[0].getAttribute('data-has-attributes'));

        });
    </script>
@endsection
