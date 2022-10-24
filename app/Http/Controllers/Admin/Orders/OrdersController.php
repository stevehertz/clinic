<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
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
            $data = $clinic->order()
                ->join('clinics', 'clinics.id', '=', 'orders.clinic_id')
                ->join('patients', 'patients.id', '=', 'orders.patient_id')
                ->join('workshops', 'workshops.id', '=', 'orders.workshop_id')
                ->select('orders.*', 'clinics.clinic', 'patients.first_name as patient_first', 'patients.last_name as patient_last', 'workshops.name as workshop')
                ->orderBy('orders.created_at', 'desc')
                ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('full_names', function ($row) {
                    return $row->patient_first . ' ' . $row->patient_last;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="#" data-id="' . $row->id . '" class="btn btn-tools btn-sm viewOrderBtn"><i class="fa fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'full_names'])
                ->make(true);
        }
        $patients = $clinic->patient->count();
        $page_title = 'Orders';
        return view('admin.orders.index', [
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
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $order = Order::find($data['order_id']);
        $request->session()->put('order_id', $order->id);

        $response['status'] = true;
        $response['data'] = $order;
        return response()->json($response, 200);
    }

    public function view(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $patients = $clinic->patient->count();
        if ($request->session()->has('order_id')) {
            $order_id = $request->session()->get('order_id');
            $order = Order::findOrFail($order_id);
            $request->session()->forget('order_id');
            $page_title = 'Order #' . $order->id;
            return view('admin.orders.view', [
                'page_title' => $page_title,
                'clinic' => $clinic,
                'order' => $order,
                'patients' => $patients,
            ]);
        }
        return redirect()->route('admin.orders.index', $clinic->id);
    }
}
