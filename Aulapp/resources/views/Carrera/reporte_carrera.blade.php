@extends('plantilla')
@section('title', 'Carreras')
@section("editar","carreraEdit")
@section("registrar","carreras")
@section("reporte","reporte_carrera")
@section("eliminar","eliminar-carrera")
@section('Titulo')
<h3 text-center>Administracion de carrera </h3>
@endsection
@section('Contenido formulario')


<div id="C_tabla">
<h3 id="T_tabla" class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de carreras</h3>
@if(count($carreras) == 0)
      <br>
      <br>
      <br>
      <h4 class="row justify-content-center">No hay resultados</h4>
 
      @else
      
      <table class="table table-striped">
      
            <thead>                
                  <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Código</th>

                  </tr>
            </thead>
            <tbody>
                    @foreach($carreras as $carrera)
                   <tr>
                         <td>{{$carrera->Nombre}}</td>
                         <td>{{$carrera->Codigo}}</td>
         
                   </tr>     
                  @endforeach
            </tbody>
      </table>
      @endif
  
</div>
@endsection
