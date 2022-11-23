

    <table id="invoice_header" class="pdf-table-header">
    <tbody>
        <tr>
            <td colspan="6" style="padding: 2cm;"></td>
        </tr>
        <tr>
        <td>Booking No.</td>
        <td>:</td>
        <td id="booking_id">{{$test_queue['sales_invoice']['invoice_no']}}</td>
        <td>Booking Date</td>
        <td>:</td>
        <td id="booking_date">{{date('d-m-Y',strtotime($test_queue['sales_invoice']['invoice_date']))}}</td>
    </tr>
    <tr>
        <td>Patient</td>
        <td>:</td>
        <td id="patient_name">{{$test_queue['patient']['name']}}</td>
        <td>age</td>
        <td>:</td>
        <td id="patient_age">{{$test_queue['sales_invoice']['age']}}</td>
    </tr>
        <tr>
        <td>Address</td>
        <td>:</td>
        <td id="patient_address">{{$test_queue['patient']['address']}}</td>
        <td>Sex</td>
        <td>:</td>
        <td id="patient_gender">{{$test_queue['patient']['gender']}}</td>
    </tr>

        <tr>
        <td>Ref. Doctor</td>
        <td>:</td>
        <td id="referral_doctor">{{$test_queue['sales_invoice']['referral_doctor']['name']}}</td>
        <td>Reporting Time</td>
        <td>:</td>
        <td id="reporting_time">{{date('d-m-Y H:i')}}</td>
    </tr>
</tbody></table>
