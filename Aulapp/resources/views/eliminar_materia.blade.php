@extends('plantilla2')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de carreras </h3>
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

    <form id="formulario" method="GET" action="{{route('eliminar-materia')}}">
      <h3 text-center>Eliminar materia</h3>
      @csrf

      <label for="inputNombre" class="form-label">Coloque el codigo de la materia que quiere eliminar</label>
      <input type="text" id="inputNombre" class="form-control search" name="search" required>


      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg">
          Buscar
        </button>
      </div>


      <br>
      @if (count($materias) <= 0) <p class="p-1" id="datosEliminar">No hay resultados</p>
        @elseif (count($materias) > 1)

        @elseif (count($materias) == 1)
        @foreach ($materias as $materia )
        <div class="p-1" id="datosEliminar">
          <h6>Datos de la carrera</h6>

          <span>Nombre: {{$materia->nombre_materia}}</span>
          <br>
          <span>Codigo:{{$materia->Cod_materia}}</span>

        </div>


    </form>
  </div>
  <div class="row">
    <div class="col-6">
      <form action="{{route('materias-destroy', ['materia'=>$materia->id])}}" method="POST" class="Eliminar">
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
            title: '¿Estás seguro que quieres eliminar la materia?',
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
  title: 'Materia eliminada',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@endsection