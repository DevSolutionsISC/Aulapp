<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    public function user_rol()
    {
        return $this->hasMany(UserRol::class, 'rol_id');
    }
}