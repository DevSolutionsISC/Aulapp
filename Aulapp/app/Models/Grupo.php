<?php

namespace App\Models;


use App\Models\Materia_Carrera;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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