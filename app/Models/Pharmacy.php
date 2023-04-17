<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'avatar',
        'priority',
        'area_id'
    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
