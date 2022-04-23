@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de materia </h3>
@endsection
@section('Contenido formulario')

<div class="row" >
  <div style=" width: 100%;
    max-width: 600px;
    margin: 0 auto;
    display: flex;
    position: absolute;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    top: 15%; left:25%" class="col-xl-3 col-md-4 col-12">
    <form id="formulario" method="post">
      <h3 text-center>Eliminar materia</h3>
      @csrf

      <label for="inputNombre" class="form-label">Coloque el codigo de la materia que quiere eliminar</label>
      <input type="text" id="inputNombre" class="form-control" name="nombre" value=""
      value="" autofocus>

      <span class="error text-danger" for="input-nombre">
      </span>

      <br>
      <div style="padding-left:40%">
      <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off">
       Buscar
      </button>
      </div>
      <br>
      <h5 text>Nombre:</h5>
      <h5 text>Apellido:</h5>
      <h5 text>Ci:</h5>
      <label for="inputNombre" class="form-label">Nombre</label>
      <input type="text" id="inputNombre" class="form-control" name="nombre" value=""
      value="" autofocus>

      <span class="error text-danger" for="input-nombre"></span>
      <label for="Codigo" class="form-label">Codigo</label>
      <input type="text" id="inputCodigo" class="form-control" name="codigo" value=""
      value="" autofocus>

      <span class=" error text-danger" for="input-codigo"></span>
   
      <div style="padding-left:20%">
      
        <button style = "width:130px" class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Eliminar</button>
        <a href="" style = "width:130px" class="btn btn-danger btn-block btn-lg" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>

    </form>

  </div>
  
@endsection