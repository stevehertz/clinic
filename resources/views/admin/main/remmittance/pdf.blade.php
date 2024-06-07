<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    <p>Generated on: {{ $date }}</p>
    <h2>Unique Code: {{ $unique_code }}</h2>
    <table>
        <thead>
            <tr>
                <th>Clinic</th>
                <th>Receipt Number</th>
                <th>Patient Names</th>
                <th>Phone Number</th>
                <th>Insurance</th>
                <th>Scheme Name</th>
                <th>Amount Billed</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($remmittances as $remmittance)
                <tr>
                    <td>{{ $remmittance->paymentBill->clinic->clinic }}</td>
                    <td>{{ $remmittance->paymentBill->appontment->lens_power->frame_prescription->receipt_number }}</td>
                    <td>{{ $remmittance->paymentBill->patient->first_name }}
                        {{ $remmittance->paymentBill->patient->last_name }}
                    </td>
                    <td>{{ $remmittance->paymentBill->patient->phone }}</td>
                    <td>
                        @if ($remmittance->paymentBill->payment_detail->insurance)
                            {{ $remmittance->paymentBill->payment_detail->insurance->title }}
                        @endif
                    </td>
                    <td>
                        @if ($remmittance->paymentBill->payment_detail)
                            {{ $remmittance->paymentBill->payment_detail->scheme }}
                        @endif
                    </td>
                    <td>
                        {{ $remmittance->paymentBill->paid_amount }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
