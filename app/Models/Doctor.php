<?php

namespace App\Models;

use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class
Doctor extends Model
{
    use HasFactory, HasRoles,Bannable;

    protected $fillable = [
        'national_id',
        'image',
        'name',
        'email',
        'password',
        'pharmacy_id',
        'banned_at',
        'is_banned',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'created_at',
        'banned_at',

    ];
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function doctor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
