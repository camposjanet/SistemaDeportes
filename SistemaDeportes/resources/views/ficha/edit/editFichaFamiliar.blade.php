@extends('layouts.home')

@section('content')
<div class="container">
    {!!Form::model($ficha, ['route'=>['ficha.familiar.update',$ficha->id],'method'=>'PATCH','autocomplete'=>'off'])!!}  
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
            <h3>Categoría: <b>FAMILIAR</b></h3>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="documentacion_probatoria">¿Presentó documentación probatoria? *</label>
                <select name="documentacion_probatoria" class="form-control" required>
                    @if($documentacion->presentoDF == 2)
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
                {!! Field::text('nombre_documentacion',$documentacion->nombre_documentacion,['class'=>'form-control', 'name'=>'nombre_documentacion', 'value'=>'old(nombre_documentacion)'])!!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Field::text('nombre_familiar',$documentacion->nombre_familiar,['class'=>'form-control', 'name'=>'nombre_familiar', 'value'=>'old(nombre_familiar)'])!!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Field::text('legajo_familiar',$documentacion->legajo_familiar, ['class'=>'form-control'])!!}
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="certificado_familiar">¿Presentó certificado médico? *</label>
                <select name="certificado_familiar" class="form-control" required>
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
                {!! Field::text('certificado_medico_familiar',$certificado->nombre_medico,['class'=>'form-control', 'name'=>'certificado_medico_familiar','placeholder'=>'Ingrese informacion necesaria...', 'value'=>'old(certificado_medico_familiar)'])!!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                @if($certificado->fecha_de_emision == null)
                    {!! Field::date('fecha_de_emision_certificado_familiar',now(), ['class'=>'form-control'])!!}
                @else
                    {!! Field::date('fecha_de_emision_certificado_familiar',$certificado->fecha_de_emision, ['class'=>'form-control'])!!}
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