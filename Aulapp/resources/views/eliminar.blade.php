@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de materia</h3>
@endsection
@section('Contenido formulario')

<div class="row">
  <div class="d-flex" id="formularioEditar">
    <form method="POST" action="">
      @method('PATCH')
      @csrf
      <h3 text-center>Editar materia</h3>

      <label for="inputNombre" class="form-label">Coloque el codigo de la materia que quiere eliminar</label>
      <input type="text" id="inputNombre" class="form-control" name="nombre" value=""
      value="" autofocus>

      <span class="error text-danger" for="input-nombre">nombre</span>

      <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off">
       Buscar
      </button>
   
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-dark btn-block btn-lg" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>

@endsection