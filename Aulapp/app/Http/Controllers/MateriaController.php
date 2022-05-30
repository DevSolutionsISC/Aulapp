<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMateria;
use App\Models\asignacionDocentes;
use App\Models\Carrera;

//use Illuminate\Support\Facades\Session;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use Illuminate\Http\Request;

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
        return view('Materia.registrar_materia', ['carreras' => $carreras]);

    }
    public function reporte()
    {
        $materias = Materia::all();
        return view('Materia.reporte_materia', compact('materias'));

    }
    public function showEdit()
    {
        $materias = Materia::all();
        $carreras = Carrera::all();
        $mcs = Materia_Carrera::all();
        return view('Materia.editarmateria', ['materias' => $materias, 'carreras' => $carreras, 'mcs' => $mcs]);

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
        $materia = new Materia();
        $materia->nombre_materia = $request->nombre;
        $materia->Cod_materia = $request->codigo;
        $materia->save();

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
            'Nombre' => 'required|regex:/^[\pL\s\-]+$/u|min:5|max:60',
            'Codigo' => 'required|numeric|digits_between:6,10|unique:materias,Cod_materia,' . $materia->id,
        ]);
        $materia->nombre_materia = $request->Nombre;
        $materia->Cod_materia = $request->Codigo;
        $materia->estado = $request->estadoE;
        $materia->save();
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
            $materia_carrera->grupos()->each(function ($grupo) {
                $grupo->where('id', $grupo->id)->update(['estado' => false]);
                $grupo->asignacionDocentes()->each(function ($asignacionDocentes) {
                    $asignacionDocentes->where('id', $asignacionDocentes->id)->update(['estado' => false]);
                });
            });
        });

        return redirect()->route('eliminar-materia')->with('eliminar', 'ok');
    }
}