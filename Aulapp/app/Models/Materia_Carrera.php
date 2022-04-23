<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia_Carrera extends Model
{
    use HasFactory;
}
public function carrera(){
	return $this->belongsTo('App\Models\Carrera');
}

public function materia(){
	return $this->belongsTo('App\Models\Materia');
}
public function grupos(){
	return $this->hasMany('App\Models\Grupo');
}
