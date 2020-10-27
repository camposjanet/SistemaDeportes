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
                <a role="button" href="usuarios" style="padding:0px;">
                    <div class="card border-primary mb-2 mr-2"  style="width:100%;">
                    
                        <div class="card-header bg-primary text-white">Usuarios</div>
                        <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                            <a href="usuarios" class="text-primary">
                                <i class="fa fa-users"></i>
                            </a>
                            
                        </div>
                        
                    </div>
                </a>
            </div>
        @endif

        @if(Auth::user()->roles->first()->nombre_rol== "Administrador" || Auth::user()->roles->first()->nombre_rol=="Profesor")
            <div class="col-md-3">
                <a role="button" href="#" style="padding:0px;">
                        <div class="card border-info mb-2 mr-2" style="width:100%; ">
                            <div class="card-header bg-info text-white">Control de Asistencia</div>
                            <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                                <a href="#" class="text-info">
                                    <i class="fa fa-calendar"></i>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif

        @if(Auth::user()->roles->first()->nombre_rol== "Administrador" || Auth::user()->roles->first()->nombre_rol=="Operario") 
            <div class="col-md-3">
                    <a role="button" href="#" style="padding:0px;">
                        <div class="card border-success mb-2 mr-2" style="width:100%;">
                            <div class="card-header bg-success text-white">Pagos</div>
                            <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                                <a href="#" class="text-success">
                                    <i class="fa fa-usd"></i>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif

        @if(Auth::user()->roles->first()->nombre_rol== "Administrador")
            <div class="col-md-3">
                <a role="button" href="users" style="padding:0px;">
                        <div class="card border-secondary mb-2 mr-2" style="width:100%; ">
                            <div class="card-header bg-secondary text-white">Personal DEFyD</div>
                            <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                                <a href="users" class="text-secondary">
                                    <i class="fa fa-user"></i>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif
            
    </div>
</div>
@endsection
