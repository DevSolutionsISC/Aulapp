@extends('plantilla')
@section('title', 'Carrera')
@section('Titulo')
@section("editar","carreraEdit")
@section("registrar","carreras")
@section("reporte","reporte_carrera")
@section("eliminar","eliminar-carrera")
<h3 text-center id="Titulo">Administracion de Carreras</h3>
@endsection
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar carrera</h3>

      <label for="inputtexto" class="form-label ">Coloque el codigo de la carrera que quiere editar y presione buscar</label>
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
      <label for="Codigo" class="form-label ed">Codigo</label>
      <input type="text" id="inputCodigo" class="form-control ed" name="Codigo" value="{{old('Codigo')}}" autofocus>
      @if ($errors->has('Codigo'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('Codigo') }}</span>
      @endif
   
      <br>
      <input type="text" name="estadoE" id="estadoE" value="{{old('estadoE')}}">
      <label class=" oculto">Estado:</label>
      <div class="form-check form-switch oculto">
        <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado" >
        <label class="form-check-label" for="flexSwitchCheckDefault">Baja/Alta</label>
      </div>
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg ed" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-danger btn-block btn-lg ed" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>
@if ($errors->has('Codigo') || $errors->has('Nombre') )
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
  var nombre= document.getElementById("inputNombre");
  var codigo=document.getElementById("inputCodigo");
  var texto=document.getElementById("inputtexto");
  var estado=document.getElementById("estado")
  var estadoE=document.getElementById("estadoE")
  estadoE.value=1
  var asignado=0
  buscar.onclick=function(){
  var encontrado=0;
  var formulario=document.getElementById("formulario");
  @foreach ($carreras as $carrera)
    if(texto.value =='{{$carrera->Codigo}}'){
      nombre.value='{{$carrera->Nombre}}'
      codigo.value='{{$carrera->Codigo}}'
      formulario.action="{{route('carreras-update', ['id'=>$carrera->id])}}"
      localStorage.setItem('ruta',formulario.action)
      localStorage.setItem('id',texto.value)
      var ed=document.getElementsByClassName("ed");
      encontrado=1;
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      texto.disabled=true;
      if({{$carrera->estado}}==0){
            Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'La carrera se encuentra de baja, dar de alta para poder editarlo',
            })
            var oculto=document.getElementsByClassName("oculto");
           
            for(var i=0;i<oculto.length;i++){
            oculto[i].style.display="block"
            nombre.disabled=true
            codigo.disabled=true
          }
          estadoE.value=0
          }
          @foreach ($mcs as $mc)
            if({{$carrera->id}} == {{$mc->carrera_id}}){
             asignado=1
             nombre.disabled=true
              codigo.disabled=true
              }
           @endforeach
    }
  @endforeach
  if(encontrado == 0){
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se encontro ninguna carrera con ese codigo',
    })
  }
  estado.onclick=function(){
    
    estadoE.value=1
    estado.disabled=true
    if(asignado == 0){
            nombre.disabled=false
            codigo.disabled=false
    }
  }
  var registrar=document.getElementById("botonRegistrar");
  registrar.onclick=function(){
    nombre.disabled=false
            nombre.disabled=false
            codigo.disabled=false
            estado.disabled=false
  }
  }
</script>
@endsection