<?php

namespace App\Http\Controllers;

use App\Models\gestion;
use App\Models\nuevasnotificacion;
use App\Models\reserva;
use App\Models\UserRol;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class infoRechazados extends Controller
{
    public function reporte(){
        $usuario = Auth::user();
        $gestion=gestion::where("estado",1)->get();
        $ur = UserRol::where("usuario_id",$usuario->id)->get();
        $not= nuevasnotificacion::where("user_rol_id",$ur[0]->id)->get();
        $cantidad=0;
             if($not!="[]"){
                  $cantidad=$not[0]->cantidad_not;
              }
        $rechazados = reserva::where('estado','rechazado')->get();
        $date=new DateTime('now');
        $date=$date->format('Y-m-d H:i:s');
        echo($date);
       // return view('InfoRechazados.infoRechazados',['not'=>$cantidad,'rechazados'=>$rechazados]);
    }
}
