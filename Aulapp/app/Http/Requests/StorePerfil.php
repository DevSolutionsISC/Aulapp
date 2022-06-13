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
            'new_password_confirmation' =>'required|alpha_num|min:10|max:20',
        ];
    }
    public function messages()
    {
        return[
            'new_password.alpha_num'=>'El campo "Nueva contraseña" sólo puede contener letras y números.',
            'new_password_confirmation.alpha_num'=>'El campo "Repetir contraseña" sólo puede contener letras y números.',
            'new_password.min'=>'El campo "Contraseña actual" debe tener al menos 10 caracteres.',
            'new_password.max'=>'El campo "Contraseña actual" debe ser menor que 20 caracteres.',
            'new_password_confirmation.min'=>'El campo "Repetir contraseña" debe tener al menos 10 caracteres.',
            'new_password_confirmation.max'=>'El campo "Repetir contraseña" debe ser menor que 20 caracteres.',
            'old_password.exists'=>'La contraseña es incorrecta.',
            'old_password.required'=>'El campo "Contraseña actual" es obligatorio.',
            'new_password.required'=>'El campo "Contraseña nueva" es obligatorio.',
            'new_password.confirmed'=>'El campo "Repetir contraseña" no coincide con este campo.',
            'new_password_confirmation.required'=>'El campo "Repetir contraseña" es obligatorio.',
            
        ];
    }
}
