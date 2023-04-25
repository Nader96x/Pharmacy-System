<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'doctor_id',
        'pharmacy_id',
        'delivering_address_id',
        'is_insured',
        'prescription'
    ];
}
