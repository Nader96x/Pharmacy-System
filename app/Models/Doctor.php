<?php

namespace App\Models;

use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Authenticatable
{
    use HasFactory, HasRoles, Bannable;
}
