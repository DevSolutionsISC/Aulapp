<?php

namespace App\Http\Controllers;

use App\Models\Materia_Carrera;
use Illuminate\Http\Request;

class MateriaCarreraController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  //
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
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Materia_Carrera  $materia_Carrera
  * @return \Illuminate\Http\Response
  */
 public function show(Materia_Carrera $materia_Carrera)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Materia_Carrera  $materia_Carrera
  * @return \Illuminate\Http\Response
  */
 public function edit(Materia_Carrera $materia_Carrera)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Materia_Carrera  $materia_Carrera
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Materia_Carrera $materia_Carrera)
 {
  //
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Materia_Carrera  $materia_Carrera
  * @return \Illuminate\Http\Response
  */
 public function busqueda(Request $request)
 {
  try {
   $materiaCarrera = Materia_Carrera::query();

   if ($request->has('search')) {
    $materiaCarrera->where('id', 'like', $request->search);
   }
   $materiasCarrera = $materiaCarrera->get();
   return view('Materia.eliminar_materia_carrera', compact('materiasCarrera'));
  } catch (\Throwable $th) {
   return redirect()->route('eliminar-materia-carrera')->with('buscar', 'error');

  }
  $materiaCarrera = Materia_Carrera::query();

  if ($request->has('search')) {
   $materiaCarrera->where('id', 'like', $request->search);
  }
  $materiasCarrera = $materiaCarrera->get();
  return view('eliminar_materia_carrera', compact('materiasCarrera'));

 }
 public function estado($materia_carrera)
 {
  $materia_carrera         = Materia_Carrera::find($materia_carrera);
  $materia_carrera->estado = false;
  $materia_carrera->save();
  $materia_carrera->asignacionDocentes()->each(function ($asignacionDocente) {
   $asignacionDocente->where('id', $asignacionDocente->id)->update(['estado' => false]);
  });

  return redirect()->route('eliminar-materia-carrera')->with('eliminar', 'ok');
 }
}