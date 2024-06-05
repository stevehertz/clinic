<?php

namespace App\Repositories;

use App\Enums\DocumentStatus;
use App\Models\PaymentBill;
use Carbon\Carbon;

class CloseBillsRepository
{
    public function sendPhysicalDoc(PaymentBill $paymentBill, $status = DocumentStatus::PHYSICAL_DOCUMENT)  
    {
        $date = Carbon::now()->format('Y-m-d');
        $paymentBill->update([
            'document_status' => $status,
            'send_date' => $date
        ]);
        return $paymentBill;
    }
}