<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">TEST CATEGORY</h1>
            <button type="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.test_category.store') }}" method="post" enctype="multipart/form-data">
            <div class="modal-body">

                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Test Category Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Test Category Name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group  ">

                                <label for="department_id">Test Group</label>

                                <select class="form-control testgroup_select" name="test_group_id" id="test_group_id">

                                    <option value="" class="text-bold">Select Test Group</option>

                                    @forelse ($test_group as $tg)
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
                        <div class="col-md-6">
                            <div class="form-group  ">

                                <label for="has_method">Has Method</label>
                                <select class="form-control" name="has_method" id="has_method">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>


                            </div>
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
    $(document).ready(function() {
        $('.testgroup_select').select2();
    });
</script>