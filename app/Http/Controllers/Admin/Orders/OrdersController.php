<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order as ResourcesOrder;
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
        $page_title = trans('pages.orders');
        return view('admin.orders.clinics.index', [
            'clinic' => $clinic,
            'patients' => $patients,
            'page_title' => $page_title,
        ]);
    }

    public function show($order_id)
    {
        # code...
        $order = Order::find($order_id);

        return new ResourcesOrder($order);
    }

    public function view($id, $order_id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $order = $clinic->order()->findOrFail($order_id);
        $page_title = trans('pages.orders');
        return view('admin.orders.clinics.view', [
            'page_title' => $page_title,
            'clinic' => $clinic,
            'order' => $order,
        ]);
    }
}
