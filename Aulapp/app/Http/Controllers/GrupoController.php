<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupo;
use App\Models\asignacionDocentes;
use App\Models\Carrera;
use App\Models\gestion;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use App\Models\UserRol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $grupos = Grupo::all();
        $docentes = Usuario::all();
        $carreras = Carrera::all();
        $materias = Materia::all();
        $Urs = UserRol::all();
        $ads = asignacionDocentes::all();
        $mcs = Materia_Carrera::all();
        return view('Grupo.editargrupo', ['grupos' => $grupos, 'docentes' => $docentes, 'carreras' => $carreras, 'materias' => $materias, 'urs' => $Urs, "ads" => $ads, "mcs" => $mcs]);

    }

    public function registro()
    {

        $carreras = Carrera::where('estado', true)->get();
        $materia_carrera = Materia_Carrera::where('estado', true)->get();
        $materias = Materia::where('estado', true)->get();
        $docentes = Usuario::where('estado', true)->get();
        $user_rol = UserRol::where('estado', true)->get();
      

        return view('Grupo.registrar_grupo', ['urs' => $user_rol, 'docentes' => $docentes, 'carreras' => $carreras, 'materia_carrera' => $materia_carrera,  'materias' => $materias]);

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
        $lista_materia_carrera=Materia_Carrera::where('materia_id',$request->materia)->where('estado',true)->get();
        $id_grupo=Grupo::where('materia_carrera_id',$lista_materia_carrera[0]->id)->get();
       
        $id_docente="";
        if($id_grupo!="[]"){
            $id_docente=asignacionDocentes::where('grupo_id',$id_grupo[0]->id)->get();
        }
    
        $id_gestion=gestion::firstWhere('estado', true);
        if($request->carrera=="Seleccione una carrera"){
    
    
        for($i=0;$i<sizeof($lista_materia_carrera);$i=$i+1){
            if(!Grupo::where('materia_carrera_id',$lista_materia_carrera[$i]->id)->where('nombre',"G:".$request->nombre)->exists()){
            $grupo                         = new Grupo();
            $grupo->nombre                 = "G:".$request->nombre;
            $grupo->materia_carrera_id     = $lista_materia_carrera[$i]->id;
            $grupo->save();
            if($id_docente!="[]" && $id_docente!=""){
                $asignacion= new asignacionDocentes();
                $asignacion->user_rol_id=$id_docente[0]->user_rol_id;
                $asignacion->grupo_id=$grupo->id;
                $asignacion->gestion_id=$id_gestion->id;
                $asignacion->save();
            }
            }else{
                $grupo=Grupo::where('materia_carrera_id',$lista_materia_carrera[$i]->id)->where('nombre',"G:".$request->nombre)->get();
                if(!$grupo[0]->estado){
                    
                }
            }
        }

     }else{
         
    $id_materia_carrera=Materia_Carrera::where('materia_id',$request->materia)->where('carrera_id',$request->carrera)->get();
    $grupo                         = new Grupo();
    $grupo->nombre                 = "G:".$request->nombre;
    $grupo->materia_carrera_id     = $id_materia_carrera[0]->id;
    $grupo->save();
    if($id_docente!="[]" && $id_docente!=""){
        $asignacion= new asignacionDocentes();
        $asignacion->user_rol_id=$id_docente[0]->user_rol_id;
        $asignacion->grupo_id=$grupo->id;
        $asignacion->gestion_id=$id_gestion->id;
        $asignacion->save();
    }

  }
  

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
        if ($request->docente != 0) {
            $grupo->asignacion_docentes_id = $request->docente;
        }
        $grupo->estado = $request->estadoE;
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
            $asignacionDocentes = asignacionDocentes::all();
            return view('Grupo.eliminar_grupo', compact('grupos', 'asignacionDocentes'));

        } catch (\Throwable $th) {
            return redirect()->route('eliminar-grupo')->with('buscar', 'error');

        }

    }
    public function estado($id)
    {
        $grupo = Grupo::find($id);
        $grupo->estado = false;
        $grupo->save();
        $grupo->asignacionDocentes()->each(function ($asignacionDocentes) {
            $asignacionDocentes->where('id', $asignacionDocentes->id)->update(['estado' => false]);
        });

        return redirect()->route('eliminar-grupo')->with('eliminar', 'ok');
    }
}