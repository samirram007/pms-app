<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Payment Mode</h1>
            <button type="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route($save_route) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                <div class="card-body">
                    <div class="row   border-bottom pb-2 mb-2">

                        <div class="col-md-3 col-sm-6">

                            <div class="form-group">
                                {{-- <h5>Profile Image <span class="text-danger"></span></h5> --}}
                                <div class="">
                                    <input type="file" name="image" id="image" class="form-control d-none">
                                </div>
                                <div class="controls ">
                                    <img id="showImage" class="  "
                                        style="cursor:pointer;width: 80px; height:50px; border:1px solid #00000011;"
                                        src="{{  url('upload/no_image.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name </label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Enter  Name">
                            </div>
                        </div>


                        {{-- description --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="Enter Description">{{ old('description') }}</textarea>
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


<script type="text/javascript">
    $(document).ready(function() {
            $('#showImage').click(function() {
                $('#image').click();
            });
            $('#showAadhaarImage').click(function() {
                $('#aadhaar_image').click();
            });
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
        });
</script>