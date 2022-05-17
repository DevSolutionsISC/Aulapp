<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignacionDocentes;
use App\Models\Carrera;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use App\Models\UserRol;
use App\Models\Usuario;
class reservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function registro(){

        $docentes=Usuario::all();
        $urs=UserRol::all();
        $mcs=Materia_Carrera::all();
        $ms=Materia::all();
        $cs=Carrera::all();
        $ads=asignacionDocentes::all();
        $gs=Grupo::all();
        return view('registrarreserva',['docentes'=>$docentes,'urs'=>$urs,'mcs'=>$mcs,'ms'=>$ms, 'cs'=>$ms,'cs'=>$cs,'ads'=>$ads,'gs'=>$gs]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
