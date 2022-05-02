@extends('plantilla')
@section('title', 'Docente')
@section('Titulo')
@section("editar","docenteEdit")
@section("registrar","docente")
@section("reporte","reporte_user_rol")
@section("eliminar","eliminar-docente")
<h3 text-center>Administracion de docentes </h3>
@endsection
@section('Contenido formulario')

      <h3 class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de docentes</h3>

    
      
      <table class="table table-striped">
      
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
                    @if ($user_rol->rol_id == 2) 
                    
                   <tr>
                         <td>{{$user_rol->usuario->Nombre}}</td>
                         <td>{{$user_rol->usuario->Apellido}}</td>
                         <td>{{$user_rol->usuario->CI}}</td>
                         <td>{{$user_rol->usuario->Email}}</td>
                         
                   </tr>   
                   
                   @endif
                   @endforeach
                  
                  
            </tbody>
      </table>

@endsection