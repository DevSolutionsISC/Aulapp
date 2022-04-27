@extends('plantilla')
@section('title', 'Materia')
@section("editar","materiaEdit")
@section("registrar","materias")
@section("reporte","materia")
@section('Titulo')
<h3 text-center id="Titulo">Administracion de Materias</h3>
@endsection
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar materia</h3>

      <label for="inputtexto" class="form-label ">Coloque el codigo de la materia que quiere editar y presione buscar</label>
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
      <br>
      @endif
   
      <br>
      <span class="ed">Carreras a las que pertenece:</span>
      <br>
      <div class="d-grid gap-2">
          <div id="Asignaciones"></div>
          <label id="error_asignacion"></label>
          <span class="ed" id="agregar">Nueva asignacion</span>
          <input type="text" id="actual" class="oculto" value="" name="Actual">
          <input type="text" id="nuevo" class="oculto" value="" name="Nuevo">
          <input type="text" id="eliminar" class="oculto"value="" name="Eliminar">
          <input type="text" id="permanente" class="oculto" value="{{old('permanente')}}" name="permanente">
        <button class="btn btn-dark btn-block btn-lg ed" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-danger btn-block btn-lg ed " 
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>
@if ($errors->has('Codigo') || $errors->has('Nombre') )
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
  @foreach ($carreras as $carrera )
          @foreach ($conexiones as $conexion )
                    if(localStorage.getItem("key")== '{{$conexion -> materia_id}}' && '{{$carrera -> id}}' == '{{$conexion -> carrera_id}}'){
                        asignaciones.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><span class='A_let' id='{{$carrera->id}}'>{{$carrera->Nombre}}</span></div>"
                        var actual= document.getElementById("actual");
                        actual.value+="+"+'{{$carrera -> id}}'
                        var permanente= document.getElementById("permanente");
                        permanente.value+="+"+'{{$carrera -> id}}'
                      }          
          @endforeach
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
  @foreach ($materias as $materia)
    if(texto.value =='{{$materia->Cod_materia}}'){
        buscar.disabled=true;
      nombre.value='{{$materia->nombre_materia}}'
      codigo.value='{{$materia->Cod_materia}}'
      formulario.action="{{route('materias-update', ['id'=>$materia->id])}}"
      localStorage.setItem('ruta',formulario.action)
      localStorage.setItem('id',texto.value)
      var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      texto.disabled=true;
      encontrado=1;
      var asignaciones= document.getElementById("Asignaciones");
      @foreach ($carreras as $carrera )
          @foreach ($conexiones as $conexion )
                    if('{{$materia -> id}}'== '{{$conexion -> materia_id}}' && '{{$carrera -> id}}' == '{{$conexion -> carrera_id}}'){
                        asignaciones.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><span class='A_let' id='{{$carrera->id}}'>{{$carrera->Nombre}}</span></div>"
                        localStorage.setItem("key",{{$materia -> id}});
                        var actual= document.getElementById("actual");
                        actual.value+="+"+'{{$carrera -> id}}'
                        var permanente= document.getElementById("permanente");
                        permanente.value+="+"+'{{$carrera -> id}}'
                    }          
          @endforeach
      @endforeach
    }
  @endforeach
  if(encontrado==0){
      Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No se encontro ninguna materia con ese codigo',
    })

    }
  }

</script>
<script>
    var agreras=document.getElementById("agregar");
    agreras.onclick=function(){
        var aux=document.createElement("select")
        aux.className="form-select"
        var letras=document.getElementsByClassName("A_let")
        var todos=[]
        @foreach ($carreras as $carrera )
            todos.push(['{{$carrera->Nombre}}','{{$carrera->id}}']);
        @endforeach
        for(var i=0;i<todos.length;i++){
            var encontrado=0;
            for(var j=0;j<letras.length && encontrado==0;j++){
                if(todos[i][0]==letras[j].innerHTML){
                    encontrado=1;
                }
            }
            if(encontrado==0){
                aux.innerHTML+="<option id="+todos[i][1]+">"+todos[i][0]+"</option>"
            }
        }
        Swal.fire({
        title: 'Seleccione la carrera a la que desea asignar',
        showCancelButton: true,
        cancelButtonText:'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Asignar',
        html:aux,
        }).then((result) => {
        if (result.isConfirmed) {
            var asignaciones= document.getElementById("Asignaciones");
            asignaciones.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><span class='A_let' id="+aux.options[aux.selectedIndex].id+">"+aux.options[aux.selectedIndex].text +"</span></div>";
            var actual=document.getElementById("actual")
            var eliminar=document.getElementById("eliminar");
            var nuevo= document.getElementById("nuevo")
            if(esta(aux.options[aux.selectedIndex].id, eliminar.value)){
                if(!esta(aux.options[aux.selectedIndex].id, nuevo.value)){
                  nuevo.value+="+"+aux.options[aux.selectedIndex].id
                  eliminar.value=sacar(aux.options[aux.selectedIndex].id,eliminar.value)
                  console.log(eliminar.value+"==="+nuevo.value+"==="+actual.value)
                }

            }else{
              nuevo.value+="+"+aux.options[aux.selectedIndex].id
              console.log(eliminar.value+"==="+nuevo.value+"==="+actual.value)
            }

        }
        })
    }
</script>
<script>
    var letras=document.getElementsByClassName("A_let")
    var asignaciones= document.getElementById("Asignaciones");
    document.onclick=function(a){
        var f=a.target;
        var nuevo=document.getElementById("nuevo");
        for(var i=0;i<letras.length;i++){
     if(f==letras[i]){
            asignaciones.removeChild(letras[i].parentNode)
            var actual=document.getElementById("actual");
            var eliminar=document.getElementById("eliminar")
            var nuevo=document.getElementById("nuevo");
            if(esta(f.id,actual.value)){
                
                if(!esta(f.id,eliminar.value)){
                  eliminar.value+="+"+f.id
                actual.value=sacar(f.id,actual.value)
                console.log(eliminar.value+"==="+nuevo.value+"==="+actual.value)
                }
            }
            
            if(esta(f.id,nuevo.value)){
                var eliminar=document.getElementById("eliminar")
                if(!esta(f.id,eliminar.value)){
                  eliminar.value+="+"+f.id
                  nuevo.value=sacar(f.id,nuevo.value);
                  console.log(eliminar.value+"==="+nuevo.value+"==="+actual.value)
                }
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
<script>
  var enviar=document.getElementById("botonRegistrar")
  enviar.onclick=function(event){
    
    var actual=document.getElementById("actual");
    var nuevo= document.getElementById("nuevo");
    var eliminar= document.getElementById("eliminar");
    var mensaje=document.getElementById("error_asignacion");
    if(actual.value == "" && nuevo.value==""){
      event.preventDefault();
      mensaje.innerHTML="Asignar una carrera es obligatorio"
    }else{
      mensaje.innerHTML="";
      
    }
  }
  function sacar(elemento, lista){
    var separado= lista.split("+");
    var palabra="";
    for(var i=0; i<separado.length;i++){
      if(!(separado[i]==elemento)&& separado[i]!=""){
                  palabra+='+'+separado[i];
                }
    }
    return palabra;
  }
</script>
@endsection
