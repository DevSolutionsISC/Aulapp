<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuario;
use App\Models\asignacionDocentes;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use App\Models\UserRol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
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
 public function reporte()
 {
  $usuarios = Usuario::all();
  return view('Usuario-Docente\reporte_docente', compact('usuarios'));

 }

 public function registro()
 {
  $materias        = Materia::all();
  $carreras        = Carrera::all();
  $materia_carrera = Materia_Carrera::join("materias", "materias.id", "=", "materia_carreras.materia_id")->join("carreras", "carreras.id", "=", "materia_carreras.carrera_id")
   ->select("materia_carreras.id as id", "materias.id as id_materia", "carreras.id as id_carrera", "materias.nombre_materia as nom_materia", "carreras.Nombre as nom_carrera")->get();

  return view('Usuario-Docente\registrar_docente', ['materias' => $materias, 'carreras' => $carreras, 'materia_carrera' => $materia_carrera]);
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
 public function store(StoreUsuario $request)
 {
  $usuario           = new Usuario();
  $usuario->Nombre   = $request->nombre;
  $usuario->Apellido = $request->apellido;
  $usuario->CI       = $request->ci;
  $usuario->Email    = $request->email;

  $user       = explode(" ", $request->nombre);
  $iniciales  = "";
  $caracteres = "";
  for ($i = 0; $i < sizeof($user); $i++) {
   if ($user[$i] != "") {
    $iniciales = $iniciales . substr($user[$i], 0, 1);
    $caracteres .= $user[$i];
   }
  }

  $caracteres .= $request->ci;
  $Usercontrasenia = substr(str_shuffle($caracteres), 0, 10);
  $User            = $request->ci . $iniciales;

  $usuario->usuario     = $User;
  $usuario->contrasenia = $Usercontrasenia;
  $usuario->save();

  $userRol             = new UserRol();
  $id_usuario          = Usuario::firstWhere('CI', $request->ci);
  $userRol->usuario_id = $id_usuario->id;
  $userRol->rol_id     = 2;
  $userRol->save();

  

  return redirect()->route('docentes',['registrar'=>"ok"]);
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Usuario  $usuario
  * @return \Illuminate\Http\Response
  */
 public function show(Usuario $usuario)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Usuario  $usuario
  * @return \Illuminate\Http\Response
  */
 public function edit(Usuario $usuario)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Usuario  $usuario
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, $id)
 {
  $docente = Usuario::find($id);
  $request->validate([
   'Nombre'   => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u|min:3|max:60',
   'Apellido' => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u|min:2|max:60',
   'CI'       => 'bail|required|numeric|digits_between:6,10|unique:usuarios,CI,' . $docente->id,
   'Correo'   => 'bail|required|email|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9 @ . _]+$/|unique:usuarios,Email,' . $docente->id,
  ]);
  $docente->save();
  $ur          = DB::table("user_rols")->where(['usuario_id' => $id])->value('id');
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
    $asignacion                      = new asignacionDocentes();
    $asignacion->user_rol_id         = $ur;
    $asignacion->materia_carreras_id = $ids[$i];
    $asignacion->save();

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
    $sql = DB::table("asignacion_docentes")->where(['materia_carreras_id' => $idse[$i], 'user_rol_id' => $ur])->value('id');
    $a   = asignacionDocentes::find($sql);
    $a->delete();
   }

  }
  return redirect()->route('docentes_edit')->with('actualizar', 'ok');
 }

 public function showEdit()
 {
  $carreras        = Carrera::all();
  $materias        = Materia::all();
  $docentes        = Usuario::all();
  $a_docentes      = asignacionDocentes::all();
  $userRol         = UserRol::all();
  $materia_carrera = Materia_Carrera::join("materias", "materias.id", "=", "materia_carreras.materia_id")->join("carreras", "carreras.id", "=", "materia_carreras.carrera_id")
   ->select("materia_carreras.id as id", "materias.id as id_materia", "carreras.id as id_carrera", "materias.nombre_materia as nom_materia", "carreras.Nombre as nom_carrera")->get();

  return view('Usuario-Docente\editardocente', ['materias' => $materias, 'carreras' => $carreras, 'materia_carrera' => $materia_carrera, 'docentes' => $docentes, 'a_docentes' => $a_docentes, 'userRol' => $userRol]);

 }
 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Usuario  $usuario
  * @return \Illuminate\Http\Response
  */
 public function busqueda(Request $request)
 {
  try {
   $usuario = Usuario::query();

   if ($request->has('search')) {
    $usuario->where('CI', 'like', $request->search);
   }
   $usuarios = $usuario->get();
   return view('Usuario-Docente.eliminar_docente', compact('usuarios'));

  } catch (\Throwable $th) {
   return redirect()->route('eliminar-docente')->with('buscar', 'error');

  }

 }
 public function estado(Request $request, $usuario)
 {
  $usuario = Usuario::find($usuario);
  $usuario->where('id', $request->usuario)->update(['estado' => false]);

  $usuario->user_rol()->each(function ($user_rol) {
   $user_rol->where('id', $user_rol->id)->update(['estado' => false]);
   $user_rol->asignacionDocentes()->each(function ($asignacion_docente) {
    $asignacion_docente->where('id', $asignacion_docente->id)->update(['estado' => false]);
    $asignacion_docente->grupos()->each(function ($grupo) {
     $grupo->where('id', $grupo->id)->update(['estado' => false]);
    });
   });
  });

  return redirect()->route('eliminar-docente')->with('eliminar', 'ok');
 }
}