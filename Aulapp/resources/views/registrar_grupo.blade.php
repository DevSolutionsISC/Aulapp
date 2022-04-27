@extends('plantilla')

@section('Contenido formulario')

<div class="row" >

  <div class="d-flex" id="formularioEditar">
    <form id="formulario" method="post" action='{{route('grupos')}}')>

      <h3 text-center>Registrar grupos</h3>
      @csrf
      <label for="input1" class="form-label">Nombre</label>
      <input type="text" id="input1" class="form-control" name="nombre" value="{{old("nombre")}}" autofocus>
      @if ($errors->has("nombre"))
      <span class="error text-danger" for="input1">{{ $errors->first("nombre") }}</span>
      @endif
      <br>
      <label for="input2" class="form-label">Carrera</label>
      <select name="carrera" id="carrera" class="form-select">
        <option >Seleccione una carrera</option>
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
        <option >Seleccione una materia</option>
      </select>
      @if ($errors->has("materia"))
        <span class="error text-danger" for="input1">{{ $errors->first("materia") }}</span>
        @endif
<br>
      <script>
        var carrera=document.getElementById("carrera");   
        var todosCM=[]
        
        @foreach ($materia_carrera as $m_c )
            todosCM.push(['{{$m_c->nom_carrera}}','{{$m_c->nom_materia}}','{{$m_c->id}}']);
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
        <select name="docente" id="docente" class="form-select">
            <option >Seleccione un docente</option>

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
                docentes.innerHTML="<option >Seleccione un docente</option>";
                @foreach ($docentes as $docente)
                    @foreach ($ads as $ad)
                        @foreach ($urs as $ur)
                            if('{{$ad->materia_carreras_id}}'==materia.options[materia.selectedIndex].id && '{{$ad->user_rol_id}}'=='{{$ur->id}}' && '{{$ur->usuario_id}}'=='{{$docente->id}}' ){
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


@endsection