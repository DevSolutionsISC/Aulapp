@extends('plantilla')
@section('title', 'Carrera')
@section('Titulo')
<h3 text-center id="Titulo">Administracion de Carreras</h3>
@endsection
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="POST" action="" id="formulario">
      @method('PATCH')
      @csrf
      <h3 text-center>Editar carrera</h3>

      <label for="inputNombre" class="form-label">Coloque el codigo de la materia que quiere editar</label>
      <input type="text" id="inputNombre" class="form-control" name="nombre" value=""
      value="" autofocus>

      <span class="error text-danger" for="input-nombre">
        
      </span>
      <br>
      <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off">
       Buscar
      </button>
      <br>
      <span class="error text-danger" for="input-nombre"></span>
      <label for="inputNombre" class="form-label">Nombre</label>
      <input type="text" id="inputNombre" class="form-control" name="nombre" value=""
      value="" autofocus disabled>
      <span class="error text-danger" for="input-nombre"></span>

      <label for="Codigo" class="form-label">Codigo</label>
      <input type="text" id="inputCodigo" class="form-control" name="codigo" value=""
      value="" autofocus disabled>
      <span class=" error text-danger" for="input-codigo"></span>
   
      <br>
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-danger btn-block btn-lg" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>

@endsection
@section('js')
<script>
console.log("safsa")
</script>
@endsection