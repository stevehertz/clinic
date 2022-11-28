<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FramePrescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'power_id',
        'prescription_id',
        'stock_id',
        'frame_code',
        'receipt_number',
        'workshop_id',
        'remarks',
    ];

    public function lens_power()
    {
        # code...
        return $this->belongsTo(LensPower::class, 'power_id', 'id');
    }

    public function lens_prescription()
    {
        # code...
        return $this->belongsTo(LensPrescription::class, 'prescription_id', 'id');
    }

    public function workshop()
    {
        # code...
        return $this->belongsTo(Workshop::class, 'workshop_id', 'id');
    }

    public function report()
    {
        # code...
        return $this->hasMany(Report::class, 'frame_prescription_id', 'id');
    }

    public function treatment()
    {
        # code...
        return $this->hasOne(Treatment::class, 'frame_prescription_id', 'id');
    }
}
