<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMateria extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    public function rules()
    {
        return [      
        'nombre' => 'required|regex:/^[\pL\s\-]+$/u|min:5|max:20',
        'codigo' => 'required|min:6|max:10|unique:materias'
        ];
    }

    public function attributes(){
        return[
            'nombre_materia'=> 'nombre',
            'Cod_materia'=>'código'
        ];
    }

    public function messages()
    {
        return[
            'nombre_materia.regex' => 'Solo se aceptan caracteres alfabéticos y espacios.',
            'nombre_materia.unique'=> 'Ya existe una materia registrada con ese nombre.',
            'Cod_materia.unique'=> 'Ya existe una materia registrada con ese código.'
        ];
    }
}
