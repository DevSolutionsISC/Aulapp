@extends('plantilla')
@section("editar","grupoEdit")
@section("registrar","grupos")
@section("reporte","reporte_grupo")
@section("eliminar","eliminar-grupo")
@section('Contenido formulario')

<div class="row" >

  <div class="d-flex" id="formularioEditar">
    <form id="formulario" method="post" action='{{route('grupos')}}')>

      <h3 text-center>Registrar grupos</h3>
      @csrf
      <label for="input1" class="form-label">Nombre</label>
      <br>
      <div class="row">
        <div class="col-2">
          <label>G :</label>
        </div>
        <div class="col">
          <input type="text" id="input1" class="form-control" name="nombre" value="{{old("nombre")}}" autofocus>
        </div>
      </div>
      
     
      @if ($errors->has("nombre"))
      <span class="error text-danger" for="input1">{{ $errors->first("nombre") }}</span>
      @endif
      <span id="extra"></span>
      <br>
      <label for="input2" class="form-label">Carrera</label>
      <select name="carrera" id="carrera" class="form-select">
        <option selected>Seleccione una carrera</option>
        @foreach ($carreras as $carrera)
            <option>{{$carrera->Nombre}}</option>
        @endforeach
      </select>
      @if ($errors->has("carrera"))
        <span class="error text-danger" for="input1">{{ $errors->first("carrera") }}</span>
        @endif
      <br>
      <label for="input2" class="form-label">Materia</label>
      <select name="materia" id="materia" class="form-select">
        <option selected>Seleccione una materia</option>
      </select>
      @if ($errors->has("materia"))
        <span class="error text-danger" for="input1">{{ $errors->first("materia") }}</span>
        @endif
<br>
      <script>
        var carrera=document.getElementById("carrera");   
        var todosCM=[]
        
        @foreach ($materia_carrera as $m_c )
            todosCM.push(['{{$m_c->carrera->Nombre}}','{{$m_c->materia->nombre_materia}}','{{$m_c->id}}']);
        @endforeach
        
        carrera.addEventListener('change', (event) => {
                    
                   
                    var materias=document.getElementById("materia");
                    materias.innerHTML="";
                    materias.innerHTML="<option >Seleccione una materia</option>";
                   for(var contM=0;contM<todosCM.length;contM++){
                     
                      if( carrera.options[carrera.selectedIndex].text==todosCM[contM][0]){
                          materias.innerHTML+="<option id="+todosCM[contM][2]+">"+todosCM[contM][1]+"</option>"
                      }
                   }
                  });
    </script>
      <label for="input2" class="form-label">Docente</label>
        <select name="docente" id="docente" class="form-select" >
            <option selected>Seleccione un docente</option>
            

        </select>
        @if ($errors->has("docente"))
        <span class="error text-danger" for="input1">{{ $errors->first("docente") }}</span>
        @endif
        <script>
            var todosCMD=[];          
            var materia=document.getElementById("materia");
            

           
            materia.addEventListener('change', (event) => {
                var docentes=document.getElementById("docente");
                docentes.innerHTML="";
    
                var bandera=0;
                @foreach ($docentes as $docente)
                    @foreach ($ads as $ad)
                        @foreach ($urs as $ur)
                              if('{{$ad->materia_carreras_id}}'==materia.options[materia.selectedIndex].id && '{{$ad->user_rol_id}}'=="" && bandera==0){
                                docentes.innerHTML+="<option value='{{$ad->id}}'>POR DESIGNAR</option>"
                                bandera=1;
                              }
                            if('{{$ad->materia_carreras_id}}'==materia.options[materia.selectedIndex].id && '{{$ad->user_rol_id}}'=='{{$ur->id}}'  && '{{$ur->usuario_id}}'=='{{$docente->id}}' ){
                              
                              docentes.innerHTML+="<option value='{{$ad->id}}'>{{$docente->Nombre}} {{$docente->Apellido}}</option>"
                              
                            }
                        @endforeach
                    @endforeach
                @endforeach
            });

        </script>
      <div>
      
        <button style = "width:150px" class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Registrar</button>
        
      </div>

    </form>

  </div>
  
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('registrar')=='ok')

<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Registro exitoso',
  showConfirmButton: false,
  timer: 1500
  })

</script>
@endif
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
@if (session('eliminar')=='ok')
<script>
  Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Carrera eliminado',
  showConfirmButton: false,
  timer: 1500
  })
</script>

@endif
<script>
  var registrar=document.getElementById("botonRegistrar")
  registrar.onclick=function(event){
    var docentes=document.getElementById("docente");
    var materia=document.getElementById("materia");
    var carrera=document.getElementById("carrera"); 
    var text=document.getElementById("input1"); 
    if(carrera.options[carrera.selectedIndex].text !="Seleccione una carrera" && materia.options[materia.selectedIndex].text!="Seleccione una materia" && docentes.options[docentes.selectedIndex].text != "Seleccione un docente"){
      var alerta=0;
      @foreach ($grupos as $grupo)
        @foreach ($materias as $materia)
          if('{{$grupo->nombre}}' == 'G:'+text.value && '{{$grupo->asignacionDocente->materia_carrera->materia->nombre_materia}}'== materia.options[materia.selectedIndex].text){
            alerta=1
            
          }
        @endforeach
      @endforeach
          if(alerta==1){
            var extra=document.getElementById("extra")
            extra.innerHTML="Ya existe grupo con esas caracteristicas"
            extra.style.color="red"
        event.preventDefault();
          }
        
    }

  }
</script>
@endsection