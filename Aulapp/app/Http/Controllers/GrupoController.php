<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupo;
use App\Models\asignacionDocentes;
use App\Models\Carrera;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use App\Models\UserRol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {

 }
 public function showEdit()
 {
  $grupos   = Grupo::all();
  $docentes = Usuario::all();
  $carreras = Carrera::all();
  $materias = Materia::all();
  $Urs      = UserRol::all();
  $ads      = asignacionDocentes::all();
  $mcs      = Materia_Carrera::all();
  return view('Grupo.editargrupo', ['grupos' => $grupos, 'docentes' => $docentes, 'carreras' => $carreras, 'materias' => $materias, 'urs' => $Urs, "ads" => $ads, "mcs" => $mcs]);

 }

 public function registro()
 {

  $carreras        = Carrera::where('estado',true)->get();
  $materia_carrera = Materia_Carrera::where('estado',true)->get();
  $materias=Materia::where('estado',true)->get();
  $docentes   = Usuario::where('estado',true)->get();
  $user_rol   = UserRol::where('estado',true)->get();
  $asignacion = asignacionDocentes::where('estado',true)->get();
  $grupos= Grupo::where('estado',true)->get();

  return view('Grupo.registrar_grupo', ['urs' => $user_rol, 'ads' => $asignacion, 'docentes' => $docentes, 'carreras' => $carreras, 'materia_carrera' => $materia_carrera,'grupos'=> $grupos, 'materias'=>$materias]);

 }

 /*public function reporte()
 {
  $grupos   = Grupo::all();
  $docentes = Usuario::all();
  $carreras = Carrera::all();
  $materias = Materia::all();
  $Urs      = UserRol::all();
  $ads      = asignacionDocentes::all();
  $mcs      = Materia_Carrera::all();
  return view('Grupo.reporte_grupo', ['grupos' => $grupos, 'docentes' => $docentes, 'carreras' => $carreras, 'materias' => $materias, 'urs' => $Urs, "ads" => $ads, "mcs" => $mcs]);

 }*/
 public function reporte()
    {
        $grupos = Grupo::all();
        return view('Grupo.reporte_grupo', compact('grupos'));

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
 public function store(StoreGrupo $request)
 {
  $grupo                         = new Grupo();
  $grupo->nombre                 = "G:".$request->nombre;
  $grupo->asignacion_docentes_id = $request->docente;
  $grupo->save();

  return redirect()->route('grupos')->with('registrar', 'ok');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Grupo  $grupo
  * @return \Illuminate\Http\Response
  */
 public function show(Grupo $grupo)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Grupo  $grupo
  * @return \Illuminate\Http\Response
  */
 public function edit(Grupo $grupo)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Grupo  $grupo
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, $id)
 {
  $grupo = Grupo::find($id);
  if($request->docente != 0){
      $grupo->asignacion_docentes_id=$request->docente;
  }
  $grupo->estado=$request->estadoE;
  $grupo->save();
  return redirect()->route('grupo_edit')->with('actualizar', 'ok');
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Grupo  $grupo
  * @return \Illuminate\Http\Response
  */
 public function busqueda(Request $request)
 {
  try {
   $grupo = Grupo::query();

   if ($request->has('search')) {
    $grupo->where('id', 'like', $request->search);
   }
   $grupos = $grupo->get();
   return view('Grupo.eliminar_grupo', compact('grupos'));

  } catch (\Throwable $th) {
   return redirect()->route('eliminar-grupo')->with('buscar', 'error');

  }

 }
 public function estado($id)
 {
  $grupo         = Grupo::find($id);
  $grupo->estado = false;
  $grupo->save();

  return redirect()->route('eliminar-grupo')->with('eliminar', 'ok');
 }
}