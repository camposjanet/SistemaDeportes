@extends('layouts.home')
@section('content')
<div class="container">
    {!!Form::model($ficha, ['route'=>['ficha.estudiante.update',$ficha->id],'method'=>'PATCH','autocomplete'=>'off'])!!}  
	{{Form::token()}}
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-md-12" >
            <div class="media">
                <div class="media-body" align="center">
                    <br>
                    <h1 class="media-heading"> MODIFICAR FICHA DEL USUARIO</h1>
                </div>
                <div class="media-right">
                    <img class="media-object" src="{{asset('img/usuarios/'.$usuario->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px">
                </div>
            </div>
            <br>
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
        
        <div class="col-md-12" >
            <br>
            <h3>Categoría: <b>ESTUDIANTE</b></h3>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="unidad">Unidad Académica</label>
                <select id="unidad" name="unidad" class="form-control" disabled>
                    <option selected>{{$unidad->unidad}}</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Field::text('lu',$ficha->lu_legajo, ['class'=>'form-control','disabled'])!!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="certificado_alumno">¿Presentó certificado de alumno regular? *</label>
                <select name="certificado_alumno" class="form-control" required>
                    @if($car->presentoCAR == 2)
                        <option value=0 selected >NO</option>
                        <option value=1>SI</option>
                    @else
                        <option value=0>NO</option>
                        <option value=1 selected>SI</option>
                    @endif       
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                @if($car->fecha_de_vencimiento == null)
                    {!! Field::date('fecha_de_vencimiento',$fecha, ['class'=>'form-control'])!!}
                @else
                    {!! Field::date('fecha_de_vencimiento',$car->fecha_de_vencimiento, ['class'=>'form-control'])!!}
                @endif
                
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="certificado_estudiante">¿Presentó certificado médico? *</label>
                <select name="certificado_estudiante" class="form-control" required>
                    @if($certificado->presentoCM == 2)
                        <option value=0 selected >NO</option>
                        <option value=1>SI</option>
                    @else
                        <option value=0>NO</option>
                        <option value=1 selected>SI</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {!! Field::text('certificado_medico_estudiante',$certificado->nombre_medico,['class'=>'form-control', 'name'=>'certificado_medico_estudiante','placeholder'=>'Ingrese informacion necesaria...', 'value'=>'old(certificado_medico_estudiante)'])!!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                @if($certificado->fecha_de_emision == null)
                    {!! Field::date('fecha_de_emision_certificado_estudiante',now(), ['class'=>'form-control'])!!}
                @else
                    {!! Field::date('fecha_de_emision_certificado_estudiante',$certificado->fecha_de_emision, ['class'=>'form-control'])!!}
                @endif
                
            </div>
        </div>
        <div class=" form-group mx-auto">
            <a class="btn btn-danger btn-lg" href="{{ URL::previous() }}" name="cancelar">Cancelar</a>
            <button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Actualizar</button>
        </div>

    </div>
    {!!Form::close()!!}
</div>
@endsection