@extends('plantilla')
@section("editar","seccionEdit")
@section("registrar","seccion")
@section("reporte","section")
@section("eliminar","eliminar-seccion")
@section('title', 'Sección')
@section('Titulo')
<h3 text-center id="Titulo">Administracion de Secciones</h3>
@endsection
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar Sección</h3>

      <label for="inputtexto" class="form-label ">Coloque el codigo de la seccion que quiere editar y presione buscar</label>
      <input type="text" id="inputtexto" class="form-control" name="entrada" value="{{old('entrada')}}" autofocus>
      <br>
      <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off" id="buscar">
       Buscar
      </button>
      <br>
      <span class="error text-danger" for="input-nombre"></span>
      <label for="inputNombre" class="form-label ed">Nombre</label>
      <input type="text" id="inputNombre" class="form-control ed" name="nombre" value="{{old('nombre')}}" autofocus>
      @if ($errors->has('nombre'))
            <span class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
      @endif
      <br>
      <label for="descripcion" class="form-label ed">Descripcion</label>
      <input type="text" id="inputCodigo" class="form-control ed" name="descripcion" value="{{old('descripcion')}}" autofocus>
      @if ($errors->has('descripcion'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('descripcion') }}</span>
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
@if ($errors->has('descripcion') || $errors->has('nombre') )
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
  var codigo=document.getElementById("inputCodigo");
  var texto=document.getElementById("inputtexto");
  var encontrado=0;
  var formulario=document.getElementById("formulario");
  @foreach ($secciones as $seccion)
    if(texto.value =='{{$seccion->nombre}}'){
      nombre.value='{{$seccion->nombre}}'
      codigo.value='{{$seccion->descripcion}}'
      formulario.action="{{route('seccion-update', ['id'=>$seccion->id])}}"
      localStorage.setItem('ruta',formulario.action)
      localStorage.setItem('id',texto.value)
      var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      texto.disabled=true;
      encontrado=1;
    }
  @endforeach
  if(encontrado==0){
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se encontro ninguna seccion con ese nombre',
    })
  }
  
  }
</script>
@endsection