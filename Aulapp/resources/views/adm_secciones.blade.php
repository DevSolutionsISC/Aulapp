@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de seccion</h3>
@endsection
@section('Contenido formulario')
<h3 text-center>Registrar Seccion</h3>
<form id="formulario" method="post">
  <label for="inputNombre" class="form-label">Nombre</label>
  <input type="text" id="inputNombre" class="form-control">
  <label for="Descripcion" class="form-label">Descripcion</label>
  <textarea id="Descripcion" class="form-control" placeholder="Descripcion" rows="5" style="resize:none"></textarea>
  <input class="btn btn-lg  btn-block" type="submit" value="Registrar">
</form>
@endsection