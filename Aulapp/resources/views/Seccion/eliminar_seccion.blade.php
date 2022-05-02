@extends('plantilla2')
@section('title', 'Seccion')


<header>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}"
          width="50" id="logo"></a>
      <h3 text-center id="Titulo"> Administración de sección</h3>
      <a href="#" class="material-symbols-outlined" id="menu">menu</a>
      <form class="d-flex">
        <a class="nav-link active" aria-current="page" href="{{url('/menu_adm')}}">Inicio</a>
        <a class="nav-link active" aria-current="page" href="{{url('/seccion')}}">Registrar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/seccionEdit')}}">Editar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/eliminar-seccion')}}">Eliminar</a>
        <a class="nav-link active" aria-current="page" href="{{url('/reporte_section')}}">Ver reporte</a>

      </form>
    </div>
  </nav>
</header>
@section('Contenido formulario')

<div class="d-flex align-items-center justify-content-center row p-2 formulario" id="formulario">
  <div class="col-12">

    <form id="formulario" method="GET" action="{{route('eliminar-seccion')}}">
      <h3 text-center>Eliminar sección</h3>
      @csrf

      <label for="inputNombre" class="form-label">Coloque el nombre de la sección que quiere eliminar</label>
      <input type="text" id="inputNombre" class="form-control search" name="search" id="inputtexto">


      <br>
      <div class="d-flex justify-content-center">
        <button class="btn btn-dark btn-block btn-lg" id="buscar">
          Buscar
        </button>
      </div>


      <br>
      @if (count($sections) <= 0) @elseif (count($sections)> 1)

        @elseif (count($sections) == 1)
        @foreach ($sections as $section )
        @if ($section->estado == true)


        <div class="p-1" id="datosEliminar">
          <h6><b>Datos de la sección</b> </h6>

          <span><b>Nombre:</b> {{$section->nombre}}</span>
          <br>
          <span><b>Descripcion:</b> {{$section->descripcion}}</span>

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
      <a href="{{url('/eliminar-seccion')}}" class="btn btn-danger btn-block btn-lg" id="botonRegistrar"
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



@if (session('eliminar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Sección eliminada',
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
text: 'No se encontro ninguna sección con ese nombre',
showConfirmButton: true,

})
</script>
@endif
@php
  use App\Models\Section;
  $ss=Section::all();
@endphp
<script>
  var buscar=document.getElementById("buscar");
var nombre=document.getElementById("inputNombre");
buscar.onclick=function(evento){
  var encontrado=0

  @foreach ($ss as $s )
    if(nombre.value== '{{$s->nombre}}' && {{$s->estado}}==1){
      encontrado=1;
    }
  @endforeach
  if(encontrado==0){
    event.preventDefault();
    Swal.fire({
position: 'center',
icon: 'error',
title: 'Oops...',
text: 'No se encontro ninguna sección con ese nombre',
showConfirmButton: true,

})
  }

}
</script>
@endsection