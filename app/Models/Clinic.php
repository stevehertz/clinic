<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'clinic',
        'logo',
        'phone',
        'email',
        'address',
        'location',
        'initials',
    ];

    public function organization()
    {
        # code...
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function user()
    {
        # code...
        return $this->hasMany(User::class, 'clinic_id', 'id');
    }

    public function patient()
    {
        # code...
        return $this->hasMany(Patient::class, 'clinic_id', 'id');
    }

    function patients_per_clinic() 
    {
        return $this->patient()->where('status', 1)->latest()->count();   
    }

    public function appointment()
    {
        # code...
        return $this->hasMany(Appointment::class, 'clinic_id', 'id');
    }

    public function payment_detail()
    {
        # code...
        return $this->hasMany(PaymentDetail::class, 'clinic_id', 'id');
    }

    public function doctor_schedule()
    {
        # code...
        return $this->hasMany(DoctorSchedule::class, 'clinic_id', 'id');
    }

    public function diagnosis()
    {
        # code...
        return $this->hasMany(Diagnosis::class, 'clinic_id', 'id');
    }

    public function payment_bill()
    {
        # code...
        return $this->hasMany(PaymentBill::class, 'clinic_id', 'id');
    }

    public function order()
    {
        # code...
        return $this->hasMany(Order::class, 'clinic_id', 'id');
    }

    public function asset()
    {
        # code...
        return $this->hasMany(Asset::class, 'clinic_id', 'id');
    }

    public function from_asset_transfer()
    {
        # code...
        return $this->hasMany(AssetTransfer::class, 'from_clinic_id', 'id');
    }

    public function to_asset_transfer()
    {
        # code...
        return $this->hasMany(AssetTransfer::class, 'to_clinic_id', 'id');
    }

    public function frame()
    {
        # code...
        return $this->hasMany(Frame::class, 'clinic_id', 'id');
    }

    public function frame_stock()
    {
        # code...
        return $this->hasMany(FrameStock::class, 'clinic_id', 'id');
    }

    public function sun_glass()
    {
        # code...
        return $this->hasMany(SunGlass::class, 'clinic_id', 'id');
    }

    public function contact_len()
    {
        # code...
        return $this->hasMany(ContactLen::class, 'clinic_id', 'id');
    }

    public function sun_glass_stock()
    {
        # code...
        return $this->hasMany(SunGlassStock::class, 'clinic_id', 'id');
    }

    public function remittance()
    {
        # code...
        return $this->hasMany(Remittance::class, 'clinic_id', 'id');
    }

    public function report()
    {
        # code...
        return $this->hasMany(Report::class, 'clinic_id', 'id');
    }

    public function frame_purchase()
    {
        # code...
        return $this->hasMany(FramePurchase::class, 'clinic_id', 'id');
    }

    public function frame_transfer_from()
    {
        # code...
        return $this->hasMany(FrameTransfer::class, 'from_clinic_id', 'id');
    }

    public function frame_transfer_to()
    {
        # code...
        return $this->hasMany(FrameTransfer::class, 'to_clinic_id', 'id');
    }

    public function frame_received_from()
    {
        return $this->hasMany(ReceivedFrame::class, 'from_clinic_id', 'id');
    }

    public function frame_received_to()
    {
        return $this->hasMany(ReceivedFrame::class, 'to_clinic_id', 'id');
    }
}
