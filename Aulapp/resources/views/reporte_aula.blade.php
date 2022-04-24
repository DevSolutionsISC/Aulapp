@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de aulas </h3>
@endsection
@section('Contenido formulario')

<div id="C_tabla">
      <h3 id="T_tabla">Lista de aulas</h3>
      <table class="table">
      
            <thead>                
                  <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col">Seccion</th>
                  </tr>
            </thead>
            <tbody>
                    @foreach($aulas as $aula)
                   <tr>
                         <td>{{$aula->nombre}}</td>
                         <td>{{$aula->capacidad}}</td>
                         <td>{{$aula->nombre}}</td>
                         
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
