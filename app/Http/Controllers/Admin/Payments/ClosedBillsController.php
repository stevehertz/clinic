<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\PaymentBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClosedBillsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        if ($request->ajax()) {
            $data = $clinic->payment_bill()->join('patients', 'payment_bills.patient_id', '=', 'patients.id')
                ->select('payment_bills.*', 'patients.first_name', 'patients.last_name')
                ->where('payment_bills.bill_status', '=', 'CLOSED')
                ->latest()
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
        $patients = $clinic->patient->count();
        $page_title = 'Closed Bills';
        return view('admin.closed.index', [
            'clinic' => $clinic,
            'patients' => $patients,
            'page_title' => $page_title,
        ]);
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
        $request->session()->put('bill_id', $payment_bill->id);

        $response['status'] = true;
        $response['data'] = $payment_bill;

        return response()->json($response, 200);
    }

    public function view(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $patients = $clinic->patient->count();
        if($request->session()->has('bill_id')){
            $bill_id = $request->session()->get('bill_id');
            $payment_bill = PaymentBill::findOrFail($bill_id);
            $request->session()->forget('bill_id');
            $page_title = 'View Closed Bill';
            return view('admin.closed.view', [
                'clinic' => $clinic,
                'patients' => $patients,
                'payment_bill' => $payment_bill,
                'page_title' => $page_title,
            ]);
        }
        return redirect()->route('admin.payments.closed.bills.index', $clinic->id);
    }

    public function print(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $patients = $clinic->patient->count();
        if($request->session()->has('bill_id')){
            $bill_id = $request->session()->get('bill_id');
            $payment_bill = PaymentBill::findOrFail($bill_id);
            $request->session()->forget('bill_id');
            $page_title = 'View Closed Bill';
            return view('admin.closed.print', [
                'clinic' => $clinic,
                'patients' => $patients,
                'payment_bill' => $payment_bill,
                'page_title' => $page_title,
            ]);
        }
        return redirect()->route('admin.payments.closed.bills.index', $clinic->id);
    }
}
