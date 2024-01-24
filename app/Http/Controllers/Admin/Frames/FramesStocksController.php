<?php

namespace App\Http\Controllers\Admin\Frames;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Clinic\Frames\StoreFrameStock;
use App\Models\Clinic;
use App\Models\Frame;
use App\Models\FrameColor;
use App\Models\FrameShape;
use App\Models\FrameStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;

class FramesStocksController extends Controller
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
            $data = $clinic->frame_stock()->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('color', function($row){
                    return $row->frame_color->color;
                })
                ->addColumn('shape', function($row){
                    return $row->frame_shape->shape;
                })
                ->addColumn('actions', function ($row) {
                })
                ->rawColumns(['actions', 'color', 'shape'])
                ->make(true);
        }
        $page_title = trans('admin.clinics.page.frames.sub_page.stocks');
        return view('admin.clinic.frames.index', [
            'page_title' => $page_title,
            'clinic' => $clinic,
            'organization' => $organization,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFrameStock $request, Clinic $clinic)
    {
        //
        $data = $request->except("_token");

        $frame = Frame::findOrFail($data['frame_id']);

        $frame_color = FrameColor::findOrFail($data['color_id']);

        $frame_shape = FrameShape::findOrFail($data['shape_id']);

        $opening = $data['opening'];

        $total = $opening;

        $sold = 0;

        $closing = $total - $sold;

        $clinic->frame_stock()->create([
            'frame_id' => $frame->id,
            'code' => $frame->code,
            'gender' => $data['gender'],
            'color_id' => $frame_color->id,
            'shape_id' => $frame_shape->id,
            'opening' => $opening,
            'total' => $total,
            'sold' => $sold,
            'closing' => $closing,
            'price' => $data['price'],
            'supplier_price' => $data['supplier_price'],
            'remarks' => $data['remarks'],
        ]);

        $response['status'] = true;
        $response['message'] = 'Frame Stock Added Successfully';
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FrameStock $frameStock)
    {
        //
        $response['status'] = true;
        $response['data'] = $frameStock;
        return response()->json($response, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FrameStock $frameStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrameStock $frameStock)
    {
        //
        $frameStock->delete();
        $response['status'] = true;
        $response['message'] = 'Frame Stock Deleted Successfully';
        return response()->json($response, 200);
    }
}
