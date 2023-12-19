<?php

namespace App\Http\Controllers\Users\Payments;

use App\Http\Controllers\Controller;
use App\Models\PaymentBill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CloseBillsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        # code...
        $user = User::find(Auth::user()->id);
        $clinic = $user->clinic;
        if ($request->ajax()) {

            $data = $clinic->payment_bill()->join('patients', 'payment_bills.patient_id', '=', 'patients.id')
                ->join('doctor_schedules', 'payment_bills.schedule_id', '=', 'doctor_schedules.id')
                ->select('payment_bills.*', 'patients.first_name', 'patients.last_name')
                ->where('payment_bills.bill_status', '=', 'CLOSED')
                ->where('doctor_schedules.user_id', $user->id)
                ->orderBy('payment_bills.id', 'desc')
                ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('full_names', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('total_amount', function ($row) {
                    return number_format($row->total_amount, 2, '.', ',');
                })
                ->addColumn('total_paid', function ($row) {
                    return number_format($row->paid_amount, 2, '.', ',');
                })
                ->addColumn('close_date', function ($row) {
                    return date('d-M-Y', strtotime($row->close_date));
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row['id'] . '" data-original-title="View" class="view btn btn-tools btn-sm viewBtn"><i class="fa fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'full_names', 'total_amount', 'total_paid', 'close_date'])
                ->make(true);
        }
        $page_title = 'Close Bills';
        return view('users.closed.index', [
            'page_title' => $page_title,
            'clinic' => $clinic,
        ]);
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'bill_id' => 'required|integer|exists:payment_bills,id',
            'invoice_number' => 'required|numeric',
            'close_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $payment_bill = PaymentBill::findOrFail($data['bill_id']);

        $clinic = $payment_bill->clinic;

        $appointment = $payment_bill->appontment;

        $payment_bill->id = $payment_bill->id;
        $payment_bill->open_date = $payment_bill->open_date;
        $payment_bill->invoice_number = $clinic->initials . '/' . $data['invoice_number'];
        $payment_bill->lpo_number = $data['lpo_number'];
        $payment_bill->bill_status = 'CLOSED';
        $payment_bill->close_date = $data['close_date'];

        if ($payment_bill->save()) {

            $report_id = $appointment->report_id;

            $report = $clinic->report()->findOrFail($report_id);

            $report->update([
                'bill_status' => $payment_bill->bill_status,
                'bill_closed_date' => $payment_bill->close_date,
            ]);

            $response['status'] = true;
            $response['message'] = 'You have closed this bill';

            return response()->json($response, 200);
        }
    }

    public function show(Request $request)
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

        $payment_bill = PaymentBill::findOrFail($data['bill_id']);

        $response['status'] = true;
        $response['data'] = $payment_bill;

        return response()->json($response, 200);
    }

    public function view($id)
    {
        # code...
        $user = User::findOrFail(auth()->user()->id);
        $clinic = $user->clinic;
        $payment_bill = PaymentBill::findOrFail($id);
        $page_title = 'View Closed Bill';
        return view('users.closed.view', [
            'page_title' => $page_title,
            'user' => $user,
            'clinic' => $clinic,
            'payment_bill' => $payment_bill,
        ]);
    }

    public function update_lpo(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'bill_id' => 'required|integer|exists:payment_bills,id',
            'lpo_number' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $payment_bill = PaymentBill::findOrFail($data['bill_id']);

        $payment_bill->lpo_number = $data['lpo_number'];
        $payment_bill->save();

        $response['status'] = true;
        $response['message'] = 'You have updated the LPO number';

        return response()->json($response, 200);
    }

    public function print($id)
    {
        # code...
        $user = User::findOrFail(auth()->user()->id);
        $clinic = $user->clinic;
        $payment_bill = PaymentBill::findOrFail($id);
        $page_title = 'Print Closed Bill';
        return view('users.closed.print', [
            'page_title' => $page_title,
            'user' => $user,
            'clinic' => $clinic,
            'payment_bill' => $payment_bill,
        ]);
    }
}
