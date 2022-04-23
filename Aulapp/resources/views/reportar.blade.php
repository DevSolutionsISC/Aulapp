@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de materia </h3>
@endsection
@section('Contenido formulario')
@section('Tabla')
<div id="C_tabla">
      <h3 id="T_tabla">Lista de materias</h3>
      <table class="table">
      
            <thead>                
                  <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Codigo</th>
                  </tr>
            </thead>
            <tbody>
                   <tr>
                         <td>ingrese un nombre</td>
                         <td>ingrese un codigo</td>
                         
                         <td>
                               <div><a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    </svg>
                               </a>
                               </div>
                             
                         </td>
                         
                   </tr>     
                  
            </tbody>
      </table>
</div>
@endsection