<?php

namespace App\Http\Requests;

use App\Rules\Seleccion;
use App\Rules\SeleccionMateri;
use Illuminate\Foundation\Http\FormRequest;

class StoreAsignacion extends FormRequest
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
  
            'docente'=>[new Seleccion],
            'materia'=>[new SeleccionMateri]
        ];
    }

  

}
