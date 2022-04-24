<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarrerasEdirRequest extends FormRequest
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
            'Nombre' => 'bail|required|min:3|max:20|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u',
            'Codigo' => 'bail|required|numeric|digits_between:6,10| unique:carreras,Codigo,',
        ];
    }
}
