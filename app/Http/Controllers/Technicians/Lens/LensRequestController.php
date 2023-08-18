<?php

namespace App\Http\Controllers\Technicians\Lens;

use App\Models\Workshop;
use App\Models\RequestLens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Technicians\Lens\RequestLensRequest;
use App\Mail\Technicians\RequestLensMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class LensRequestController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');   
    }

    /***
     * 
     * Send Lens Request
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestLensRequest $request)  
    {
        $data = $request->except("_token");

        $workshop = Workshop::findOrFail($data['workshop_id']);

        $organization = $workshop->organization;

        $workshop->request_lens()->create([
            'organization_id' => $organization->id,
            'technician_id' => Auth::guard('technician')->user()->id,
            'power' => $data['power'],
            'lens_type_id' => $data['lens_type_id'],
            'lens_material_id' => $data['lens_material_id'],
            'lens_index' => $data['lens_index'],
            'eye' => $data['eye'],
            'date_requested' => Carbon::now(),
            'quantity' => $data['quantity']
        ]);

        $admin = $organization->admin;
        $email = $admin->email;

        $details  = [
            'workshop' => $workshop->name
        ];

        Mail::to($email)->send(new RequestLensMail($details));

        $response = [
            'status' => true,
            'message' => 'You have successfully send request'
        ];

        return response()->json($response, 200);
        
    }
}
