<?php

namespace App\Http\Controllers;

use App\Models\nuevasnotificacion;
use App\Models\UserRol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function loadMenu(Request $request)
    {
        $usuario = Auth::user();
        $rol = $usuario->getRol();

        $privilegios = $this->obtenerPrivilegios($rol);
        $ur = UserRol::where("usuario_id",$usuario->id)->get();
       $not= nuevasnotificacion::where("user_rol_id",$ur[0]->id)->get();
        $cantidad=0;
       if($not!="[]"){
            $cantidad=$not[0]->cantidad_not;
        }
       return view('menu', [
            'rol' => $rol,
            'privilegios' => $privilegios,
           "not"=> $cantidad
        ]);

    }


    public function loadPerfil($id)
    {
        $usuario = Auth::user();
    
     return view('Perfil-Usuario.perfil', ['usuario' => $usuario]);
    }

    private function obtenerPrivilegios($rol)
    {
        return $rol->privilegios()
            ->with('funcionalidad')
            ->where('listar', true)
            ->get();
    }
}
