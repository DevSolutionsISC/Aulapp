<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
}
public function materia_carrera(){
	return $this->belongsTo('App\Models\Materia_Carrera');
}

