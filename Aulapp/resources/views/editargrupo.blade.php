@extends('plantilla')
@section("editar","seccionEdit")
@section("registrar","seccion")
@section("reporte","section")
@section('title', 'Grupo')
@section('Titulo')
<h3 text-center id="Titulo">Administracion de Grupos</h3>
@endsection
@section('Contenido formulario')

<div class="row">
<div >
  <div class="d-flex" id="formularioEditar">
    <form method="GET" action="" id="formulario">
      
      @csrf
      <h3 text-center>Editar Grupo</h3>
      <label  class="form-label " id="titulo">Selecione docente, materia , carrera y nombre del grupo que desee editar</label>
      <label for="carreras">Carrera</label><br>
      <select name="Carrera" id="carreras" class="form-select"> <option value="0">Seleccione una carrera</option>
      </select>
      <br>
      <label for="materias">Materia</label><br>
      <select name="Materia" id="materias" class="form-select"><option value="0">Seleccione una materia</option></select>
      <br>
      <label for="docentes">Docente</label> <br>
      <select name="Docente" id="docentes" class="form-select" > <option value="0">Seleccione un docente</option>
      </select>
      <br>
      <label for="grupos">Grupo</label><br>
      <input type="text" id="inputGrupo" class="form-control " name="Grupo" value="{{old('Grupo')}}" autofocus>
      <label id="mensaje"></label>
      @if ($errors->has('Grupo'))
      <span class="error text-danger" for="inputCorreo">{{ $errors->first('Grupo') }}</span>
      <br>
      @endif<br>
      <button type="button" class="btn btn-dark btn-block btn-lg" data-toggle="button" aria-pressed="false" autocomplete="off" id="editar">
       Editar
      </button>
      <br>
      <input type="text" id="ac" class="form-control oculto" name="ac" value="{{old('ac')}}" autofocus>
      <div class="d-grid gap-2">
        <button class="btn btn-dark btn-block btn-lg ed" id="botonRegistrar" type="submit">Guardar</button>
        <a href="" class="btn btn-danger btn-block btn-lg ed" id="botonRegistrar"
          type="button">Cancelar</a>
      </div>
    </form>
  </div>

</div>
@if ($errors->has('Grupo'))
<script>
   var ed=document.getElementsByClassName("ed");
      for(var i=0;i<ed.length;i++){
        ed[i].style.display="block"
      }
  formulario.action=localStorage.getItem("ruta");

</script>
@endif
@if (session('actualizar')=='ok')
  <script>localStorage.setItem('ruta',"")</script>
@endif

@endsection
@section('js')
    <script>
        var carreras=document.getElementById("carreras");
        var docentes=document.getElementById("docentes");
                
            @foreach ($carreras as $carrera )
                    carreras.innerHTML+="<option id='{{$carrera->id}}'>{{$carrera->Nombre}}</option>"
            @endforeach
            carreras.addEventListener('change', (event) => {
                var materias=document.getElementById("materias");
                materias.innerHTML="<option value='0'>Seleccione una materia</option>";
                docentes.innerHTML="<option value='0'>Seleccione un docente</option>";
                @foreach ($materias as $materia )
                    @foreach ($mcs as $mc)
                        if('{{$mc->materia_id}}'== '{{$materia->id}}' && {{$mc->carrera_id}}== carreras.options[carreras.selectedIndex].id){
                            materias.innerHTML+="<option id='{{$mc->id}}'>{{$materia->nombre_materia}}</option>"
                        }
                    @endforeach
                @endforeach
            });
            var materias=document.getElementById("materias");
            materias.addEventListener('change', (event) => {
                var docentes=document.getElementById("docentes");
                docentes.innerHTML="<option value='0'>Seleccione un docente</option>";
                @foreach ($docentes as $docente)
                    @foreach ($ads as $ad)
                        @foreach ($urs as $ur)
                            if('{{$ad->materia_carreras_id}}'==materias.options[materias.selectedIndex].id && '{{$ad->user_rol_id}}'=='{{$ur->id}}' && '{{$ur->usuario_id}}'=='{{$docente->id}}' ){
                                docentes.innerHTML+="<option id='{{$ad->id}}'>{{$docente->Nombre}} {{$docente->Apellido}}</option>"
                            }
                        @endforeach
                    @endforeach
                @endforeach
            });

            var editar=document.getElementById("editar");
            editar.onclick=function(){
                var nombre=document.getElementById("inputGrupo");
                var encontrado=0;
                @foreach ($grupos as $grupo)
                    if(nombre.value== '{{$grupo->nombre}}' && docentes.options[docentes.selectedIndex].id){
                        encontrado=1;
                        formulario.action="{{route('grupo-update', ['id'=>$grupo->id])}}"
                        localStorage.setItem('ruta',formulario.action)
                        localStorage.setItem("id", {{$grupo->id}})
                        var ac=document.getElementById("ac");
                        ac.value=docentes.options[docentes.selectedIndex].id;
                        ed=document.getElementsByClassName("ed")
                        for(var i=0;i<ed.length;i++){
                        ed[i].style.display="block";
                         }
                         editar.style.display="none";
                         var titulo=document.getElementById("titulo")
                         titulo.innerHTML="Ahora puedes editar los campos"
                    }
                @endforeach
                if(encontrado==0){
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se encontro ningun grupo con esas especificaciones',
    })
                }
            }

            var enviar=document.getElementById("botonRegistrar")
  enviar.onclick=function(event){
    var encontrado=0;
    var grupo=document.getElementById("inputGrupo");
    var carreras=document.getElementById("carreras");
    var mensaje=document.getElementById("mensaje")
        @foreach ($grupos as $grupo)
            @foreach ($ads as $ad )
            if(grupo.value=='{{$grupo->nombre}}' &&  '{{$ad->materia_carreras}}' == carreras.options[carreras.selectedIndex].id && '{{$grupo->id}}'!= localStorage.getItem("id")){
                encontrado==1
            }
            @endforeach
        @endforeach
    if(encontrado== 1){
        console.log("Existe")
      event.preventDefault();
      mensaje.innerHTML="Ya existe otro grupo con estas asignaciones"
    }else{
      mensaje.innerHTML="";
      
    }
  }
    </script>
@endsection