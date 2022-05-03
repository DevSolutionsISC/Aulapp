<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use app\Models\Materia;
use app\Models\Grupo;
use app\Models\asignacionDocentes;

class ControlGrupo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     * 
     */

     public $nomGrupo;

    public function __construct($nomGrupo)
    {
      $this->nomGrupo=$nomGrupo;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $materias=Materia::all();
        $grupos=Grupo::where('nombre',$this->nomGrupo);

        for($i=0;$i<sizeof($grupos);$i++){
            
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
