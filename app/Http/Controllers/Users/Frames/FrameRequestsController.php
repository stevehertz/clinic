<?php

namespace App\Http\Controllers\Users\Frames;

use App\Models\User;
use App\Models\FrameRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Users\Frames\FrameRequestMail;
use App\Http\Requests\Users\Frames\StoreFrameRequest;

class FrameRequestsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user  = User::findOrFail(Auth::user()->id);
        $clinic = $user->clinic;
        if ($request->ajax()) {
            $data = $clinic->frame_request()->latest()->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('request_date', function($row){
                    return date('F d, Y', strtotime($row->request_date));
                })
                ->addColumn('color', function ($row) {
                    return $row->frame_color->color;
                })
                ->addColumn('shape', function ($row) {
                    return $row->frame_shape->shape;
                })
                ->addColumn('status', function($row){
                    if($row->status){
                        return '<span class="badge badge-success">Requested</span>';
                    }else{
                        return '<span class="badge badge-danger">Not Requested</span>';
                    }
                })
                ->addColumn('transfer_status', function($row){
                    if($row->transfer_status){
                        return '<span class="badge badge-success">Transferred</span>';
                    }else{
                        return '<span class="badge badge-danger">Not Transferred</span>';
                    }
                })
                ->addColumn('requested_by', function ($row) {
                    return $row->user->first_name . ' ' . $row->user->last_name;
                })
                ->addColumn('actions', function ($row) {
                })
                ->rawColumns(['actions', 'color', 'shape', 'status', 'transfer_status'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFrameRequest $request)
    {
        //
        $user  = User::findOrFail(Auth::user()->id);

        $clinic = $user->clinic;

        $organization = $clinic->organization;

        $data = $request->except("_token");

        $frame = $organization->frame()->findOrFail($data['frame_id']);

        $clinic->frame_request()->create([
            'organization_id' => $organization->id,
            'user_id' => $user->id,
            'frame_id' => $frame->id,
            'request_date' => $data['request_date'],
            'frame_code' => $frame->code,
            'gender' => $data['gender'],
            'color_id' => $data['color_id'],
            'shape_id' => $data['shape_id'],
            'quantity' => $data['quantity'],
            'remarks' => $data['remarks'],
            'status' => 1,
            'transfer_status' => 0
        ]);

        $details = [
            'title' => 'Frame Request',
            'body' => 'You have a new frame request from ' . $clinic->clinic . '.' . ' Please check your dashboard.'
        ];

        Mail::to($organization->email)->send(new FrameRequestMail($details));

        return response()->json([
            'status' => true,
            'message' => 'Frame request has been sent successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FrameRequest $frameRequest)
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
