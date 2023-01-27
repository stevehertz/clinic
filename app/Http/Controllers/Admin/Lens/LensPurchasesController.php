<?php

namespace App\Http\Controllers\Admin\Lens;

use App\Http\Controllers\Controller;
use App\Models\Lens;
use App\Models\LensPurchase;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\WorkDay;

class LensPurchasesController extends Controller
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
        $workshop = Workshop::findOrFail($id);
        if ($request->ajax()) {
            $data = $workshop->lens_purchase->sortBy('created_at', SORT_DESC);
            return datatables()->of($data)
                ->addColumn('lens_code', function ($row) {
                    $lens_code = $row->lens->code;
                    return $lens_code;
                })
                ->addColumn('power', function ($row) {
                    $power = $row->lens->power;
                    return $power;
                })
                ->addColumn('vendor', function ($row) {
                    # code...
                    $vendor = $row->vendor->first_name . ' ' . $row->vendor->last_name;
                    return $vendor;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-tools btn-sm deleteLensPurchaseBtn"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'lens_code', 'power', 'vendor'])
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
        $data = $request->except("_token");

        $validator = Validator::make($data, [
            'lens_id' => 'required|integer|exists:lenses,id',
            'vendor_id' => 'required|integer|exists:vendors,id',
            'purchased_date' => 'required|date',
            'quantity' => 'required|integer',
            'price' => 'required',
            'received_date' => 'required|date'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $lens = Lens::findOrFail($data['lens_id']);

        $opening = $lens->opening;

        $purchased = $lens->purchased + $data['quantity'];

        $transfered = $lens->transfered;

        $total = ($opening + $purchased) - $transfered;

        $sold = $lens->sold;

        $closing = $total - $sold;

        $lens->update([
            'opening' => $opening,
            'purchased' => $purchased,
            'transfered' => $transfered,
            'total' => $total,
            'sold' => $sold,
            'closing' => $closing
        ]);

        $quantity = $data['quantity'];

        $price = $data['price'];

        $total_price = $quantity * $price;

        $lens_purchase = new LensPurchase();

        $lens_purchase->create([
            'organization_id' => $lens->organization->id,
            'workshop_id' => $lens->workshop->id,
            'lens_id' => $lens->id,
            'vendor_id' => $data['vendor_id'],
            'purchased_date' => $data['purchased_date'],
            'quantity' => $quantity,
            'price' => $price,
            'total_price' => $total_price,
            'received_date' => $data['received_date']
        ]);

        $response = [
            'status' => true,
            'message' => 'You have successfully added new lens purchase'
        ];

        return response()->json($response, 200);

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
    public function destroy(Request $request)
    {
        //

        $data = $request->except("_token");

        $validator = Validator::make($data, [
            'lens_purchase_id' => 'required|integer|exists:lens_purchases,id'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response['status'] = false;
            $response['errors'] = $errors;
            return response()->json($response, 401);
        }

        $lens_purchase = LensPurchase::findOrFail($data['lens_purchase_id']);
        $lens = Lens::findOrFail($lens_purchase->lens_id);
        $quantity = $lens_purchase->quantity;
        $opening = $lens->opening;
        $purchased = $lens->purchased - $quantity;
        $transfered = $lens->transfered;
        $total = ($opening + $purchased) - $transfered;
        $sold = $lens->sold;
        $closing  = $total - $sold;
        $lens->update([
            'opening' => $opening,
            'purchased' => $purchased,
            'transfered' => $transfered,
            'total' => $total,
            'sold' => $sold,
            'closing' => $closing
        ]);
        $lens_purchase->delete();

        $response['status'] = true;
        $response['message'] = "You have successfully removed lens purchase";

        return response()->json($response, 200);
    }
}
