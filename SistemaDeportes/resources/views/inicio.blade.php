@extends('layouts.home')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item active" aria-current="page">Inicio</li>
    </ol>
    </nav>
    <div class="row justify-content-center">
        @if(Auth::user()->roles->first()->nombre_rol== "Administrador" || Auth::user()->roles->first()->nombre_rol=="Operario")
            <div class="col-md-3">
                <a role="button" href="albergue/menu_albergue" style="padding:0px;">
                        <div class="card border-info mb-2 mr-2" style="width:100%; ">
                            <div class="card-header bg-info text-white">Albergue</div>
                            <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                                <a href="albergue/menu_albergue" class="text-info">
                                    <i class="fas fa-hotel"></i>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif

        @if(Auth::user()->roles->first()->nombre_rol== "Administrador" || Auth::user()->roles->first()->nombre_rol=="Operario" || Auth::user()->roles->first()->nombre_rol== "Profesor")
            <div class="col-md-3">
                <a role="button" href="salamusculacion" style="padding:0px;">
                    <div class="card border-primary mb-2 mr-2"  style="width:100%;">
                    
                        <div class="card-header bg-primary text-white">Sala de Musculación</div>
                        <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                            <a href="salamusculacion" class="text-primary">
                                <i class="fas fa-dumbbell"></i>
                            </a>
                            
                        </div>
                        
                    </div>
                </a>
            </div>
        @endif

        @if(Auth::user()->roles->first()->nombre_rol== "Administrador")
            <div class="col-md-3">
                <a role="button" href="users" style="padding:0px;">
                        <div class="card border-danger mb-2 mr-2" style="width:100%; ">
                            <div class="card-header bg-danger text-white">Personal DEFyD</div>
                            <div class="card-body text-danger mx-auto" style="font-size: 6rem;">
                                <a href="users" class="text-danger">
                                    <i class="fa fa-user"></i>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif

        @if(Auth::user()->roles->first()->nombre_rol== "Administrador" || Auth::user()->roles->first()->nombre_rol=="Operario") 
            <div class="col-md-3">
                    <a role="button" href="notificaciones" style="padding:0px;">
                        <div class="card border-warning mb-2 mr-2" style="width:100%;">
                            <div class="card-header bg-warning text-white">Notificaciones</div>
                            <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                                <a href="notificaciones" class="text-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif
        
        @if(Auth::user()->roles->first()->nombre_rol== "Administrador")
            <div class="col-md-3">
                <a role="button" href="configuracion" style="padding:0px;">
                        <div class="card border-secondary mb-2 mr-2" style="width:100%; ">
                            <div class="card-header bg-secondary text-white">Configuración</div>
                            <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                                <a href="configuracion" class="text-secondary">
                                    <i class="fa fa-cog"></i>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif
            
    </div>
</div>

<!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <script src="https://kit.fontawesome.com/53e0ed4112.js" crossorigin="anonymous"></script>
@endsection
