<?php

namespace App\Models;

use App\Models\Materia_Carrera;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignacionDocentes extends Model
{
    use HasFactory;
    public function materia_carrera()
    {
        return $this->belongsTo(Materia_Carrera::class, 'materia_carreras_id');
    }
}