<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="{{asset('css/plantilla.css')}}" />
  <link rel="stylesheet" href="{{asset('css/editar.css')}}" />
  <title>@yield('title')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gruppo&family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>


  <header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><span id="Nlogo">Aulapp</span><img src="{{asset('Imagenes/logo.jpeg')}}" width="50" id="logo"></a>
        <h3>Realizar reserva</h3>
        <a href="#" class="material-symbols-outlined" id="menu">menu</a>
        <form class="d-flex">
          <a class="nav-link active" aria-current="page" href="menu_docente" id="inicio">Inicio</a>
          <a class="nav-link active" aria-current="page" href="@yield("registrar")" id="registrar">DevSolution</a>
        </form>
      </div>
    </nav>
  </header>
  <div id="Container" class="container-fluid">
    <div class="row">
        <div >
          <div class="d-flex" id="formularioEditar">
            <form method="GET" action="" id="formulario">
              
              @csrf
              <h3 text-center>Realizar reserva</h3>
              <label>Materia:</label>
              <select name="materia" id="materia" class="form-select"> 
              </select>
                <label id="nombre">Nombre:</label>
              <br>
              <input type="text" name="docentes" id="lista_docentes" class="form-control">
              <div id="docentes"></div>
              <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off" id="añadirD">
                Añadir docente +
               </button><br>
              <label>Grupos:</label><br>
              <input type="text" name="grupos" id="lista_grupos" class="form-control">
              <div id="grupos"></div>
              <span id="errorg" class="error"></span><br>
              <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off" id="añadirG">
                Añadir grupo +
               </button>
              <div class="row">
                  <div class="col"><label>Cantidad de estudiantes:</label></div>
                  <div class="col"><input type="text" id="cantidad" class="form-control"></div>
                  <span id="errorc" class="error"></span>
              </div> 

              <label>Motivo</label><br>
              <textarea name="motivo" id="motivo" cols="45" rows="3" class="form-control"></textarea>
              <span id="errorm" class="error"></span><br>
                <label>Fecha: </label> <input type="date" name="fecha" id="fecha" class="date"><br>
                <span id="errorf" class="error"></span><br>
                <div class="row">
                    <div class="col"><label>Horario:</label></div>
                    <div class="col"><select name="horario" id="horario" class="form-select">
                        <option value="6:45">6:45</option>
                        <option value="6:45">8:15</option>
                        <option value="6:45">9:45</option>
                        <option value="6:45">11:15</option>
                        <option value="6:45">12:45</option>
                        <option value="6:45">14:15</option>
                        <option value="6:45">15:45</option>
                        <option value="6:45">17:15</option>
                        <option value="6:45">18:45</option>
                    </select></div>
                </div><br>
                <div class="row">
                        <div class="col"><label>Duración:</label></div>
                        <div class="col"><select name="duracion" id="duracion" class="form-select">
                            <option value="1:30">1:30</option>
                            <option value="3:00">3:00</option>    
                        </select></div>
                        <div class="col"><label>Hrs.</label></div>
                </div>
              <div class="d-grid gap-2">
                <button class="btn btn-dark btn-block btn-lg " id="botonRegistrar" type="submit">Guardar</button>
                <a href="" class="btn btn-danger btn-block btn-lg " id="botonRegistrar"
                  type="button">Cancelar</a>
              </div>
            </form>
          </div>
        
        </div>
  </div>
  <footer>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @yield('js')
<script>
  var menu=document.getElementsByClassName("nav-link");
  var btn_menu=document.getElementById("menu")
  btn_menu.onclick=function(){
    if(btn_menu.innerHTML=="menu"){
      for(var i=0 ; i<menu.length;i++){
      menu[i].style.display="block"
      }
       btn_menu.innerHTML="close";
    }else{
      for(var i=0 ; i<menu.length;i++){
      menu[i].style.display="none"
    }
    btn_menu.innerHTML="menu";
    }
  }
