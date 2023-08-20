<table>
    <thead>
        <tr>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Clinic</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Open Date</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Patient Names</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Client Type</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Insurance</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Scheme</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Insurande Card Number</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Consultation Fee</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Consultation Receipt Number</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Invoice Number</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">LPO Number</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Approval Number</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Approval Status</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Bill Status</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Claimed Amount</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Agreed Amount</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Total Amount</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Paid Amount</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Balance Amount</th>
            <th style="background-color: #FFFF00; font-size:14px; padding:10px;">Closed Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reports as $report)
            <tr>
                <td>{{ $report->clinic->clinic }}</td>
                <td>{{ date('d F Y', strtotime($report->open_date)) }}</td>
                <td>
                    {{ $report->patient->first_name }} {{ $report->patient->last_name }}
                </td>
                <td>
                    {{ $report->payment_detail->client_type->type }}
                </td>
                <td>
                    @if ($report->payment_detail->insurance)
                        {{ $report->payment_detail->insurance->title }}
                    @endif
                </td>
                <td>
                    @if ($report->payment_detail->client_type->type == 'Insurance')
                        {{ $report->payment_detail->scheme }}
                    @endif
                </td>
                <td>
                    @if ($report->payment_detail->client_type->type == 'Insurance')
                        {{ $report->payment_detail->card_number }}
                    @endif
                </td>
                <td>
                    {{ $report->consultation_fee }}
                </td>
                <td>
                    {{ $report->consultation_receipt_number }}
                </td>
                <td>
                    {{ $report->invoice_number }}
                </td>
                <td>
                    {{ $report->lpo_number }}
                </td>
                <td>
                    {{ $report->approval_number }}
                </td>
                <td>
                    {{ $report->approval_status }}
                </td>
                <td>
                    {{ $report->bill_status }}
                </td>
                <td>
                    {{ $report->claimed_amount }}
                </td>
                <td>
                    {{ $report->agreed_amount }}
                </td>
                <td>
                    {{ $report->total_amount }}
                </td>
                <td>
                    {{ $report->paid_amount }}
                </td>
                <td>
                    {{ $report->balance }}
                </td>
                <td>
                    @if ($report->close_date)
                        {{ date('d F Y', strtotime($report->close_date)) }}
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="20">
                    No payments made to be reported
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
