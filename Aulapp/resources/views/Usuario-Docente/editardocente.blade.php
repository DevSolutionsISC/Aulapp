@extends('plantilla')
@section('title', 'Docente')
@section("editar","docenteEdit")
@section("registrar","docente")
@section("reporte","reporte_docente")
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

      <label for="inputtexto" class="form-label ">Coloque el CI del docente que quiere editar y presione buscar</label>
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
      <label for="Apellido" class="form-label ed">Apellido</label>
      <input type="text" id="inputApellido" class="form-control ed" name="Apellido" value="{{old('Apellido')}}" autofocus>
      @if ($errors->has('Apellido'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('Apellido') }}</span>
      <br>
      @endif
      <br>
      <label for="CI" class="form-label ed">CI</label>
      <input type="text" id="inputCI" class="form-control ed" name="CI" value="{{old('CI')}}" autofocus>
      @if ($errors->has('CI'))
      <span class="error text-danger" for="inputCI">{{ $errors->first('CI') }}</span>
      <br>
      @endif
      <br>
      <label for="Correo" class="form-label ed">Correo</label>
      <input type="text" id="inputCorreo" class="form-control ed" name="Correo" value="{{old('Correo')}}" autofocus>
      @if ($errors->has('Correo'))
      <span class="error text-danger" for="inputCorreo">{{ $errors->first('Correo') }}</span>
      <br>
      @endif
      <br>
      <span class="ed">Materiass a las que se le asigno:</span>
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
@if ($errors->has('Correo') || $errors->has('Nombre') || $errors->has('Apellido')|| $errors->has('CI') )
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
  @foreach ($materia_carrera as $mc )
          @foreach ($userRol as $ur )
              @foreach ($a_docentes as $ad)
                  if(localStorage.getItem("key")== '{{$ur->usuario_id}}'&& '{{$mc->id}}'=='{{$ad->materia_carreras_id}}' && '{{$ur->id}}'=='{{$ad->user_rol_id}}'){
                    asignaciones.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><span class='A_let' id='{{$mc->id}}'>{{$mc->nom_carrera}}-{{$mc->nom_materia}}</span></div>";
                    var actual= document.getElementById("actual");
                        actual.value+="+"+'{{$mc -> id}}'
                        var permanente= document.getElementById("permanente");
                        permanente.value+="+"+'{{$mc -> id}}'
                }
              @endforeach
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
  var apellido=document.getElementById("inputApellido");
  var ci=document.getElementById("inputCI");
  var correo=document.getElementById("inputCorreo");
  var texto=document.getElementById("inputtexto");
  var encontrado=0;
  var formulario=document.getElementById("formulario");
  @foreach ($docentes as $docente)
    if(texto.value =='{{$docente->CI}}'){
        buscar.disabled=true;
      nombre.value='{{$docente->Nombre}}'
      apellido.value='{{$docente->Apellido}}'
      ci.value='{{$docente->CI}}'
      correo.value='{{$docente->Email}}'
      formulario.action="{{route('docente-update', ['id'=>$docente->id])}}"
      localStorage.setItem('ruta',formulario.action)
      localStorage.setItem('id',texto.value)
      var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
      texto.disabled=true;
      encontrado=1;
      var asignaciones= document.getElementById("Asignaciones");
      @foreach ($materia_carrera as $mc )
          @foreach ($userRol as $ur )
              @foreach ($a_docentes as $ad)
                  if('{{$docente->id}}'== '{{$ur->usuario_id}}'&& '{{$mc->id}}'=='{{$ad->materia_carreras_id}}' && '{{$ur->id}}'=='{{$ad->user_rol_id}}'){
                    asignaciones.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><span class='A_let' id='{{$mc->id}}'>{{$mc->nom_carrera}}-{{$mc->nom_materia}}</span></div>";
                    localStorage.setItem("key",{{$docente -> id}});
                        var actual= document.getElementById("actual");
                        actual.value+="+"+'{{$mc -> id}}'
                        var permanente= document.getElementById("permanente");
                        permanente.value+="+"+'{{$mc -> id}}'
                }
              @endforeach
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
                    var todosC=[]
                    var todosM=[]
                    var todosCM=[]
                    @foreach ($carreras as $carrera )
                        todosC.push(['{{$carrera->Nombre}}','{{$carrera->id}}']);
                    @endforeach
                     @foreach ($materias as $materia )
                        todosM.push(['{{$materia->nombre_materia}}','{{$materia->id}}']);
                    @endforeach
                    @foreach ($materia_carrera as $m_c )
                    todosCM.push(['{{$m_c->nom_carrera}}','{{$m_c->nom_materia}}','{{$m_c->id}}']);
                       
                    @endforeach
                    var contenedor=document.createElement("div");
                    var materias=document.createElement("select");
                    materias.className="form-select"
                    aux.innerHTML+="<option >Seleccione una carrera</option>"
                    for(var i=0;i<todosC.length;i++){
                        var encontrado=0;
                        
                        if(encontrado==0){
                            aux.innerHTML+="<option id="+todosC[i][1]+">"+todosC[i][0]+"</option>"
                        }
                    }
                    aux.addEventListener('change', (event) => {
                        materias.innerHTML="";
                     for(var contM=0;contM<todosCM.length;contM++){
                        var bandera=0;
                        for(var contEn=0;contEn<letras.length && bandera==0;contEn++){
                            var asignacion=letras[contEn].innerHTML.split("-");
                            if(todosCM[contM][1]==asignacion[1] && aux.options[aux.selectedIndex].text==asignacion[0]){
                                bandera=1;
                            }
                        }
                        
                        if(bandera==0 && aux.options[aux.selectedIndex].text==todosCM[contM][0]){
                           

                            materias.innerHTML+="<option id="+todosCM[contM][2]+">"+todosCM[contM][1]+"</option>"
                        }
                     }
                    });
                    contenedor.appendChild(aux);
                    contenedor.appendChild(materias);

                    Swal.fire({
                    title: 'Seleccione la carrera a la que desea asignar',
                    showCancelButton: true,
                    cancelButtonText:'Cancelar',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Asignar',
                    html:contenedor,
                    }).then((result) => {
                    if (result.isConfirmed) {
                        var asignaciones= document.getElementById("Asignaciones");
                        asignaciones.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><span class='A_let' id="+materias.options[materias.selectedIndex].id+">"+aux.options[aux.selectedIndex].text+"-"+materias.options[materias.selectedIndex].text +"</span></div>";
                        var actual=document.getElementById("actual")
                        var eliminar=document.getElementById("eliminar");
                        var nuevo= document.getElementById("nuevo")
                        if(esta(materias.options[materias.selectedIndex].id, eliminar.value)){
                             if(!esta(materias.options[materias.selectedIndex].id, nuevo.value)){
                                nuevo.value+="+"+materias.options[materias.selectedIndex].id
                                eliminar.value=sacar(materias.options[materias.selectedIndex].id,eliminar.value)
                                console.log(eliminar.value+"==="+nuevo.value+"==="+actual.value)
                                }

            }else{
              nuevo.value+="+"+materias.options[materias.selectedIndex].id
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
