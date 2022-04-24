<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'sections';
    public function aulas()
    {
        return $this->hasMany(Aula::class);
    }
}