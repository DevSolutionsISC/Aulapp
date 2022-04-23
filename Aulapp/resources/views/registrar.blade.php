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
      <input type="text" id="inputNombre" class="form-control" name="nombre" value=""
      value="" autofocus>

      <span class="error text-danger" for="input-nombre"></span>

      <br>
      <label for="Descripcion" class="form-label">Codigo</label>
      <input type="text" id="inputCodigo" class="form-control" name="codigo" value=""
      value="" autofocus>

      <span class=" error text-danger" for="input-codigo"></span>
   
      <br>
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-danger btn-block btn-lg" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>

    </form>
  </div>
@endsection