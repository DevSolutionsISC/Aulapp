@extends('plantilla')
@section('title', 'Grupo')
@section("editar","grupoEdit")
@section("registrar","grupos")
@section("reporte","reporte_grupo")
@section("eliminar","eliminar-grupo")
@section('Titulo')
<h3 text-center>Administracion de grupos </h3>
@endsection
@section('Contenido formulario')
<div id="C_tabla">
<h3 id="T_tabla" class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de grupos</h3>
      @if(count($grupos) == 0)
      
      <br>
      <br>
      <br>
      <h4 class="row justify-content-center">No hay resultados</h4>
 
      @else

      <table class="table table-striped">
      
            <thead>                
                  <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                      
                    
                  </tr>
            </thead>
            <tbody>
                    @foreach($grupos as $grupo)
                   <tr>
                         
                         <td>{{$grupo->nombre}}</td>
                         
                         
                   </tr>   
                   @endforeach  
                  
            </tbody>
      </table>
      @endif
</div>
@endsection