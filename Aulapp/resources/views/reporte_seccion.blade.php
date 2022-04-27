@extends('plantilla')
@section('title', 'Seccion')
@section("editar","seccionEdit")
@section("registrar","seccion")
@section("reporte","section")
@section('Titulo')
<h3 text-center>Administracion de secciones </h3>
@endsection
@section('Contenido formulario')
<div id="C_tabla">
      <h3 id="T_tabla">Lista de secciones</h3>
      <table class="table">
      
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
                         
                         <td>
                               <div><a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    </svg>
                               </a>
                               </div>
                             
                         </td>
                         
                   </tr>   
                   @endforeach  
                  
            </tbody>
      </table>
</div>
@endsection