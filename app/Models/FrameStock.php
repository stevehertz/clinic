<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'frame_id',
        'gender',
        'color_id',
        'shape_id',
        'opening_stock',
        'purchase_stock',
        'transfered_stock',
        'total_stock',
        'sold_stock',
        'closing_stock',
        'price',
        'supplier_price',
        'remarks',
    ];

    public function clinic()
    {
        # code...
        return $this->belongsTo(Clinic::class, 'clinic_id', 'id');
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

    public function frame_purchase()
    {
        # code...
        return $this->hasMany(FramePurchase::class, 'stock_id', 'id');
    }
}
