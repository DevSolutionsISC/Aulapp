<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMateria;
use App\Models\asignacionDocentes;
use App\Models\Carrera;

//use Illuminate\Support\Facades\Session;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */

 public function index()
 {
  $carreras = Carrera::all();
  return view('Materia\registrar_materia', ['carreras' => $carreras]);

 }
 public function reporte()
 {
  $materias = Materia::all();
  return view('Materia\reporte_materia', compact('materias'));

 }
 public function showEdit()
 {
  $materias   = Materia::all();
  $carreras   = Carrera::all();
  $conexiones = Materia_Carrera::all();
  return view('Materia\editarmateria', ['materias' => $materias, 'carreras' => $carreras, 'conexiones' => $conexiones]);

 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
  //  return view('materia.create');
 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(StoreMateria $request)
 {
  $materia                 = new Materia();
  $materia->nombre_materia = $request->nombre;
  $materia->Cod_materia    = $request->codigo;
  $materia->save();

  $id_materia = Materia::firstWhere('Cod_materia', $request->codigo);
  $ids        = explode("+", $request->Nuevo);
  for ($i = 1; $i < sizeof($ids); $i++) {
   $materia_carrera             = new Materia_Carrera();
   $materia_carrera->materia_id = $id_materia->id;
   $materia_carrera->carrera_id = $ids[$i];

   $materia_carrera->save();
  }

  return redirect()->route('materias')->with('registrar', 'ok');

 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Materia  $materia
  * @return \Illuminate\Http\Response
  */
 public function show(Materia $materia)
 {

 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Materia  $materia
  * @return \Illuminate\Http\Response
  */
 public function edit(Materia $materia)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Materia  $materia
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, $id)
 {
  $materia = Materia::find($id);
  $request->validate([
   'Nombre' => 'required|regex:/^[\pL\s\-]+$/u|min:5|max:60|unique:materias,nombre_materia,' . $materia->id,
   'Codigo' => 'required|numeric|digits_between:6,10|unique:materias,Cod_materia,' . $materia->id,
  ]);

  $materia                 = Materia::find($id);
  $materia->nombre_materia = $request->Nombre;
  $materia->Cod_materia    = $request->Codigo;
  $materia->save();

  $id_materia  = Materia::firstWhere('Cod_materia', $request->Codigo);
  $ids         = explode("+", $request->Nuevo);
  $permanentes = explode("+", $request->permanente);

  for ($i = 1; $i < sizeof($ids); $i++) {
   $encontrado = 0;
   for ($j = 1; $j < sizeof($permanentes); $j++) {
    if ($ids[$i] == $permanentes[$j]) {
     $encontrado = 1;
    }
   }
   if ($encontrado == 0) {
    $materia_carrera             = new Materia_Carrera();
    $materia_carrera->materia_id = $id_materia->id;
    $materia_carrera->carrera_id = $ids[$i];
    $materia_carrera->save();
   }

  }
  $idse = explode("+", $request->Eliminar);
  for ($i = 1; $i < sizeof($idse); $i++) {
   $encontrado = 0;
   for ($j = 1; $j < sizeof($permanentes); $j++) {
    if ($idse[$i] == $permanentes[$j]) {
     $encontrado = 1;
    }
   }
   if ($encontrado == 1) {
    $sql = DB::table("materia_carreras")->where(['carrera_id' => $idse[$i], 'materia_id' => $id])->value('id');
    $a   = Materia_Carrera::find($sql);
    $a->delete();
   }

  }
  return redirect()->route('materia_edit')->with('actualizar', 'ok');

 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Materia  $materia
  * @return \Illuminate\Http\Response
  */
 public function busqueda(Request $request)
 {

  try {
   $materia = Materia::query();

   if ($request->has('search')) {
    $materia->where('Cod_materia', 'like', $request->search);
   }
   $materias = $materia->get();
   return view('Materia.eliminar_materia', compact('materias'));

  } catch (\Throwable $th) {
   return redirect()->route('eliminar-materia')->with('buscar', 'error');

  }

 }
 public function estado(Request $request, $materia)
 {
  $materia = Materia::find($materia);
  $materia->where('id', $request->materia)->update(['estado' => false]);

  $materia->materia__carreras()->each(function ($materia_carrera) {
   $materia_carrera->where('id', $materia_carrera->id)->update(['estado' => false]);
   $materia_carrera->asignacionDocentes()->each(function ($asignacion_docente) {
    $asignacion_docente->where('id', $asignacion_docente->id)->update(['estado' => false]);

   });
  });

  return redirect()->route('eliminar-materia')->with('eliminar', 'ok');
 }
}