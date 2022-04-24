<?php

namespace App\Models;

use App\Models\Carrera;
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
}