<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'patient_id',
        'appointment_id',
        'schedule_id',
        'payment_bill_id',
        'workshop_id',
        'lens_power_id',
        'lens_prescription_id',
        'frame_prescription_id',
        'order_date',
        'receipt_number',
        'status',
        'closed_date',
    ];

    public function clinic()
    {
        # code...
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    public function patient()
    {
        # code...
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function appointment()
    {
        # code...
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }

    public function doctor_schedule()
    {
        # code...
        return $this->belongsTo(DoctorSchedule::class, 'schedule_id', 'id');
    }

    public function payment_bill()
    {
        # code...
        return $this->belongsTo(PaymentBill::class, 'payment_bill_id', 'id');
    }

    public function workshop()
    {
        # code...
        return $this->belongsTo(Workshop::class, 'workshop_id', 'id');
    }

    public function lens_power()
    {
        # code...
        return $this->belongsTo(LensPower::class, 'lens_power_id', 'id');
    }

    public function lens_prescription()
    {
        # code...
        return $this->belongsTo(LensPrescription::class, 'lens_prescription_id', 'id');
    }

    public function frame_prescription()
    {
        # code...
        return $this->belongsTo(FramePrescription::class, 'frame_prescription_id', 'id');
    }

    public function order_track()
    {
        # code...
        return $this->hasMany(OrderTrack::class, 'order_id', 'id');
    }

    public function report()
    {
        # code...
        return $this->hasMany(Report::class, 'order_id', 'id');
    }

    public function treatment()
    {
        # code...
        return $this->hasOne(Treatment::class, 'order_id', 'id');
    }
}
