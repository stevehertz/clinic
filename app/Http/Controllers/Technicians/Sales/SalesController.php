<?php

namespace App\Http\Controllers\Technicians\Sales;

use App\Http\Controllers\Controller;
use App\Mail\TechnicianOrdersMail;
use App\Models\Lens;
use App\Models\Order;
use App\Models\WorkshopSale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:technician');   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $data = $request->all();

        $validator = Validator::make($data, [
            'order_id' => 'required|integer|exists:orders,id',
            'lens_id' => 'required|integer|exists:lenses,id',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $lens = Lens::findOrFail($data['lens_id']);

        $quantity = 1;

        $opening = $lens->opening;

        $purchased = $lens->purchased;

        $transfered = $lens->transfered;

        $total = $lens->total;

        $sold = $lens->sold;

        $closing = $lens->closing;

        if($closing <= 0 || $closing < $quantity)
        {
            $errors = ['The lens selected are not enough to complete the current task. Please contact the Admin for more help'];
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $sold = $sold + $quantity;

        $closing = $total - $sold;

        $lens->update([
            'opening' => $opening,
            'purchased' => $purchased,
            'transfered' => $transfered,
            'total' => $total,
            'sold' => $sold,
            'closing' => $closing,
        ]);

        $order = Order::findOrFail($data['order_id']);

        $sale = new WorkshopSale;

        $sale->organization_id = $lens->organization->id;
        $sale->order_id = $order->id;
        $sale->lens_id = $lens->id;
        $sale->payment_bill_id = $order->payment_bill->id;
        $sale->quantity = $quantity;
        $sale->paid = $order->payment_bill->paid_amount;

        $sale->save();

        $appointment = $order->appointment;

        $order->id = $order->id;

        $order->status = $data['status'];

        if ($order->status == 'GLAZED') {
            $clinic = $order->clinic;

            $email = $clinic->email;

            $details['title'] = 'Order Details';
            $details['body'] = 'Order has been successfully glazed. The Lens will be sent to you shortly.';

            Mail::to($email)->send(new TechnicianOrdersMail($details));
        }

        if($order->save())
        {
            $order->order_track()->create([
                'user_id' => $order->doctor_schedule->user->id,
                'workshop_id' => $order->workshop->id,
                'track_date' => Carbon::now()->format('Y-m-d'),
                'track_status' => $order->status,
            ]);

            $clinic = $order->clinic;

            $report_id = $appointment->report_id;
    
            $report = $clinic->report()->findOrFail($report_id);
    
            $report->update([
                'order_status' => $order->status,
            ]);
    
            $response = [
                'status' => true,
                'message' => 'New Sale has been successfully registered'
            ];
    
            return response()->json($response, 200);

        }


       

       

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
