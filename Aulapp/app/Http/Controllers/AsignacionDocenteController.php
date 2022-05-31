<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsignacion;
use App\Models\asignacionDocentes;
use App\Models\gestion;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\UserRol;
use Illuminate\Http\Request;

class AsignacionDocenteController extends Controller
{

 public function registro()
 {
  $materias       = Materia::where('estado', true)->get();
  $grupos         = Grupo::join("materia_carreras", "materia_carreras.id", "=", "grupos.materia_carrera_id")->join("materias", "materias.id", "=", "materia_carreras.materia_id")->where('grupos.estado', true)->select("grupos.*", "materias.id as materia_id")->get();
  
  $grupos=$grupos->unique(function ($item) {
    return $item['nombre'].$item['materia_id'];
});
  
  $docentes       = UserRol::all();
  $gestion        = gestion::firstWhere('estado', true);
  $docente_grupos = asignacionDocentes::where('gestion_id', $gestion->id)->get();
 
  $filtered       = $grupos->reject(function ($value, $key) {
   $gestion        = gestion::firstWhere('estado', true);
 
   $docente_grupos = asignacionDocentes::where('gestion_id', $gestion->id)->where('estado', true)->get();
  
   return $docente_grupos->contains('grupo_id', $value->id);
  });
  
return view('Asignacion-Docente.registro_asignacion_docente', ['materias' => $materias, 'docentes' => $docentes, 'docente_materias' => $docente_grupos, 'grupos' => $filtered]);
 }

 public function store(StoreAsignacion $request)
 {

  $grupos = Grupo::join("materia_carreras", "materia_carreras.id", "=", "grupos.materia_carrera_id")->join("materias", "materias.id", "=", "materia_carreras.materia_id")->where('grupos.estado', true)->where('grupos.nombre', $request->grupo)->where('materias.id', $request->materia)->select("grupos.id")->get();
  
  
  $gestion = gestion::firstWhere('estado', true);
  foreach ($grupos as $grupo) {
    $deshabilitado=asignacionDocentes::where('grupo_id',$grupo->id)->where('user_rol_id', $request->docente)->where('gestion_id',$gestion->id)->where('estado',false)->get();
    
    if($deshabilitado->isNotEmpty()){
        $deshabilitado[0]->estado=true;
        $deshabilitado[0]->save();
    }else{
        $asignacion_docente              = new asignacionDocentes();
        $asignacion_docente->user_rol_id = $request->docente;
        $asignacion_docente->grupo_id    = $grupo->id;
        $asignacion_docente->gestion_id  = $gestion->id;
        $asignacion_docente->save();
    }
  
  }

  return redirect()->route('materia_docente')->with('registrar', 'ok');

 }

 public function busqueda(Request $request)
 {

  try {
   $asignacionDocente = asignacionDocentes::query();

   if ($request->has('search')) {
    $asignacionDocente->where('id', 'like', $request->search);
   }
   $asignacionDocentes = $asignacionDocente->get();
   return view('Asignacion-Docente.eliminar_asignacion_docente', compact('asignacionDocentes'));

  } catch (\Throwable $th) {
   return redirect()->route('eliminar-asignacion-docente')->with('buscar', 'error');

  }

 }
 public function reporte()
 {

  $asignacionDocentes = asignacionDocentes::all();
  return view('Asignacion-Docente.reporte_asignacion_docente', compact('asignacionDocentes'));

 }
 public function estado($asignacion_docente)
 {
  $asignacion_docente  = asignacionDocentes::find($asignacion_docente);
  $asignacion_docentes = asignacionDocentes::all();
  foreach ($asignacion_docentes as $asignacion_docente_) {
   if ($asignacion_docente_->user_rol->usuario->Nombre == $asignacion_docente->user_rol->usuario->Nombre && $asignacion_docente_->grupos->nombre == $asignacion_docente->grupos->nombre && $asignacion_docente_->grupos->materia_carrera->materia->nombre_materia == $asignacion_docente->grupos->materia_carrera->materia->nombre_materia) {
    $asignacion_docente_->estado = false;
    $asignacion_docente_->save();
   }
  }

  // dump($asignacion_docente->user_rol->usuario->Nombre);
  return redirect()->route('eliminar-asignacion-docente')->with('eliminar', 'ok');
 }
}