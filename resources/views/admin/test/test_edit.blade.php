<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Test Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.test.update', $editData->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row   border-bottom pb-2 mb-2">

                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-outline-info"><span class="iconify"
                                    data-icon="mdi:content-save-all-outline" data-width="15" data-height="15"></span>
                                Save</button>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Test Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $editData->name }}" placeholder="Enter Test Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Test Alias</label>
                                <input type="text" class="form-control" id="alias" name="alias"
                                    value="{{ $editData->alias }}" placeholder="Enter Test Alias">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Test Code</label>
                                <input type="text" class="form-control" id="code" name="code"
                                    value="{{ $editData->code }}" placeholder="Enter Test Code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Test Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Enter Test Description">{!! $editData->description !!}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Test Cost</label>
                                <input type="text" class="form-control" id="cost" name="cost"
                                    value="{{ $editData->cost }}" placeholder="Enter Test Cost">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Rate</label>
                                <input type="text" class="form-control" id="amount" name="amount"
                                    value="{{ $editData->amount }}" placeholder="Enter Rate">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Discount(if any)</label>
                                <input type="text" class="form-control" id="discount" name="discount"
                                    value="{{ $editData->discount }}" placeholder="Enter Discount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Test Duration</label>
                                <input type="text" class="form-control" id="test_duration" name="test_duration"
                                    value="{{ $editData->test_duration }}" placeholder="Enter Test Duration">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  ">

                                <label for="test_group_id">Test Group</label>

                                <select class="form-control testgroup_select" name="test_group_id" id="test_group_id"
                                    data-url="{{ route('admin.get-category-by-groupid') }}">
                                    <option value="" class="text-bold">Select Group</option>

                                    @forelse ($test_groups as $tg)
                                    <option value="{{ $tg['id'] }}" {{ $editData->test_group_id ==$tg['id']?
                                        'selected':'' }}>
                                        {{ $tg['name'] }}
                                    </option>

                                    @empty
                                    <option value="">No record found
                                    </option>
                                    @endforelse



                                </select>


                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">

                                <label for="test_category_id">Test Category</label>

                                <select class="form-control testcategory_select" name="test_category_id"
                                    id="test_category_id">
                                    <option value="" style=" font-weight: bold" data-has-attributes="0">SELECT
                                        CATEGORY</option>

                                    @forelse($test_categories as $tc)
                                    @if ($tc['test_group_id'] == 1)
                                    <option value="{{ $tc['id'] }}"
                                        data-has-attributes="{{ !empty($tc['has_method']) ? '1' : '0' }}"
                                        {{$tc['id']==$editData->test_category_id ? 'selected' : ''}}>
                                        {{ !empty($tc['name']) ? $tc['name'] : 'unknown' }}
                                    </option>
                                    @endif
                                    @empty
                                    <option value="" data-has-attributes="NO">No record found
                                    </option>
                                    @endforelse




                                </select>
                                {{-- <input type="text" class="form-control" name="TestCategoryID" id="TestCategoryID"
                                    placeholder="TestCategoryID" value="{{ $TestCategoryID }}"> --}}
                            </div>

                        </div>

                    </div>
                    <div class="row" id="Attributes" style="display: none;" data-aos="fade-in">
                        <input type="hidden" id="has_method" name="has_method" value="{{ $editData->has_method }}">

                        <div class="col-md-6">
                            <div class="form-group ">

                                <label for="inhouse_test">Inhouse Test ?</label>

                                <select class="form-control " name="inhouse_test" id="inhouse_test">
                                    <option value="1" {{ $editData->inhouse_test==1 ? 'selected':''}}>YES</option>
                                    <option value="0" {{ $editData->inhouse_test==0 ? 'selected':''}}>NO</option>


                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="Unit">Unit</label>


                                <select class="form-control " name="test_unit_id" id="test_unit_id">
                                    <option value="" class="text-bold">SELECT GROUP</option>
                                    @forelse ($test_units as $tu)
                                    <option value="{{ $tu['id'] }}" {{$tu['id']==$editData->test_unit_id ?
                                        'selected':''}}>
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
                                <label for="specimen_type">Specimen</label>
                                <input type="text" class="form-control" name="specimen_type" id="specimen_type"
                                    placeholder="Specimen" value="{{$editData->specimen_type}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="TestMethod">Test Method</label>
                                <input type="text" class="form-control" name="test_method" id="test_method"
                                    placeholder="TestMethod" value="{{$editData->test_method}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="test_method_description">Method Description</label>
                                <input type="text" class="form-control" name="test_method_description"
                                    id="test_method_description" placeholder="TestMethodDescription"
                                    value="{{$editData->test_method_description}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="reference_range">Reference Range</label>
                                <input type="text" class="form-control" name="reference_range" id="reference_range"
                                    placeholder="ReferenceRange" value="{{$editData->reference_range}}">
                            </div>
                        </div>



                    </div>





            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
        </div>
    </div>
</div>


<script>
    $(document).on("change", "#test_group_id", function() {
        // var parent_elm = $(this).parents(".test_group_category_container");
        //$('#test_category_id').val('').trigger('change');
        var elm = $("#Attributes");
        $(elm).show();

        var parent_elm = $("#test_category_id");
        var test_group_id = $(this).val();

        if (test_group_id != '') {
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
                    'test_group_id': test_group_id
                },
                success: function(response) {
                    // alert(testgroup_id+url);
                   //  console.log(response);
                    parent_elm.empty();
                    parent_elm.append('<option value="" style=" font-weight: bold" data-has-attributes="0">Select Category</option>');
                    $.each(response, function(key, value) {
                        parent_elm.append('<option value="' + value.id + '" data-has-attributes="' + value.has_method +
                            '">' + value.name + '</option>');
                    });
                    //$('#test_category_id').val('').change();
                    // $(parent_elm).html(response['html']);
                    // $(parent_elm).find(".testcategory_select").html(response['html']);
                },
                error: function(xhr, status, error) {
                     //console.log(response);
                     parent_elm.empty();
                    parent_elm.append('<option value="" style=" font-weight: bold" data-has-attributes="0">Select Category</option>');
                   // $('#test_category_id').val('').change();
                    //$(parent_elm).html(response['html']);
                    // $(parent_elm).find(".testcategory_select").html(error);
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
       // $('#test_category_id').change();

    });

    $(document).on("change", "#test_category_id", function() {
       // console.log('test_category_id');
        var parent_elm = $("#Attributes");

        var TestCategoryID = $(this).val();
        console.log(TestCategoryID);
        if (this.selectedOptions[0].getAttribute('data-has-attributes') == '0') {
            // alert('NO');
            $(parent_elm).hide();
        } else {
            //alert('YES');
            $(parent_elm).show();
        }
        $("#has_method").val(this.selectedOptions[0].getAttribute('data-has-attributes'));

    });
    var current_category_id = $("#test_category_id").val();
    $('#test_category_id').val(current_category_id).change();

</script>