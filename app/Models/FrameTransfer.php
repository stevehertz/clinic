<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'from_clinic_id',
        'to_clinic_id',
        'stock_id',
        'transfer_user_id',
        'frame_code',
        'transfer_date',
        'transfer_status',
        'transfer_stock_status',
        'transfer_remarks',
        'received_user_id',
        'received_date',
        'received_status',
        'received_stock_status',
        'received_remarks',
    ];
}
