<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionGrupo extends Model
{
    use HasFactory;
}
public function userRol(){
	return $this->belongsTo('App\Models\UserRol');
}
