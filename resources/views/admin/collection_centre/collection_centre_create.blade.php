<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Collection Centre</h1>
            <button type="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.collection_centre.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3 col-sm-6">

                            <div class="form-group">
                                {{-- <h5>Profile Image <span class="text-danger"></span></h5> --}}
                                <div class="">
                                    <input type="file" name="image" id="image" class="form-control d-none">
                                </div>
                                <div class="controls ">
                                    <img id="showImage" class=" rounded-circle"
                                        style="cursor:pointer;width: 75px; height:75px; border:1px solid #000000;"
                                        src="{{  url('upload/no_image.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Collection Centre Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                    placeholder="Enter Collection Centre Name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Collection Centre Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{old('code')}}"
                                    placeholder="Enter Test Code">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date_of_foundation">Date of Foundation</label>
                                <input type="date" class="form-control" id="date_of_foundation"
                                    name="date_of_foundation" value="{{ date('Y-m-d', strtotime('-20 years')) }}"
                                    placeholder="Enter Date of birth">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lab_centre_id">Lab Centre</label>
                                <select class="form-control " name="lab_centre_id" id="lab_centre_id">
                                    <option value="" class="text-bold">Select Lab Centre</option>
                                    @forelse ($lab_centre as $tg)
                                    <option value="{{ $tg['id'] }}">
                                        {{ $tg['name'] }}
                                    </option>
                                    @empty
                                    <option value="">No record found </option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="license_no">License No</label>
                                <input type="text" class="form-control" id="license_no" name="license_no"
                                    value="{{old('license_no')}}" placeholder="Enter License No">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{old('email')}}" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_no">Mobile no</label>
                                <input type="text" size="10" class="form-control" id="contact_no" name="contact_no"
                                    value="{{old('contact_no')}}" placeholder="Enter Mobile no">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address"
                                    placeholder="Enter Address">{{old('address')}}</textarea>
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