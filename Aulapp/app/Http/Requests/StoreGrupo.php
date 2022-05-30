<?php

namespace App\Http\Requests;

use App\Models\Materia_Carrera;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SeleccionMateri;
use App\Rules\UniqueGrupo;
use App\Rules\ValidacionGrupo;

class StoreGrupo extends FormRequest
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
            'nombre'=>'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9 ]+$/|max:3:',
            'carrera'=>[new ValidacionGrupo],
            'materia'=>[new SeleccionMateri,new UniqueGrupo],
            
           
        ];
    }

   

    public function messages()
    {
        return[
            
            'nombre.unique'=> 'Ya existe un grupo registrado con ese nombre en la misma materia.',
            'nombre.required'=>'El campo nombre es obligatorio',
             'nombre.regex'=>'Solo se aceptan caracteres alfanuméricos',
             
                        
           
        ];
    }
}
