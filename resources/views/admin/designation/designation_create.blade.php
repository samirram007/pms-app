<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Designation</h1>
            <button type="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.designation.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Designation </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Designation">
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