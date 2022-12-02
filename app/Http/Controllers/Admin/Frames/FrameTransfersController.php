<?php

namespace App\Http\Controllers\Admin\Frames;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\FrameStock;
use App\Models\FrameTransfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FrameTransfersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');   
    }

    public function index(Request $request, $id)
    {
        # code...
        $clinic = Clinic::findOrFail($id);
        $organization = $clinic->organization;
        if ($request->ajax()) {
            $data = $clinic->frame_transfer_from()->latest()->get();
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('from_clinic', function($row){
                $from_clinic = $row->from_clinic->clinic;
                return $from_clinic;
            })
            ->addColumn('to_clinic', function($row){
                $to_clinic = $row->to_clinic->clinic;
                return $to_clinic;
            })
            ->addColumn('doctor', function($row)
            {
                # code...
                $transfer_user = $row['transfer_user_id'];
                $doctor = User::findOrFail($transfer_user);
                return $doctor['first_name'] . ' ' . $doctor['last_name'];
            })
            ->rawColumns(['from_clinic', 'from_clinic'])
            ->make(true);
        }
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->except("_token");

        $validator = Validator::make($data, [
            "from_clinic_id" => "required|exists:clinics,id",
            "to_clinic_id" => "required|exists:clinics,id",
            "stock_id" => "required|exists:frame_stocks,id",
            "transfer_user_id" => "required|exists:users,id",
            "transfer_date" => "required|date",
            "quantity" => "required|numeric",
            "transfer_status" => "required|string",
            "condition" => "required|string",
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $clinic = Clinic::findOrFail($data['from_clinic_id']);

        $organization = $clinic->organization;

        $frame_stock = FrameStock::findOrFail($data['stock_id']);

        // perform quantity deduction on frame stocks
        $quantity = $data['quantity'];

        // check if the quantity ask for is available
        if($quantity > $frame_stock->closing_stock) 
        {
            $response['status'] = false;
            $response['errors'] = "The quantity requested is not available at the moment";
            return response()->json($response, 401);
        }

        // available stocks
        $transfered_stock = $frame_stock->transfered_stock + $quantity;
        $total_stock = $frame_stock->total_stock - $transfered_stock;
        $sold_stock = $total_stock - $frame_stock->sold_stock;
        $closing_stock = $frame_stock->closing_stock - $sold_stock;

        // update frame stock 
        $frame_stock->update([
            'transfered_stock' => $transfered_stock,
            'total_stock' => $total_stock,
            'sold_stock' => $sold_stock,
            'closing_stock' => $closing_stock,
        ]);

        // create transfer

        $transfer = new FrameTransfer;

        $transfer->create([
            'organization_id' => $organization->id,
            'from_clinic_id' => $clinic->id,
            'to_clinic_id' => $data['to_clinic_id'],
            'stock_id' => $frame_stock->id,
            'transfer_user_id' => $data['transfer_user_id'],
            'frame_code' => $frame_stock->frame->code,
            'transfer_date' => $data['transfer_date'],
            'quantity' => $quantity,
            'transfer_status' => $data['transfer_status'],
            'condition' => $data['condition'],
            'remarks' => $data['remarks'],
        ]);

        $to_clinic = Clinic::findOrFail($data['to_clinic_id']);

        $response['status'] = true;
        $response['message'] = "You have successfully transfered ".$quantity." frames to ".$to_clinic->clinic;

        return response()->json($response, 200);
    }

    public function show(Request $request)
    {
        # code...
    }
}
