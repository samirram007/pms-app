@extends('layouts.main')
@section('content')

    <style link="https://use.fontawesome.com/releases/v5.8.1/css/all.css"></style>
    <style>
        .tab-content {
            border: 0;
            border-top: 0;
            padding: 2rem 1rem;
            text-align: justify;
        }

        .nav-tabs .nav-link {
            background: #3f678f2e;
            color: #546e70;
            border-radius: 0;
            border: 1px solid #CED4DA;
            padding: .75rem 1.5rem;
        }

        input[type="radio"] {
            margin-right: 5px
        }

        .bold {
            font-weight: bold
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-dark py-2">Pay Now </h4>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right border-0">
                            <li class="breadcrumb-item "><a href="{{ route('patient.dashboard') }}"
                                    class="text-active">Dashboard</a></li>
                            <li class="breadcrumb-item "><a
                                    href="{{ route('patient.sales_invoice.edit', $sales_invoice->id) }}"
                                    class="text-active">back to Preview</a></li>
                            <li class="breadcrumb-item active"> pay now</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            {{-- payment mode selection --}}

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card ">
                        <div class="card-header">
                            <div class="bg-white shadow-sm pt-1 pl-2 pr-2 pb-2">
                                <!-- Credit card form tabs -->
                                <div class="h6 px-1 text-right underline">CHOOSE PAYMENT MODE</div>
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div>
                                            <label for="">Invoice No. : {{ $sales_invoice->invoice_no }}</label>
                                        </div>
                                        <div>
                                            <label for="">Invoice Date :
                                                {{ date('d-M-Y', strtotime($sales_invoice->invoice_date)) }}</label>
                                        </div>


                                    </div>
                                    <div class="col-md-6 mx-auto text-right ">
                                        @php
                                            $sub_total = $sales_invoice['total_amount'];
                                            $discount = $sales_invoice['discount_amount'];
                                            $total = $sales_invoice['discounted_amount'];
                                            $total_due = $total - $sales_invoice['paid_amount'];
                                        @endphp
                                        <h4 class="text-right mb-2 d-flex justify-content-end px-2 text-success">
                                            <div>
                                                <span>Net Amount Payble <span>:</span></span>
                                                <span>₹ {{ number_format($total, 2, '.', '') }}</span>
                                            </div>
                                            <div>
                                                <span>Total Due <span>:</span></span>
                                                <span>₹ {{ number_format($total_due, 2, '.', '') }}</span>
                                            </div>
                                            <input id="total_due" name="total_due" type="hidden"
                                                value="{{ $total_due }}">
                                            <input id="sales_invoice_id" name="sales_invoice_id" type="hidden"
                                                value="{{ $sales_invoice->id }}">
                                        </h4>
                                        <hr>
                                    </div>
                                </div> <!-- End -->

                                <ul role="tablist" class="nav  nav-tabs  nav-fill ">
                                    @foreach ($payment_modes as $mode)
                                        @if ($mode->is_active)
                                            <li class="nav-item"> <a data-id={{ $mode->id }} href="javascript:"
                                                    class="nav-link payment-mode {{ $mode->id == 1 ? 'active' : '' }}  "> <i
                                                        class="fas fa-credit-card mr-2"></i>
                                                    {{ $mode->name }}</a> </li>
                                        @endif
                                    @endforeach
                                    {{-- <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                                    <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                                    <li class="nav-item"> <a data-toggle="pill" href="#net-banking" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Net Banking </a> </li> --}}
                                </ul>

                                <!-- Credit card form content -->
                                <div class="tab-content">
                                    <!-- credit card info-->
                                    @foreach ($payment_modes as $mode)
                                        @if ($mode->is_active)
                                            @if ($mode->id == 1)
                                                <div id="mode{{ $mode->id }}" data-aos="fade" data-aos-easing="linear"
                                                    data-aos-duration="1000"
                                                    class="aos-init aos-animate tab-pane  show active pt-3">

                                                    <form id="form{{ $mode->id }}" role="form"
                                                        onsubmit="event.preventDefault()">
                                                        @csrf
                                                        <input type="hidden" name="payment_mode_id"
                                                            id="payment_mode_id{{ $mode->id }}"
                                                            value="{{ $mode->id }}">
                                                        <div class="form-group">

                                                            <div id="card-element">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group"> <label for="username">
                                                                            <h6>Payer Name</h6>
                                                                        </label> <input type="text" name="payer_name"
                                                                            id="payer_name{{ $mode->id }}"
                                                                            placeholder="Payer Name" required
                                                                            value="{{ $sales_invoice['patient']['name'] }}"
                                                                            class="form-control ">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label><span class="hidden-xs">
                                                                                <h6>Current Receiving Amount</h6>
                                                                            </span> </label>
                                                                        <div class="input-group">


                                                                            <input type="hidden" name="card_umber"
                                                                                id="card_umber{{ $mode->id }}">
                                                                            <input type="hidden" name="tid"
                                                                                id="tid{{ $mode->id }}">
                                                                            <input type="hidden" name="transaction_number"
                                                                                id="transaction_number{{ $mode->id }}">
                                                                            <input type="number" placeholder="amount"
                                                                                name="amount"
                                                                                id="amount{{ $mode->id }}"
                                                                                value="{{ number_format(round($due_amount), 2, '.', '') }}"
                                                                                class="form-control" required>

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button class="btn btn-info pay "
                                                                            data-payment-mode="{{ $mode->id }}"
                                                                            type="button">Accept
                                                                            Payment</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Used to display form errors. -->
                                                            <div id="amount-errors" role="alert"></div>
                                                        </div>

                                                    </form>
                                                </div>
                                            @elseif(in_array($mode->id, [2, 3]))
                                                <div>Payment Mode: {{ $mode->name }}</div>
                                            @elseif(in_array($mode->id, [4, 5]))
                                                <div id="mode{{ $mode->id }}" class="tab-pane fade  pt-3">
                                                    <form id="form{{ $mode->id }}" role="form"
                                                        onsubmit="event.preventDefault()">
                                                        @csrf
                                                        <input type="hidden" name="payment_mode_id"
                                                            id="payment_mode_id{{ $mode->id }}"
                                                            value="{{ $mode->id }}">


                                                        <div class="row">

                                                            <div class="col-sm-6">
                                                                <div class="form-group"> <label for="username">
                                                                        <h6>Card Owner</h6>
                                                                    </label> <input type="text" name="payer_name"
                                                                        id="payer_name{{ $mode->id }}"
                                                                        placeholder="Card Owner Name" required
                                                                        value="{{ $sales_invoice['patient']['name'] }}"
                                                                        class="form-control ">

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group"> <label for="cardNumber">
                                                                        <h6>Card number</h6>
                                                                    </label>
                                                                    <div class="input-group">
                                                                        {{-- <div class="input-group-append"> Card number  </div> --}}
                                                                        <input type="text" name="card_number"
                                                                            id="card_number{{ $mode->id }}"
                                                                            placeholder="Valid card number"
                                                                            class="form-control " required>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group "> <label data-toggle="tooltip"
                                                                        title="TID Number">
                                                                        <h6>TID <i
                                                                                class="fa fa-question-circle d-inline"></i>
                                                                        </h6>
                                                                    </label> <input type="text" name="tid"
                                                                        id="tid{{ $mode->id }}" required
                                                                        class="form-control">

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group  "> <label data-toggle="tooltip"
                                                                        title="Bank Transaction No">
                                                                        <h6>Bank Transaction No<i
                                                                                class="fa fa-question-circle d-inline"></i>
                                                                        </h6>
                                                                    </label> <input type="text"
                                                                        name="transaction_number"
                                                                        id="transaction_number{{ $mode->id }}"
                                                                        required class="form-control">

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label><span class="hidden-xs">
                                                                            <h6>Current Receiving Amount</h6>
                                                                        </span> </label>
                                                                    <div class="input-group">

                                                                        <input type="number" placeholder="amount"
                                                                            name="amount" id="amount{{ $mode->id }}"
                                                                            value="{{ number_format(round($due_amount), 2, '.', '') }}"
                                                                            class="form-control" required>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="card-footer">
                                                            <button class="btn btn-info pay "
                                                                data-payment-mode="{{ $mode->id }}"
                                                                type="button">Confirm
                                                                Payment</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach

                                </div> <!-- End -->
                                <!-- Paypal info -->

                            </div> <!-- End -->

                        </div>
                    </div>
                </div>
            </div>
            {{-- payment mode selection --}}
        </section>
        <script>
            $(document).ready(function() {
                $('.payment-mode').click(function() {
                    var payment_mode_id = $(this).data('id');
                    console.log("#mode" + payment_mode_id);
                    $(".payment-mode.nav-link").removeClass("active");
                    $(this).addClass("active");
                    $(".tab-pane").removeClass("show active");
                    $("#mode" + payment_mode_id).addClass("show active");

                });
                $('.pay1').click(function() {
                    const url = "{{ route('patient.sales_invoice.pay') }}";

                    var payment_mode_id = $('#payment_mode_id').val();
                    var amount = $('#amount').val();
                    if (payment_mode_id == 1) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                payment_mode_id: payment_mode_id,
                                amount: amount,

                            },
                            success: function(data) {
                                console.log(data);
                                if (data.status == 'success') {
                                    window.location.href =
                                        "{{ route('patient.sales_invoice.index') }}";
                                }
                            }
                        });
                    }
                    // console.log("#mode" + payment_mode_id);

                });

                $('.pay').click(function() {
                    const url = "{{ route('patient.sales_invoice.pay') }}";
                    const link = "{{ route('patient.sales_invoice.index') }}";
                    var payment_mode_id = $(this).data('payment-mode');
                    var sales_invoice_id = $('#sales_invoice_id').val();
                    var amount = $('#amount' + payment_mode_id).val();
                    var payer_name = $('#payer_name' + payment_mode_id).val();
                    var card_number = $('#card_number' + payment_mode_id).val();
                    var tid = $('#tid' + payment_mode_id).val();
                    var transaction_number = $('#transaction_number' + payment_mode_id).val();

                    var total_due = $('#total_due').val();
                    // console.log(amount+":"+total_due);
                    if (amount == '') {
                        // alert("Amount is greater than total due");
                        Swal.fire({
                            title: 'Error',
                            text: 'Please Enter Amount',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return;
                    }
                    if (parseInt(amount) > parseInt(total_due)) {
                        // alert("Amount is greater than total due");
                        Swal.fire({
                            title: 'Error',
                            text: 'Amount is greater than total due',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return;
                    }

                    if (payment_mode_id == 4 || payment_mode_id == 5) {
                        if (payer_name.trim() == '') {
                            Swal.fire({
                                title: 'Please enter card owner name',
                                text: "Please enter card owner name",
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    return;

                                }
                            })

                            return;
                        }
                        if (card_number.trim() == '') {
                            Swal.fire({
                                title: 'Please enter card number',
                                text: "Please enter card number",
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    return;
                                }
                            })
                            return;
                        }
                        if (tid.trim() == '') {
                            Swal.fire({
                                title: 'Please enter TID number',
                                text: "Please enter TID number",
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    return;
                                }
                            })
                            return;
                        }
                        if (transaction_number.trim() == '') {
                            Swal.fire({
                                title: 'Please enter transaction number',
                                text: "Please enter transaction number",
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    return;
                                }
                            })
                            return;
                        }


                    }
                    //console.log(payment_mode_id);
                    Swal.fire({
                        title: 'Please press confirm button to confirm payment',
                        text: "Please press confirm button to confirm payment",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    sales_invoice_id: sales_invoice_id,
                                    payment_mode_id: payment_mode_id,
                                    amount: amount,
                                    payer_name: payer_name,
                                    card_number: card_number,
                                    tid: tid,
                                    transaction_number: transaction_number,

                                },
                                success: function(data) {
                                    console.log(data);
                                    if (data.status == 'success') {
                                        window.location.href = link;
                                    }



                                }
                            });
                        }
                    });


                    // console.log("#mode" + payment_mode_id);

                });
            });
        </script>
    </div>
@endsection
