<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Usuario;
class StorePerfil extends FormRequest
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
            
            'old_password' => 'required|exists:usuarios,contrasenia',
            'new_password' => 'required|confirmed|alpha_num|min:10|max:20',
            'new_password_confirmation' =>'required|min:10|max:20',
        ];
    }
    public function messages()
    {
        return[
            'new_password.min'=>'El campo contraseña actual debe tener al menos 10 caracteres.',
            'new_password.max'=>'El campo contraseña actual debe ser menor que 20 caracteres.',
            'old_password.exists'=>'La contraseña es incorrecta.',
            'old_password.required'=>'El campo contraseña actual es obligatorio.',
            'new_password.required'=>'El campo contraseña nueva es obligatorio.',
            'new_password.confirmed'=>'El campo de confirmación repetir contraseña no coincide.',
            'new_password_confirmation.required'=>'El campo repetir contraseña es obligatorio.',
            
        ];
    }
}
