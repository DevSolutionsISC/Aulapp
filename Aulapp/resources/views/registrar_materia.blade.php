@extends('registrar')
@section('title', 'Materia')
@section('Titulo')
<h3 text-center  id="Titulo"> Administración de materias</h3>
@endsection
@section('action')
action="{{route('materias')}}"
@endsection
@section('TituloForm','Registrar materia')
@section('NombreCampo','Nombre')
@section('Name')
name="nombre"
@endsection
@section('value')
value="{{old('nombre')}}"
@endsection
@section('error1')
@if ($errors->has('nombre'))
      <span class="error text-danger" for="input1">{{ $errors->first('nombre') }}</span>
      @endif
      <br>
@endsection
@section('NombreCampo2','Codigo')
@section('Name2')
name="codigo"
@endsection

@section('value2')
value="{{old('codigo')}}"
@endsection
@section('error2')
@if ($errors->has('codigo'))
      <span class="error text-danger" for="input1"> {{ $errors->first('codigo') }}</span>
      @endif
      <br>
@endsection
@section('campos')
<span >Carreras a las que pertenece:</span>
<br>
@if ($errors->has('Nuevo'))
      <span class="error text-danger" for="input1"> {{ $errors->first('Nuevo') }}</span>
      @endif
      <br>
<div class="d-grid gap-2">
      <div id="Asignaciones"></div>
      <span id="agregar">Nueva asignacion</span>
      
      <input type="text" id="nuevo" class="oculto" value="{{old('Nuevo')}}" name="Nuevo">
      <input type="text" id="nuevotxt" class="oculto" value="{{old('Nuevotxt')}}" name="Nuevotxt">
    
  </div>
      <script>
          var recuperar=document.getElementById("nuevo");
          recuperar=recuperar.value.split("+");
          if(recuperar.length>0){
              var recuperartxt=document.getElementById("nuevotxt");
              recuperartxt=recuperartxt.value.split("+");
            for(var i=1;i<recuperar.length;i++){
                var asignaciones= document.getElementById("Asignaciones");
               asignaciones.innerHTML+="<div class='A_cont'><span class='material-symbols-outlined A_icon'>close</span><span class='A_let' id="+recuperar[i]+">"+recuperartxt[i] +"</span></div>";
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
                    nuevos=document.getElementById('nuevo');
                    nuevo.value+="+"+aux.options[aux.selectedIndex].id
                    nuevostxt=document.getElementById('nuevotxt');
                    nuevotxt.value+="+"+aux.options[aux.selectedIndex].text
                    
                }
                })
            }
        </script>
       
        
        <script>
            var letras=document.getElementsByClassName("A_let")
            var asignaciones= document.getElementById("Asignaciones");
            document.onclick=function(a){
                var f=a.target;
                for(var i=0;i<letras.length;i++){
             if(f==letras[i]){
                 
                    asignaciones.removeChild(letras[i].parentNode)
                    nuevos=document.getElementById('nuevo');
                        separado=nuevos.value.split("+");
                        var aux="";
                        for(var i=1;i<separado.length;i++){
                              if(separado[i]!=f.id){
                                    aux=aux+"+"+separado[i]
                                   
                                   
                              }
                        }
                        nuevos.value=aux
                    
                 
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