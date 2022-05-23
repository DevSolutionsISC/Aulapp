<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materia_Carrera;
use App\Models\asignacionDocentes;


class Grupo extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'grupos';

    
    public function materia_carrera()
    {
        return $this->belongsTo(Materia_Carrera::class, 'materia_carrera_id');
    }

   
}