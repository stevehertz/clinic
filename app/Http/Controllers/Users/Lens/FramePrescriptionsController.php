<?php

namespace App\Http\Controllers\Users\Lens;

use App\Http\Controllers\Controller;
use App\Models\FramePrescription;
use App\Models\FrameStock;
use App\Models\LensPower;
use App\Models\Treatment;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FramePrescriptionsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'power_id' => 'required|integer|exists:lens_powers,id',
            'prescription_id' => 'required|integer|exists:lens_prescriptions,id',
            'stock_id' => 'required|integer|exists:frame_stocks,id',
            'receipt_number' => 'required|numeric',
            'workshop_id' => 'required|integer|exists:workshops,id',
            'remarks' => 'nullable|string|max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $lens_power = LensPower::findOrFail($data['power_id']);
        $lens_prescription = $lens_power->lens_prescription;
        $workshop = Workshop::findOrFail($data['workshop_id']);
        $frame_stock = FrameStock::findOrFail($data['stock_id']);

        // get cinic through appointment
        $appointment = $lens_power->appointment;

        $clinic = $appointment->clinic;

        // check avalable frame stocks
        $closing = $frame_stock->closing_stock;

        $quantity = 1;


        if($closing <= 0 || $quantity > $closing) {
            $errors = ['No Frame Stocks available for the clinic. Please contact the admin in order to continue'];
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $frame_prescription = $lens_power->frame_prescription()->create([
            'prescription_id' => $lens_prescription->id,
            'stock_id' => $frame_stock->id,
            'frame_code' => $frame_stock->frame->code,
            'receipt_number' => $clinic->initials.'/'.$data['receipt_number'],
            'workshop_id' => $workshop->id,
            'quantity' => $quantity,
            'remarks' => $data['remarks'],
        ]);

        // update treatment
        $treatment = Treatment::findOrFail($lens_power->treatment->id);

        $treatment->update([
            'frame_prescription_id' => $frame_prescription->id,
            'workshop_id' => $workshop->id,
            'payments' => 'treatment',
            'status' => 'frame prescription'
        ]);

        // update report
        $clinic = $lens_power->diagnosis->clinic;

        $report_id = $appointment->report_id;

        $report = $clinic->report()->findOrFail($report_id);

        $report->update([
            'frame_prescription_id' => $frame_prescription->id,
        ]);

        $response['status'] = true;
        $response['message'] = 'Frame Prescription created successfully';
        return response()->json($response, 200);
    }

    public function show(Request $request)
    {
        # code...
        $data = $request->except('_token');

        $validator = Validator::make($data, [
            'frame_prescription_id' => 'required|integer|exists:frame_prescriptions,id',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $frame_prescription = FramePrescription::findOrFail($data['frame_prescription_id']);
        $response['status'] = true;
        $response['data'] = $frame_prescription;

        return response()->json($response, 200);
    }

    public function update(Request $request)
    {
        # code...
        $data = $request->except('_token');

        $validator = Validator::make($data, [
            'frame_prescription_id' => 'required|integer|exists:frame_prescriptions,id',
            'stock_id' => 'required|integer|exists:frame_stocks,id',
            'workshop_id' => 'required|integer|exists:workshops,id',
            'remarks' => 'nullable|string|max:255',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $frame_stock = FrameStock::findOrFail($data['stock_id']);

        $workshop = Workshop::findOrFail($data['workshop_id']);

        $frame_prescription = FramePrescription::findOrFail($data['frame_prescription_id']);

        // check avalable frame stocks
        $closing = $frame_stock->closing_stock;

        $quantity = 1;

        if($closing <= 0 && $quantity > $closing) {
            $errors = ['No Frame Stocks available for the clinic. Please contact the admin in order to continue'];
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $frame_prescription->update([
            'power_id' => $frame_prescription->power_id,
            'prescription_id' => $frame_prescription->prescription_id,
            'stock_id' => $frame_stock->id,
            'frame_code' => $frame_stock->frame->code,
            'receipt_number' => $frame_prescription->receipt_number,
            'workshop_id' => $workshop->id,
            'quantity' => $quantity,
            'remarks' => $data['remarks']
        ]);

        $response['status'] = true;
        $response['message'] = 'Frame Prescription updated successfully';
        return response()->json($response, 200);

    }
}
