<?php

namespace App\Http\Controllers\Users\Orders;

use App\Http\Controllers\Controller;
use App\Mail\OrdersMail;
use App\Mail\OrderTechnicianMail;
use App\Models\FramePrescription;
use App\Models\FrameStock;
use App\Models\LensPower;
use App\Models\Order;
use App\Models\PaymentBill;
use App\Models\Report;
use App\Models\User;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
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
        $user = User::findOrFail(Auth::user()->id);
        $clinic = $user->clinic;
        if ($request->ajax()) {
            if(!empty($request->status)){
                $data = $clinic->order()->where('status', $request->status)->latest()->get();
            }else{
                $data = $clinic->order()->latest()->get();
            }
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_names', function ($row) {
                    return $row->patient->first_name . ' ' . $row->patient->last_name;
                })
                ->addColumn('clinic', function($row){
                    $clinic = $row->clinic->clinic;
                    return $clinic;
                })
                ->addColumn('workshop', function($row){
                    $workshop = $row->workshop->name;
                    return $workshop;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="#" data-id="' . $row->id . '" class="btn btn-tools btn-sm viewOrderBtn"><i class="fa fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'full_names', 'clinic', 'workshop'])
                ->make(true);
        }
        $page_title = 'Orders';
        return view('users.orders.index', [
            'user' => $user,
            'clinic' => $clinic,
            'page_title' => $page_title,
        ]);
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
            'bill_id' => 'required|integer|exists:payment_bills,id',
            'workshop_id' => 'required|integer|exists:workshops,id',
            'lens_power_id' => 'required|integer|exists:lens_powers,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $payment_bill = PaymentBill::find($data['bill_id']);

        $workshop = Workshop::find($data['workshop_id']);

        $lens_power = LensPower::find($data['lens_power_id']);

        // find frame prescription (Frame selected)
        $frame_prescription = FramePrescription::findOrFail($lens_power->frame_prescription->id);

        // Quantity of frames selected
        $quantity = $frame_prescription->quantity;

        // find the frame in stock
        $frame_stock = FrameStock::findOrFail($frame_prescription->stock_id);

        // update quantity
        $opening = $frame_stock->opening_stock;

        $purchased = $frame_stock->purchase_stock;

        $transfered  = $frame_stock->transfered_stock;

        $total = ($opening + $purchased) - $transfered;

        $sold = $frame_stock->sold_stock + $quantity;

        $closing = $total - $sold;
        
        // remove the frame from stock
        $frame_stock->update([
            'opening_stock' => $opening,
            'purchase_stock' => $purchased,
            'transfered_stock' => $transfered,
            'total_stock' => $total,
            'sold_stock' => $sold,
            'closing_stock' => $closing
        ]);

        // create order
        $order = $payment_bill->order()->create([
            'clinic_id' => $payment_bill->clinic_id,
            'patient_id' => $payment_bill->patient_id,
            'appointment_id' => $payment_bill->appointment_id,
            'schedule_id' => $payment_bill->schedule_id,
            'payment_bill_id' => $payment_bill->id,
            'workshop_id' => $workshop->id,
            'lens_power_id' => $lens_power->id,
            'lens_prescription_id' => $lens_power->lens_prescription->id,
            'frame_prescription_id' => $frame_prescription->id,
            'order_date' => Carbon::now(),
            'receipt_number' => $lens_power->frame_prescription->receipt_number,
            'status' => 'APPROVED',
        ]);

        // update order id on the treatment
        $treatment = $lens_power->treatment;

        $treatment->update([
            'order_id' => $order->id,
            'status' => 'ordered'
        ]);

        $clinic = $payment_bill->clinic;

        $appointment = $payment_bill->appontment;

        $report_id = $appointment->report_id;

        $report = $clinic->report()->findOrFail($report_id);

        $report->update([
            'order_id' => $order->id,
            'order_status' => $order->status
        ]);

        $response['status'] = true;
        $response['order_id'] = $payment_bill->order->id;
        $response['message'] = 'Order created successfully';
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
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $order = Order::find($data['order_id']);

        $response['status'] = true;
        $response['data'] = $order;
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        # code...
        $order = Order::findOrFail($id);
        $user = User::findOrFail(Auth::user()->id);
        $clinic = $user->clinic;
        $page_title = 'Order Details';
        return view('users.orders.view', [
            'page_title' => $page_title,
            'order' => $order,
            'clinic' => $clinic,
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
        $data = $request->all();

        $validator = Validator::make($data, [
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $order = Order::findOrFail($id);

        $appointment = $order->appointment;

        $order->id = $order->id;

        $order->status = $data['status'];

        if($order->status == 'SENT TO WORKSHOP') 
        {
            $workshop = $order->workshop;  
            $email = $workshop->email;
            $details['title'] = 'Order Details';
            $details['body'] = 'An order has been send to the workshop. Please check';

            Mail::to($email)->send(new OrderTechnicianMail($details));
        }

        if($order->status == 'FRAME SENT TO WORKSHOP')
        {
            $workshop = $order->workshop;   
            $email = $workshop->email;
            $details['title'] = 'Order Details';
            $details['body'] = 'Frame has been send to the workshop. Please check';

            Mail::to($email)->send(new OrderTechnicianMail($details));
        }

        if($order->status == 'RECEIVED FROM WORKSHOP')
        {
            $workshop = $order->workshop;   
            $email = $workshop->email;
            $details['title'] = 'Order Details';
            $details['body'] = 'Order and Frame has been received. Thank you';

            Mail::to($email)->send(new OrderTechnicianMail($details));
        }

        if($order->status == 'CALL FOR COLLECTION')
        {
            $patient = $order->patient;
            $email = $patient->email;

            $details['title'] = 'Order Details';

            $details['body'] = 'Your lens that you ordered is ready to be picked up. You are welcome to come an pick them up';

            Mail::to($patient->email)->send(new OrdersMail($details));
            
        }

        if ($order->status == 'CLOSED') {
            $order->closed_date = Carbon::now();
        }

        if ($order->save()) {

            $order = Order::findOrFail($order->id);

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

            $response['status'] = true;
            $response['message'] = 'Order updated successfully';
            return response()->json($response, 200);
        } else {
            $response['status'] = false;
            $response['errors'] = 'Something went wrong';
            return response()->json($response, 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function send_mail(Request $request)
    {
        # code...
        $data = $request->all();

        $validator = Validator::make($data, [
            'order_id' => 'required|integer|exists:orders,id',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $order = Order::findOrFail($data['order_id']);

        $patient = $order->patient;

        $details['title'] = 'Order Details';

        $details['body'] = 'Your lens that you ordered is ready to be picked up. You are welcome to come an pick them up';

        Mail::to($patient->email)->send(new OrdersMail($details));

        $response['status'] = true;
        $response['message'] = 'Patient has been successfully notified';

        return response()->json($response, 200);
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
