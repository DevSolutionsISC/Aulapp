<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    use HasFactory;
}

public function usuario(){
	return $this->belongsTo('App\Models\Usuario');
}


public function rol(){
	return $this->belongsTo('App\Models\Rol');
}

public function asignacionGrupos(){
	return $this->hasMany('App\Models\AsignacionGrupo');
}