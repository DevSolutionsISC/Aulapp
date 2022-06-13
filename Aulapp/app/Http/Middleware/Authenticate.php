<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
        if (Auth::guard($guard)->check() && auth()->user()->estado == 0) {

            // usuario con sesión iniciada pero inactivo
        
            // cerramos su sesión
            Auth::guard()->logout();
        
            // invalidamos su sesión
            $request->session()->invalidate();
        
            // redireccionamos a donde queremos
            redirect('/ruta-para-usuario-desactivado');
        }
    }
}
