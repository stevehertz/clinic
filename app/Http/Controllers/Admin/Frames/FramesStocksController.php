<?php

namespace App\Http\Controllers\Admin\Frames;

use App\Http\Controllers\Controller;
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
    public function index(Request $request, $id)
    {
        //
        $clinic = Clinic::findOrFail($id);
        $organization = $clinic->organization;
        if ($request->ajax()) {
            $data = $clinic->frame_stock()->join('frames', 'frame_stocks.frame_id', '=', 'frames.id')
                ->join('frame_colors', 'frame_stocks.color_id', '=', 'frame_colors.id')
                ->join('frame_shapes', 'frame_stocks.shape_id', '=', 'frame_shapes.id')
                ->select('frame_stocks.*', 'frames.code as frame_code', 'frame_colors.color as color', 'frame_shapes.shape as shape')
                ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('remarks', function($row){
                    return Str::limit($row->remarks, 20, '...');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-tools btn-sm deleteFrameStock"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'remarks'])
                ->make(true);
        }
        $patients = $clinic->patient->count();
        $clinic_frames = $clinic->frame->sortBy('created_at', SORT_DESC);
        $frame_colors = $organization->frame_color->sortBy('created_at', SORT_DESC);
        $frame_shapes = $organization->frame_shape->sortBy('created_at', SORT_DESC);
        $num_frames = $clinic->frame_stock->count();
        $page_title = 'Frame Stocks';
        return view('admin.frames.stocks', [
            'clinic' => $clinic,
            'patients' => $patients,
            'clinic_frames' => $clinic_frames,
            'frame_colors' => $frame_colors,
            'frame_shapes' => $frame_shapes,
            'num_frames' => $num_frames,
            'page_title' => $page_title,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * return all stocks for index page
     */
    public function stocks(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        if ($request->ajax()) {
            $data = $clinic->frame_stock()->join('frames', 'frame_stocks.frame_id', '=', 'frames.id')
                ->join('frame_colors', 'frame_stocks.color_id', '=', 'frame_colors.id')
                ->join('frame_shapes', 'frame_stocks.shape_id', '=', 'frame_shapes.id')
                ->select('frame_stocks.*', 'frames.code as frame_code', 'frame_colors.color as color', 'frame_shapes.shape as shape')
                ->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-tools btn-sm deleteFrameStock"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
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
        $data = $request->all();

        $validator = Validator::make($data, [
            'clinic_id' => 'required|integer|exists:clinics,id',
            'frame_id' => 'required|integer|exists:frames,id',
            'gender' => 'required|string|max:255',
            'color_id' => 'required|integer|exists:frame_colors,id',
            'shape_id' => 'required|integer|exists:frame_shapes,id',
            'opening_stock' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);

        $frame = Frame::findOrFail($data['frame_id']);

        $frame_color = FrameColor::findOrFail($data['color_id']);

        $frame_shape = FrameShape::findOrFail($data['shape_id']);

        $opening_stock = $data['opening_stock'];

        $purchased_stock = 0;

        $total_stock = $opening_stock + $purchased_stock;

        $sold_stock = 0;

        $closing_stock = $total_stock - $sold_stock;

        $clinic->frame_stock()->create([
            'frame_id' => $frame->id,
            'gender' => $data['gender'],
            'color_id' => $frame_color->id,
            'shape_id' => $frame_shape->id,
            'opening_stock' => $opening_stock,
            'purchase_stock' => $purchased_stock,
            'total_stock' => $total_stock,
            'sold_stock' => $sold_stock,
            'closing_stock' => $closing_stock,
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
    public function show(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator::make($data, [
            'stock_id' => 'required|integer|exists:frame_stocks,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $stock = FrameStock::findOrFail($data['stock_id']);
        $response['status'] = true;
        $response['data'] = $stock;
        return response()->json($response, 200);
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
    public function destroy(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator::make($data, [
            'stock_id' => 'required|integer|exists:frame_stocks,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $stock = FrameStock::findOrFail($data['stock_id']);
        $stock->delete();
        $response['status'] = true;
        $response['message'] = 'Frame Stock Deleted Successfully';
        return response()->json($response, 200);
    }
}
