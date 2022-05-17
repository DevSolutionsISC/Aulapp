<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
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

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
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
