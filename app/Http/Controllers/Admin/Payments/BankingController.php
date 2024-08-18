<?php

namespace App\Http\Controllers\Admin\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankingRequest;
use App\Models\Insurance;
use App\Repositories\BankingRepository;
use App\Repositories\InsurancesRepository;
use App\Repositories\RemmittanceRepository;

class BankingController extends Controller
{

    private $bankingRepository, $remmittanceRepository, $insurancesRepository;
    public function __construct(BankingRepository $bankingRepository, RemmittanceRepository $remmittanceRepository, InsurancesRepository $insurancesRepository)
    {
        $this->middleware('auth:admin');  
        $this->bankingRepository = $bankingRepository;
        $this->remmittanceRepository = $remmittanceRepository;
        $this->insurancesRepository = $insurancesRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->bankingRepository->getAllBanking();
        $submitted = $this->remmittanceRepository->getSubmiited();
        $insuranceData = $this->insurancesRepository->getAllInsurance();
        $receivedRemmittanceData = $this->remmittanceRepository->getReceived();
        return view('admin.main.banking.index', [
            'data' => $data,
            'submitted' => $submitted,
            'insuranceData' => $insuranceData,
            'rceivedRemmittanceData' => $receivedRemmittanceData
        ]);
    }

    /**
     * Pill remmittances for insurance.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRemmittanceForInsurance($id)
    {
        //
        $remmittanceData = $this->insurancesRepository->getRemmittanceForInsurance($id);
        return response()->json([
            'status' => true,
            'data' => $remmittanceData
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankingRequest $request)
    {
        //
        $data = $request->except("_token");
        $banking = $this->bankingRepository->storeBanking($data);
        if($banking)
        {
            return response()->json([
                'status' => true,
                'message' => 'Banking created successfully',
                'bank_id' => $banking->id
            ]);
        }

        return response()->json([
            'status' => false,
            'error' => 'Something went wrong'
        ]);
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
        $banking = $this->bankingRepository->show($id);
        return response()->json([
            'status' => true,
            'data' => $banking
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)  
    {
        $data =  $this->bankingRepository->show($id);
        
        return view('admin.main.banking.view', [
            'data' => $data
        ]);   
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
