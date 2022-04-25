@extends('registrar')
@section('title', 'Docente')
@section('Titulo')
<h3 text-center  id="Titulo"> Administracion de docentes</h3>
@endsection
@section('action')
action="{{route('docentes')}}"
@endsection
@section('TituloForm','Registrar docente')
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
@section('NombreCampo2','Apellido')
@section('Name2')
name="apellido"
@endsection

@section('value2')
value="{{old('apellido')}}"
@endsection
@section('error2')
@if ($errors->has('apellido'))
      <span class="error text-danger" for="input2"> {{ $errors->first('apellido') }}</span>
      @endif
      <br>
@endsection
@section('campos')
    <label for="input3" class="form-label">Cédula de identidad</label>
    <input type="text" id="input3" class="form-control" name='ci' value="{{old('ci')}}"   autofocus>
    @if ($errors->has('ci'))
          <span class="error text-danger" for="input3"> {{ $errors->first('ci') }}</span>
          @endif
          <br>
    
    <label for="input4" class="form-label">Email</label>
    <input type="text" id="input4" class="form-control" name='email' value="{{old('email')}}"  autofocus>
    @if ($errors->has('email'))
          <span class="error text-danger" for="input4"> {{ $errors->first('email') }}</span>
          @endif
          <br>

    <span >Materias en las que dicta clases:</span>
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
                        console.log(aux.options[aux.selectedIndex].text);
                        console.log(todosCM[contM][0]);
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
                        nuevos=document.getElementById('nuevo');
                        nuevo.value+="+"+materias.options[materias.selectedIndex].id
                        nuevostxt=document.getElementById('nuevotxt');
                        nuevotxt.value+="+"+aux.options[aux.selectedIndex].text+"-"+materias.options[materias.selectedIndex].text
                       
                        
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