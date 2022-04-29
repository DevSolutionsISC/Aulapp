@extends('plantilla2')
@section('title', 'Aula')




<header>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}"
          width="50" id="logo"></a>
      @yield('Titulo')
      <a href="#" class="material-symbols-outlined" id="menu">menu</a>
      <h3 text-center id="Titulo">Administracion de aula </h3>
      <form class="d-flex">
        <a class="nav-link active" aria-current="page" href="{{url('menu_adm')}}">Inicio</a>
        <a class="nav-link active" aria-current="page" href="{{url('/aula')}}">Registrar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/aulaEdit')}}">Editar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/eliminar-aula')}}">Eliminar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/reporte_aula')}}">Ver reporte</a>

      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<div class="d-flex align-items-center justify-content-center row p-2" id="formulario">
  <div class="col-12">

    <form id="formulario" method="GET" action="{{route('eliminar-aula')}}">
      <h3 text-center>Eliminar aula</h3>
      @csrf

      <label for="inputNombre" class="form-label">Coloque el nombre del aula que quiere eliminar</label>
      <input type="text" id="inputNombre" class="form-control search" name="search">


      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg">
          Buscar
        </button>
      </div>


      <br>
      @if (count($aulas) <= 0) @elseif (count($aulas)> 1)

        @elseif (count($aulas) == 1)
        @foreach ($aulas as $aula)
        @if ($aula->estado == true && $aula->section->estado == true)


        <div class="p-1" id="datosEliminar">
          <h6><b>Datos del aula</b></h6>

          <span> <b>Nombre:</b> {{$aula->nombre}}</span>
          <br>
          <span> <b>Capacidad:</b> {{$aula->capacidad}}</span>
          <br>
          <span> <b>Seccion: </b> {{$aula->section->nombre}}</span>

        </div>


    </form>
  </div>
  <div class="row">
    <div class="col-6">
      <form action="{{route('aulas-destroy', [$aula->id])}}" method="POST" class="Eliminar">
        @method('DELETE')
        @csrf
        <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Eliminar</button>
      </form>
    </div>
    <div class="col-6">
      <a href="{{url('/eliminar-aula')}}" class="btn btn-danger btn-block btn-lg" id="botonRegistrar"
        type="button">Cancelar</a>
    </div>
    @endif
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
            title: '¿Estás seguro que quieres eliminar el aula?',
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
  title: 'Aula eliminada',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@if (session('buscar')=='error')
<script>
  Swal.fire({
position: 'center',
icon: 'error',
title: 'Oops...',
text: 'No se encontro ninguna aula con ese nombre',
showConfirmButton: true,
})
</script>
@endif
@endsection