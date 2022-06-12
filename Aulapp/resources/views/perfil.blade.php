@extends('header')
@section('Contenido')
<form action=""id="">
    <div class="container bootstrap snippets bootdey">
        <div class="col-md-8">
            <div class="panel panel-white profile-widget panel-shadow">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="details">
                            <div class="card mb-3" style="max-width: 540px;" id="presentacion">
                                <div class="row g-0">
                                    @if ($usuario->id == 1)
                                        <div class="col-md-6">
                                        <img src="{{asset('Imagenes/admi.svg')}}" class="img-fluid rounded-start" alt="..." id="doc">
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                        <img src="{{asset('Imagenes/docente.svg')}}" class="img-fluid rounded-start" alt="..." id="doc">
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="card-body">
                                                <h4>{{$usuario->Nombre}} {{$usuario->Apellido}}<i class="fa fa-sheild"></i></h4>
                                                <p class="card-text">Email: {{$usuario->Email}}</p>
                                                <p class="card-text">C.I: {{$usuario->CI}}</p>
                                                <div class="mg-top-10">
                                                <a  class="btn btn-info"  href="{{ url("/CambiarContraseña/{$usuario->id}") }}">Cambiar contraseña</a>
                                                </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</form>                                
@endsection

