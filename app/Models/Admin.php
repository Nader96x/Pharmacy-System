<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, HasRoles;

    /**
     * @var array|bool|mixed|string|null
     */
    protected $fillable = [
        'email',
        'password',
        'name',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = 'admins';
    // add validations
    public static $rules = [
        'email' => 'required|email|unique:admins',
        'password' => 'required|min:6',
    ];
}
