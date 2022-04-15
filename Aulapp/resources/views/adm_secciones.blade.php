@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de seccion</h3>
@endsection
@section('Contenido formulario')

<div class="row">
  <div class="col-xl-3 col-md-4 col-12">
    <form method="POST" action="{{route('secciones')}}" id="formulario">
      @csrf


      <h3 text-center>Registrar Seccion</h3>

      <label for="inputNombre" class="form-label">Nombre</label>
      <input type="text" id="inputNombre" class="form-control" name="nombre" value="{{old('nombre')}}" autofocus>
      @if ($errors->has('nombre'))
      <span class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
      @endif
      <br>
      <label for="inputDescripcion" class="form-label">Descripcion</label>
      <input type="text" id="inputDescripcion" class="form-control" name="descripcion" value="{{old('descripcion')}}"
        autofocus>
      @if ($errors->has('descripcion'))
      <span class=" error text-danger" for="input-descripcion">{{ $errors->first('descripcion') }}</span>
      @endif
      <br>
      <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Registrar</button>
    </form>
  </div>

  <div class="col-xl-9 col-md-8 col-12">
    <h3 id="listaSecciones">Lista de secciones</h3>
    <table class="table table-striped">
      <thead>
        <tr id="filaSeccion">
          <th scope="col">Seccion</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sections as $section )
        <tr>
          <td>{{$section->nombre}}</td>
          <td>{{$section->descripcion}}</td>

          <td>
            <div class="d-flex">
              <div class="m-1"><a id="EditarEliminar" href="{{route('secciones-show', ['id'=> $section->id])}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path
                      d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd"
                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg></a></div>
              <div class="m-1">


                <button id="EditarEliminar" class="btn" type="submit" data-bs-toggle="modal"
                  data-bs-target="#modal{{$section->id}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                    viewBox="0 0 16 16">
                    <path
                      d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd"
                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </button>

              </div>

            </div>
          </td>


        </tr>
        <div class="modal fade " id="modal{{$section->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true" data-bs-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar seccion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Al eliminar la seccion <strong>{{ $section->nombre }}</strong> se eliminan todas las aulas asignadas
                a la
                misma.
                ¿Está seguro que desea eliminar la seccion <strong>{{ $section->nombre }}</strong>?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, cancelar</button>
                <form action="{{route('secciones-destroy', [$section->id]) }}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-danger">Sí, eliminar seccion</button>
                </form>

              </div>
            </div>
          </div>
        </div>
        @endforeach


      </tbody>
    </table>
  </div>
</div>

@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('registrar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Registro exitoso',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@if (session('actualizar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Cambios guardados exitosamente',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@if (session('eliminar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Seccion eliminada',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@endsection