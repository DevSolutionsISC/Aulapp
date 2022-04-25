@extends('plantilla')
@section('title', 'Aulas')
@section("editar","aulaEdit")
@section("registrar","aula")
@section("reporte","aulas")
@section('Titulo')
<h3 text-center id="Titulo">Administracion de Aulas</h3>
@endsection
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar Aula</h3>

      <label for="inputtexto" class="form-label ">Coloque el codigo del aula que quiere editar y presione buscar</label>
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
      <label for="capacidad" class="form-label ed">Capacidad</label>
      <input type="text" id="inputCodigo" class="form-control ed" name="capacidad" value="{{old('capacidad')}}" autofocus>
      @if ($errors->has('capacidad'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('capacidad') }}</span>
      <br>
      @endif
      <label for="asignar" class="ed">Seccion a la que pertenece:</label>
      <br>
      <select name="section" id="asignar" class="form-select ed"></select>
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg ed" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-danger btn-block btn-lg ed" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>
@if ($errors->has('capacidad') || $errors->has('Nombre') )
<script>
    var buscar=document.getElementById("buscar");
    buscar.disabled=true;
   var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      var texto=document.getElementById("inputtexto");
      texto.disabled=true
      texto.value=localStorage.getItem('id')
  formulario.action=localStorage.getItem("ruta");
  var asignaciones= document.getElementById("Asignaciones");
  var asignaciones= document.getElementById("asignar");
      @foreach ($secciones as $seccion )
        if ({{$seccion->id}} == localStorage.getItem("key")){
            asignaciones.innerHTML+="<option selected='selected'value={{$seccion->id}}>{{$seccion->nombre}}</option>"
        }else{
            asignaciones.innerHTML+="<option value={{$seccion->id}}>{{$seccion->nombre}}</option>"
        }
        
      @endforeach
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
  @foreach ($aulas as $aula)
    if(texto.value =='{{$aula->nombre}}'){
        buscar.disabled=true;
      nombre.value='{{$aula->nombre}}'
      codigo.value='{{$aula->capacidad}}'
      formulario.action="{{route('aula-update', ['id'=>$aula->id])}}"
      localStorage.setItem('ruta',formulario.action)
      localStorage.setItem('id',texto.value)
      var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      texto.disabled=true;
      encontrado=1;
      var asignaciones= document.getElementById("asignar");
      @foreach ($secciones as $seccion )
        if ({{$seccion->id}} == {{$aula->id_section}}){
            asignaciones.innerHTML+="<option selected='selected'value={{$seccion->id}}>{{$seccion->nombre}}</option>"
            localStorage.setItem("key",'{{$seccion->nombre}}');
        }else{
            asignaciones.innerHTML+="<option value={{$seccion->id}}>{{$seccion->nombre}}</option>"
        }
      @endforeach
    }
  @endforeach
  if(encontrado==0){
      Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se encontro ningun aula con ese nombre',
    })

    }
  }

</script>
<script>
    var letras=document.getElementsByClassName("A_let")
    var asignaciones= document.getElementById("Asignaciones");
    document.onclick=function(a){
        var f=a.target;
        for(var i=0;i<letras.length;i++){
     if(f==letras[i]){
         if(letras.length>1){
            asignaciones.removeChild(letras[i].parentNode)
            var actual=document.getElementById("actual");
            if(esta(f.id,actual.value)){
                var eliminar=document.getElementById("eliminar")
                eliminar.value+="+"+f.id
                console.log(eliminar.value+"-eliminar-"+actual.value)
            }
         }else{
            Swal.fire({ icon: 'error',title: 'No puedes dejar una materia sin carreras'})
        }
    }
        }}
         function esta(id, cadena){
            var alerta =false;
            var separado=cadena.split("+");
            for(var i=1;i<separado.length;i++){
                if(separado[i]==id){
                    alerta=true;
                }
            }
            return alerta;
        }
        

</script>
@endsection
