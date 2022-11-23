@extends('layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Edit Package </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('admin.package.index') }}"
                                    class="text-active">Package
                                    List</a></li>
                            <li class="breadcrumb-item active"> Edit Package</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="rounded card p-3 bg-white shadow min-vh-100">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="{{ route('admin.package.update', $editData->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row   border-bottom pb-2 mb-2">
                                        <div class="col-sm-12 text-right">
                                            <button type="submit"
                                                class="load-popup float-right btn btn-rounded btn-outline-info ">
                                                <span class="iconify" data-icon="lucide:package-plus" data-width="15"
                                                    data-height="15"></span>
                                                </span> Save package</button>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Package Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $editData->name }}" placeholder="Enter Test Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Test Code</label>
                                                <input type="text" class="form-control" id="code" name="code"
                                                    value="{{ $editData->code }}" placeholder="Enter Test Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">Package Start Date</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date"
                                                    placeholder="Enter Start Date" value={{ $editData->start_date }}>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="end_date">Package Closing Date</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date"
                                                    placeholder="Enter End Date" value="{{ $editData->end_date }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Package Description</label>
                                                <textarea class="form-control" id="description" name="description" placeholder="Enter Test Description">{{ $editData->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 px-4  mt-4 border-bottom border-primary ">List of Test included
                                            in this
                                            package</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row  mt-0 pt-2">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="test">Select Test</label>
                                                        <div class="controls">

                                                            <select name="test" id="test" class="form-control test">
                                                                <option value="">Select test</option>
                                                                @foreach ($collection as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        data-amount="{{ $item->amount }}">
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                                {{-- @dd($item) --}}
                                                            </select>
                                                            @error('test')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-group">
                                                        <label for="test_cost">Amount</label>
                                                        <input type="text" class="form-control test_cost" id="test_cost"
                                                            name="test_cost" placeholder="Enter Package Amount">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-6 text-center m-auto  ">

                                                    <div class="text-center">
                                                        <span id="addtest" onclick="addtest();"
                                                            class=" btn btn-rounded btn-outline-info  p-0  ">
                                                            <span class="iconify" data-icon="akar-icons:circle-plus"
                                                                data-width="30" data-height="30"></span></span>


                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-12 border-bottom border-info my-1 px-4"></div>
                                            <div class="p-3" id="Testpanel">
                                                @php
                                                    $counter = 0;
                                                    $total_cost = 0;
                                                @endphp
                                                @foreach ($test_package as $pack)
                                                    @php
                                                        $total_cost += $pack['test']['cost'];
                                                    @endphp
                                                    {{-- @dd($pack['test']['cost']) --}}
                                                    <div class="row">
                                                        <div class="col-md-2 m-auto">{{ ++$counter }}</div>
                                                        <div class="col-md-4 m-auto">{{ $pack['test']['name'] }}</div>
                                                        <div class="col-md-4 m-auto testcost">{{ $pack['test']['cost'] }}
                                                        </div>
                                                        <input type="hidden" class="test_id" name="test_id[]"
                                                            value="{{ $pack->test_id }}">
                                                        <input type="hidden" class="test_amount" name="test_amount[]"
                                                            value="{{ $pack['test']['cost'] }}">
                                                        <input type="hidden" class="test_name" name="test_name[]"
                                                            value="{{ $pack['test']['name'] }}">
                                                        <input type="hidden" class="test_package_id"
                                                            name="test_package_id[]" value="{{ $pack->id }}">
                                                        <div class="col-md-2 text-center ">
                                                            <span
                                                                data-tpid="{{ route('admin.delete_test_package', $pack->id) }}"
                                                                class=" btn btn-outline-danger   p-0 cursor-pointer mx-auto  removetestpackage ">
                                                                <span class="iconify"
                                                                    data-icon="ant-design:minus-circle-outlined"
                                                                    data-width="15" data-height="15"></span>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-12 border-bottom border-info my-1"></div>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row border border-success   rounded p-3 bg-light">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cost">Cost</label>
                                                <input type="text" class="form-control" id="cost" name="cost"
                                                    placeholder="Enter Package Cost" value="{{ $editData->cost }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="discount">Discount(%)</label>
                                                <input type="text" class="form-control" id="discount"
                                                    name="discount" placeholder="Enter Package Discount"
                                                    value="{{ $editData->discount }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="text" class="form-control" id="amount" name="amount"
                                                    placeholder="Enter Package Amount" value="{{ $editData->amount }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row   border-top pt-2 mt-2">
                                        <div class="col-sm-12 text-right">
                                            <button type="submit"
                                                class="load-popup float-right btn btn-rounded btn-outline-info ">
                                                <span class="iconify" data-icon="lucide:package-plus" data-width="15"
                                                    data-height="15"></span>
                                                </span> Save package</button>

                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>

    </div>
    <script>
        var counter = 0;
        var totalcost_amount = 0;
        var cost_amount = 0;

        function addtest() {
            var test_id = $('#test').val();
            var test_cost = $('#test_cost').val();
            let discount = $('#discount').val();
            cost_amount += parseInt(test_cost);
            var test_name = $('#test option:selected').text();
            //alert(test_cost);
            if (test_id == '') {
                alert('Please select test');
                return false;
            }
            if (test_cost == '') {
                alert('Please enter amount');
                return false;
            }
            $("#Testpanel").append('<div class="row"> <div class="col-md-2 m-auto">' + ++counter +
                '</div> <div class="col-md-4 m-auto">' + test_name + '</div><div class="col-md-4 m-auto">' +
                test_cost + '</div>' +
                '<input type="hidden" class="test_id" name="test_id[]" value="' + test_id + '">' +
                '<input type="hidden" class="test_amount" name="test_amount[]" value="' + test_cost + '">' +
                '<input type="hidden" class="test_name" name="test_name[]" value="' + test_name + '">' +
                '<input type="hidden" class="test_package_id" name="test_package_id[]" value="">' +
                '<div class="col-md-2 text-center "><span class=" btn btn-outline-danger   p-0 cursor-pointer mx-auto  removetest">' +
                '<span class="iconify" data-icon="ant-design:minus-circle-outlined" data-width="15" data-height="15"></span></span></div>' +
                '<div class="col-md-12 border-bottom border-info my-1"></div></div>');

            $('#test option[value=' + test_id + ']').remove();
            $('#test').val('');
            $('#test_cost').val('');
            $('#cost').val(cost_amount);
            $('#amount').val(cost_amount - (cost_amount * discount) / 100);



        }

        function InitF() {
            var elm = document.querySelectorAll('.testcost');
            var elm_test_id = document.querySelectorAll('.test_id');

            for (var x = 0; x < elm.length; x++) {
                totalcost_amount += parseInt(elm[x].innerHTML);

                $('#test option[value=' + elm_test_id[x].value + ']').remove();
                ++counter;
            }
            $('#cost').val(totalcost_amount);
            var discount = $('#discount').val();

            //console.log(discount);
            var cost_amount = totalcost_amount;
            $('#amount').val((cost_amount - (cost_amount * discount) / 100).toFixed(2));
        }


        $(document).ready(function() {

            InitF();
            //delete_test_package

            $(function() {
                $(document).on('click', '.removetestpackage', function(e) {
                    e.preventDefault();
                    //var link = $(this).attr("href");
                    var link = $(this).data('tpid');
                    console.log(link);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = link
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                });
            });

            // $(document).on('click', '.removetestpackage', function() {
            //     //e.preventDefault();
            //     var url = $(this).data('tpid');
            //     console.log(url);
            //     $.ajax({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //         },
            //         url: url,
            //         method: 'get',
            //         success: function(result) {
            //             window.history.back();
            //             console.log(result);
            //         }
            //     });


            // });
            $(document).on("change", "#test", function() {
                var test_cost = $(this).find(':selected').data('amount');
                console.log(test_cost);

                $(this).closest('.row').find('.test_cost').val(test_cost);
            });
            //discount
            $(document).on("change keyup", "#discount", function() {
                var discount = $(this).val();
                var cost_amount = $('#cost').val();
                $('#amount').val((cost_amount - (cost_amount * discount) / 100).toFixed(2));
            });
            $(document).on("change keyup", "#amount", function() {
                var amount = $(this).val();
                var cost_amount = $('#cost').val();

                $('#discount').val(((cost_amount - amount) / cost_amount * 100).toFixed(2));
            });
            $(document).on("click", ".removetest", function() {
                var test_id = $(this).closest('.row').find('.test_id').val();
                var test_amount = $(this).closest('.row').find('.test_amount').val();
                var test_name = $(this).closest('.row').find('.test_name').val();
                $('#test').append('<option value="' + test_id + '" data-amount="' + test_amount + '">' +
                    test_name + '</option>');
                $(this).closest('.row').remove();
                counter--;
                cost_amount -= parseInt(test_amount);
                $('#cost').val(cost_amount);
                $('#amount').val(cost_amount - (cost_amount * discount) / 100);
            });






        });
    </script>
@endsection
