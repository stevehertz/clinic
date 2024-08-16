<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Models\ReceivedPayment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReceivedPaymentRequest;
use App\Http\Requests\UpdateReceivedPaymentRequest;

class ReceivedPaymentController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReceivedPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceivedPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReceivedPayment  $receivedPayment
     * @return \Illuminate\Http\Response
     */
    public function show(ReceivedPayment $receivedPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceivedPayment  $receivedPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceivedPayment $receivedPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReceivedPaymentRequest  $request
     * @param  \App\Models\ReceivedPayment  $receivedPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceivedPaymentRequest $request, ReceivedPayment $receivedPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceivedPayment  $receivedPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceivedPayment $receivedPayment)
    {
        //
    }
}
