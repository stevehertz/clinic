<table>
    <thead>
        <tr>
            <th>Clinic</th>
            <th>Patient Names</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Next of Kin</th>
            <th>Next of Kin Contacts</th>
            <th>Appointment Date</th>
            <th>Client Type</th>
            <th>Scheduled Date</th>
            <th>Doctor</th>
            <th>Signs</th>
            <th>Symptoms</th>
            <th>Diagnosis</th>
            <th>Right Sphere</th>
            <th>Right Cylinder</th>
            <th>Right Axis</th>
            <th>Right Add</th>
            <th>Left Sphere</th>
            <th>Left Cylinder</th>
            <th>Left Axis</th>
            <th>Left Add</th>
            <th>Notes</th>
            <th>Index</th>
            <th>Tint</th>
            <th>Diameter</th>
            <th>Focal Height</th>
            <th>Receipt Number</th>
            <th>Frame Code</th>
            <th>Bill Open Date</th>
            <th>Consultation Fee</th>
            <th>Consultation Receipt Number</th>
            <th>Bill Status</th>
            <th>Claimed Amount</th>
            <th>Agreed Amount</th>
            <th>Paid Amount</th>
            <th>Balance</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Workshop</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reports as $report)
            <tr>
                <td>{{ $report->clinic->clinic }}</td>
                <td>{{ $report->patient->first_name }} {{ $report->patient->last_name }}</td>
                <td>{{ $report->patient->phone }}</td>
                <td>{{ $report->patient->email }}</td>
                <td>{{ date('d-M-Y', strtotime($report->patient->dob))}}</td>
                <td>{{ $report->patient->gender }}</td>
                <td>{{ $report->patient->address }}</td>
                <td>{{ $report->patient->next_of_kin }}</td>
                <td>{{ $report->patient->next_of_kin_contact }}</td>
                <td>{{ date('d-M-Y', strtotime($report->appointment_date)) }}</td>
                <td>{{ $report->payment_detail->client_type->type }}</td>
                <td>
                    @if ($report->doctor_schedule)
                        {{ date('d-M-Y', strtotime($report->doctor_schedule->date)) }}
                    @endif
                </td>
                <td>
                    @if ($report->doctor_schedule)
                        {{ $report->doctor_schedule->user->first_name }}
                        {{ $report->doctor_schedule->user->last_name }}
                    @endif
                </td>
                <td>
                    @if ($report->diagnosis)
                        {{ $report->diagnosis->signs }}
                    @endif
                </td>
                <td>
                    @if ($report->diagnosis)
                        {{ $report->diagnosis->symptoms }}
                    @endif
                </td>
                <td>
                    @if ($report->diagnosis)
                        {{ $report->diagnosis->diagnosis }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_power)
                        {{ $report->lens_power->right_sphere }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_power)
                        {{ $report->lens_power->right_cylinder }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_power)
                        {{ $report->lens_power->right_axis }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_power)
                        {{ $report->lens_power->right_add }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_power)
                        {{ $report->lens_power->left_sphere }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_power)
                        {{ $report->lens_power->left_cylinder }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_power)
                        {{ $report->lens_power->left_axis }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_power)
                        {{ $report->lens_power->left_add }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_power)
                        {{ $report->lens_power->notes }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_prescription)
                        {{ $report->lens_prescription->index }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_prescription)
                        {{ $report->lens_prescription->tint }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_prescription)
                        {{ $report->lens_prescription->diameter }}
                    @endif
                </td>
                <td>
                    @if ($report->lens_prescription)
                        {{ $report->lens_prescription->focal_height }}
                    @endif
                </td>
                <td>
                    @if ($report->frame_prescription)
                        {{ $report->frame_prescription->receipt_number }}
                    @endif
                </td>
                <td>
                    @if ($report->frame_prescription)
                        {{ $report->frame_prescription->frame_code }}
                    @endif
                </td>
                <td>
                    @if ($report->payment_bill)
                        {{ date('d-M-Y', strtotime($report->payment_bill->open_date)) }}
                    @endif
                </td>
                <td>
                    {{ $report->consultation_fee }}
                </td>
                <td>
                    @if ($report->payment_bill)
                        {{ $report->payment_bill->consultation_receipt_number }}
                    @endif
                </td>
                <td>
                    @if ($report->payment_bill)
                        {{ $report->payment_bill->bill_status }}
                    @endif
                </td>
                <td>
                    {{ $report->claimed_amount }}
                </td>
                <td>
                    {{ $report->agreed_amount }}
                </td>
                <td>
                    {{ $report->paid_amount }}
                </td>
                <td>
                    {{ $report->balance }}
                </td>
                <td>
                    @if ($report->order)
                        {{ date('d-M-Y', strtotime($report->order->order_date)) }}
                    @endif
                </td>
                <td>
                    @if ($report->order)
                        {{ $report->order->status }}
                    @endif
                </td>
                <td>
                    @if ($report->order)
                        {{ $report->order->workshop->name }}
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="43">
                    No Reports Found
                </td>
            </tr>
        @endforelse
        <tr></tr>
    </tbody>
</table>
