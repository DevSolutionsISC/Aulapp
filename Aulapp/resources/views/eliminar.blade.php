@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de Materias</h3>
@endsection
@section('Contenido formulario')

<div class="row">
  <div class="d-flex" id="formularioEliminar">
    <form method="POST" action="">
      @method('PATCH')
      @csrf
      <h3 text-center>Eliminar materia</h3>

      <label for="inputNombre" class="form-label">Coloque el codigo de la materia que quiere eliminar</label>
      <input type="text" id="inputNombre" class="form-control" name="nombre" value=""
      value="" autofocus>

      <span class="error text-danger" for="input-nombre"></span>
      <br>
      <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off">
      Buscar
      </button>
      <br>
      <br>
      <h5 text>Nombre:</h5>
      <h5 text>Apellido:</h5>
      <h5 text>Ci:</h5>
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Eliminar</button>
        <a href="" class="btn btn-danger btn-block btn-lg" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>

@endsection