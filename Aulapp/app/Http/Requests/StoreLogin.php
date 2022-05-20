<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogin extends FormRequest
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
            'usuario' => ['required'],
            'contrasenia' => ['required'],
        ];
    }
    public function messages()
    {
        return[
            'usuario.required'=>'El campo usuario es obligatorio',
            'contrasenia.required'=>'El campo contraseña es obligatorio',
            
        ];
    }
}
