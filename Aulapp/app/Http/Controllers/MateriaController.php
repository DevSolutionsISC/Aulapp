<?php

namespace App\Http\Controllers;

use App\Models\Materia;
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
        return view('adm_materias', ['materias' => $materias]);
 
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
        $materia = Materia::find($id);
        return view('adm_materias-show', ['materia' => $materia]);
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
    public function update(StoreMateria $request, $id)
    {

        
        $materia=Materia::find($id);
        $materia->nombre_materia=$request->nombre_materia;
        $materia->Cod_materia=$request->Cod_materia;
        $materia->save();

        return redirect()->route('materias')->with('actualizar', 'ok');
       
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
