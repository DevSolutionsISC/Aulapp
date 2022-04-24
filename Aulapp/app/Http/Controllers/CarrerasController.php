<?php
 
namespace App\Http\Controllers;
session_start();

use App\Http\Requests\CarrerasEdirRequest;
use App\Models\Carrera;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarrera;



class CarrerasController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('registrar_carrera');
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

        $carrera=new Carrera();
        $carrera->Nombre=$request->nombre;
        $carrera->Codigo=$request->codigo;
        $carrera->save();

        return redirect()->route('carreras')->with('registrar','ok');
    }

    public function cancelar(){

       
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

        $carrera=Carrera::find($id);
       
      
        return redirect()->route('carreras')->cookie('id',$carrera->id)->cookie('nombre',$carrera->Nombre)->cookie('codigo',$carrera->Codigo)->cookie('editar','ok');
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
    public function update(CarrerasEdirRequest $request, $id)
    {
        $carrera=Carrera::find($id);        
        $carrera->Nombre=$request->Nombre;
        $carrera->Codigo=$request->Codigo;
        $carrera->save();        
        return redirect()->route('carreras')->with('actualizar', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrera = Carrera::find($id);
        $carrera->delete();
        return redirect()->route('carreras')->with('eliminar', 'ok');
    }
}
