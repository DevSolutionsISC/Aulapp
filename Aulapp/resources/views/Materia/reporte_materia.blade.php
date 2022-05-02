@extends('plantilla')
@section('title', 'Materias')
@section("editar","materiaEdit")
@section("registrar","materias")
@section("reporte","reporte_materia")
@section("eliminar","eliminar-materia")
@section('Titulo')
<h3 text-center>Administracion de materia </h3>
@endsection
@section('Contenido formulario')
<div id="C_tabla">
<h3 id="T_tabla" class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de materias</h3>
      @if(count($materias) == 0)
      
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
                   @foreach($materias as $materia)
                   <tr>
                         <td>{{$materia->nombre_materia}}</td>
                         <td>{{$materia->Cod_materia}}</td>
      
                   </tr>    
                   @endforeach 
                  
            </tbody>
      </table>
      @endif
</div>
@endsection