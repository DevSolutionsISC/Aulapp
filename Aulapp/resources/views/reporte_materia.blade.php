@extends('plantilla')
@section('title', 'Materia')
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
      @endif
</div>
@endsection