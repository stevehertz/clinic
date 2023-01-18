<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lens extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'workshop_id',
        'power',
        'code',
        'lens_type_id',
        'lens_material_id',
        'lens_index',
        'date_added',
        'opening',
        'purchased',
        'transfered',
        'total',
        'sold',
        'closing',
    ];
}
