<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
}
public function materia(){
	return $this->belongsTo('App\Models\Materia');
}
public function carrera(){
	return $this->belongsTo('App\Models\Carrera');
}
public function docente(){
	return $this->belongsTo('App\Models\Docente');
}
