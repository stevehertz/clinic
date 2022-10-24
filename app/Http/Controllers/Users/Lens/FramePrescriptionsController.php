<?php

namespace App\Http\Controllers\Users\Lens;

use App\Http\Controllers\Controller;
use App\Models\FrameStock;
use App\Models\LensPower;
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

        $frame_prescription = $lens_power->frame_prescription()->create([
            'prescription_id' => $lens_prescription->id,
            'stock_id' => $frame_stock->id,
            'frame_code' => $frame_stock->frame->code,
            'receipt_number' => $clinic->initials.'/'.$data['receipt_number'],
            'workshop_id' => $workshop->id,
            'remarks' => $data['remarks'],
        ]);

        $sold_stock = $frame_stock->sold_stock + 1;
        $closing_stock = $frame_stock->closing_stock - $sold_stock;

        $frame_stock->update([
            'sold_stock' => $sold_stock,
            'closing_stock' => $closing_stock,
        ]);

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
    }
}
