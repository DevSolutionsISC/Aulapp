<?php

namespace App\Models;

use App\Models\asignacionDocentes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    //
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'grupos';
    public function asignacionDocente()
    {
        return $this->belongsTo(asignacionDocentes::class, 'asignacion_docentes_id');
    }
}