<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $docentes = Docente::all();
        return view('adm_docentes', ['docentes' => $docentes]) ;
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
        $request->validate([
            'Nombre' => 'required|min:3|max:20|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ]+$/u',
            'Apellido' => 'required|min:3|max:20|regex:/^[a-zA-Z0-9\s áéíóúÁÉÍÓÚñÑ]+$/u',
            'CI'=> 'required|unique:docentes|digits_between:6,10',
            'Email' => 'required|email'
        ]);

        $docentes = new Docente();
        $docentes->Nombre = $request->Nombre;
        $docentes->Apellido = $request->Apellido;
        $docentes->CI = $request->CI;
        $docentes->Email = $request->Email;
        $docentes->save();

        return redirect()->route('docentes')->with('registrar', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $docente=Docente::find($id);
        return redirect()->route('carreras-update',['id'=> $docente->id]);
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
    public function update(Request $request, $id)
    {
        $docente=Docente::find($id);
        $docente->Nombre = $request->Nombre;
        $docente->Apellido = $request->Apellido;
        $docente->CI = $request->CI;
        $docente->Email = $request->Email;
        $docente->save();

        return redirect()->route('docentes')->with('actualizar', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $docente = Docente::find($id);
        $docente->delete();
        return redirect()->route('docentes')->with('eliminar', 'ok');
    }
}