</script>
</body>
<script>
  var materia=document.getElementById("materia");
  var listaD=document.getElementById("lista_docentes");
  var listaG=document.getElementById("lista_grupos");
  var nombre="";
  @foreach ($ads as $ad)
  @if ($ad->user_rol_id == "")
    
  @else
    if('{{$ad->user_rol->usuario->CI}}'== localStorage.getItem('usuario')){
        materia.innerHTML+="<option>{{$ad->materia_carrera->materia->nombre_materia}}</option>"}
        nombre="{{$ad->user_rol->usuario->Nombre}} {{$ad->user_rol->usuario->Apellido}}"
  @endif
    
  @endforeach
  listaD.value=nombre
  //--------------------------------------Añadir docente-----------------------------------
  var añadirD=document.getElementById("añadirD");
  var añadirG=document.getElementById("añadirG");
  var asignacionD=document.getElementById("docentes")
  var asignacionG=document.getElementById("grupos")
  var docentes= document.createElement("select");
  docentes.className="form-select"
  añadirD.onclick=function(){
    var docentes= document.createElement("select");
  docentes.className="form-select"
 @foreach ($ads as $ad)
  @if ($ad->user_rol_id == "")
    
  @else
    if('{{$ad->materia_carrera->materia->nombre_materia}}'== materia.options[materia.selectedIndex].text && !encontrardocente("{{$ad->user_rol->usuario->Nombre}} {{$ad->user_rol->usuario->Apellido}}") ){
        docentes.innerHTML+="<option>{{$ad->user_rol->usuario->Nombre}} {{$ad->user_rol->usuario->Apellido}}</option>"
      }
  @endif
  @endforeach
    Swal.fire({
  title: 'Elija un docente',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Agregar',
  html: docentes,
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    listaD.value+=","+ docentes.options[docentes.selectedIndex].text
    asignacionD.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><spam class='A_let'>"+docentes.options[docentes.selectedIndex].text+"</spam></div>"
  }
})
  }
  //-----------------------------funcion de encontrardocente-----------------------
  function encontrardocente(d){
    var listado=listaD.value.split(",")
    var encontrado=false;
    for(var i=0;i<listado.length;i++){
      if(d== listado[i]){
        encontrado=true;
      }
    }
    return encontrado;
  }
  //--------------------------------funcion encontrar grupo------------------------
  function encontrargrupo(d){
    var listado=listaG.value.split(",")
    var encontrado=false;
    for(var i=0;i<listado.length;i++){
      if(d== listado[i]){
        encontrado=true;
      }
    }
    return encontrado;
  }
  //--------------------------------funcion quitar docente---------------------------------
  var letras=document.getElementsByClassName("A_let")
  asignacionD.onclick=function(a){
    var f=a.target;
    for(var i=0; i<letras.length;i++){
      if(f==letras[i]){
            quitarDocente(letras[i].innerHTML)
            asignacionD.removeChild(letras[i].parentNode)
    }
  }
  }
  function quitarDocente(d){
    var listado=listaD.value.split(",")
    listaD.value=""
    for(var i=0;i<listado.length;i++){
      if(d!= listado[i]){
        if(listaD.value==""){
          listaD.value+= listado[i]
        }else{listaD.value+= ','+listado[i]}
      }
    }
  }
  //----------------------------funcion quitar grupo--------------------------
  asignacionG.onclick=function(a){
    var f=a.target;
    for(var i=0; i<letras.length;i++){
      if(f==letras[i]){
            quitarGrupo(letras[i].innerHTML)
            asignacionG.removeChild(letras[i].parentNode)
    }
  }
  }
  function quitarGrupo(d){
    var listado=listaG.value.split(",")
    listaG.value=""
    for(var i=0;i<listado.length;i++){
      if(d!= listado[i]){
        if(listaG.value==""){
          listaG.value+= listado[i]
        }else{listaG.value+= ','+listado[i]}
      }
    }
    if(listaG.value==""){
      añadirD.disabled=false;
    }
  }
  //----------------Añadir grupo-------------------------------
  añadirG.onclick=function(){
    var grupos= document.createElement("select");
    grupos.className="form-select"
    var listado=listaD.value.split(",")

    @foreach ($gs as $g)
    @if ($g->asignacionDocente->user_rol_id == "")
    
    @else
      for(var i=0;i<listado.length;i++){
        if('{{$g->asignacionDocente->user_rol->usuario->Nombre}} {{$g->asignacionDocente->user_rol->usuario->Apellido}}'== listado[i] && !encontrargrupo('{{$g->nombre}}')){
          grupos.innerHTML+="<option>{{$g->nombre}}</option>"
        }
      }
    @endif
    @endforeach
    Swal.fire({
  title: 'Elija un grupo',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Agregar',
  html: grupos,
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    if(listaG.value==""){
      listaG.value+=grupos.options[grupos.selectedIndex].text
      añadirD.disabled=true;
    }else{listaG.value+=","+ grupos.options[grupos.selectedIndex].text}
    asignacionG.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><spam class='A_let'>"+grupos.options[grupos.selectedIndex].text+"</spam></div>"
  }
})
  }
  //-------------------------------------validaciones----------------------------------
var registrar =document.getElementById("botonRegistrar")
var errorg=document.getElementById("errorg");
var errorc=document.getElementById("errorc");
var errorm=document.getElementById("errorm");
var errorf=document.getElementById("errorf");
var valg=document.getElementById("lista_grupos");
var valc=document.getElementById("cantidad");
var valm=document.getElementById("motivo");
var valf=document.getElementById("fecha");
registrar.onclick=function(event){
  var alerta=0;
  errorg.innerHTML=""
  errorm.innerHTML=""
  errorc.innerHTML=""
  errorf.innerHTML=""
  if(valg.value==""){
    errorg.innerHTML="Debe añadir un grupo"
    alerta=1;
  }
  if(valm.value==""){
    errorm.innerHTML="Campo obligatorio"
    alerta=1
  }
  if(valc.value.match('^[0-9]+$')==null){
    errorc.innerHTML="Solo se aceptan números"
    alerta=1;
  }
  if(valc.value== "0"){
    errorc.innerHTML="La cantidad debe ser mayor a 0"
    alerta=1;
  }
  if(valc.value==""){
    errorc.innerHTML="Campo obligatorio"
    alerta=1
  }
  var fecha=new Date(valf.value);
  if(fecha.getDay()==6){
    errorf.innerHTML="La fecha no puede ser domingo"
    alerta=1;
  }
  if(valf.value==""){
    errorf.innerHTML="Fecha no valida"
    alerta=1
  }

  if(alerta==1){
    event.preventDefault();
  }
}
</script>
</html>