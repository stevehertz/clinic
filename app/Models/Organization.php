<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
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
        return $this->belongsTo(Admin::class);
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
}
