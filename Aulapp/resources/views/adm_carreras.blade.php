@extends('administrador')

@section('Titulo')
<h3 text-center>Administracion de Carreras</h3>
@endsection
@section('Formulario')
     <script>
           
     
     console.log("{{Request::cookie('id')}}");    
     </script>

      @if(Request::cookie('editar')=='ok')
     
      <form id="formulario" method="post" action="{{route('carreras-update', ['id'=>Request::cookie('id')])}}" >
            @method('PATCH')
            @csrf
            
            <h3 text-center>Editar carrera</h3>
            <label for="inputNombre" class="form-label">Nombre</label>
            <input type="text" id="inputNombre" class="form-control" name="Nombre" value="{{Request::cookie('nombre')}}">
            @if ($errors->has('Nombre'))
            <span class="error text-danger" for="input-nombre">{{ $errors->first('Nombre') }}</span>
            @endif
            <br>
            <label for="inputCodigo" class="form-label">Código</label>
            <input type="text" id="inputCodigo" class="form-control" name="Codigo" value="{{Request::cookie('codigo')}}">
            @if ($errors->has('Codigo'))
            <span class="error text-danger" for="inputApellido">{{ $errors->first('Codigo') }}</span>
            @endif
           <input class="btn btn-lg btn-block" type="submit" value="Guardar">
           <a href="carrera5" class="btn btn-lg btn-danger">Cancelar</a>
            <br>
      </form>
      @else
      <form id="formulario" method="post" action="{{route('carreras')}}" >
            @csrf
            <h3 text-center>Registrar carrera</h3>
            <label for="inputNombre" class="form-label">Nombre</label>
            <input type="text" id="inputNombre" class="form-control" name="Nombre" value="{{old('Nombre')}}">
            @if ($errors->has('Nombre'))
            <span class="error text-danger" for="input-nombre">{{ $errors->first('Nombre') }}</span>
            @endif
            <br>
            <label for="inputCodigo" class="form-label">Código</label>
            <input type="text" id="inputCodigo" class="form-control" name="Codigo" value="{{old('Codigo')}}">
            @if ($errors->has('Codigo'))
            <span class="error text-danger" for="inputApellido">{{ $errors->first('Codigo') }}</span>
            @endif
           <input class="btn btn-lg btn-block" type="submit" value="Registrar">
            <br>
      </form>
      @endif
@endsection
@section('Tabla')
<div id="C_tabla">
      <h3 id="T_tabla">Lista de carreras</h3>
      <table class="table">
      
            <thead>
                  
                  <tr>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                  </tr>
            </thead>
            <tbody>
                  @foreach ($carreras as $carrera)
                   <tr>
                         <td>{{$carrera->Nombre}}</td>
                         <td>{{$carrera->Codigo}}</td>
                         
                         <td>
                               <div><a href="{{route('carreras-show',['id'=>$carrera->id])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                           <path
                                           d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                          <path fill-rule="evenodd"
                                          d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                          </svg>
                               </a>
                               </div>
                             
                         </td>
                         <td>
                              <form action="{{route('carreras-destroy',[$carrera->id])}}" method="POST" class="Elimina">
                                    @method('DELETE')
                                    @csrf
                                    <button class=Modelo>
                                          <!--copiado de estilo xd-->
                                          <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                  class="bi bi-trash" viewBox="0 0 16 16">
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
            title: '¿Estás seguro que quieres eliminar la carrera?',
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
  title: 'Carrera eliminado',
  showConfirmButton: false,
  timer: 1500
  })
</script>

@endif

@endsection
