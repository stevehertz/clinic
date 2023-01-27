<?php

namespace App\Http\Controllers\Technicians\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:technician');
    }


    public function index(Request $request)
    {
        # code...
        $technician = Technician::findOrFail(Auth::guard('technician')->user()->id);
        $workshop = $technician->workshop;
        if ($request->ajax()) {
            $data = $workshop->order->sortBy('created_at', SORT_DESC);
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('patient', function ($row) {
                    $patient = $row->patient->first_name . " " . $row->patient->last_name;
                    return $patient;
                })
                ->addColumn('clinic', function ($row) {
                    $clinic = $row->clinic->clinic;
                    return $clinic;
                })
                ->addColumn('view', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="View" class="view btn btn-tools btn-sm viewOrderBtn"><i class="fa fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['view', 'patient', 'clinic'])
                ->make(true);
        }
        $page_title = "Orders";
        return view('technicians.orders.index', [
            'page_title' => $page_title
        ]);
    }

    public function show($id)
    {
        # code...
        $order = Order::findOrFail($id);
        
        $response = [
            'status' => true,
            'data' => $order
        ];

        return response()->json($response);
    }

    public function view($id)
    {
        # code...
        $order = Order::findOrFail($id);

        $page_title = "View Order";
        return view('technicians.orders.view', [
            'page_title' => $page_title,
            'order' => $order,
        ]);
    }
}
