<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            header: page-header;
            footer: page-footer;
            margin: 5%;
            margin-top: 55mm;
            /* this affects the margin in the printer settings */
        }

        .pdf-table,
        .pdf-table-header {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        .pdf-table-header tr td:nth-child(3) {
            width: 300px;
        }

        .pdf-table td,
        #pdf-table th {
            border: none;
            padding: 8px;
            font-weight: normal;
        }

        /* .pdf-table tr:nth-child(even){background-color: #f2f2f2;} */

        .pdf-table tr th,
        .pdf-table tr td {
            border-bottom: 1px solid #222;
            padding: 2px;
        }

        .pdf-table tr th:nth-child(n+3) {
            text-align: center;
        }

        .pdf-table tr th:nth-child(n+5) {
            text-align: right;
        }

        .pdf-table tr th:nth-child(2) {
            width: 250px;
        }

        .pdf-table tr td:nth-child(n+3) {
            text-align: center;
        }

        .pdf-table tr td:nth-child(n+5) {
            text-align: right;
        }

        .pdf-table tr td:nth-child(n+7) {
            width: 150px;
        }

        .pdf-table tr td:nth-child(2) {
            width: 250px;
        }

        .pdf-table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #ffffff;
            color: rgb(34, 31, 31);
        }

        .pdf-table .border-none {
            border: none;
        }

        .pdf-table .border-left {
            border-left: 1px solid #222;
        }

        .pdf-table .border-top {
            border-top: 1px solid #222 !important;
        }

        .pdf-table .border-top-dark {
            border-top: 2px solid #222;

        }

        .cancel {
            text-decoration: line-through;
        }
    </style>
</head>

