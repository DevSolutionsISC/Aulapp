@extends('plantilla')
@section('title', 'Aula')
@section('Titulo')
<h3 text-center>Administracion de aulas</h3>
@endsection
@section('Contenido formulario')
<h3 text-center>Registrar aula</h3>
<form id="formulario" method="post">
  <label for="inputNombre" class="form-label">Nombre</label>
  <input type="text" id="inputNombre" class="form-control">
  <label for="inputCapacidad" class="form-label">Capacidad</label>
  <input type="number" id="inputCapacidad" class="form-control">
  <label for="inputSeccion" class="form-label">Seccion del aula</label>
  <select id="inputSeccion" class="form-control form-select">
    <option selected>Elige una seccion</option>
    <option value="seccion1">Seccion 1</option>
    <option value="seccion2">Seccion 2</option>
    <option value="seccion3">Seccion 3</option>
  </select>
  <input class="btn btn-lg  btn-block" type="submit" value="Registrar">
</form>
@endsection