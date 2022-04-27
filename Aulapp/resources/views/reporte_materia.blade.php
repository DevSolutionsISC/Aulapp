@extends('plantilla')
@section('title', 'Seccion')
@section("editar","materiaEdit")
@section("registrar","materias")
@section("reporte","materia")
@section('Titulo')
<h3 text-center>Administracion de materia </h3>
@endsection
@section('Contenido formulario')
<div id="C_tabla">
      <h3 id="T_tabla">Lista de materias</h3>
      <table class="table">
      
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