<?php

namespace App\Http\Controllers\Admin\Lens;

use App\Http\Controllers\Controller;
use App\Models\LensPurchase;
use App\Models\Workshop;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\WorkDay;

class LensPurchasesController extends Controller
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
            $data = $workshop->lens_purchase->sortBy('created_at', SORT_DESC);
            return datatables()->of($data)
                ->addColumn('lens_code', function ($row) {
                    $lens_code = $row->lens->code;
                    return $lens_code;
                })
                ->addColumn('power', function ($row) {
                    $power = $row->lens->power;
                    return $power;
                })
                ->addColumn('vendor', function ($row) {
                    # code...
                    $vendor = $row->vendor->first_name . ' ' . $row->vendor->last_name;
                    return $vendor;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-tools btn-sm deleteLensPurchaseBtn"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'lens_code', 'power', 'vendor'])
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
