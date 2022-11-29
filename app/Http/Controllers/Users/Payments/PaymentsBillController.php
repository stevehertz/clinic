<?php

namespace App\Http\Controllers\Users\Payments;

use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;
use App\Models\PaymentBill;
use App\Models\PaymentDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class PaymentsBillController extends Controller
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
                ->select('payment_bills.*', 'patients.first_name as patient_first', 'patients.last_name as patient_last')
                ->where('payment_bills.bill_status', '!=', 'CLOSED')
                ->where('doctor_schedules.user_id', $user->id)
                ->orderBy('payment_bills.id', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_names', function ($row) {
                    return $row->patient_first . ' ' . $row->patient_last;
                })
                ->addColumn('consultation_fee', function ($row) {
                    return number_format($row->consultation_fee, 2, '.', ',');
                })
                ->addColumn('claimed_amount', function ($row) {
                    return number_format($row->claimed_amount, 2, '.', ',');
                })
                ->addColumn('agreed_amount', function ($row) {
                    return number_format($row->agreed_amount, 2, '.', ',');
                })
                ->addColumn('total_amount', function ($row) {
                    return number_format($row->total_amount, 2, '.', ',');
                })
                ->addColumn('paid_amount', function ($row) {
                    return number_format($row->paid_amount, 2, '.', ',');
                })
                ->addColumn('balance', function ($row) {
                    return number_format($row->balance, 2, '.', ',');
                })
                ->addColumn('open_date', function ($row) {
                    $open_date = date('d-m-Y', strtotime($row->open_date));
                    return $open_date;
                })
                ->addColumn('bill_status', function ($row) {
                    if ($row['bill_status'] == 'OPEN') {
                        return '<span class="badge badge-primary">OPEN</span>';
                    } elseif ($row['bill_status'] == 'PENDING') {
                        return '<span class="badge badge-warning">PENDING</span>';
                    } else {
                        return '<span class="badge badge-success">CLOSED</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-tools btn-sm editPaymentBill"><i class="fa fa-edit"></i></a>';
                    $btn = $btn . '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="View" class="view btn btn-tools btn-sm viewPaymentBill"><i class="fa fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(
                    [
                        'action',
                        'full_names', 'open_date', 'consultation_fee', 'claimed_amount', 'agreed_amount', 'total_amount', 'paid_amount', 'balance', 'bill_status'
                    ]
                )
                ->make(true);
        }
        $page_title = 'Payment Bills';
        return view('users.billing.index', [
            'page_title' => $page_title,
            'user' => $user,
            'clinic' => $clinic,
        ]);
    }

    public function create($id)
    {
        # code...
        $user = User::findOrFail(auth()->user()->id);
        $clinic = $user->clinic;
        $payment_bill = PaymentBill::findOrFail($id);
        $page_title = 'Create Bill';
        return view('users.billing.create', [
            'page_title' => $page_title,
            'user' => $user,
            'clinic' => $clinic,
            'payment_bill' => $payment_bill,
        ]);
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'schedule_id' => 'required|integer|exists:doctor_schedules,id',
            'claimed_amount' => 'required|numeric|min:0',
            'consultation_fee' => 'required|numeric|min:0',
            'consultation_receipt' => 'required',
            'remarks' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $doctor_schedule = DoctorSchedule::findOrFail($data['schedule_id']);

        $appointment = $doctor_schedule->appointment;

        $payments_details =  $appointment->payment_detail;

        $payment_bill = new PaymentBill;

        $payment_bill->clinic_id = $doctor_schedule->clinic->id;
        $payment_bill->patient_id = $doctor_schedule->patient->id;
        $payment_bill->appointment_id = $doctor_schedule->appointment->id;
        $payment_bill->schedule_id = $doctor_schedule->id;
        $payment_bill->payment_details_id = $payments_details->id;
        $open_date = date('Y-m-d');
        $payment_bill->open_date = Carbon::createFromFormat('Y-m-d', $open_date)->format('Y-m-d');
        $payment_bill->consultation_fee = $data['consultation_fee'];
        $payment_bill->consultation_receipt_number = $data['consultation_receipt'];

        if ($data['claimed_amount'] == 0) {
            $approval_status = "CLOSING";
        } else {
            $approval_status = "PENDING";
        }


        if ($payments_details->client_type->type == 'Cash') {
            $payment_bill->bill_status = 'PENDING';
            $payment_bill->approval_status = $approval_status;
            $payment_bill->claimed_amount = $data['claimed_amount'];
            $payment_bill->agreed_amount = $payment_bill->claimed_amount;
        } else {
            if ($data['claimed_amount'] == 0) {
                $payment_bill->bill_status = 'PENDING';
            } else {
                $payment_bill->bill_status = 'OPEN';
            }
            $payment_bill->approval_status = $approval_status;
            $payment_bill->claimed_amount = $data['claimed_amount'];
            $payment_bill->agreed_amount = 0;
        }

        $payment_bill->total_amount = $payment_bill->agreed_amount + $payment_bill->consultation_fee;
        $payment_bill->paid_amount = 0 + $payment_bill->consultation_fee;
        $payment_bill->balance = $payment_bill->total_amount - $payment_bill->paid_amount;
        $payment_bill->remarks = $data['remarks'];

        if ($payment_bill->save()) {

            $clinic = $payment_bill->clinic;

            $report_id = $appointment->report_id;

            $report = $clinic->report()->findOrFail($report_id);

            $report->update([
                'bill_id' => $payment_bill->id,
                'bill_status' => $payment_bill->bill_status,
                'consultation_fee' => $payment_bill->consultation_fee,
                'claimed_amount' => $payment_bill->claimed_amount,
            ]);

            $response['status'] = true;
            $response['bill_id'] = $payment_bill->id;
            $response['message'] = 'Bill created successfully';

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
        $page_title = 'View Bill';
        return view('users.billing.view', [
            'page_title' => $page_title,
            'user' => $user,
            'clinic' => $clinic,
            'payment_bill' => $payment_bill,
        ]);
    }

    public function edit($id)
    {
        # code...
        $user = User::findOrFail(auth()->user()->id);
        $clinic = $user->clinic;
        $page_title = 'Edit Bill';
        $payment_bill = PaymentBill::findOrFail($id);
        return view('users.billing.edit', [
            'page_title' => $page_title,
            'user' => $user,
            'clinic' => $clinic,
            'payment_bill' => $payment_bill,
        ]);
    }

    public function update_agreed(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'bill_id' => 'required|integer|exists:payment_bills,id',
            'amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $payment_bill = PaymentBill::findOrFail($data['bill_id']);

        $appointment = $payment_bill->appontment;

        $payment_bill->id = $payment_bill->id;
        $payment_bill->bill_status = 'PENDING';
        if ($payment_bill->payment_detail->insurance) {
            $payment_bill->approval_status = $data['approval_status'];
            $payment_bill->approval_number = $data['approval_number'];
        }
        if ($payment_bill->approval_status == 'REJECTED') {
            $payment_bill->agreed_amount = $data['amount'];
            $payment_bill->total_amount = 0 + $payment_bill->consultation_fee;
        } else {
            $payment_bill->agreed_amount = $data['amount'];
            $payment_bill->total_amount = $payment_bill->agreed_amount + $payment_bill->consultation_fee;
        }
        $payment_bill->paid_amount = $payment_bill->paid_amount;
        $payment_bill->balance = $payment_bill->total_amount - $payment_bill->paid_amount;


        if ($payment_bill->save()) {

            $clinic = $payment_bill->clinic;

            $report_id = $appointment->report_id;

            $report = $clinic->report()->findOrFail($report_id);

            $report->update([
                'bill_status' => $payment_bill->bill_status,
                'agreed_amount' => $payment_bill->agreed_amount,
                'total_amount' => $payment_bill->total_amount,
                'paid_amount' => $payment_bill->paid_amount,
                'balance' => $payment_bill->balance,
            ]);

            $response['status'] = true;
            $response['message'] = 'You have upated the agreed amount for this bill';

            return response()->json($response, 200);
        }
    }

    public function update_consultation(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'bill_id' => 'required|integer|exists:payment_bills,id',
            'consultation_fee' => 'required|numeric',
            'consultation_receipt' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $payment_bill = PaymentBill::findOrFail($data['bill_id']);

        $appointment = $payment_bill->appontment;

        $payment_bill->id = $payment_bill->id;
        $payment_bill->consultation_fee = $data['consultation_fee'];
        $payment_bill->consultation_receipt_number = $data['consultation_receipt'];
        $payment_bill->bill_status = 'PENDING';
        $payment_bill->agreed_amount = $payment_bill->consultation_fee;
        $payment_bill->total_amount = $payment_bill->agreed_amount;
        $payment_bill->paid_amount = $payment_bill->consultation_fee;
        $payment_bill->balance = $payment_bill->total_amount - $payment_bill->paid_amount;

        return $appointment;

        // if ($payment_bill->save()) {

        //     $clinic = $payment_bill->clinic;

        //     $report_id = $appointment->report_id;

        //     $report = $clinic->report()->findOrFail($report_id);

        //     $report->update([
        //         'bill_status' => $payment_bill->bill_status,
        //         'consultation_fee' => $payment_bill->consultation_fee,
        //         'agreed_amount' => $payment_bill->agreed_amount,
        //         'total_amount' => $payment_bill->total_amount,
        //         'paid_amount' => $payment_bill->paid_amount,
        //         'balance' => $payment_bill->balance,
        //     ]);

        //     $response['status'] = true;
        //     $response['message'] = 'You have upated the consultation fee for this bill';

        //     return response()->json($response, 200);
        // }
    }

    public function print($id)
    {
        # code...
        $user = User::findOrFail(auth()->user()->id);
        $clinic = $user->clinic;
        $payment_bill = PaymentBill::findOrFail($id);
        $page_title = 'Print Bill';
        return view('users.billing.print', [
            'page_title' => $page_title,
            'user' => $user,
            'clinic' => $clinic,
            'payment_bill' => $payment_bill,
        ]);
    }
}
