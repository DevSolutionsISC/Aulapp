@extends('plantilla')
@section('title', 'Docente')
@section('Titulo')
<h3 text-center>Administracion de docentes </h3>
@endsection
@section('Contenido formulario')
<div id="C_tabla">
      <h3 id="T_tabla">Lista de docentes</h3>
      <table class="table">
      
            <thead>                
                  <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">CI</th>
                        <th scope="col">Email</th>
                  </tr>
            </thead>
            <tbody>
                 
                    @foreach($user_rols as $user_rol)
                    @if ($user_rol->usuario_id == 1) 
                    
                   <tr>
                         <td>{{$user_rol->usuario->Nombre}}</td>
                         <td>{{$user_rol->usuario->Apellido}}</td>
                         <td>{{$user_rol->usuario->CI}}</td>
                         <td>{{$user_rol->usuario->Email}}</td>
                         <td>
                               <div><a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    </svg>
                               </a>
                               </div>
                             
                         </td>
                         
                   </tr>   
                   
                   @endif
                   @endforeach 
                  
                  
            </tbody>
      </table>
</div>
@endsection