<body>

    <htmlpageheader name="page-header">
        {{-- @dd($sales_invoice) --}}
        <table class="pdf-table-header">
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
                <td>Gender</td>
                <td>:</td>
                <td> {{ $sales_invoice->patient->gender }}</td>
                <td>Booling Date</td>
                <td>:</td>
                <td>{{ date('d-m-Y H:s', strtotime($sales_invoice->created_at)) }}</td>
            </tr>
            <tr>
                <td>Age</td>
                <td>:</td>
                <td>{{ $sales_invoice->patient->age }}</td>
                <td>Contact No</td>
                <td>:</td>
                <td>{{ $sales_invoice->patient->contact_no }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td>{{ $sales_invoice->patient->address }}</td>
                <td>Ref. By</td>
                <td>:</td>
                <td>{{ $sales_invoice->referral_doctor->name }}</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center; font-weight:bold;"><u> {{ __('Money Receipt') }}</u></td>
            </tr>
        </table>

    </htmlpageheader>
    <div #scrollingContainer class="col-xxs-9 content-container" style="overflow-x: hidden;width:100%;">
        {{-- <table class="pdf-table">
            <tr style="font-weight: normal">
                <td>SL</td>
                <td>Test</td>
                <td>Test Date</td>
                <td>Rpt Date</td>
                <td>Rate(₹)</td>
                <td>Disc(%)</td>
                <td>Amount(₹)</td>
            </tr>

            @foreach ($sales_invoice_items as $key => $item)
                <tr class="page-break">
                    <td class="{{ $item->is_cancelled ? 'cancel' : '' }}">{{ $key + 1 }}</td>
                    <th class="{{ $item->is_cancelled ? 'cancel' : '' }}">{{ $item['test']['name'] }}</th>
                    <td class="{{ $item->is_cancelled ? 'cancel' : '' }}">{{ date('y-m-d', strtotime($item->test_date)) }}
                    </td>
                    <td class="{{ $item->is_cancelled ? 'cancel' : '' }}">
                        {{ date('y-m-d', strtotime($item->report_date)) }}</td>
                    <td class="{{ $item->is_cancelled ? 'cancel' : '' }}">{{ $item->test_cost }}</td>
                    <td class="{{ $item->is_cancelled ? 'cancel' : '' }}">{{ $item->discount }}</td>
                    <td class="{{ $item->is_cancelled ? 'cancel' : '' }}">{{ $item->amount }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align: right; font-weight:bold;">Total</td>
                <td>{{ $sales_invoice->total_amount }}</td>
            </tr>
        </table> --}}
        <table class="pdf-table">
            <tr style="font-weight: normal">
                <td>SL</td>
                <td>Test</td>
                <td>Test Date</td>
                <td>Rpt Date</td>
                <td>Rate(₹)</td>
                <td>Disc(%)</td>
                <td>Amount(₹)</td>
                {{-- <td>Action/Status</td> --}}
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
                    <td class="{{ $item->is_cancelled ? 'cancel' : '' }} text-right">
                        {{ $item->test_cost }}</td>
                    <td class="{{ $item->is_cancelled ? 'cancel' : '' }}  text-center">
                        {{ $item->discount_percentage == null ? 'n/a' : number_format($item->discount_percentage, 0, '.', '') . '%' }}
                    </td>
                    <td class="{{ $item->is_cancelled ? 'cancel' : '' }} text-right border-left">
                        {{ $item->amount }}</td>
                    {{-- <td>
                        @if ($item->is_cancelled)
                            @php
                                $sales_returnable += $item->amount;
                            @endphp
                            <span class="badge badge-danger">Cancelled...</span>
                        @else
                            <a href="{{ route('employee.sales_invoice.test_delete', $item->id) }}"
                                class="badge badge-outline-secondary item-delete">
                                <span class="iconify" data-icon="ep:document-remove" color="#dd5500" data-width="15"
                                    data-height="15"></span> remove</a>
                        @endif
                    </td> --}}
                </tr>
            @endforeach
            <tr class="border-top-dark">
                <th colspan="6" style="text-align: right; font-weight:bold;">Sub
                    Total : </th>
                <th class=" text-right  border-left">
                    {{ $sales_invoice->item_total }}</th>
                {{-- <th> </th> --}}
            </tr>
            @if ($sales_invoice->discount_type_id != 0)
                <tr class="border-none">
                    <td colspan="6" style="text-align: right; font-weight:bold;">
                        Discount [{{ $sales_invoice['discount_type']['name'] }}] :
                    </td>
                    <td class=" text-right  border-left">
                        {{ $sales_invoice->discount_amount }}</td>
                    {{-- <td> </td> --}}
                </tr>
            @endif
            @php
                $is_ready = true;
            @endphp
            <tr style="border-bottom:none;">
                <td colspan="6" style="text-align: right; font-weight:bold; border-bottom:none;">Net : </td>
                <td class=" text-right  border-left  border-top"
                    style="border-bottom:2px solid #222;border-top:2px solid #222;">
                    {{ $sales_invoice->total_amount }}
                </td>
                {{-- <td> </td> --}}
            </tr>
            @foreach ($sales_invoice_payments as $key => $payment)
                <tr class="border-none">
                    <td colspan="6" style="text-align: right; font-weight:bold;">
                        {{ __('Paid via ') }}{{ $payment['payment_mode']['name'] }}
                        {{ __('on') }}
                        {{ date('d-M-y', strtotime($payment->payment_date)) }} :
                    </td>
                    <td class=" text-right  border-left  border-top-dark">
                        {{ $payment->amount }}</td>
                    {{-- <td> </td> --}}
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
                    {{-- <td><span class="badge badge-success"> Initiated </span>
                    </td> --}}
                </tr>
            @endif
            @if ($sales_returnable != 0)
                @if (empty($sales_return[0]) || $sales_return[0]->amount != $sales_returnable)
                    @php
                        $is_ready = false;
                    @endphp
                    <tr class="border-none">
                        <td colspan="6" style="text-align: right; font-weight:bold;">
                            Returnable: </td>
                        <td class=" text-right  border-left">
                            {{ number_format($sales_returnable, 2, '.', '') }}</td>
                        {{-- <td> <a href="{{ route('employee.sales_invoice.return_initiate', $sales_invoice->id) }}"
                                class="badge badge-outline-info   item-delete">
                                <span class="iconify" data-icon="ep:document-remove" color="#005588" data-width="15"
                                    data-height="15"></span> Initiate</a>
                        </td> --}}
                    </tr>
                @endif
            @endif
            @if ($is_ready)
                @if ($due_amount > 0)
                    <tr class="border-none">
                        <td colspan="6" style="text-align: right; font-weight:bold;">
                            Due : </td>
                        <td class=" text-right  border-left">
                            {{ number_format(abs($due_amount), 2, '.', '') }}
                        </td>
                        {{-- <td>
                            <a href="{{ route('employee.sales_invoice.pay_now', $sales_invoice->id) }}"
                                class="badge badge-outline-info   pay_now">
                                <span class="iconify" data-icon="ep:document-remove" color="#005588" data-width="15"
                                    data-height="15"></span> Receive Payment</a>
                        </td> --}}
                    </tr>
                @elseif($due_amount < 0)
                    <tr>
                        <td colspan="6" style="text-align: right; font-weight:bold;">
                            overdue : </td>
                        <td class=" text-right  border-left">
                            {{ number_format(abs($current_due_amount), 2, '.', '') }}
                        </td>

                    </tr>
                @else
                    @foreach ($sales_payback as $key => $payback)
                        <tr class="border-none">
                            <td colspan="6" style="text-align: right; font-weight:bold;">
                                {{ __('Return ') }}
                                {{ __('on') }}
                                {{ date('d-M-y', strtotime($payback->sales_payback_date)) }}
                                :
                            </td>
                            <td class=" text-right  border-left  border-top">
                                {{ number_format($payback->amount, 2, '.', '') }}
                            </td>
                            {{-- <td> </td> --}}
                        </tr>
                    @endforeach
                @endif
            @endif


            <tr>
                <td colspan="6">
                    {{ Terbilang::make($sales_invoice->total_amount, ' only', 'Rupees ') }}
                </td>
                <td class=" text-right  border-left  border-top">
                    @if ($due_amount == 0)
                        Fully Paid
                    @endif
                </td>
            </tr>
        </table>
    </div>


    {{-- @dd($details) --}}

    <br>

    <htmlpagefooter name="page-footer">
        <i style="font-size: 10px; float:right;">Print Data:{{ date('d M Y') }}</i>
    </htmlpagefooter>
</body>

</html>
