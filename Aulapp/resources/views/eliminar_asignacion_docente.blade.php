@extends('plantilla2')
@section('title', 'Asignacion docente')
@section('Titulo')
<h3 text-center>Administracion de asignacion-docente </h3>
@endsection

<header>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}"
          width="50" id="logo"></a>
      @yield('Titulo')
      <a href="#" class="material-symbols-outlined" id="menu">menu</a>
      <form class="d-flex">
        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        <a class="nav-link active" aria-current="page" href="#">Registrar</a>
        <a class="nav-link active" aria-current="page" href="#">Editar</a>
        <a class="nav-link active" aria-current="page" href="#">Eliminar</a>
        <a class="nav-link active" aria-current="page" href="{{route('secciones')}}">Ver reporte</a>

      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<div class="d-flex align-items-center justify-content-center row p-2" id="formulario">
  <div class="col-12">

    <form id="formulario" method="GET" action="{{route('eliminar-asignacion-docente')}}">
      <h3 text-center>Eliminar asignacion docente</h3>
      @csrf

      <label for="inputNombre" class="form-label">Introduzca el id de registro</label>
      <input type="text" id="inputNombre" class="form-control search" name="search" required>

      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg">
          Buscar
        </button>
      </div>


      <br>
      @if (count($asignacionDocentes) <= 0) <p class="p-1" id="datosEliminar">No hay resultados</p>
        @elseif (count($asignacionDocentes) > 1)

        @elseif (count($asignacionDocentes) == 1)
        @foreach ($asignacionDocentes as $asignacionDocente )
        <div class="p-1" id="datosEliminar">
          <h6> <b>Datos de la asignacion materia-docente</b></h6>

          <span><b>id:</b> {{$asignacionDocente->id}}</span>
          <br>
          <span><b>Docente:</b> {{$asignacionDocente->user_rol->usuario->Nombre}}
            {{$asignacionDocente->user_rol->usuario->Apellido}}</span>

          <br>
          <span><b>Carrera:</b> {{$asignacionDocente->materia_carrera->carrera->Nombre}}</span>
          <br>
          <span><b>Materia:</b> {{$asignacionDocente->materia_carrera->materia->nombre_materia}}</span>


        </div>


    </form>
  </div>
  <div class="row">
    <div class="col-6">
      <form action="{{route('asignacionDocente-destroy', ['asignacionDocente'=>$asignacionDocente->id])}}" method="POST"
        class="Eliminar">
        @method('DELETE')
        @csrf
        <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Eliminar</button>
      </form>
    </div>
    <div class="col-6">
      <a href="{{route('secciones')}}" class="btn btn-danger btn-block btn-lg" id="botonRegistrar"
        type="button">Cancelar</a>
    </div>
    @endforeach
    @endif

  </div>






</div>

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('.Eliminar').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: '¿Estás seguro que quieres eliminar la materia asignada al docente?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
            }).then((result) => {
                  if (result.isConfirmed) {
                  this.submit();
            }
            })
      });
</script>


@if (session('eliminar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Materia asignada al docente eliminada',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@endsection