<?php

namespace App\Http\Controllers;

use App\Models\AulaAsignada;
use App\Models\reserva;
use Illuminate\Support\Facades\Auth;

class respuestaAdmin extends Controller
{
 public function show()
 {
  $usuario = Auth::user();

  $respuestas = reserva::where('docentes', 'LIKE', '%' . $usuario->Nombre . '%')->get();
  return view('bandeja_docente', ['respuestas' => $respuestas]);
 }

 public function respuestasAdmin($id)
 {
  $mensaje = reserva::firstWhere('id', $id);
  $aulas   = AulaAsignada::join("aulas", "aulas.id", "aula_asignadas.aula_id")->where('reserva_id', $mensaje->id)->select("aulas.nombre")->get();

  $aulas = $aulas->implode('nombre', ',');

  //Notification::route('mail', $mensaje->user_rol->usuario->Email)->notify(new NotificacionReserva($mensaje, $aulas)); /* para usar cuando se guarde la reserva */

  return view('respuestaAdmin', ['mensaje' => $mensaje, 'aulas' => $aulas]);
 }
}