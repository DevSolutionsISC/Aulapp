@extends('plantilla')
@section('title', 'Aulas')
@section("editar","aulaEdit")
@section("registrar","aula")
@section("reporte","aulas")
@section("eliminar","eliminar-aula")

@section('Titulo')
<h3 text-center>Administracion de aulas </h3>
@endsection
@section('Contenido formulario')

<div id="C_tabla">
  <h3 id="T_tabla" class="row justify-content-center justify-content-md-start">&nbsp;&nbsp;Lista de aulas</h3>
  @if(count($aulas) == 0)
  <br>
  <br>
  <br>
  <h4 class="row justify-content-center">No hay resultados</h4>

  @else
  <table class="table table-striped">

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
        <td>{{$aula->section->nombre}}</td>

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