<?php

namespace App\Http\Controllers\Admin\Reports\Orders;

use App\Models\Clinic;
use App\Models\Workshop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;

class OrdersReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //
        $clinic = Clinic::findOrFail($id);
        if ($request->ajax()) {
            $data = $clinic->order()->join('order_tracks', 'orders.id', '=', 'order_tracks.order_id')
                ->select('orders.id', 'orders.patient_id', 'orders.clinic_id', 'orders.receipt_number', 'orders.workshop_id', 'order_tracks.track_status', 'order_tracks.track_date')
                ->orderBy('orders.created_at', 'desc')
                ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('order_date', function ($row) {
                    return date('d, F, Y', strtotime($row->track_date));
                })
                ->addColumn('order_number', function ($row) {
                    return '#' . $row->id;
                })
                ->addColumn('clinic', function ($row) {
                    $clinic = Clinic::findOrFail($row->clinic_id);
                    return $clinic->clinic;
                })
                ->addColumn('full_names', function($row){
                    $patient = Patient::findOrFail($row->patient_id);
                    return ucwords("{$patient->first_name} {$patient->last_name}");
                })
                ->addColumn('status', function ($row) {
                    return $row->track_status;
                })
                ->addColumn('workshop', function ($row) {
                    $workshop = Workshop::findOrFail($row->workshop_id);
                    return $workshop->name;
                })
                ->rawColumns(['order_number', 'clinic', 'order_date', 'workshop'])
                ->make(true);
        }
        $page_title = trans('pages.reports.orders');
        return view('admin.reports.orders.index', [
            'page_title' => $page_title,
            'clinic' => $clinic,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
