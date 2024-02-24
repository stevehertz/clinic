<?php

namespace App\Http\Controllers\Admin\Reports\TAT;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicsTATReportsController extends Controller
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
    public function index(Request $request, Clinic $clinic)
    {
        //
        $organization = $clinic->organization;

        if ($request->ajax()) {
            $data = $clinic->order()->where('tat_one', '>', 0)->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('order_date', function ($row) {
                    return date('d, F, Y', strtotime($row->order_date));
                })
                ->addColumn('clinic', function($row){
                    return $row->clinic->clinic;
                })
                ->addColumn('full_names', function($row){
                    return $row->patient->first_name . ' ' . $row->patient->last_name;
                })
                ->addColumn('workshop', function($row){
                    return $row->workshop->name;
                })
                ->rawColumns(['order_date', 'order_number', 'clinic', 'workshop'])
                ->make(true);
        }

        $page_title = trans('menus.admins.sidebar.reports.tat');
        return view('admin.reports.tat.index', [
            'clinic' => $clinic,
            'organization' => $organization,
            'page_title' => $page_title
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_tat_two(Request $request, Clinic $clinic)  
    {
        $organization = $clinic->organization;
        if ($request->ajax()) {
            $data = $clinic->order()->where('tat_two', '>', 0)->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('order_date', function ($row) {
                    return date('d, F, Y', strtotime($row->order_date));
                })
                ->addColumn('clinic', function($row){
                    return $row->clinic->clinic;
                })
                ->addColumn('full_names', function($row){
                    return $row->patient->first_name . ' ' . $row->patient->last_name;
                })
                ->addColumn('workshop', function($row){
                    return $row->workshop->name;
                })
                ->rawColumns(['order_date', 'order_number', 'clinic', 'workshop'])
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        //
    }
}
