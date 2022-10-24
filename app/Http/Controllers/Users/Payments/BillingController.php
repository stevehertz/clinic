<?php

namespace App\Http\Controllers\Users\Payments;

use App\Http\Controllers\Controller;
use App\Models\PaymentBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'bill_id' => 'required|integer|exists:payment_bills,id',
            'item' => 'required|string',
            'amount' => 'required|string',
            'receipt' => 'required|string',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $payment_bill = PaymentBill::find($data['bill_id']);

        // check if the bill is already paid
        if ($payment_bill->balance <= 0) {
            $response['status'] = false;
            $response['errors'] = 'The bill is already paid';
            return response()->json($response, 401);
        }

        $payment_bill->billing()->create([
            'item' => $data['item'],
            'amount' => $data['amount'],
            'receipt_number' => $data['receipt'],
            'date' => $data['date'],
        ]);

        $response['status'] = true;
        $response['message'] = 'Billing successfully created.';

        return response()->json($response, 200);
    }

    // Update Payment Bill total paid amount
    public function update_payment_bill(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'bill_id' => 'required|integer|exists:payment_bills,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $payment_bill = PaymentBill::find($data['bill_id']);

        $appointment = $payment_bill->appontment;

        $paid = $payment_bill->billing()->sum('amount');

        $total_paid = $payment_bill->consultation_fee + $paid;

        $payment_bill->id = $payment_bill->id;
        $payment_bill->bill_status = 'PENDING';
        $payment_bill->total_amount = $payment_bill->total_amount;
        $payment_bill->paid_amount = $total_paid;
        $payment_bill->balance = $payment_bill->total_amount - $payment_bill->paid_amount;

        if ($payment_bill->save()) {

            $clinic = $payment_bill->clinic;

            $report_id = $appointment->report_id;

            $report = $clinic->report()->findOrFail($report_id);

            $report->update([
                'total_amount' => $payment_bill->total_amount,
                'paid_amount' => $payment_bill->paid_amount,
                'balance' => $payment_bill->balance
            ]);

            $response['status'] = true;
            $response['message'] = 'Billing successfully updated.';

            return response()->json($response, 200);
        }
    }
}
