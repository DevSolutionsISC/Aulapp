@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de Materias</h3>
@endsection
@section('Contenido formulario')

<div class="row">
  <div class="d-flex" id="formularioEditar">
    <form method="POST" action="{{route('materias-update', ['id'=>$materia->id])}}" id="formulario">
      @method('PATCH')
      @csrf
      <h3 text-center>Editar Materia</h3>

      <label for="nombre_materia" class="form-label">Nombre</label>
      <input type="text" id="nombre_materia" class="form-control" name="nombre_materia" value="{{$materia->nombre_materia}}"
        value="{{old('nombre_materia')}}" autofocus>
      @if ($errors->has('nombre_materia'))
      <span class="error text-danger" for="input-nombre">{{ $errors->first('nombre_materia') }}</span>
      @endif
      <br>
      <label for="Cod_materia" class="form-label">Código</label>
      <input type="text" id="Cod_materia" class="form-control" name="Cod_materia" value="{{$materia->Cod_materia}}"
        value="{{old('Cod_materia')}}" autofocus>
      @if ($errors->has('descripcion'))
      <span class=" error text-danger" for="input-Cod_materia">{{ $errors->first('Cod_materia') }}</span>
      @endif
      <br>
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Guardar cambios</button>
        <a href="{{route('materias')}}" class=" btn btn-danger btn-block btn-lg" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>
  {{--
  <div class="col-xl-9 col-md-8 col-12">
    <h3 id="listaMaterias">Lista de materias</h3>
    <table class="table table-striped">
      <thead>
        <tr id="filaMateria">
          <th scope="col">Materia</th>
          <th scope="col">Código</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($materias as $materia )
        <tr>
          <td>{{$materia->nombre_materia}}</td>
          <td>{{$materia->Cod_materia}}</td>
          <td><button id="EditarEliminar">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path
                  d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd"
                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
              </svg></button>
            <button id="EditarEliminar">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                viewBox="0 0 16 16">
                <path
                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd"
                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
              </svg>
            </button>
          </td>
          @endforeach


      </tbody>
    </table>
  </div> --}}
</div>

@endsection