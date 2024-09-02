<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\PaymentBill; 
use App\Models\Remmittance;
use App\Models\Organization;
use App\Enums\DocumentStatus;
use App\Enums\RemmittanceStatus;

class BillingRepository
{
    public function closed_bills()
    {
        return PaymentBill::with(['clinic', 'appontment', 'appontment.patient', 'appontment.lens_power', 'appontment.lens_power.frame_prescription', 'payment_detail', 'payment_detail.insurance'])->where('bill_status', 'CLOSED')->where('remmittance_status', '=', null)->latest()->get();
    }

    public function sentToHq($status = DocumentStatus::PHYSICAL_DOCUMENT)
    {
        return PaymentBill::with(['clinic', 'appontment', 'appontment.patient', 'appontment.lens_power', 'appontment.lens_power.frame_prescription', 'payment_detail', 'payment_detail.insurance'])->where('bill_status', 'CLOSED')->where('document_status', $status)->where('remmittance_status', '=', null)->latest()->get();
    }

    public function receivedFromClinic($status = DocumentStatus::RECEIVED_DOCUMENT)
    {
        return PaymentBill::with(['clinic', 'appontment', 'appontment.patient', 'appontment.lens_power', 'appontment.lens_power.frame_prescription', 'payment_detail', 'payment_detail.insurance'])->where('bill_status', 'CLOSED')->where('document_status', $status)->where('remmittance_status', '=', null)->latest()->get();
    }
    public function receiveDocument(PaymentBill $paymentBill, $status = DocumentStatus::RECEIVED_DOCUMENT)
    {
        $date = Carbon::now()->format('Y-m-d');
        $paymentBill->update([
            'document_status' => $status,
            'received_date' => $date
        ]);
        return $paymentBill;
    }
    public function storeRemmittance(array $attributes)
    {
        $payment_bill_id = data_get($attributes, 'payment_bill_id');
        $status = RemmittanceStatus::PENDING;
        foreach ($payment_bill_id as $billId) {
            $paymentBill = PaymentBill::findOrFail($billId);
            $paymentDetail = $paymentBill->payment_detail;
            $client_type = $paymentDetail->client_type;
            if ($client_type->type == 'Insurance') {

                if ($paymentBill->document_status == DocumentStatus::RECEIVED_DOCUMENT) {
                    Remmittance::create([
                        'payment_bill_id' => $billId,
                        'date' => Carbon::now()->format('Y-m-d'),
                        'status' => $status
                    ]);
                    $paymentBill->update([
                        'remmittance_status' => $status
                    ]);
                }
                
            }
        }
        return true;
    }
}
