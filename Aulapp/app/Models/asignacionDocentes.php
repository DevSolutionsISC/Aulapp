<?php

namespace App\Models;

use App\Models\Grupo;
use App\Models\Materia_Carrera;
use App\Models\UserRol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignacionDocentes extends Model
{
    use HasFactory;
    public function materia_carrera()
    {
        return $this->belongsTo(Materia_Carrera::class, 'materia_carreras_id');
    }
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'asignacion_docentes_id');
    }
    public function user_rol()
    {
        return $this->belongsTo(UserRol::class, 'user_rol_id');
    }

}