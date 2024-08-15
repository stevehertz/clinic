<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date_received',
        'transaction_code',
        'transaction_mode',
        'insurance_id',
        'amount',
        'paid',
        'balance',
        'status',
        'notes'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function insurance()  
    {
        return $this->belongsTo(Insurance::class);
    }
}
