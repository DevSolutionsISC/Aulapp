<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Seleccion;
use App\Rules\SeleccionMateri;
use App\Rules\SeleccionCarrera;

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
            'nombre'=>'bail|required|unique:grupos,nombre,null,id,asignacion_docentes_id,'.$this->get('docente').'|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9 : ]+$/|min:2|max:4:',
            'carrera'=>[new SeleccionCarrera],
            'materia'=>[new SeleccionMateri],
            'docente'=>[new Seleccion],
        ];
    }
}
