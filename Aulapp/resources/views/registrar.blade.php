@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de materia </h3>
@endsection
@section('Contenido formulario')

<div class="row">
  <div class="col-xl-3 col-md-4 col-12">
    <form id="formulario" method="post">
      <h3 text-center>Registrar materia</h3>
      @csrf
      <label for="inputNombre" class="form-label">Nombre</label>
      <input type="text" id="inputNombre" class="form-control">
      <label for="Codigo" class="form-label">Codigo</label>
      <input type="text" id="inputCodigo" class="form-control"></input>
      <input class="btn btn-lg  btn-block" type="submit" value="Registrar">
    </form>
  </div>
@endsection