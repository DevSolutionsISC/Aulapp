@extends('plantilla')
@section("editar","grupoEdit")
@section("registrar","grupos")
@section("reporte","reporte_grupo")
@section("eliminar","eliminar-grupo")
@section('Contenido formulario')
@section("Titulo")
<H3>
  Administración de grupos
</H3>
@endsection
<div class="row" >

  <div class="d-flex" id="formularioEditar">
    <form id="formulario" method="post" action='{{route('grupos')}}' class="Grupo">

      <h3 text-center>Registrar grupos</h3>
      @csrf
      <label for="input1" class="form-label">Nombre</label>
      <br>
      <div class="row">
        <div class="col-2">
          <label>G :</label>
        </div>
        <div class="col">
          <input type="text" id="input1" class="form-control" name="nombre" value="{{old('nombre')}}" autofocus>
        </div>
      </div>
      
     
      @if ($errors->has("nombre"))
      <span class="error text-danger" for="input1">{{ $errors->first("nombre") }}</span>
      @endif
     
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
        @foreach ($materias as $materia)
        <option value="{{$materia->id}}">{{$materia->Cod_materia}} - {{$materia->nombre_materia}}</option>
        @endforeach
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
                        
                          materias.innerHTML+="<option value="+todosCM[contM][2]+">"+todosCM[contM][1]+"</option>"
                      }
                   }
                   if(carrera.options[carrera.selectedIndex].text=="Seleccione una carrera"){
                    
                     @foreach ($materias as $materia)
                     materias.innerHTML+="<option value={{$materia->id}}>{{$materia->Cod_materia}} - {{$materia->nombre_materia}} </option>"
                    @endforeach
                   }
                  });
    </script>
    <div>
      
        <button style = "width:150px" class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Registrar</button>
        
      </div>

    </form>

  </div>
  
@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  var carrera=document.getElementById("carrera");
  var materia=document.getElementById("materia");
  if(carrera.options[carrera.selectedIndex].text=="Seleccione una carrera" && materia.options[materia.selectedIndex].text!="Seleccione una materia"){
    $('.Grupo').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: 'No seleccionó ninguna carrera, por lo tanto el grupo será creado para la materia en todas las carreras que esten utilizando dicha materia ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
                  if (result.isConfirmed) {
                  this.submit();
            }
            })
      });
  }
</script>

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
@endsection