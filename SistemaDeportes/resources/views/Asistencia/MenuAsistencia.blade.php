@extends('layouts.home')

@section('content')
<div class="container">
    <h1 align="center"> ASISTENCIAS DE SALA DE MUSCULACION </h1>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item active" aria-current="page"></li>
    </ol>
    </nav>
    <div class="row justify-content-center">
        @if(Auth::user()->roles->first()->nombre_rol== "Profesor") 
            <div class="col-md-3">
                    <a role="button" href="cabeceraplanilla" style="padding:0px;">
                        <div class="card border-success mb-2 mr-2" style="width:100%;">
                            <div class="card-header bg-success text-white">Registrar Planilla de Asistencia</div>
                            <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                                <a href="cabeceraplanilla" class="text-success">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                        <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif

        @if(Auth::user()->roles->first()->nombre_rol== "Administrador" || Auth::user()->roles->first()->nombre_rol=="Profesor")
            <div class="col-md-3">
                <a role="button" href="#" style="padding:0px;">
                        <div class="card border-danger mb-2 mr-2" style="width:100%; ">
                            <div class="card-header bg-danger text-white">Ver Planillas de Asistencia</div>
                            <div class="card-body text-danger mx-auto" style="font-size: 6rem;">
                                <a href="#" class="text-danger">
                                   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M1 2.828v9.923c.918-.35 2.107-.692 3.287-.81 1.094-.111 2.278-.039 3.213.492V2.687c-.654-.689-1.782-.886-3.112-.752-1.234.124-2.503.523-3.388.893zm7.5-.141v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.811V2.828c-.885-.37-2.154-.769-3.388-.893-1.33-.134-2.458.063-3.112.752zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                </svg>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif
            
    </div>
</div>
@endsection
