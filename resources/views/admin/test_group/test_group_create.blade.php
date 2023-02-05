<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Test Group</h1>
            <button type="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.test_group.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Test Group Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Test Group Name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group  ">

                                <label for="department_id">Department</label>

                                <select class="form-control testgroup_select" name="department_id" id="department_id">
                                    <option value="" class="text-bold">Select Department</option>

                                    @forelse ($department as $tg)
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
</script>