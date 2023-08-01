<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id', // new
        'clinic_id',
        'brand_id', //new
        'type_id', // new
        'size_id', // new
        'material_id', //new
        'frame_id',
        'code', // new
        'gender',
        'color_id',
        'shape_id',
        'opening_stock',
        'purchase_stock',
        'transfered_stock',
        'received_stock',
        'total_stock',
        'sold_stock',
        'closing_stock',
        'price',
        'supplier_price',
        'remarks',
        'status' // new
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

    public function frame_prescription()
    {
        # code...
        return $this->hasMany(FramePrescription::class, 'stock_id', 'id');
    }

    public function received_frame() 
    {
        return $this->hasMany(ReceivedFrame::class, 'stock_id', 'id');    
    }
}
