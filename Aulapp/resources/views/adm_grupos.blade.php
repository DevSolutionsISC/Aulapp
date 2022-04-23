@extends('plantilla')
@section('title', 'Seccion')
@section('Titulo')
<h3 text-center>Administracion de grupos</h3>
@endsection
@section('Contenido formulario')

<div class="row">
  <div class="col-xl-3 col-md-4 col-12">
    <form method="POST" action="{{route('grupos')}}" id="formulario">
      @csrf
      <h3 text-center>Registrar Grupo</h3>

      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" id="nombre" class="form-control" name="nombre" value="{{old('nombre')}}" autofocus>
      @if ($errors->has('nombre'))
      <span class="error text-danger" for="input-nombre">{{ $errors->first('nombre') }}</span>
      @endif

      <br>
      <label for="id_materia" class="form-label">Materia</label>
      <input type="text" id="id_materia" class="form-control" name="id_materia" value="{{old('id_materia')}}"
        autofocus>
      @if ($errors->has('id_materia'))
      <span class=" error text-danger" for="input-id_materia">{{ $errors->first('id_materia') }}</span>
      @endif


      <br>
      <label for="id_carrera" class="form-label">Carrera</label>
      <input type="text" id="id_carrera" class="form-control" name="id_carrera" value="{{old('id_carrera')}}"
        autofocus>
      @if ($errors->has('id_materia'))
      <span class=" error text-danger" for="input-id_carrera">{{ $errors->first('id_carrera') }}</span>
      @endif

      <br>
      <label for="id_docente" class="form-label">Docente</label>
      <input type="text" id="id_docente" class="form-control" name="id_docente" value="{{old('id_docente')}}"
        autofocus>
      @if ($errors->has('id_docente'))
      <span class=" error text-danger" for="input-id_docente">{{ $errors->first('id_docente') }}</span>
      @endif

    
      <br>
      <button class="btn btn-dark btn-block btn-lg" id="botonRegistrar" type="submit">Registrar</button>
    </form>
  </div>

  <div class="col-xl-9 col-md-8 col-12">
    <h3 id="listaGrupos">Lista de Grupos</h3>
    <table class="table table-striped">
      <thead>
        <tr id="filaGrupo">
          <th scope="col">Nombre</th>
          <th scope="col">Materia</th>
          <th scope="col">Carrera</th>
          <th scope="col">Dcoente</th>
          <th scope="col">Editar</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($grupos as $grupo)
        <tr>
          <td>{{$grupo->nombre}}</td>
          <td>{{$grupo->id_materia}}</td>
          <td>{{$grupo->id_carrera}}</td>
          <td>{{$grupo->id_docente}}</td>

          <td>
        
          </td>
          <td>
         
            </td>


         

  </div>

</div>
</td>


</tr>

@endforeach


</tbody>
</table>
</div>
</div>

@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('.Eliminar').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: '¿Estás seguro que quieres eliminar esta materia?',
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
  title: 'Materia eliminada',
  showConfirmButton: false,
  timer: 1500
  })
</script>
@endif
@endsection