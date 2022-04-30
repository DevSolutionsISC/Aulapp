<?php

namespace App\Http\Controllers;

use App\Models\asignacionDocentes;
use Illuminate\Http\Request;

class AsignacionDocenteController extends Controller
{
 public function busqueda(Request $request)
 {

  try {
   $asignacionDocente = asignacionDocentes::query();

   if ($request->has('search')) {
    $asignacionDocente->where('id', 'like', $request->search);
   }
   $asignacionDocentes = $asignacionDocente->get();
   return view('Usuario-Docente.eliminar_asignacion_docente', compact('asignacionDocentes'));

  } catch (\Throwable $th) {
   return redirect()->route('eliminar-asignacion-docente')->with('buscar', 'error');

  }

 }
 public function estado($asignacion_docente)
 {
  $asignacion_docente         = asignacionDocentes::find($asignacion_docente);
  $asignacion_docente->estado = false;
  $asignacion_docente->save();

  $asignacion_docente->where('id', $asignacion_docente->id)->update(['estado' => false]);
  $asignacion_docente->grupos()->each(function ($grupo) {
   $grupo->where('id', $grupo->id)->update(['estado' => false]);
  });

  return redirect()->route('eliminar-asignacion-docente')->with('eliminar', 'ok');
 }
}