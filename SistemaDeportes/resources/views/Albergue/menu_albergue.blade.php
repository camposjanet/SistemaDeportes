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
                <a role="button" href="{{url('albergues')}}" style="padding:0px;">
                    <div class="card border-primary mb-2 mr-2"  style="width:100%;">
                    
                        <div class="card-header bg-primary text-white">Albergue</div>
                        <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                            <a href="{{url('albergues')}}" class="text-primary">
                                <i class="fas fa-bed"></i>

                            </a>
                            
                        </div>
                        
                    </div>
                </a>
            </div>
        @endif

        @if(Auth::user()->roles->first()->nombre_rol== "Administrador" || Auth::user()->roles->first()->nombre_rol=="Operario") 
            <div class="col-md-3">
                    <a role="button" href="{{url('bienespatrimoniales')}}" style="padding:0px;">
                        <div class="card border-success mb-2 mr-2" style="width:100%;">
                            <div class="card-header bg-success text-white">Bienes Patrimoniales</div>
                            <div class="card-body text-secondary mx-auto" style="font-size: 6rem;">
                                <a href="{{url('bienespatrimoniales')}}" class="text-success">
                                    <i class="fas fa-couch"></i>
                                </a>
                            </div>
                        </div>
                    </a>
            </div>
        @endif                      
    </div>
</div>
@endsection
