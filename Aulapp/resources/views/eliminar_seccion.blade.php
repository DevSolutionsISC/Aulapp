@extends('plantilla2')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de seccion </h3>
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

    <form id="formulario" method="GET" action="{{route('eliminar-seccion')}}">
      <h3 text-center>Eliminar seccion</h3>
      @csrf

      <label for="inputNombre" class="form-label">Coloque el nombre de la seccion que quiere eliminar</label>
      <input type="text" id="inputNombre" class="form-control search" name="search" required>


      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg">
          Buscar
        </button>
      </div>


      <br>
      @if (count($sections) <= 0) <p class="p-1" id="datosEliminar">No hay resultados</p>
        @elseif (count($sections) > 1)

        @elseif (count($sections) == 1)
        @foreach ($sections as $section )
        <div class="p-1" id="datosEliminar">
          <h6>Datos de la seccion</h6>

          <span>Nombre: {{$section->nombre}}</span>
          <br>
          <span>Descripcion:{{$section->descripcion}}</span>

        </div>


    </form>
  </div>
  <div class="row">
    <div class="col-6">
      <form action="{{route('secciones-destroy', ['section'=>$section->id])}}" method="POST" class="Eliminar">
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
            title: '¿Estás seguro que quieres eliminar la seccion?',
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
  title: 'Seccion eliminada',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@endsection