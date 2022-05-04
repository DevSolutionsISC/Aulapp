@extends('header')
@section("notificacion","bandeja_administrador")
@section('Titulo')
    <h3>Menu del Administrador</h3>
@endsection
@section('Contenido')
    </div>
    <div id="funcionalidades">
        <div>
            <a href="reporte_user_rol" class="funcion btn"><span class="letras">Administracion de docentes</span> 
                <span class="material-symbols-outlined icon" >
                    person
                    </span>
            </a>
        </div>
        <div>
            <a href="reporte_materia" class="funcion btn"><span class="letras">Administracion de materias</span>
                <span class="material-symbols-outlined icon" >
                    menu_book
                    </span>
            </a> 
        </div>
        <div>
            <a href="reporte_grupo"class="funcion btn"><span class="letras">Administrador de grupos</span>
                <span class="material-symbols-outlined icon">
                    group
                    </span>
            </a>
        </div>
        <div>
            <a href="reporte_carrera"class="funcion btn"><span class="letras">Administrador de carreras</span>
                <span class="material-symbols-outlined icon">
                    book
                    </span>
            </a> 
        </div>
        <div>
            <a href="reporte_aula"class="funcion btn"><span class="letras">Administrador de aulas</span>
                <span class="material-symbols-outlined icon">
                    home_pin
                    </span>
                    
            </a>
        </div>
        <div>
            <a href="reporte_section"class="funcion btn"><span class="letras">Administrador de secciones</span>
                <span class="material-symbols-outlined icon">
                    map
                    </span>
            </a>
        </div> 
        <div>
            <a href="reporte_carrera_materia"class="funcion btn"><span class="letras">Administrador de materia-carrera</span>
                <span class="material-symbols-outlined icon">
                    auto_stories
                    </span> 
            </a>
        </div> 
        <div>
            <a href="reporte_asignacion_docente"class="funcion btn"><span class="letras">Administrador de materia-docente</span>
                <span class="material-symbols-outlined icon">
                    gbadge
                    </span>
            </a>
        </div> 

    </div>
    <div class="card mb-3" style="max-width: 540px;" id="presentacion">
        <div class="row g-0">
          <div class="col-md-6">
            <img src="{{asset('Imagenes/admi.svg')}}" class="img-fluid rounded-start" alt="..." id="admi">
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