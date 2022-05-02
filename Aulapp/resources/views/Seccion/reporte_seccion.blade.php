@extends('plantilla')
@section('title', 'Seccion')
@section("editar","seccionEdit")
@section("registrar","seccion")
@section("reporte","reporte_section")
@section("eliminar","eliminar-seccion")
@section('Titulo')
<h3 text-center>Administracion de secciones </h3>
@endsection
@section('Contenido formulario')

<h3 class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de secciones</h3>
     
      @if(count($sections) == 0)
      
      <br>
      <br>
      <br>
      <h4 class="row justify-content-center">No hay resultados</h4>
 
      @else
      <table class="table table-striped">
      
            <thead>                
                  <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                  </tr>
            </thead>
            <tbody>
                    @foreach($sections as $section)
                   <tr>
                         <td>{{$section->nombre}}</td>
                         <td>{{$section->descripcion}}</td>
                         
                   </tr>   
                   @endforeach  
                  
            </tbody>
      </table>
      @endif

@endsection