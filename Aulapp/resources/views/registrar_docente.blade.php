@extends('registrar')
@section('title', 'Docente')
@section('Titulo')
<h3 text-center  id="Titulo"> Administracion de docentes</h3>
@endsection
@section('action')
action="{{route('materias')}}"
@endsection
@section('TituloForm','Registrar docente')
@section('NombreCampo','Nombre')
@section('Name')
name="nombre"
@endsection
@section('NombreCampo2','Apellido')
@section('Name2')
name="apellido"
@endsection
@section('campos')
    <label for="input3" class="form-label">Cédula de identidad</label>
    <input type="text" id="input3" class="form-control" name='ci' value=""   autofocus>
    <span class=" error text-danger" for="input3"></span>
    <br>
    
    <label for="input4" class="form-label">Email</label>
    <input type="text" id="input4" class="form-control" name='email' value=""  autofocus>
    <span class=" error text-danger" for="input4"></span>
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
        
        
      </div>
          
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
                        todosM.push(['{{$m_c->carrera_id}}','{{$m_c->materia_id}}','{{$m_c->id}}']);
                    @endforeach
                    for(var i=0;i<todosC.length;i++){
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