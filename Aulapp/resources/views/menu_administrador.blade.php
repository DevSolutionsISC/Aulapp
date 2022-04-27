@extends('header')
@section('Titulo')
    <h3>Menu del Administrador</h3>
@endsection
@section('Contenido')
    </div>
    <div id="funcionalidades">
        <div>
            <a href="#" class="funcion btn"><span class="letras">Administracion de docentes</span> 
                <span class="material-symbols-outlined icon" >
                    person
                    </span>
            </a>
        </div>
        <div>
            <a href="materia" class="funcion btn"><span class="letras">Administracion de materias</span>
                <span class="material-symbols-outlined icon" >
                    menu_book
                    </span>
            </a> 
        </div>
        <div>
            <a href="#"class="funcion btn"><span class="letras">Administrador de grupos</span>
                <span class="material-symbols-outlined icon">
                    group
                    </span>
            </a>
        </div>
        <div>
            <a href="carrera"class="funcion btn"><span class="letras">Administrador de carreras</span>
                <span class="material-symbols-outlined icon">
                    home_pin
                    </span>
            </a> 
        </div>
        <div>
            <a href="aulas"class="funcion btn"><span class="letras">Administrador de aulas</span>
                <span class="material-symbols-outlined icon">
                    book
                    </span>
                    
            </a>
        </div>
        <div>
            <a href="section"class="funcion btn"><span class="letras">Administrador de secciones</span>
                <span class="material-symbols-outlined icon">
                    map
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
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>
@endsection
</body>
</html>