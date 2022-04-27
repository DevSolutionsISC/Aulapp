<?php

namespace App\Http\Controllers;

session_start();

use App\Http\Requests\StoreCarrera;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('Carrera\registrar_carrera');

    }
    public function reporte()
    {
        $carreras = Carrera::all();
        return view('Carrera\reporte_carrera', compact('carreras'));

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
    public function store(StoreCarrera $request)
    {

        $carrera = new Carrera();
        $carrera->Nombre = $request->nombre;
        $carrera->Codigo = $request->codigo;

        $carrera->save();

        return redirect()->route('carreras')->with('registrar', 'ok');
    }

    public function cancelar()
    {

        return redirect()->route('carreras');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $carrera = Carrera::find($id);

        return redirect()->route('carreras')->cookie('id', $carrera->id)->cookie('nombre', $carrera->Nombre)->cookie('codigo', $carrera->Codigo)->cookie('editar', 'ok');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showEdit()
    {
        $carreras = Carrera::all();
        return view('Carrera\editarcarrera', ['carreras' => $carreras]);

    }
    public function update(Request $request, $id)
    {

        $carrera = Carrera::find($id);
        $request->validate([
            'Nombre' => 'bail|required|min:3|max:20|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u',
            'Codigo' => 'bail|required|numeric|digits_between:6,10|unique:carreras,Codigo,' . $carrera->id,
        ]);

        $carrera->Nombre = $request->Nombre;
        $carrera->Codigo = $request->Codigo;
        $carrera->save();
        return redirect()->route('carrera_edit')->with('actualizar', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {
        try {
            $carrera = Carrera::query();

            if ($request->has('search')) {
                $carrera->where('Codigo', 'like', $request->search);
            }
            $carreras = $carrera->get();
            return view('eliminar_carrera', compact('carreras'));

        } catch (\Throwable $th) {
            return redirect()->route('eliminar-carrera')->with('buscar', 'error');

        }

    }
    public function destroy($carrera)
    {

        $carrera = Carrera::find($carrera);
        $newCarrera = $carrera->replicate();
        $newCarrera->setTable('log_carreras');
        $newCarrera->save();

        $carrera->materia__carreras()->each(function ($materia_carrera) {
            $materia_carrera->delete(); // <-- direct deletion
        });
        $carrera->delete();

        return redirect()->route('eliminar-carrera')->with('eliminar', 'ok');
    }
}