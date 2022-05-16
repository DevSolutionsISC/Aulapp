<?php

namespace App\Http\Controllers;

use App\Models\gestion;
use Illuminate\Http\Request;

class gestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gestiones=gestion::all();
        return view('estadogestion', ['gestiones' => $gestiones]);
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
    public function store($año, $id , $aux)
    {
        /*
        $g1=new gestion();
        $g1->nombreG="1".$año;
        $g1->save();
        $g2=new gestion();
        $g2->nombreG="2".$año;
        $g2->estado=false;
        $g2->save();
        $g3=new gestion();
        $g3->nombreG="3".$año;
        $g2->estado=false;
        $g3->save();
        $g4=new gestion();
        $g4->nombreG="4".$año;
        $g2->estado=false;
        $g4->save();
        $antigu=gestion::find($id);
        $antigu->estado=false;
        $antigu->save();*/
        return redirect()->route('estadogestion')->with('actualizar', 'ok');
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
    public function update( $id , $id2 ,$tipo)
    {
       
       if($tipo==0){
        $antiguo= gestion::find($id);
        $nuevo=gestion::find($id2);
        $antiguo->estado=0;
        $nuevo->estado=1;
        $antiguo->save();
        $nuevo->save();
        
       }
       if($tipo==1){
        $g1=new gestion();
        $g1->nombreG="1/". strval($id);
        $g1->estado=1;
        $g1->save();
        $g2=new gestion();
        $g2->nombreG="2/". strval($id);
        $g2->estado=0;
        $g2->save();
        $g3=new gestion();
        $g3->nombreG="3/". strval($id);
        $g3->estado=0;
        $g3->save();
        $g4=new gestion();
        $g4->nombreG="4/". strval($id);
        $g4->estado=0;
        $g4->save();
        $antigu=gestion::find($id2);
        $antigu->estado=0;
        $antigu->save();
       }
       return redirect()->route('estadogestion')->with('actualizar', 'ok');
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
