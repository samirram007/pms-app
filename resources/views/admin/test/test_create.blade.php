<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Test</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="javascript:void(0)" id="test_data" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3 col-sm-3 col">
                            <div class="form-group">
                                <label for="name">Test Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Test Name">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col">
                            <div class="form-group">
                                <label for="name">Test Alias</label>
                                <input type="text" class="form-control" id="alias" name="alias"
                                    placeholder="Enter Test Alias">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col">
                            <div class="form-group">
                                <label for="name">Test Code</label>
                                <input type="text" class="form-control" id="code" name="code"
                                    placeholder="Enter Test Code">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col">
                            <div class="form-group">
                                <label for="name">Test Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Enter Test Description"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col">
                            <div class="form-group">
                                <label for="cost">Test Cost</label>
                                <input type="text" class="form-control" id="cost" name="cost"
                                    placeholder="Enter Test Cost">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col">
                            <div class="form-group">
                                <label for="amount">Rate</label>
                                <input type="text" class="form-control" id="amount" name="amount"
                                    placeholder="Enter Test Rate">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col">
                            <div class="form-group">
                                <label for="discount">Discount(if any)</label>
                                <input type="text" class="form-control" id="discount" name="discount"
                                    placeholder="Enter Test Discount">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col">
                            <div class="form-group">
                                <label for="test_duration">Test Duration</label>
                                <input type="text" class="form-control" id="test_duration" name="test_duration"
                                    placeholder="Enter Test Duration">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col">
                            <div class="form-group  ">

                                <label for="test_group_id">Test Group</label>

                                <select class="form-control testgroup_select" name="test_group_id" id="test_group_id"
                                    data-url="{{ route('admin.get-category-by-groupid') }}">
                                    <option value="" class="text-bold">SELECT GROUP</option>

                                    @forelse ($test_groups as $tg)
                                    <option value="{{ $tg['id'] }}">
                                        {{ $tg['name'] }}
                                    </option>

                                    @empty
                                    <option value="">No record found
                                    </option>
                                    @endforelse



                                </select>


                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col">
                            <div class="form-group ">

                                <label for="test_category_id">Test Category</label>

                                <select class="form-control testcategory_select" name="test_category_id"
                                    id="test_category_id">
                                    <option value="" style=" font-weight: bold" data-has-attributes="0">
                                        SELECT
                                        CATEGORY</option>

                                    @forelse($test_categories as $tc)
                                    @if ($tc['test_group_id'] == 1)
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
                                {{-- <input type="text" class="form-control" name="TestCategoryID" id="TestCategoryID"
                                    placeholder="TestCategoryID" value="{{ $TestCategoryID }}"> --}}
                            </div>

                        </div>

                    </div>
                    <div class="row" id="Attributes" style="display: none;" data-aos="fade-in">
                        <input type="hidden" id="has_method" name="has_method" value="true">

                        <div class="col-md-6">
                            <div class="form-group ">

                                <label for="inhouse_test">Inhouse Test ?</label>

                                <select class="form-control " name="inhouse_test" id="inhouse_test">
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>


                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="Unit">Unit</label>


                                <select class="form-control " name="test_unit_id" id="test_unit_id">
                                    <option value="" class="text-bold">SELECT GROUP</option>
                                    @forelse ($test_units as $tu)
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
                                <input type="text" class="form-control" name="specimen" id="Specimen"
                                    placeholder="Specimen" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="TestMethod">Test Method</label>
                                <input type="text" class="form-control" name="test_method" id="test_method"
                                    placeholder="TestMethod" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="test_method_description">Method Description</label>
                                <input type="text" class="form-control" name="test_method_description"
                                    id="test_method_description" placeholder="TestMethodDescription" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="reference_ange">Reference Range</label>
                                <input type="text" class="form-control" name="reference_ange" id="reference_ange"
                                    placeholder="ReferenceRange" value="">
                            </div>
                        </div>



                    </div>



                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-outline-info"><span class="iconify"
                            data-icon="mdi:content-save-all-outline" data-width="15" data-height="15"></span>
                        Save</button>


                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).on("change", "#test_group_id", function() {
        // var parent_elm = $(this).parents(".test_group_category_container");
        //$('#test_category_id').val('').trigger('change');
        var elm = $("#Attributes");
        $(elm).hide();
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
                    parent_elm.append(
                        '<option value="" style=" font-weight: bold" data-has-attributes="0">Select Category</option>'
                        );
                    $.each(response, function(key, value) {
                        parent_elm.append('<option value="' + value.id +
                            '" data-has-attributes="' + value.has_method +
                            '">' + value.name + '</option>');
                    });
                    //$('#test_category_id').val('').change();
                    // $(parent_elm).html(response['html']);
                    // $(parent_elm).find(".testcategory_select").html(response['html']);
                },
                error: function(xhr, status, error) {
                    //console.log(response);
                    parent_elm.empty();
                    parent_elm.append(
                        '<option value="" style=" font-weight: bold" data-has-attributes="0">Select Category</option>'
                        );
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
            parent_elm.append(
                '<option value="" style=" font-weight: bold" data-has-attributes="0">Select Category</option>'
                );

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
    </script>
    <script type="text/javascript">
        $("#test_data").on("submit", function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            url: "{{ route('admin.test.store') }}",
            type: "POST",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: "application/json; charset=utf-8",
            data: formData,
            dataType: "json",
            encode: true,
            success: function(response) {
                if (response.status === 400) {
                    console.log("Data Error");
                } else if (response.status === 200) {
                    $("#resultView").html(response.html);
                    $("#modal-popup").html('');
                    $("#modal-popup").modal('hide');
                }
            }
        });
    });
    </script>