<?php

namespace App\Http\Controllers\Admin\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('admin.main.banking.index', [
            'data' => $data,
            'submitted' => $submitted,
            'insuranceData' => $insuranceData
        ]);
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
