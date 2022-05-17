@extends('plantilla_planillas')
@section('Titulo','Registro de planillas docente-materia')
@section("registrar","grupos")
@section("reporte","reporte_asignacion_docente")
@section("eliminar","eliminar-grupo")
@section("action")
action={{route('materia_docente')}}
@endsection
@section('Titulo form')
<h3>Registro de asignacion de docente a materia</h3>
@endsection
@section('Contenido formulario')
<label class="form-label">Docente</label>
    <select name="docente" id="docente" class="form-select">
        <option>Seleccione un docente</option>
        @foreach($docentes as $docente)          
        <option value="{{$docente->id}}">{{$docente->usuario->Nombre}} {{$docente->usuario->Apellido}}</option>
        @endforeach
    </select>
    @if ($errors->has("docente"))
        <span class="error text-danger" for="input1">{{ $errors->first("docente") }}</span>
        @endif
        <br>
        <label class="form-label">Materia</label>
        <select name="materia" id="materia" class="form-select">
            <option selected>Seleccione una materia</option>
           
        </select>
        @if ($errors->has("materia"))
            <span class="error text-danger" for="input1">{{ $errors->first("materia") }}</span>
            @endif
        <script>
        

                var docente=document.getElementById("docente");
                docente.addEventListener('change', (event) => {
                    var materias=document.getElementById("materia");
                    materia.innerHTML="";
                    materia.innerHTML+="<option>Seleccione una materia</option>"
                    
                   @foreach($materias as $materia)
                   var bandera=0;
                      @foreach($docente_materias as $docente_materia)
           
                        if('{{$materia->id}}'=='{{$docente_materia->materia_carreras_id}}' && '{{$docente_materia->user_rol_id}}'==docente.options[docente.selectedIndex].value){
                            bandera=1;
                     
                        }
                      @endforeach
                      if(bandera==0){
                        materias.innerHTML+="<option value='{{$materia->id}}'>{{ $materia->materia->nombre_materia }} - {{$materia->carrera->Nombre}}</option>"
                        
                      }
                   @endforeach
                })
            </script>
@endsection
        