<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'name',
        'initials',
        'logo',
        'phone',
        'email',
        'address',
    ];

    public function organization()
    {
        # code...
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function frame_prescription()
    {
        # code...
        return $this->hasMany(FramePrescription::class, 'power_id', 'id');
    }

    public function order()
    {
        # code...
        return $this->hasMany(Order::class, 'workshop_id', 'id');
    }

    public function workshop()
    {
        # code...
        return $this->hasMany(Workshop::class, 'workshop_id', 'id');
    }

    public function treatment()
    {
        # code...
        return $this->hasOne(Treatment::class, 'workshop_id', 'id');
    }

    public function technician()
    {
        # code...
        return $this->hasMany(Technician::class, 'workshop_id', 'id');
    }

    public function workshop_asset()
    {
        # code...
        return $this->hasMany(WorkshopAsset::class, 'workshop_id', 'id');
    }

    public function lens()
    {
        # code...
        return $this->hasMany(Lens::class, 'workshop_id', 'id');
    }

    public function from_workshop_transfer_asset()
    {
        # code...
        return $this->hasMany(WorkshopTransferAsset::class, 'from_workshop_id', 'id');
    }

    public function to_workshop_transfer_asset()
    {
        # code...
        return $this->hasMany(WorkshopTransferAsset::class, 'to_workshop_id', 'id');
    }
}
