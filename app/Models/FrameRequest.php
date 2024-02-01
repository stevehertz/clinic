<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'clinic_id',
        'user_id',
        'frame_id',
        'request_date',
        'frame_code',
        'gender',
        'color_id',
        'shape_id',
        'quantity',
        'remarks',
        'status',
        'transfer_status'
    ];

    public function organization()
    {
        # code...
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function clinic()
    {
        # code...
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
    }

    public function user()
    {
        # code...
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function frame()
    {
        # code...
        return $this->belongsTo(Frame::class, 'frame_id', 'id');
    }

    public function frame_color()
    {
        # code...
        return $this->belongsTo(FrameColor::class, 'color_id', 'id');
    }

    public function frame_shape()
    {
        # code...
        return $this->belongsTo(FrameShape::class, 'shape_id', 'id');
    }
}
