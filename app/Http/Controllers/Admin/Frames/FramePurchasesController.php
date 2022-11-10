<?php

namespace App\Http\Controllers\Admin\Frames;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\FramePurchase;
use App\Models\FrameStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FramePurchasesController extends Controller
{
    //
    public function __construct()
    {
        # code...
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $organization = $clinic->organization;
        if($request->ajax()){
            $data = $clinic->frame_purchase->sortBy('created_at', SORT_DESC);
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('color', function($row){
                $color = $row->frame_color->color;
                return $color;
            })
            ->addColumn('shape', function($row){
                $shape = $row->frame_shape->shape;
                return $shape;
            })
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-tools btn-sm deleteFramePurchase"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['color', 'shape', 'action'])
            ->make(true);

        }
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'clinic_id' => 'required|integer|exists:clinics,id',
            'stock_id' => 'required|integer|exists:frame_stocks,id',
            'receipt_number' => 'required',
            'quantity' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $clinic = Clinic::findOrFail($data['clinic_id']);

        //1. Get Stock 
        $frame_stock = $clinic->frame_stock->find($data['stock_id']);

        //2. Update Stocks 
        $frame_stock->id = $frame_stock->id;
        $frame_stock->opening_stock = $frame_stock->opening_stock;
        $frame_stock->purchase_stock = $frame_stock->purchase_stock + $data['quantity'];
        $frame_stock->total_stock = $frame_stock->opening_stock + $frame_stock->purchase_stock;
        $frame_stock->sold_stock = $frame_stock->sold_stock;
        $frame_stock->closing_stock = $frame_stock->total_stock - $frame_stock->sold_stock;
        //3. Store Purchase
        if($frame_stock->save()){

            $frame_purchase = new FramePurchase();

            $frame_purchase->organization_id = $clinic->organization_id;
            $frame_purchase->clinic_id = $clinic->id;
            $frame_purchase->stock_id = $frame_stock->id;
            $frame_purchase->frame_id = $frame_stock->frame_id;
            $frame_purchase->code = $frame_stock->frame->code;
            $frame_purchase->color_id = $frame_stock->frame_color->id;
            $frame_purchase->shape_id = $frame_stock->frame_shape->id;
            $frame_purchase->receipt_number = $data['receipt_number'];
            $frame_purchase->purchase_date = $data['purchase_date'];
            $frame_purchase->gender = $frame_stock->gender;
            $frame_purchase->quantity = $data['quantity'];
            $frame_purchase->price = $data['price'];
            $frame_purchase->total = $frame_purchase->quantity * $frame_purchase->price;
            $frame_purchase->supplier = $data['supplier'];

            $frame_purchase->save();

            $response['status'] = true;
            $response['message'] = 'Successfully stored frame purchase record';

            return response()->json($response);

        }else{

            $response['status'] = false;
            $response['error'] = 'Something went wrong...';

            return response()->json($response);   
        }
        // return "Store Frame Purchase";
    }

    public function destroy(Request $request)
    {
        # code...
        $data = $request->except('_token');

        $validator = Validator::make($data, [
            'purchase_id' => 'required|integer|exists:frame_purchases,id'
        ]);

        if($validator->fails())
        {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $frame_purchase = FramePurchase::findOrFail($data['purchase_id']);

        $frame_stock = $frame_purchase->frame_stock;

        $purchased_stocks = $frame_stock->purchase_stock;

        $quantity = $frame_purchase->quantity;

        $remaining_stock = $purchased_stocks - $quantity;

        $frame_stock->opening_stock = $frame_stock->opening_stock;

        $frame_stock->purchase_stock = $remaining_stock;

        $frame_stock->total_stock = $frame_stock->opening_stock + $frame_stock->purchase_stock;

        $frame_stock->sold_stock = $frame_stock->sold_stock;

        $frame_stock->closing_stock = $frame_stock->total_stock - $frame_stock->sold_stock;

        if($frame_stock->save()){

            $frame_purchase->delete();

            $response['status'] = true;
            $response['message'] = 'Frame Purchase Deleted Successfully';
            return response()->json($response, 200);

        }

    }
}
