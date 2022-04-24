<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
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
        $grupos = Grupo::all();
        return view('adm_grupos', ['grupos' => $grupos]);

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
        $grupo = new Grupo();
        $grupo->nombre = $request->nombre;
        $grupo->id_materia = $request->id_materia;
        $grupo->id_carrera = $request->id_carrera;
        $grupo->id_docente = $request->id_docente;
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
    public function update(Request $request, Grupo $grupo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {

        $grupo = Grupo::query();

        if ($request->has('search')) {
            $grupo->where('id', 'like', $request->search);
        }
        $grupos = $grupo->get();
        return view('eliminar_grupo', compact('grupos'));

    }
    public function destroy($id)
    {
        $grupo = Grupo::find($id);

        $grupo->delete();

        return redirect()->route('eliminar-grupo')->with('eliminar', 'ok');
    }
}