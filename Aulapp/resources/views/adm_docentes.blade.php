@extends('administrador')
@section("Direccion")
action="{{route('docentes')}}"
@endsection
@section('Titulo')
<h3 text-center>Administracion de docentes</h3>
@endsection
@section('Titulo formulario')
<h3 text-center id="editarDocente">Registrar docente</h3>
@endsection
@section('Contenido formulario')
<label for="inputApellido" class="form-label">Apellido</label>
<input type="text" id="inputApellido" class="form-control" name="Apellido" value="{{old('Apellido')}}">
@if ($errors->has('Apellido'))
<span class="error text-danger" for="inputApellido">{{ $errors->first('Apellido') }}</span>
@endif
<br>
<label for="inputCI" class="form-label">CI</label>
<input type="text" id="inputCI" class="form-control" name="CI" value="{{old('CI')}}">
@if ($errors->has('CI'))
<span class="error text-danger" for="inputCI">{{ $errors->first('CI') }}</span>
@endif
<br>
<label for="inputEmail" class="form-label">Email</label>
<input type="email" id="inputEmail" class="form-control" name="Email" value="{{old('Email')}}">
@if ($errors->has('Email'))
<span class="error text-danger" for="inputEmail">{{ $errors->first('Email') }}</span>
@endif
<br>
@endsection
@section('Tabla')
<div id="C_tabla">
  <h3 id="T_tabla">Lista de docentes</h3>
  <table class="table">

    <thead>

      <tr>
        <th scope="col">Nombre completo</th>
        <th scope="col">Ci</th>
        <th scope="col">Correo</th>
        <th scope="col">Editar</th>
        <th scope="col">Eliminar</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($docentes as $docente)
      <tr>
        <td>{{$docente->Nombre . " ". $docente->Apellido}}</td>
        <td>{{$docente->CI}}</td>
        <td>{{$docente->Email}}</td>
        <td>
          <button id='{{$docente->id}}'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path
                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
              <path fill-rule="evenodd"
                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg>
          </button>
          <script>
            var btnEditar=document.getElementById("{{$docente->id}}");
                                    btnEditar.className="Modelo";
                                    btnEditar.onclick=function(){
                                    document.getElementById("editarDocente").innerHTML="Editar docente";
                                    var nombre=document.getElementById("inputNombre");
                                    nombre.value="{{$docente->Nombre}}";
                                    var codigo=document.getElementById("inputApellido");
                                    codigo.value="{{$docente->Apellido}}";
                                    var codigo=document.getElementById("inputCI");
                                    codigo.value="{{$docente->CI}}";
                                    var codigo=document.getElementById("inputEmail");
                                    codigo.value="{{$docente->Email}}";
                                    var formulario=document.getElementById("formulario");
                                    formulario.method="PATCH";
                                    formulario.action="{{route('docentes-update',['id'=> $docente->id])}}";
                                    var boton=document.getElementsByClassName("Boton");
                                    boton[0].value="Aceptar";
                                    boton[0].type="submit";
                                    var bandera=formulario.getElementsByTagName("a");
                                    if(bandera.length==0){
                                    var btnCancelar=document.createElement("a");
                                    btnCancelar.className="btn btn-danger";
                                    btnCancelar.innerHTML="Cancelar";
                                    btnCancelar.href="carrera";
                                    formulario.appendChild(btnCancelar);
                                    }
                                    }
                                    
          </script>
        </td>
        <td>
          <form action="{{route('docentes-destroy',[$docente->id])}}" method="POST" class="Elimina">
            @method('DELETE')
            @csrf
            <button class=Modelo>
              <!--copiado de estilo xd-->
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                  viewBox="0 0 16 16">
                  <path
                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd"
                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </div>

              <!--fin copia xd-->
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $('.Elimina').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: '¿Estás sguro que quieres eliminar al docente?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
            }).then((result) => {
                  if (result.isConfirmed) {
                  this.submit();
            }
            })
      });
</script>

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
  title: 'Docente eliminado',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@endsection