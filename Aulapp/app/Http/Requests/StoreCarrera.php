<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarrera extends FormRequest
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
            'nombre' => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ ]+$/u|min:3|max:30|unique:carreras',
            'codigo' => 'bail|required|numeric|unique:carreras|digits_between:6,10',
        ];
    }
    public function messages()
    {
        return[
            'nombre.required'=>'El campo \'Nombre\' es obligatorio',
            'nombre.regex' => 'Solo se aceptan caracteres alfabéticos y espacios.',
            'nombre.unique'=> 'Ya existe una carrera registrada con ese nombre.',
            'codigo.required'=>'El campo \'Codigo\' es obligatorio',
            'codigo.unique'=> 'Ya existe una carrera registrada con ese codigo.',
            'codigo.numeric'=>'Solo se aceptan caracteres numéricos.',
        ];
    }
}
