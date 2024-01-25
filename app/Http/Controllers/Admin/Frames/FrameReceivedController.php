<?php

namespace App\Http\Controllers\Admin\Frames;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\FrameReceived;
use Illuminate\Http\Request;

class FrameReceivedController extends Controller
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
            $data = $clinic->frame_received()->where('is_hq', 1)->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('received_by', function ($row) {
                })
                ->rawColumns(['received_by'])
                ->make(true);
        }
        $page_title = trans('admin.clinics.page.frames.sub_page.received');
        return view('admin.clinic.frames.received', [
            'organization' => $organization,
            'clinic' => $clinic,
            'page_title' => $page_title
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function get_received_from_clinic(Request $request, Clinic $clinic)  
    {
        $organization = $clinic->organization;
        if ($request->ajax()) {
            $data = $clinic->frame_received()->where('is_hq', 0)->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('from_clinic', function($row){

                })
                ->addColumn('received_by', function ($row) {
                })
                ->rawColumns(['received_by', 'from_clinic'])
                ->make(true);
        }
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
    public function show(FrameReceived $frameReceived)
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
