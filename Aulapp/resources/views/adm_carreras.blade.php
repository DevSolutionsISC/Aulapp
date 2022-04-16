@extends('administrador')
@section('Direccion')
action="{{route('carreras')}}"
@endsection
@section('Titulo')
<h3 text-center>Administracion de Carreras</h3>
@endsection
@section('Titulo formulario')
<h3 text-center>Registrar carrera</h3>
@endsection
@section('Contenido formulario')
<label for="inputApellido" class="form-label">Código</label>
<input type="text" id="inputApellido" class="form-control" name="Codigo" value="{{old('Codigo')}}">


@if ($errors->has('Codigo'))
      <span class="error text-danger" for="inputApellido">{{ $errors->first('Codigo') }}</span>
      @endif
<br>

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
                              <form action="{{route('carreras-destroy',[$carrera->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class=Eliminar>
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
                         <td>Eliminar</td>
                   </tr>     
                  @endforeach
            </tbody>
      </table>
</div>

@endsection
