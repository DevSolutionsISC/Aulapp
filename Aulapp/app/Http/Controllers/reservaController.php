<?php

namespace App\Http\Controllers;

use App\Models\asignacionDocentes;
use App\Models\Aula;
use App\Models\AulaAsignada;
use App\Models\Materia;
use App\Models\reserva;
use App\Notifications\NotificacionReserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class reservaController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
 }

 public function registro()
 {

  $ads = asignacionDocentes::all();

  return view('registrarreserva', ['ads' => $ads]);
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
  //
 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(Request $request)
 {
  //
  $reserva                 = new reserva();
  $reserva->motivo         = $request->motivo;
  $reserva->estado         = "enviado";
  $reserva->fecha_examen   = $request->fecha;
  $reserva->hora_inicio    = $request->horario;
  $reserva->hora_fin       = $request->fechaf;
  $reserva->cantE          = $request->cantidad;
  $reserva->grupos         = $request->grupos;
  $reserva->docentes       = $request->docentes;
  $reserva->materia        = $request->materia;
  $reserva->user_rol_id    = $request->id;
  $reserva->motivo_rechazo = "";
  $reserva->save();
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
  $reserva        = reserva::find($id);
  $aulasAsignadas = AulaAsignada::all();
  return view('respuesta', compact('reserva', 'aulasAsignadas'));
 }

 public function respuesta(Request $request, $id, $estado)
 {
  $aulas_asignadas = [];
  if ($estado == 0) {
   $request->validate([
    'motivo_rechazo' => 'required',
   ]);
   $rechazado                 = reserva::find($id);
   $rechazado->estado         = "rechazado";
   $rechazado->motivo_rechazo = $request->motivo_rechazo;
   $rechazado->save();
   Notification::route('mail', $rechazado->user_rol->usuario->Email)->notify(new NotificacionReserva($rechazado)); /* para usar cuando se guarde la reserva */

  } else {
   $aceptado         = reserva::find($id);
   $aceptado->estado = "aceptado";
   $aceptado->save();
   $aulas = explode(",", $request->aulas_nombres);
   for ($i = 0; $i < sizeof($aulas); $i++) {
    $aula_asignada             = new AulaAsignada();
    $sql                       = Aula::where("nombre", $aulas[$i])->value("id");
    $aula_asignada->reserva_id = $id;
    $aula_asignada->aula_id    = $sql;
    $aula_asignada->save();
    $aulas_asignadas[] = $aula_asignada;
   }
   Notification::route('mail', $aceptado->user_rol->usuario->Email)->notify(new NotificacionReserva($aceptado, $aulas_asignadas)); /* para usar cuando se guarde la reserva */

  }

  return redirect()->route('respuestaAdmin')->with('actualizar', 'ok');
 }
 public function reportePeticiones()
 {
  $reservas = reserva::All();
  return view('bandeja_administrador', compact('reservas'));
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function edit($id)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, $id)
 {
  //
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function destroy($id)
 {
  //
 }
}