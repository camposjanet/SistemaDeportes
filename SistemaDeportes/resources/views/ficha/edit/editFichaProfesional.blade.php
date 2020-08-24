@extends('layouts.home')

@section('content')
<div class="container">
    {!!Form::model($ficha, ['route'=>['ficha.profesional.update',$ficha->id],'method'=>'PATCH','autocomplete'=>'off'])!!}  
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
            @if($ficha->id_categoria == 2)
                <h3>Categoría: <b>DOCENTE</b></h3>
            @else
                <h3>Categoría: <b>PAU</b></h3>
            @endif
        </div>
        <div class="col-md-9">
            <div class="form-group">
                {!! Field::text('lugar_de_trabajo',$ficha->lugar_de_trabajo, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Field::text('legajo',$ficha->lu_legajo, ['class'=>'form-control','disabled'])!!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="recibo_sueldo">¿Presentó recibo de sueldo? *</label>
                <select name="recibo_sueldo" class="form-control" required>
                    @if($recibo->presentoR == 2)
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
                {!! Field::text('nro_recibo',$recibo->nro_recibo,['class'=>'form-control', 'name'=>'nro_recibo', 'value'=>'old(nro_recibo)'])!!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="certificado_profesional">¿Presentó certificado médico? *</label>
                <select name="certificado_profesional" class="form-control" required>
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
                {!! Field::text('certificado_medico_profesional',$certificado->nombre_medico,['class'=>'form-control', 'name'=>'certificado_medico_profesional','placeholder'=>'Ingrese informacion necesaria...', 'value'=>'old(certificado_medico_profesional)'])!!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                @if($certificado->fecha_de_emision == null)
                    {!! Field::date('fecha_de_emision_certificado_profesional',now(), ['class'=>'form-control'])!!}
                @else
                    {!! Field::date('fecha_de_emision_certificado_profesional',$certificado->fecha_de_emision, ['class'=>'form-control'])!!}
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