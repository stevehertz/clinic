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
}
