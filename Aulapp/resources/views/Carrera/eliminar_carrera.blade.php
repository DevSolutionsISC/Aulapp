@extends('plantilla2')
@section('title', 'Carrera')




<header>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img id="logo"
          src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
      @yield('Titulo')
      <a href="#" class="material-symbols-outlined" id="menu">menu</a>
      <h3 text-center id="Titulo">Administración de carrera </h3>
      <form class="d-flex">
        <a class="nav-link active" aria-current="page" href="{{url('/menu_adm')}}">Inicio</a>
        <a class="nav-link active" aria-current="page" href="{{url('carreras')}}">Registrar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/carreraEdit')}}">Editar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/eliminar-carrera')}}">Eliminar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/reporte_carrera')}}">Ver reporte</a>

      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<div class="d-flex align-items-center justify-content-center row p-2" id="formulario">
  <div class="col-12">

    <form id="formulario" method="GET" action="{{route('eliminar-carrera')}}">

      <h3 text-center>Eliminar carrera</h3>

      @csrf

      <label for="inputNombre" class="form-label">Introduzca el codigo de la carrera que quiere eliminar</label>
      <input type="text" id="inputNombre" class="form-control search" name="search">


      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg">
          Buscar
        </button>
      </div>


      <br>
      @if (count($carreras) <= 0) @elseif (count($carreras)> 1)

        @elseif (count($carreras) == 1)
        @foreach ($carreras as $carrera )
        @if ($carrera->estado == true)
        <div class="p-1" id="datosEliminar">

          <h6><b>Datos de la carrera</b></h6>

          <span><b>Codigo:</b>{{$carrera->Codigo}}</span>

          <br>
          <span><b>Nombre: </b>{{$carrera->Nombre}}</span>

        </div>


    </form>
  </div>
  <div class="d-flex justify-content-center">

    <form action="{{route('carreras-destroy', ['carrera'=>$carrera->id])}}" method="POST" class="Eliminar">
      @method('DELETE')
      @csrf
      <button class="btn btn-dark btn-block btn-lg" type="submit">Eliminar</button>
    </form>


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
            title: '¿Estás seguro que quieres eliminar la carrera?',
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
  title: 'Carrera eliminada',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@if (session('buscar')=='error')
<script>
  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'No se encontro ninguna carrera  ese codigo',
  showConfirmButton: true,
  })

</script>
@endif
@endsection