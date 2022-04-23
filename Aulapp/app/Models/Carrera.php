<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
}
/*public function grupos(){
	return $this->hasMany('App\Models\Grupo');
}
*/
public function materias(){
	return $this->hasMany('App\Models\Materia');
}