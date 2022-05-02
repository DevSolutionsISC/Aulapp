@extends('plantilla')
@section('title', 'Docente')
@section('Titulo')
@section("editar","docenteEdit")
@section("registrar","docente")
@section("reporte","reporte_user_rol")
@section("eliminar","eliminar-docente")
@section('Titulo')

<h3 text-center id="Titulo">Administracion de Docentes</h3>
@endsection
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar docente</h3>

      <label for="inputtexto" class="form-label ">Coloque el CI de la carrera que quiere editar y presione buscar</label>
      <input type="text" id="inputtexto" class="form-control" name="nombre" value="{{old('nombre')}}" autofocus>
      <br>
      <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off" id="buscar">
       Buscar
      </button>
      <br>
      <span class="error text-danger" for="input-nombre"></span>
      <label for="inputNombre" class="form-label ed">Nombre</label>
      <input type="text" id="inputNombre" class="form-control ed" name="Nombre" value="{{old('Nombre')}}" autofocus>
      @if ($errors->has('Nombre'))
            <span class="error text-danger" for="input-nombre">{{ $errors->first('Nombre') }}</span>
      @endif
      <br>
      <label for="Codigo" class="form-label ed">Apellido</label>
      <input type="text" id="inputApellido" class="form-control ed" name="Apellido" value="{{old('Apellido')}}" autofocus>
      @if ($errors->has('Apellido'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('Apellido') }}</span>
      @endif
      <br>
      <label for="CI" class="form-label ed">CI</label>
      <input type="text" id="inputCI" class="form-control ed" name="CI" value="{{old('CI')}}" autofocus>
      @if ($errors->has('CI'))
      <span class="error text-danger" for="inputCI">{{ $errors->first('CI') }}</span>
      @endif
      <br>
      <label for="Correo" class="form-label ed">Correo</label>
      <input type="text" id="inputCorreo" class="form-control ed" name="Correo" value="{{old('Correo')}}" autofocus>
      @if ($errors->has('Codigo'))
      <span class="error text-danger" for="inputCorreo">{{ $errors->first('Correo') }}</span>
      @endif
   
      <br>
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg ed" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-danger btn-block btn-lg ed" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>
@if ($errors->has('Correo') || $errors->has('Nombre') ||$errors->has('CI')  ||$errors->has('Apellido') )
<script>
   var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      var texto=document.getElementById("inputtexto");
      texto.disabled=true
      texto.value=localStorage.getItem('id')
  formulario.action=localStorage.getItem("ruta");

</script>
@endif
@if (session('actualizar')=='ok')
  <script>localStorage.setItem('ruta',"")</script>
@endif
@endsection
@section('js')
<script>
  var buscar=document.getElementById("buscar");
  buscar.onclick=function(){
  var nombre= document.getElementById("inputNombre");
  var apellido=document.getElementById("inputApellido");
  var ci=document.getElementById("inputCI");
  var correo=document.getElementById("inputCorreo");
  var texto=document.getElementById("inputtexto");
  var encontrado=0;
  var formulario=document.getElementById("formulario");
  @foreach ($docentes as $docente)
    @foreach ($urs as $ur )
      if(texto.value=='{{$docente->CI}}' && '{{$ur->rol_id}}'=='2'){
          nombre.value='{{$docente->Nombre}}'
          apellido.value= '{{$docente->Apellido}}'
          ci.value='{{$docente->CI}}'
          correo.value= '{{$docente->Email}}'
          formulario.action="{{route('docente-update', ['id'=>$docente->id])}}"
          localStorage.setItem('ruta',formulario.action)
          localStorage.setItem('id',texto.value)
          var ed=document.getElementsByClassName("ed");
          encontrado=1;
          for(var i=0;i<ed.length;i++){
          ed[i].style.display="block"
          }
          texto.disabled=true;

      }
    @endforeach

  @endforeach
  if(encontrado == 0){
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se encontro ningun docente con ese CI',
    })
  }
  }
</script>
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
@endsection