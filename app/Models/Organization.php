<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization',
        'tagline',
        'logo',
        'phone',
        'email',
        'address',
        'location',
        'website',
        'profile',
    ];

    public function admin()
    {
        # code...
        return $this->hasMany(Admin::class, 'organization_id', 'id');
    }

    public function clinic()
    {
        # code...
        return $this->hasMany(Clinic::class, 'organization_id', 'id');
    }

    public function user()
    {
        # code...
        return $this->hasMany(User::class, 'organization_id', 'id');
    }

    public function status()
    {
        # code...
        return $this->hasMany(Status::class, 'organization_id', 'id');
    }

    public function client_type()
    {
        # code...
        return $this->hasMany(ClientType::class, 'organization_id', 'id');
    }

    public function insurance()
    {
        # code...
        return $this->hasMany(Insurance::class, 'organization_id', 'id');
    }

    public function lens_type()
    {
        # code...
        return $this->hasMany(LensType::class, 'organization_id', 'id');
    }

    public function lens_material()
    {
        # code...
        return $this->hasMany(LensMaterial::class, 'organization_id', 'id');
    }

    public function workshop()
    {
        # code...
        return $this->hasMany(Workshop::class, 'organization_id', 'id');
    }

    public function asset_type()
    {
        # code...
        return $this->hasMany(AssetType::class, 'organization_id', 'id');
    }

    public function asset_condition()
    {
        # code...
        return $this->hasMany(AssetCondition::class, 'organization_id', 'id');
    }

    public function frame_type()
    {
        # code...
        return $this->hasMany(FrameType::class, 'organization_id', 'id');
    }

    public function frame_material()
    {
        # code...
        return $this->hasMany(FrameMaterial::class, 'organization_id', 'id');
    }

    public function frame_brand()
    {
        # code...
        return $this->hasMany(FrameBrand::class, 'organization_id', 'id');
    }

    public function frame_size()
    {
        # code...
        return $this->hasMany(FrameSize::class, 'organization_id', 'id');
    }

    public function frame_color()
    {
        # code...
        return $this->hasMany(FrameColor::class, 'organization_id', 'id');
    }

    public function frame()
    {
        # code...
        return $this->hasMany(Frame::class, 'organization_id', 'id');
    }

    public function frame_shape()
    {
        # code...
        return $this->hasMany(FrameShape::class, 'organization_id', 'id');
    }

    public function color()
    {
        # code...
        return $this->hasMany(Color::class, 'organization_id', 'id');
    }

    public function shape()
    {
        # code...
        return $this->hasMany(Shape::class, 'organization_id', 'id');
    }

    public function size()
    {
        # code...
        return $this->hasMany(Size::class, 'organization_id', 'id');
    }

    public function frame_purchase()
    {
        # code...
        return $this->hasMany(FramePurchase::class, 'organization_id', 'id');
    }

    public function vendor()
    {
        # code...
        return $this->hasMany(Vendor::class, 'organization_id', 'id');
    }

    public function coating()
    {
        # code...
        return $this->hasMany(Coating::class, 'organization_id', 'id');
    }

    public function lens_index()
    {
        # code...
        return $this->hasMany(LensIndex::class, 'organization_id', 'id');
    }

    public function technician()
    {
        # code...
        return $this->hasMany(Technician::class, 'organization_id', 'id');
    }

    public function workshop_asset()
    {
        # code...
        return $this->hasMany(WorkshopAsset::class, 'organization_id', 'id');
    }

    public function lens()
    {
        # code...
        return $this->hasMany(Lens::class, 'organization_id', 'id');
    }

    public function workshop_transfer_asset()
    {
        # code...
        return $this->hasMany(WorkshopTransferAsset::class, 'organization_id', 'id');
    }

    public function lens_purchase()
    {
        # code...
        return $this->hasMany(LensPurchase::class, 'organization_id', 'id');
    }

    public function lens_transfer()
    {
        # code...
        return $this->hasMany(LensTransfer::class, 'organization_id', 'id');
    }

    public function workshop_sale()
    {
        # code...
        return $this->hasMany(WorkshopSale::class, 'organization_id', 'id');
    }

    public function received_frame()
    {
        return $this->hasMany(ReceivedFrame::class, 'organization_id', 'id');
    }

    public function hq_frame_stock()  
    {
        return $this->hasMany(HqFrameStock::class, 'organization_id', 'id');
    }
}
