<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\asignacionDocentes;
use App\Models\gestion;
use Illuminate\Http\Request;
use App\Models\UserRol;
use App\Models\nuevasnotificacion;
class gestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();
        $gestion=gestion::where("estado",1)->get();
        $ur = UserRol::where("usuario_id",$usuario->id)->get();
        $not= nuevasnotificacion::where("user_rol_id",$ur[0]->id)->get();
        $cantidad=0;
             if($not!="[]"){
                  $cantidad=$not[0]->cantidad_not;
              }
        $gestiones=gestion::all();
        return view('Gestion.estado_gestion', ['gestiones' => $gestiones, 'not'=>$cantidad]);
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
       //actualizar
       if($tipo==0 && $id != $id2){
        $antiguo= gestion::find($id);
        $nuevo=gestion::find($id2);
        $nombre="2/".explode("/",$nuevo->nombreG)[1];
        $antiguo->estado=0;
        $nuevo->estado=1;
        if($nuevo->nombreG ==$nombre){
            $asignaciones_nuevas=asignacionDocentes::where("gestion_id",$id2);
            if($asignaciones_nuevas->count()==0){
                $gestion1=gestion::where("nombreG","1/".explode("/",$nuevo->nombreG)[1])->get();
                $asignaciones_antiguas=asignacionDocentes::where("gestion_id",$gestion1[0]->id)->get();
                for($i=0;$i<$asignaciones_antiguas->count();$i++){
                    $n=new asignacionDocentes();
                    $n->user_rol_id=$asignaciones_antiguas[$i]->user_rol_id;
                    $n->grupo_id=$asignaciones_antiguas[$i]->grupo_id;
                    $n->gestion_id=$id2;
                    $n->save();
                }
            }
        }
        $antiguo->save();
        $nuevo->save();
        // Nuevo año
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
        $gestion_n=gestion::where("nombreG","2/". strval($id-1))->get();
        $asig=asignacionDocentes::where("gestion_id",$gestion_n[0]->id)->get();
        $id_nuevo=gestion::where("nombreG",$g1->nombreG)->get();
        for($i=0; $i<$asig->count();$i++){
            $n=new asignacionDocentes();
                    $n->user_rol_id=$asig[$i]->user_rol_id;
                    $n->grupo_id=$asig[$i]->grupo_id;
                    $n->gestion_id=$id_nuevo[0]->id;
                    $n->save();
        }

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
