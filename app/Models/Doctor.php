<?php

namespace App\Models;

use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class
Doctor extends Authenticatable
{
    use HasFactory, HasRoles, Bannable;

    public $timestamps;
    protected $table = 'doctors';
    protected $guard_name = 'web';
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
        'remember_token',
    ];

    protected $dates = [
        'created_at',
        'banned_at',

    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
