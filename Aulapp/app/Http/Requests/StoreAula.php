<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAula extends FormRequest
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
        
        $validacion=[
            'nombre' => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9]+$/|min:3|max:10|unique:sections',
            'capacidad' => 'bail|required|numeric|between:10,500',
            'seccion'=>'required'
        ];


        return $validacion;
    }
    public function messages()
    {
        return[
            'nombre.required'=>'El campo nombre es obligatorio',
            'nombre.regex' => 'Solo se aceptan caracteres alfanuméricos',
            'nombre.unique'=> 'Ya existe una seccion de aula registrado con ese nombre.',
            'capacidad.required'=>'El campo capacidad es obligatorio',

        ];
    }
}
