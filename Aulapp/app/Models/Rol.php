<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
}
public function usuarioRols(){
	return $this->hasMany('App\Models\UserRol');
}
