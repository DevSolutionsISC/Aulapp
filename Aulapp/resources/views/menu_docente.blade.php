@extends('header')
@section("notificacion","bandeja_docente")
@section('Titulo')
    <h3>Menu del Docente</h3>
@endsection
@section('Contenido')
    </div>
    <div id="funcionalidades_d">
        <div>
            <a href="reserva" class="funcion btn"><span class="letras">Realizar reserva</span> 
                <span class="material-symbols-outlined icon" >
                    person
                    </span>
            </a>
        </div>
        <div>
            <a href="aulas_asignadas" class="funcion btn"><span class="letras">Aulas asignadas</span>
                <span class="material-symbols-outlined icon" >
                    menu_book
                    </span>
            </a> 
        </div>
       
    </div>
    <div class="card mb-3" style="max-width: 540px;" id="presentacion">
        <div class="row g-0">
          <div class="col-md-6">
            <img src="{{asset('Imagenes/docente.svg')}}" class="img-fluid rounded-start" alt="..." id="doc">
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <h5 class="card-title">Administrador</h5>
              <p class="card-text">Con Aulapp ahora podrás administrar las solicitudes y asignaciones de reservas de aulas de la Facultad de Ciencias y Tecnologia de la Universidad Mayor de San Simón</p>
              <p class="card-text"><small class="text-muted">Aqui tienes las diferentes funciones que te ofrece Aulapp</small></p>
            </div>
          </div>
        </div>
      </div>
@endsection
</body>
</html>