<?php

namespace App\Http\Controllers\Admin\Cases;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Clinic\Cases\ClinicCaseStockRequest;
use App\Models\CaseStock;
use App\Models\Clinic;
use Illuminate\Http\Request;

class CaseStocksController extends Controller
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
        if($request->ajax())
        {
            $data = $clinic->case_stock()->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('case_code', function($row){
                    return $row->hqStock->frame_case->code;
                })
                ->addColumn('color', function($row){
                    return $row->hqStock->frame_case->case_color->title;
                })
                ->addColumn('shape', function($row){
                    return $row->hqStock->frame_case->case_shape->title;
                })
                ->addColumn('size', function($row){
                    return $row->hqStock->frame_case->case_size->title;
                })
                ->addColumn('actions', function($row){
                    $btn = '<a href="javascript:void(0)"  data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteCaseStock">';
                    $btn = $btn . '<i class="fas fa-trash"></i>';
                    $btn = $btn . '</a>';
                    return $btn;
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        }

        $page_title = trans('menus.admins.sidebar.inventory.cases.title');
        return view('admin.clinic.cases.index', [
            'page_title' => $page_title,
            'clinic' => $clinic,
            'organization' => $organization
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClinicCaseStockRequest $request, Clinic $clinic)
    {
        //
        $data = $request->except("_token");

        $organization = $clinic->organization;

        $hq_case_stock = $organization->hq_case_stock()->findOrfail($data['hq_stock_id']);

        $opening = $data['opening'];

        $received = 0;

        $transfered = 0;

        $total = ($opening + $received) - $transfered;

        $sold = 0;

        $closing = $total - $sold;

        $clinic->case_stock()->create([
            'organization_id' => $organization->id,
            'hq_stock_id' => $hq_case_stock->id,
            'case_id' => $hq_case_stock->frame_case->id,
            'code' => $hq_case_stock->frame_case->code,
            'opening' => $opening,
            'received' => $received,
            'transfered' => $transfered,
            'total' => $total,
            'sold' => $sold,
            'closing' => $closing,
            'price' => $hq_case_stock->price,
            'remarks' => $data['remarks']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Case stock added successfully'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $clinic
        ]);
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
    public function destroy(CaseStock $caseStock)
    {
        //
        $caseStock->delete();
        return response()->json([
            'status' => true,
            'message' => 'Case stock deleted successfully'
        ]);
    }
}
