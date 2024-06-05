<?php

namespace App\Repositories;

use App\Enums\DocumentStatus;
use App\Models\Organization;
use App\Models\PaymentBill;

class BillingRepository
{
    public function closed_bills()  
    {
        return PaymentBill::with(['clinic', 'appontment', 'appontment.patient', 'appontment.lens_power', 'appontment.lens_power.frame_prescription', 'payment_detail', 'payment_detail.insurance'])->where('bill_status', 'CLOSED')->latest()->get();
    }

    public function sentToHq($status = DocumentStatus::PHYSICAL_DOCUMENT)  
    {
        return PaymentBill::with(['clinic', 'appontment', 'appontment.patient', 'appontment.lens_power', 'appontment.lens_power.frame_prescription', 'payment_detail', 'payment_detail.insurance'])->where('bill_status', 'CLOSED')->where('document_status', $status)->latest()->get();
    }

    public function receivedFromClinic($status = DocumentStatus::RECEIVED_DOCUMENT)  
    {
        return PaymentBill::with(['clinic', 'appontment', 'appontment.patient', 'appontment.lens_power', 'appontment.lens_power.frame_prescription', 'payment_detail', 'payment_detail.insurance'])->where('bill_status', 'CLOSED')->where('document_status', $status)->latest()->get();
    }
}