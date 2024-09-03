<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Enums\DocumentStatus;
use App\Enums\RemmittanceStatus;
use App\Exports\Billing\ExportBilling;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Billing\ReceiveMultipleDocumentsRequest;
use App\Http\Requests\Admin\Billing\StoreRemmittanceRequest;
use App\Models\PaymentBill;
use App\Models\Remmittance;
use App\Repositories\BillingRepository;

class BillingController extends Controller
{

    private $billingRepository;

    public function __construct(BillingRepository $billingRepository)
    {
        $this->middleware('auth:admin');
        $this->billingRepository = $billingRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = $this->billingRepository->closed_bills();
        $closedBills = $this->billingRepository->closed_bills();
        $sentToHQ = $this->billingRepository->sentToHq();
        $receivedDOC =  $this->billingRepository->receivedFromClinic();
        return view('admin.main.billing.index', [
            'closedBills' => $closedBills,
            'sentToHQ' => $sentToHQ,
            'receivedDOC' => $receivedDOC,
            'data' => $data
        ]);
    }


    /**
     * Export the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return (new ExportBilling())
            ->download('billing-' . time() . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receiveDocument(PaymentBill $paymentBill)
    {
        //
        if ($this->billingRepository->receiveDocument($paymentBill)) {
            return response()->json([
                'status' => true,
                'message' => 'You have successfully received document sent to HQ'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRemmittanceRequest $request)
    {
        //
        $data = $request->except("_token");
        $remmittance = $this->billingRepository->storeRemmittance($data);
        if ($remmittance) {
            return response()->json([
                'status' => true,
                'message' => 'Remmittance for payments under client type insurance hve been created waiting for submision'
            ]);
        }
    }

    /**
     * Receive multiple documents a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function receiveMultipleDocuments(ReceiveMultipleDocumentsRequest $request)
    {
        $data = $request->except("_token");
        $receiveDocuments = $this->billingRepository->receiveMultipleDocuments($data);
        if ($receiveDocuments) {
            return response()->json([
                'status' => true,
                'message' => 'You have successfully received multiple documents sent to HQ'
            ]);
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
