@extends('layouts.home')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item active" aria-current="page">Inicio</li>
    </ol>
    </nav>
    <!-- <div class="row justify-content-center">
        <h1>SISTEMA DEPORTES</h1>
    </div>
    <div class="row justify-content-center m-2">
        <h2 class="text-dark font-weight-bold">SECRETARIA DE EDUCACIÓN FÍSICA y DEPORTES</h2>
    </div> -->
    
    <div class="row justify-content-center">
        <div class="col-md-3">
            <a role="button" href="socios" style="padding:0px;">
                <div class="card border-primary mb-2 mr-2"  style="width:100%;">
                
                    <div class="card-header bg-primary text-white">Socios</div>
                    <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                        <a href="socios" class="text-primary">
                            <i class="fa fa-users"></i>
                        </a>
                        
                    </div>
                    
                </div>
            </a>

        </div>
        <div class="col-md-3">
            <a role="button" href="#" style="padding:0px;">
                    <div class="card border-info mb-2 mr-2" style="width:100%; ">
                        <div class="card-header bg-info text-white">Control de asistencia</div>
                        <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                            <a href="#" class="text-info">
                                <i class="fa fa-calendar"></i>
                            </a>
                        </div>
                    </div>
                </a>
        </div>
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
        <div class="col-md-3">
            <a role="button" href="#" style="padding:0px;">
                    <div class="card border-secondary mb-2 mr-2" style="width:100%; ">
                        <div class="card-header bg-secondary text-white">Usuarios</div>
                        <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                            <a href="#" class="text-secondary">
                                <i class="fa fa-user"></i>
                            </a>
                        </div>
                    </div>
                </a>
        </div>
    </div>
</div>
@endsection