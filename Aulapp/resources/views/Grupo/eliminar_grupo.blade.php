@extends('plantilla2')
@section('title', 'Grupo')




<header>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img id="logo"
          src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
      @yield('Titulo')
      <a href="#" class="material-symbols-outlined" id="menu">menu</a>
      <h3 id="Titulo">Administración de grupo </h3>
      <form class="d-flex">
        <a class="nav-link active" aria-current="page" href="{{url('menu_adm')}}">Inicio</a>
        <a class="nav-link active" aria-current="page" href="{{url('/grupos')}}">Registrar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/grupoEdit')}}">Editar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/eliminar-grupo')}}">Eliminar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/reporte_grupo')}}">Ver reporte</a>

      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<div class="d-flex align-items-center justify-content-center row p-2" id="formulario">
  <div class="col-12">

    <form id="formulario" method="GET" action="{{route('eliminar-grupo')}}">
      <h3 text-center>Eliminar grupo</h3>
      @csrf

      <label for="inputNombre" class="form-label">Introduzca el id de registro</label>
      <input type="text" id="inputNombre" class="form-control search" name="search">


      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg">
          Buscar
        </button>
      </div>


      <br>
      @if (count($grupos) <= 0) @elseif (count($grupos)> 1)

        @elseif (count($grupos) == 1)
        @foreach ($grupos as $grupo )
        @if ($grupo->estado == true)


        <div class="p-1" id="datosEliminar">
          <h6>Datos del grupo</h6>
          <span><b>id:</b>{{$grupo->id}}</span>
          <br>
          <span><b>{{$grupo->nombre}}</b></span>
          <br>
          <span><b>Docente:</b> {{$grupo->asignacionDocente->user_rol->usuario->Nombre}}
            {{$grupo->asignacionDocente->user_rol->usuario->Apellido}}</span>
          <br>

          <span><b>Carrera:</b> {{$grupo->asignacionDocente->materia_carrera->carrera->Nombre}}</span>
          <br>
          <span><b>Materia:</b> {{$grupo->asignacionDocente->materia_carrera->materia->nombre_materia}}</span>
        </div>
    </form>
  </div>
  <div class="d-flex justify-content-center">

    <form action="{{route('grupos-destroy', [$grupo->id])}}" method="POST" class="Eliminar">
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
            title: '¿Estás seguro que quieres eliminar el grupo?',
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
  title: 'Grupo eliminado',
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
  text: 'No se encontro ningun grupo con ese codigo',
  showConfirmButton: true,
  })

</script>
@endif
@endsection