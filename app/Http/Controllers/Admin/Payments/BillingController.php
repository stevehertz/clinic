<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Enums\DocumentStatus;
use App\Exports\Billing\ExportBilling;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        if ($request->ajax()) {
            $data = $this->billingRepository->closed_bills();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('patient', function($row){
                    return $row->patient->first_name. ' ' . $row->patient->last_name; 
                })
                ->addColumn('insurance', function($row){
                    if($row->payment_detail->insurance)
                    {
                        return $row->payment_detail->insurance->title;
                    }
                    
                })
                ->addColumn('document_status', function($row){
                    return DocumentStatus::getName($row->document_status);
                })
                ->addColumn('actions', function ($row) {

                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        $closedBills = $this->billingRepository->closed_bills();
        $sentToHQ = $this->billingRepository->sentToHq();
        $receivedDOC =  $this->billingRepository->receivedFromClinic();
        return view('admin.main.billing.index', [
            'closedBills' => $closedBills,
            'sentToHQ' => $sentToHQ,
            'receivedDOC' => $receivedDOC
        ]);
    }


     /**
     * Export the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export() 
    {
        return (new ExportBilling())->download('billing-' . time() . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);    
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
