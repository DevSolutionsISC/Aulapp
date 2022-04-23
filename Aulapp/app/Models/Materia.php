<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_materia','Cod_materia'];
}

public function materia_carrera(){
	return $this->hasMany('App\Models\Materia_Carrera');
}
public function docente(){
	return $this->belongsTo('App\Models\Docente');
}