<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Materia_Carrera;
use App\Models\Carrera;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreMateria;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $materias=Materia::all();
        return view('editarmateria', ['materias' => $materias]);
 
    }
    public function reporte()
    {
        $materias=Materia::all();
        return view('reporte_materia', compact('materias'));
 
    }
    public function showEdit()
    {
        $materias=Materia::all();
        $carreras=Carrera::all();
        $conexiones=Materia_Carrera::all();
        return view('editarmateria', ['materias' => $materias, 'carreras' => $carreras, 'conexiones' => $conexiones]);
 
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
        $materia=new Materia();
        $materia->nombre_materia=$request->nombre_materia;
        $materia->Cod_materia=$request->Cod_materia;
        $materia->save();

        return redirect()->route('materias')->with('registrar','ok');
      

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
        $materia=Materia::find($id);
        $request->validate([
            'Nombre' => 'required|regex:/^[\pL\s\-]+$/u|min:5|max:60|unique:materias,nombre_materia,'. $materia->id ,
            'Codigo' => 'required|numeric|digits_between:6,10|unique:materias,Cod_materia,' . $materia->id 
        ]);
        
        $materia=Materia::find($id);
        $materia->nombre_materia=$request->Nombre;
        $materia->Cod_materia=$request->Codigo;
        $materia->save();

        return redirect()->route('materia_edit')->with('actualizar', 'ok');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materia = Materia::find($id);
        $materia->delete();
        return redirect()->route('materias')->with('eliminar', 'ok');
    }
}
