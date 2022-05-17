<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function loadMenu(Request $request)
    {
        $usuario = Auth::user();
        $rol = $usuario->getRol();

        $privilegios = $this->obtenerPrivilegios($rol);

        return view('menu', [
            'rol' => $rol,
            'privilegios' => $privilegios,
        ]);
    }

    private function obtenerPrivilegios($rol)
    {
        return $rol->privilegios()
            ->with('funcionalidad')
            ->where('listar', true)
            ->get();
    }
}
