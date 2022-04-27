<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAula;
use App\Models\Aula;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $seccions = Section::all();
        return view('Aula\registrar_aula', ['seccions' => $seccions]);
    }
    public function reporte()
    {

        $aulas = Aula::all();
        return view('Aula\reporte_aula', compact('aulas'));

    }

    public function showEdit()
    {
        $aulas = Aula::all();
        $secciones = Section::all();
        return view('Aula\editaraula', ['secciones' => $secciones, 'aulas' => $aulas]);

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
    public function store(StoreAula $request)
    {

        $aula = new Aula();
        $aula->nombre = $request->nombre;
        $aula->capacidad = $request->capacidad;
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
    public function update(Request $request, $id)
    {
        $aula = Aula::find($id);
        $request->validate([
            'Nombre' => 'bail|required|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9]+$/|min:3|max:10|unique:aulas,nombre,' . $aula->id,
            'capacidad' => 'bail|required|numeric|between:10,500',
        ]);
        $aula->nombre = $request->Nombre;
        $aula->capacidad = $request->capacidad;
        $aula->section_id = $request->section;
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
    public function destroy($id)
    {
        $aula = Aula::find($id);

        $aula->delete();

        return redirect()->route('eliminar-aula')->with('eliminar', 'ok');
    }
}