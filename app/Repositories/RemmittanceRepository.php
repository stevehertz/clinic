<?php 

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Remmittance;
use App\Enums\RemmittanceStatus;

class RemmittanceRepository
{
    public function getAll()  
    {
        return Remmittance::with(['paymentBill'])->latest()->get();
    }

    public function getSubmiited($status = RemmittanceStatus::SUBMITTED)  
    {
        return Remmittance::with(['paymentBill'])->where('status', $status)->latest()->get();
    }

    public function getSubmiitedByDate($date, $status = RemmittanceStatus::SUBMITTED)  
    {
        return Remmittance::with(['paymentBill'])->where('date', $date)->where('status', $status)->latest()->get();
    }

    public function getPending($status = RemmittanceStatus::PENDING)  
    {
        return Remmittance::with(['paymentBill'])->where('status', $status)->latest()->get();
    }

    public function showRemmittance($id)  
    {
        return Remmittance::with(['paymentBill'])->findOrFail($id);
    }

    public function updateMultipleRemmittance(array $attributes)  
    {
        $remmittance_id = data_get($attributes, 'remmittance_id');
        $status = RemmittanceStatus::SUBMITTED;
        foreach($remmittance_id as $remmittanceId)
        {
            $remmittance = Remmittance::findOrFail($remmittanceId);
            $remmittance->update([
                'date' => Carbon::now()->format('Y-m-d'),
                'status' => $status
            ]);
            $paymentBill = $remmittance->paymentBill;
            $paymentBill->update([
                'remmittance_status' => $status
            ]);
        }
        return true;
    }
}