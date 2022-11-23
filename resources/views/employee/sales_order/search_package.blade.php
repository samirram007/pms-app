


@if($collections->count() > 0)
                <div id="searchPanel" class="searchPanel"  >
                    <div id="data-grid" class="data-tab-custom rounded">


                        <div class="table-responsive">
                            <table id="table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Test(s)</th>
                                        <th>Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody data-aos="fade"
                                data-aos-easing="linear"
                                data-aos-duration="1000">
                                    @foreach ($collections as $key=> $data)
                                     @php
                                         $tests = '';
                                         $a=1;
                                     @endphp
                                    @foreach($data['test_package'] as $test)
                                        @php
                                            $tests .=$a++.'. '.$test['test']['name'].'<br>';
                                        @endphp

                                    @endforeach

                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->amount }}</td>
                                            <td>{!! $tests !!}</td>
                                            <td class="text-wrap text-truncate">{{ $data->description }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('admin.package.show', $data->id) }}"
                                                    class="btn btn-outline-info"> <span class="iconify" data-icon="mdi:view-dashboard" data-width="15" data-height="15" data-rotate="180deg"></span> View</a>

                                                <a href="{{ route('admin.package.edit', $data->id) }}"
                                                    class="btn btn-outline-info"><span class="iconify" data-icon="mdi:circle-edit-outline" data-width="15" data-height="15"></span> Edit</a>
                                                <a href="{{ route('admin.package.delete', $data->id) }}"
                                                    class="btn btn-outline-info delete"><span class="iconify" data-icon="mdi:delete-sweep-outline" data-width="15" data-height="15"></span> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
@else
    <div class="alert alert-info w-100">
        <strong>No package found!</strong>
    </div>
@endif


