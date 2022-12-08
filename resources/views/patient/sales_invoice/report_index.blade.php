<div class="modal-dialog modal-md  modal-dialog-centered ">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <div class="modal-content bg-info">
        <div class="modal-header">
            <h4 class="modal-title text-light">{{ __('Test Report') }} </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{-- @dd(count($test_report)) --}}

        <div class="modal-body bg-light p-0" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1000">
            <div class=" w-100  ">


                <section class="content">
                    <div class="rounded card p-3 bg-white shadow min-h-100">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Test</th>
                                    <th class="text-center ">Status</th>
                                    <th>Report File</th>
                                </tr>
                            </thead>
                            <tbody>
                        @forelse($test_report as $data)
                        <tr id="queue{{ $data->id }}">
                            <td>{{ $data['test']['name'] }}</td>
                            <td class="text-center " style="overflow: inherit;">
                                @php
                                    if ($data->status == 'pending') {
                                        $status_color = 'warning';
                                    } elseif ($data->status == 'inprogress') {
                                        $status_color = 'info';
                                    } elseif ($data->status == 'completed') {
                                        $status_color = 'success';
                                    } elseif ($data->status == 'cancelled') {
                                        $status_color = 'danger';
                                    }
                                    elseif($data->status == 'delivered'){
                                        $status_color = 'dark';
                                    }
                                @endphp
                                <div class="dropdown d-inline-flex">
                                    <button class="btn btn-outline-link "> <span
                                            class="badge badge-{{ $status_color }}">{{ ucfirst($data->status) }}</span></button>

                                </div>
                            </td>
                            <td>
                                {{-- @dd($data['report_file1']) --}}
                                @if ($data['report_file1'] &&  in_array($data->status,['delivered']))
                                    <a class="badge badge-info" href="{{ asset('uploads/test_queue/' . $data['report_file1']) }}"
                                        target="_blank">Download</a>
                                @else
                                    @if ($data->code != null || $data->code != '')
                                        @if(in_array($data->status,['delivered']))
                                            <a target="_blank" class="badge badge-info"
                                                href="{{ route('employee.test_queue.getpdf', $data->id) }}">Download</a>
                                        @else
                                            <span class="badge badge-danger">Ready</span>
                                        @endif
                                    @else

                                            <span class="badge badge-danger">Pending</span>

                                    @endif
                                @endif


                            </td>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                    </div>
                </section>
            </div>
        </div>
        <div class="modal-footer bg-light d-none ">

            <div class="col-12">
                <div class="row text-center">


                    <div class="col-md-6 mx-auto">
                        {{-- <button type="button" data-id={{$employee->id}} class="change_pass btn btn-outline-info px-4">
                                 {{ __('Save') }}</button> --}}

                    </div>
                    <div class="col-md-6 mx-auto">
                        <button type="button" class=" btn btn-outline-danger px-4" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>

            {{-- <input type="submit" class="btn btn-outline-white btn-info px-4" value="Save"> --}}



        </div>

    </div>



    <script>
        $(document).ready(function() {

        });
    </script>

</div>
