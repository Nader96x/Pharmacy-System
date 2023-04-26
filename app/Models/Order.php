<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pharmacy_id',
        'doctor_id',
        'status',
        'total_price',
        'delivering_address_id',
        'is_insured',
        'prescription',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'order_medicine_quantity', 'order_id', 'medicine_id')
            ->withPivot('quantity', 'price');
    }
    

}
