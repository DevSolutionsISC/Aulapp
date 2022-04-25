<?php

namespace App\Models;

use App\Models\Carrera;
use App\Models\Grupo;
use App\Models\Materia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia_Carrera extends Model
{
    use HasFactory;
    protected $table = 'materia__carreras';
    protected $primaryKey = 'id';

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}