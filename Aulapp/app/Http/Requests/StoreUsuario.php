<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuario extends FormRequest
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
            'nombre' => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u|min:3|max:60',
            'apellido' => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u|min:2|max:60',
            'ci'=>'bail|required|numeric|digits_between:6,10|unique:usuarios,CI',
            'email'=>'bail|required|email|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9 @ . _]+$/|unique:usuarios,Email',
            'Nuevo'=>'required'
        ];
    }

    public function messages()
    {
        return[
            'nombre.regex' => 'Solo se aceptan caracteres alfabéticos y espacios.',
            'nombre.required'=>'El campo nombre es obligatorio',
                     
            'apellido.regex' => 'Solo se aceptan caracteres alfabéticos y espacios.',
            'apellido.required'=>'El campo apellido es obligatorio',

            'ci.unique'=> 'Ya existe un usuario registrado con ese ci.',
            'ci.required'=>'El campo ci es obligatorio', 
            
            'email.unique'=> 'Ya existe un usuario registrado con ese email.',
            'email.required'=> 'El campo email es obligatorio',

            'Nuevo.required'=>'Debe tener al menos una materia asignada'
        ];
    }
}