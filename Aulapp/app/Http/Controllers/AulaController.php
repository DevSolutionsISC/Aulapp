<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAula;
use App\Models\Aula;
use App\Models\AulaAsignada;
use App\Models\reserva;
use App\Models\Seccion;
use App\Notifications\NotificacionReserva;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;

class AulaController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

 public function vistaRegistro()
 {
  $seccions = Seccion::where('estado', true)->get();
  return view('Aula.registrar_aula', ['seccions' => $seccions]);
 }
 public function reporte()
 {

  $aulas = Aula::all();
  return view('Aula.reporte_aula', compact('aulas'));

 }

 public function vistaEditar()
 {
  $aulas     = Aula::all();
  $secciones = Seccion::all();
  return view('Aula.editar_aula', ['secciones' => $secciones, 'aulas' => $aulas]);

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
 public function registro(StoreAula $request)
 {

  $aula             = new Aula();
  $aula->nombre     = $request->nombre;
  $aula->capacidad  = $request->capacidad;
  $aula->section_id = $_POST['seccion'];

  $aula->save();

  return redirect()->route('aulas')->with('registrar', 'ok');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Aula  $aula
  * @return \Illuminate\Http\Response
  */
 public function show(Aula $aula)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Aula  $aula
  * @return \Illuminate\Http\Response
  */
 public function edit(Aula $aula)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Aula  $aula
  * @return \Illuminate\Http\Response
  */
 public function editar(Request $request, $id)
 {
  $aula = Aula::find($id);
  $request->validate([
   'Nombre'    => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9]+$/|min:3|max:10|unique:aulas,nombre,' . $aula->id,
   'capacidad' => 'bail|required|numeric|between:1,300',
  ]);
  $aula->nombre     = $request->Nombre;
  $aula->capacidad  = $request->capacidad;
  $aula->section_id = $request->section;
  $aula->estado     = $request->estadoE;
  $aula->save();

  return redirect()->route('aulas_edit')->with('actualizar', 'ok');
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Aula  $aula
  * @return \Illuminate\Http\Response
  */
 public function busqueda(Request $request)
 {
  try {
   $aula = Aula::query();

   if ($request->has('search')) {
    $aula->where('nombre', 'like', $request->search);
   }
   $aulas = $aula->get();
   return view('Aula.eliminar_aula', compact('aulas'));

  } catch (\Throwable $th) {
   return redirect()->route('eliminar-aula')->with('buscar', 'error');

  }

 }
 public function estado($id)
 {
  $aulas_asignadas = AulaAsignada::all();
  $aula            = Aula::find($id);
  $reservas        = reserva::all();
  $fecha           = Carbon::now();
  foreach ($aulas_asignadas as $aula_asignada) {
   if ($aula_asignada->aula_id == $aula->id) {
    foreach ($reservas as $reserva) {

     if ($reserva->id == $aula_asignada->reserva_id && $reserva->fecha_examen == $fecha->toDateString() && $reserva->estado == 'aceptado' && ($fecha->toTimeString() < $reserva->hora_inicio || $reserva->hora_fin > $fecha->toTimeString())) {
      foreach ($aulas_asignadas as $aula_asignada) {
       if ($aula_asignada->reserva_id == $reserva->id) {
        $aula_asignada->delete();
       }
      }

      $reserva->estado = "reasignar";
      $reserva->save();
      Notification::route('mail', $reserva->user_rol->usuario->Email)->notify(new NotificacionReserva($reserva));
     } else if ($reserva->id == $aula_asignada->reserva_id && $reserva->fecha_examen > $fecha->toDateString() && $reserva->estado == 'aceptado') {
      foreach ($aulas_asignadas as $aula_asignada) {
       if ($aula_asignada->reserva_id == $reserva->id) {
        $aula_asignada->delete();
       }
      }

      $reserva->estado = "reasignar";
      $reserva->save();

      Notification::route('mail', $reserva->user_rol->usuario->Email)->notify(new NotificacionReserva($reserva));
     }
    }
   }
  }

  $aula->estado = false;
  $aula->save();

  return redirect()->route('eliminar-aula')->with('eliminar', 'ok');

 }
}