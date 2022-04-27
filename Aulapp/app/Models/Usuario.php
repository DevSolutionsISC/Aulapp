<?php

namespace App\Models;

use App\Models\UserRol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    public function user_rol()
    {
        return $this->hasMany(UserRol::class, 'usuario_id');
    }
}