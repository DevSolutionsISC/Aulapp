<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreLogin;
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(StoreLogin $request): RedirectResponse
    {
        $credentials = $request->validate([
            'usuario' => ['required'],
            'contrasenia' => ['required'],
        ]);


        $usuario = Usuario::query()
            ->where('usuario', $credentials['usuario'])
            ->where('contrasenia', $credentials['contrasenia'])
            ->first();

      

        if ($usuario) {
            Auth::login($usuario);
            $request->session()->regenerate();
            return redirect()->intended('/menu')->with('id',$usuario->id);
        }
         else{
            throw \Illuminate\Validation\ValidationException::withMessages([
                'usuario' => __('auth.failed'),
                'contrasenia' => __('auth.failed')
                
            ]);
         }     
      

       /* if('contrasenia'!=$credentials['contrasenia'])
        {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'contrasenia' => __('auth.password'),
                
            ]);
        }*/

    }



    /**
     * @param Request $request
     * @return string
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/');
    }
}
