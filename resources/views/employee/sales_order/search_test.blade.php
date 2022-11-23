

 @if ($collections->count() > 0)
     <div id="searchPanel" class="searchPanel ">
         <div id="data-grid" class="data-tab-custom rounded">


             <div class="table-responsive">
                 <table id="table" class="table table-striped table-bordered ">
                     <thead>
                         <tr>
                             {{-- <th>ID</th> --}}
                             <th>Image</th>
                             <th>Name</th>
                             <th>Group / Under</th>
                             <th>Price</th>
                             <th class="text-center">Action</th>
                         </tr>
                     </thead>
                     <tbody data-aos="fade" data-aos-easing="linear" data-aos-duration="1000">

                         @foreach ($collections as $key => $data)
                             <tr>
                                 {{-- <td>{{ $data->id }}</td> --}}
                                 <td>
                                     @if ($data->is_package == 1)
                                         <span class="iconify" data-icon="tabler:package"
                                             style="color: rgba(18, 134, 180, 0.603);" data-width="50"
                                             data-height="50"></span>
                                     @else
                                         <span class="iconify" data-icon="twemoji:test-tube" style="color: #f22;"
                                             data-width="50" data-height="50" data-rotate="180deg"
                                             data-flip="horizontal,vertical"></span>
                                     @endif
                                 </td>
                                 <td>{{ $data->name }}</td>
                                 <td style="width:50%">
                                     @if ($data['test_group']['id'] > 0)
                                         <small> {{ $data['test_group']['name'] }} </small>
                                     @elseif ($data->is_package == 1)
                                         @foreach ($data->test_packages as $package)
                                             <small class="badge badge-outline-secondary">
                                                 {{ $package['test']['name'] }} </small>
                                         @endforeach
                                     @endif
                                 </td>
                                 <td>{{ $data->amount }}</td>
                                 <td class="text-right">
                                     @php
                                         $test_id_exists = array_key_exists($data->id, $cart);
                                     @endphp

                                     @if (!$test_id_exists)
                                         @if ($data->amount > 0)
                                             <a href="javascript:void(0)" data-test-id="{{ $data->id }}"
                                                 data-aos="flip-left"
                                                 class="btn btn-outline-primary add_to_order "><span class="iconify"
                                                     data-icon="carbon:calendar-add-alt" style="color: #7756a3;"
                                                     data-width="35" data-height="20" data-flip="vertical"></span></a>
                                         @endif
                                     @else
                                         <a href="javascript:void(0)" data-test-id="{{ $data->id }}"
                                             class="btn btn-outline-danger delete_from_order " data-aos="flip-right">
                                             <span class="iconify" data-icon="ep:document-delete"
                                                 style="color: rgb(233, 91, 91);" data-width="35" data-height="20"
                                                 data-rotate="180deg" data-flip="horizontal,vertical"></span>
                                         </a>
                                     @endif
                                     <a href="{{ route('admin.test.delete', $data->id) }}"
                                         class="btn btn-outline-info delete"><span class="iconify"
                                             data-icon="mdi:delete-sweep-outline" data-width="15"
                                             data-height="15"></span> Delete</a>
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
         <strong>No test found!</strong>
     </div>
 @endif

 <script>
     $(document).ready(function() {
         $('.add_to_order').click(function() {
             //alert('test');
             var id = $(this).data('test-id'); // get id from button's data-id attribute
             var url = "{{ route('employee.sales_order.add_to_order') }}";
             $.ajax({
                 url: url,
                 type: 'POST',
                 data: {
                     id: id,
                     _token: "{{ csrf_token() }}"
                 },
                 success: function(data) {
                     console.log(data);
                     search();
                     $('#item_count').html('No. of test: '+data.item_count);
                     // $('#searchPanel').hide();
                     // $('#orderPanel').show();
                 }
             });
         });

         $('.delete_from_order').click(function() {
             var id = $(this).data('test-id');
             //alert(id);
             var url = "{{ route('employee.sales_order.delete_from_order') }}";
             $.ajax({
                 url: url,
                 type: 'POST',
                 data: {
                     id: id,
                     _token: "{{ csrf_token() }}"
                 },
                 success: function(data) {
                     console.log(data);
                     search();
                     $('#item_count').html(data.item_count);
                     // $('#searchPanel').hide();
                     // $('#orderPanel').show();
                 }
             });
         });
     });
 </script>
