@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-4">
    <div class="col-md-12" >
            @if (($usuario->foto)!="")
                <div class="media">
                    <div class="media-body" align="center">
                        <br>
                        <h1 class="media-heading"> FICHAS DEL USUARIO</h1>
                    </div>
                    <div class="media-right">
                        <img class="media-object" src="{{asset('img/usuarios/'.$usuario->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px">
                    </div>
                </div>
                <br>
            @else
                <div class="media-body" align="center">
                    <br>
                    <h1 class="media-heading">FICHAS DEL USUARIO</h1>                
                </div>
            @endif
        </div>
        <div class="col-md-5" >
            <h5 name="nombre_usuario"><b>Usuario:</b> {{$usuario->apellido}}, {{$usuario->nombre}} </h5>    
        </div>
        <div class="col-md-3" >
            <h5 name="dni_usuario"><b>DNI:</b> {{$usuario->dni}}</b></h3>
        </div>
        <div class="col-md-4" >
            <h5 name="fecha_nacimiento_usuario"><b>Fecha de Nacimiento:</b> <?php $fv = new DateTime($usuario->fecha_de_nacimiento); echo $fv->format('d-m-Y');?></h5>
        </div>     
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div align="left">
                <a class="btn btn-info" href="{{ URL::previous() }}" name="regresar"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Regresar</a>
                <a href="{{URL::action('FichaController@create',$usuario->id)}}"><button class="btn  btn-primary"><i class="fa fa-file"></i> Agregar</button></a>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-fichas" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th>Nº</th>
                        <th>Fecha</th>
                        <th>Categoría</th>
                        <th>Documentación</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($fichas as $ficha)
                        <tr>
                            <td>{{ $ficha->id }}</td>
                            <td><?php $f = new DateTime($ficha->fecha); echo $f->format('d-m-Y');?></td>
                            <td>{{ $ficha-> categoria }}</td>
                            <td>{{ $ficha -> documentacion }}</td>
                            <td>{{ $ficha -> estado }}</td>
                            <td>
                                <button name="modificar" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                @if($ficha->documentacion=='COMPLETA')
                                    <a href="#"><button name="carnet" type="submit" class="btn btn-success"><i class="fa fa-credit-card text-dark"></i></button></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
   
</div>
@endsection

