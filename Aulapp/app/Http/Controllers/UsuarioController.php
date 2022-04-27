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
        return view('reporte_docente', compact('usuarios'));

    }

    public function registro()
    {
        $materias = Materia::all();
        $carreras = Carrera::all();
        $materia_carrera = Materia_Carrera::join("materias", "materias.id", "=", "materia_carreras.materia_id")->join("carreras", "carreras.id", "=", "materia_carreras.carrera_id")
            ->select("materia_carreras.id as id", "materias.id as id_materia", "carreras.id as id_carrera", "materias.nombre_materia as nom_materia", "carreras.Nombre as nom_carrera")->get();

        return view('registrar_docente', ['materias' => $materias, 'carreras' => $carreras, 'materia_carrera' => $materia_carrera]);
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
        $usuario = new Usuario();
        $usuario->Nombre = $request->nombre;
        $usuario->Apellido = $request->apellido;
        $usuario->CI = $request->ci;
        $usuario->Email = $request->email;

        $user = explode(" ", $request->nombre);
        $iniciales = "";
        $caracteres = "";
        for ($i = 0; $i < sizeof($user); $i++) {
            if ($user[$i] != "") {
                $iniciales = $iniciales . substr($user[$i], 0, 1);
                $caracteres .= $user[$i];
            }
        }

        $caracteres .= $request->ci;
        $Usercontrasenia = substr(str_shuffle($caracteres), 0, 10);
        $User = $request->ci . $iniciales;

        $usuario->usuario = $User;
        $usuario->contrasenia = $Usercontrasenia;
        $usuario->save();

        $userRol = new UserRol();
        $id_usuario = Usuario::firstWhere('CI', $request->ci);
        $userRol->usuario_id = $id_usuario->id;
        $userRol->rol_id = 2;
        $userRol->save();

        $id_userRol = UserRol::select('id')->orderBy('id', 'desc')->first();

        $ids = explode("+", $request->Nuevo);
        for ($i = 1; $i < sizeof($ids); $i++) {
            $asignacion = new asignacionDocentes();
            $asignacion->user_rol_id = $id_userRol->id;
            $asignacion->materia_carreras_id = $ids[$i];

            $asignacion->save();
        }

        return redirect()->route('docentes')->with('registrar', 'ok');
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
    public function update(Request $request, Usuario $usuario)
    {
        //
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
            return view('eliminar_docente', compact('usuarios'));

        } catch (\Throwable $th) {
            return redirect()->route('eliminar-docente')->with('buscar', 'error');

        }

    }
    public function destroy($usuario)
    {

        $usuario = Usuario::find($usuario);
        $newUser = $usuario->replicate();
        $newUser->setTable('log_docentes');
        $newUser->save();

        $usuario->user_rol()->each(function ($user_rol) {
            $user_rol->delete(); // <-- direct deletion
        });
        $usuario->delete();

        return redirect()->route('eliminar-docente')->with('eliminar', 'ok');
    }
}