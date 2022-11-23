<div class="modal-dialog modal-lg   modal-dialog-centered ">
    <div class="modal-content bg-secondary">
        <div class="modal-header custom-bg-blue">
            <h4 class="modal-title">Cart View </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-light text-dark  ">
                            <thead>
                                <tr>
                                    <th>Test</th>
                                    <th>Department</th>
                                    <th class="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody id="search_result">
                                @if ($collections->count() > 0)

                                    @foreach ($collections as $collection)
                                    <tr>
                                        <th>{{ $collection->name }}</th>
                                        <th>  @if ($collection['test_group']['id'] > 0)
                                            <small>  {{ $collection['test_group']['name'] }}  </small>
                                        @elseif($collection->is_package == 1)
                                            <small>
                                                {{ 'Package : ' }}
                                            </small>
                                            @foreach ($collection->test_packages as $package)
                                                <small class="badge badge-outline-secondary">
                                                    {{ $package['test']['name'] }}
                                                </small>
                                            @endforeach
                                        @endif
</th>
                                        <th><div class=" text-right">
                                            @if ($collection->discount_amount != 0)
                                                ₹{{ number_format($collection->discounted_amount, 2, '.', '') }}
                                                <div class="cancel text-gray">
                                                    <em><small>₹{{ number_format($collection->amount, 2, '.', '') }}

                                            @else
                                                ₹{{ number_format($collection->amount, 2, '.', '') }}

                                            @endif

                                        </div></th>
                                    </tr>

                                    @endforeach

                                    <tr>
                                        <th colspan="2">
                                            <div class="form-group text-right d-flex justify-content-between">
                                                <label>Count : {{ $sales_order['item_count'] }}
                                                </label>


                                            </div>
                                        </th>
                                        <th class="text-right"> <label>Item Total : ₹
                                                {{ number_format($sales_order['total_amount'], 2, '.', '') }}
                                            </label></th>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="3"><a href="{{ route('employee.sales_order.create') }}"
                                                class=" ">
                                                <div class="alert alert-info w-100 d-flex justify-content-between">
                                                    <p> <span class="iconify" data-icon="ant-design:arrow-left-outlined"
                                                            style="color: rgb(34, 130, 255);" data-width="20"
                                                            data-height="20" data-rotate="180deg"
                                                            data-flip="horizontal,vertical"></span> Back to booking
                                                    </p><strong>No test selected!</strong>
                                                </div>
                                            </a></td>
                                    </tr>

                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
