@extends('layouts.main')
@section('content')


    <style>
        .cancel {
            color: rgb(160, 154, 154);
            text-decoration: line-through;
            text-decoration-color: #a61500;
        }

        .border-none td {
            border: none;
        }

        .border-top-dark td,
        .border-top-dark th {
            border-top: 4px solid rgb(197, 195, 195);
        }
    </style>
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid bootdey">
                <div class="row invoice row-printable">
                    <div class="col-md-10">
                        <!-- col-lg-12 start here -->
                        <div class="panel panel-default plain" id="dash_0">
                            <!-- Start .panel -->
                            <div class="panel-body p30">

                                <!-- Start .row -->

                                <!-- col-lg-6 end here -->

                                <!-- col-lg-6 end here -->
                                <div class="col-lg-12">
                                    <!-- col-lg-12 start here -->

                                    <div class="invoice-to mt25">
                                        <div class="row">
                                            <table class="table">
                                                <tr>
                                                    <td colspan="6" style="padding: 35px;"></td>
                                                </tr>
                                                <tr>
                                                    <td>Patient</td>
                                                    <td>:</td>
                                                    <td>{{ $sales_invoice->patient->name }}</td>
                                                    <td>Booking Id</td>
                                                    <td>:</td>
                                                    <td>{{ $sales_invoice->invoice_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gender : {{ $sales_invoice->patient->gender }}</td>
                                                    <td colspan="2"> Age : {{ $sales_invoice->patient->age }}</td>
                                                    <td>Booling Date</td>
                                                    <td>:</td>
                                                    <td>{{ date('d-m-Y H:i', strtotime($sales_invoice->created_at)) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td>:</td>
                                                    <td>{{ $sales_invoice->patient->address }}</td>
                                                    <td>Contact No</td>
                                                    <td>:</td>
                                                    <td>{{ $sales_invoice->patient->contact_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ref. By</td>
                                                    <td>:</td>
                                                    <td colspan="4">{{ $sales_invoice->referral_doctor->name }}</td>
                                                </tr>

                                            </table>
                                        </div>

                                    </div>
                                    <div class="invoice-items mt-4">
                                        <div class="table-responsive" style="overflow: hidden; outline: none;"
                                            tabindex="0">

                                            <div #scrollingContainer class="col-xxs-9 content-container"
                                                style="overflow-x: hidden;width:100%;">
                                                <table class="table">
                                                    <tr class="bg-dark text-light" style="font-weight: normal">
                                                        <td>SL</td>
                                                        <td>Test</td>
                                                        <td>Test Date</td>
                                                        <td>Rpt Date</td>
                                                        <td>Rate(₹)</td>
                                                        <td>Disc(%)</td>
                                                        <td>Amount(₹)</td>
                                                        <td>Action/Status</td>
                                                    </tr>
                                                    {{-- @dd($sales_invoice_items) --}}
                                                    @php
                                                        $i = 1;
                                                        $total = 0;
                                                        $discount = 0;
                                                        $net_amount = 0;
                                                        $sales_returnable = 0;
                                                    @endphp
                                                    @foreach ($sales_invoice_items as $key => $item)
                                                        <tr class="page-break">
                                                            <td class="{{ $item->is_cancelled ? 'cancel' : '' }}">
                                                                {{ $key + 1 }}</td>
                                                            <th class="{{ $item->is_cancelled ? 'cancel' : '' }}">
                                                                {{ $item['test']['name'] }}</th>
                                                            <td class="{{ $item->is_cancelled ? 'cancel' : '' }}">
                                                                {{ date('y-m-d', strtotime($item->test_date)) }}</td>
                                                            <td class="{{ $item->is_cancelled ? 'cancel' : '' }}">
                                                                {{ date('y-m-d', strtotime($item->report_date)) }}</td>
                                                            <td
                                                                class="{{ $item->is_cancelled ? 'cancel' : '' }} text-right">
                                                                {{ $item->test_cost }}</td>
                                                            <td
                                                                class="{{ $item->is_cancelled ? 'cancel' : '' }}  text-center">
                                                                {{ $item->discount_percentage == null ? 'n/a' : number_format($item->discount_percentage, 0, '.', '') . '%' }}
                                                            </td>
                                                            <td
                                                                class="{{ $item->is_cancelled ? 'cancel' : '' }} text-right border-left">
                                                                {{ $item->amount }}</td>
                                                            <td>
                                                                @if ($item->is_cancelled)
                                                                    @php
                                                                        $sales_returnable += $item->amount;
                                                                    @endphp
                                                                    <span class="badge badge-danger">Cancelled...</span>
                                                                @else
                                                                    <a href="{{ route('employee.sales_invoice.test_delete', $item->id) }}"
                                                                        class="badge badge-outline-secondary item-delete">
                                                                        <span class="iconify" data-icon="ep:document-remove"
                                                                            color="#dd5500" data-width="15"
                                                                            data-height="15"></span> remove</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr class="border-top-dark">
                                                        <th colspan="6" style="text-align: right; font-weight:bold;">Sub
                                                            Total : </th>
                                                        <th class=" text-right  border-left">
                                                            {{ $sales_invoice->item_total }}</th>
                                                        <th> </th>
                                                    </tr>
                                                    @if ($sales_invoice->discount_type_id != 0)
                                                        <tr class="border-none">
                                                            <td colspan="6" style="text-align: right; font-weight:bold;">
                                                                Discount [{{ $sales_invoice['discount_type']['name'] }}] :
                                                            </td>
                                                            <td class=" text-right  border-left">
                                                                {{ $sales_invoice->discount_amount }}</td>
                                                            <td> </td>
                                                        </tr>
                                                    @endif
                                                    @php
                                                    $is_ready = true;
                                                    @endphp
                                                    <tr class="border-none">
                                                        <td colspan="6" style="text-align: right; font-weight:bold;">Net
                                                            payble: </td>
                                                        <td class=" text-right  border-left  border-top">
                                                            {{ $sales_invoice->total_amount }}</td>
                                                        <td> </td>
                                                    </tr>
                                                    @foreach ($sales_invoice_payments as $key => $payment)
                                                        <tr class="border-none">
                                                            <td colspan="6" style="text-align: right; font-weight:bold;">
                                                                {{ __('Received via ') }}{{ $payment['payment_mode']['name'] }}
                                                                {{ __('on') }}
                                                                {{ date('d-M-y', strtotime($payment->payment_date)) }} :
                                                            </td>
                                                            <td class=" text-right  border-left  border-top">
                                                                {{ $payment->amount }}</td>
                                                            <td> </td>
                                                        </tr>
                                                    @endforeach
                                                    {{-- @dd(empty($sales_return[0]) ?'null':$sales_return->amount) --}}

                                                    @if (!empty($sales_return[0]) && $sales_return[0]->amount - $sales_returnable == 0)
                                                        @php
                                                            $is_ready = true;
                                                        @endphp
                                                        <tr class="border-none">
                                                            <td colspan="6" style="text-align: right; font-weight:bold;">
                                                                Return: </td>
                                                            <td class=" text-right  border-left">
                                                                {{ number_format($sales_return[0]->amount, 2, '.', '') }}
                                                            </td>
                                                            <td><span class="badge badge-success"> Initiated </span>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @if ($sales_returnable != 0)
                                                        @if (empty($sales_return[0]) || $sales_return[0]->amount != $sales_returnable)
                                                            @php
                                                                $is_ready = false;
                                                            @endphp
                                                            <tr class="border-none">
                                                                <td colspan="6"
                                                                    style="text-align: right; font-weight:bold;">
                                                                    Returnable: </td>
                                                                <td class=" text-right  border-left">
                                                                    {{ number_format($sales_returnable, 2, '.', '') }}</td>
                                                                <td> <a href="{{ route('employee.sales_invoice.return_initiate', $sales_invoice->id) }}"
                                                                        class="badge badge-outline-info   item-delete">
                                                                        <span class="iconify" data-icon="ep:document-remove"
                                                                            color="#005588" data-width="15"
                                                                            data-height="15"></span> Initiate</a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                    @if ($is_ready)
                                                        @if ($due_amount > 0)
                                                            <tr class="border-none">
                                                                <td colspan="6"
                                                                    style="text-align: right; font-weight:bold;">
                                                                    due receivable: </td>
                                                                <td class=" text-right  border-left">
                                                                    {{ number_format(abs($due_amount), 2, '.', '') }}
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('employee.sales_invoice.pay_now', $sales_invoice->id) }}"
                                                                        class="badge badge-outline-info   pay_now">
                                                                        <span class="iconify" data-icon="ep:document-remove"
                                                                            color="#005588" data-width="15"
                                                                            data-height="15"></span> Receive Payment</a>
                                                                </td>
                                                            </tr>
                                                        @elseif($due_amount < 0)
                                                            <tr>
                                                                <td colspan="6"
                                                                    style="text-align: right; font-weight:bold;">
                                                                    overdue payble: </td>
                                                                <td class=" text-right  border-left">
                                                                    {{ number_format(abs($current_due_amount), 2, '.', '') }}
                                                                </td>
                                                                <td>
                                                                    <form
                                                                        action="{{ route('employee.sales_invoice.payback', $sales_invoice->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="payback_amount"
                                                                            id="payback_amount"
                                                                            value="{{ abs($current_due_amount) }}">
                                                                        <button type="submit" class="badge badge-warning">
                                                                            <span class="iconify"
                                                                                data-icon="ep:document-remove"
                                                                                color="#005588" data-width="15"
                                                                                data-height="15"></span> Payback
                                                                        </button>


                                                                    </form>

                                                                </td>
                                                            </tr>
                                                        @else
                                                            @foreach ($sales_payback as $key => $payback)
                                                                <tr class="border-none">
                                                                    <td colspan="6"
                                                                        style="text-align: right; font-weight:bold;">
                                                                        {{ __('Over due paid via Cash ') }}
                                                                        {{ __('on') }}
                                                                        {{ date('d-M-y', strtotime($payback->sales_payback_date)) }}
                                                                        :
                                                                    </td>
                                                                    <td class=" text-right  border-left  border-top">
                                                                        {{ number_format($payback->amount, 2, '.', '') }}
                                                                    </td>
                                                                    <td> </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif


                                                    <tr>
                                                        <td colspan="8">
                                                            {{ Terbilang::make($sales_invoice->total_amount, ' only', 'Rupees ') }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="invoice-footer mt-4">
                                        <p class="text-center">Generated on {{ date('d M Y') }}<a target="_blank"
                                                href="{{ route('employee.money_receipt', Crypt::encryptString($sales_invoice->id)) }}"
                                                class="btn btn-link ml-4"><span class="iconify" data-icon="cil:print"
                                                    data-width="15" data-height="15"></span> Print</a></p>
                                    </div>
                                </div>
                                <!-- col-lg-12 end here -->

                                <!-- End .row -->
                            </div>
                        </div>
                        <!-- End .panel -->
                    </div>
                    <!-- col-lg-12 end here -->
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
