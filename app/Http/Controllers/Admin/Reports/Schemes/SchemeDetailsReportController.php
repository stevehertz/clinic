<?php

namespace App\Http\Controllers\Admin\Reports\Schemes;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchemeDetailsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Clinic $clinic)
    {
        //
        if ($request->ajax()) {
            $data = $clinic->payment_bill()->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('appointment_date', function ($row) {
                    return date('d F Y', strtotime($row->appontment->date));
                })
                ->addColumn('clinic', function ($row) {
                    return $row->clinic->clinic;
                })
                ->addColumn('patient_names', function ($row) {
                    return $row->patient->first_name . ' ' . $row->patient->last_name;
                })
                ->addColumn('patient_phone', function ($row) {
                    return $row->patient->phone;
                })
                ->addColumn('insurance', function ($row) {
                    if ($row->payment_detail->client_type->type == "Insurance") {
                        if($row->payment_detail->insurance){
                            return $row->payment_detail->insurance->title;
                        }
                    }
                })
                ->addColumn('scheme', function ($row) {
                    if ($row->payment_detail->client_type->type == "Insurance") {
                        return $row->payment_detail->scheme;
                    }
                })
                ->addColumn('phone', function ($row) {
                })
                ->rawColumns(['patients', 'clinic', 'phone'])
                ->make(true);
        }
        $page_title = trans('menus.admins.sidebar.reports.scheme_details');
        return view('admin.reports.schemes.index', [
            'page_title' => $page_title,
            'clinic' => $clinic
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
