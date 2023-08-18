<?php

namespace App\Http\Controllers\Admin\Lens;

use App\Models\Workshop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LensRequestController extends Controller
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
        $workshop = Workshop::findOrFail($id);
        if ($request->ajax()) {
            $data = $workshop->request_lens()->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('lens_type', function ($row) {
                    return $row->lens_type->type;
                })
                ->addColumn('lens_material', function ($row) {
                    return $row->lens_material->title;
                })
                ->addColumn('technician', function ($row) {
                    return $row->technician->first_name.' '. $row->technician->last_name;
                })
                ->rawColumns(['lens_type', 'lens_material', 'technician'])
                ->make(true);
        }
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
