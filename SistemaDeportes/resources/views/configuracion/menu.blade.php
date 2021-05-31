@extends('layouts.home')

@section('content')
<div class="container">
    <h1 align="center"> CONFIGURACIÓN </h1>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item active" aria-current="page">Configuración</li>
    </ol>
    </nav>
    <div class="row justify-content-center">
        

        @if(Auth::user()->roles->first()->nombre_rol== "Administrador")
            <div class="col-md-3">
                <a role="button" href="configuracion/importes" style="padding:0px;">
                        <div class="card border-warning mb-2 mr-2" style="width:100%;">
                            <div class="card-header bg-warning text-white">Gestión de Importes</div>
                            <div class="card-body text-warning mx-auto" style="font-size: 6rem;">
                                <a href="configuracion/importes" class="text-warning">
                                <i class="fa fa-folder"></i>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif
            
    </div>
</div>
@endsection
