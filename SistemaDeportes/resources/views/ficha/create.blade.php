@extends('layouts.home')

@section('content')
<div class="container">
    
    
    {!! Form::open(array('action'=>array('FichaController@store',$usuario->id),'method'=>'post','autocomplete'=>'off')) !!}
    {{Form::token()}}
    
    <div class="row d-flex justify-content-start">
        <div class="col-md-12" >
            @if (($usuario->foto)!="")
                <div class="media">
                    <div class="media-body" align="center">
                        <br>
                        <h1 class="media-heading"> REGISTRAR FICHA INDIVIDUAL</h1>
                    </div>
                    <div class="media-right">
                        <img class="media-object" src="{{asset('img/usuarios/'.$usuario->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px">
                    </div>
                </div>
                <br>
            @else
                <div class="media-body" align="center">
                    <br>
                    <h1 class="media-heading">REGISTRAR FICHA INDIVIDUAL</h1>                
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
        <div class="col-lg-12">
        <br>
            <div class="form-group">
                <label for="id_categoria">Seleccione categoría</label>
                <select id="id_categoria" name="id_categoria" class="form-control" value="{{old('id_categoria')}}" onchange='obtener_id(this);'>
                    <option value=0 selected> - </option>
                    @foreach ($categorias as $cat)
                        <option value="{{$cat->id}}" {{ old('id_categoria') == $cat->id ? 'selected' : '' }}>{{$cat->categoria}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div id="estudiante" name="estudiante" style="display: none;">
            <div class="col-md-12 text-center" >
                <h4>ESTUDIANTE</h4>
            </div>
            <div class="col-md-6">
                {!! Field::select('id_unidad_academica', $unidades, ['class'=>'select-unidades','empty'=>'Seleccione unidad académica'])!!} 
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Field::text('lu',null, ['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="certificado_alumno">¿Presentó certificado de alumno regular? *</label>
                    <select name="certificado_alumno" class="form-control" required>
                            <option value=1 {{ old('certificado_alumno') == 1 ? 'selected' : '' }}>SI</option>
                            <option value=0 {{ old('certificado_alumno') == 0 ? 'selected' : '' }}>NO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Field::date('fecha_de_vencimiento',$fecha, ['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="certificado_estudiante">¿Presentó certificado médico? *</label>
                    <select name="certificado_estudiante" class="form-control" required>
                            <option value=1 {{ old('certificado_estudiante') == 1 ? 'selected' : '' }}>SI</option>
                            <option value=0 {{ old('certificado_estudiante') == 0 ? 'selected' : '' }}>NO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    {!! Field::text('certificado_medico_estudiante',['class'=>'form-control', 'name'=>'certificado_medico_estudiante','placeholder'=>'Ingrese informacion necesaria...', 'value'=>'old(certificado_medico_estudiante)'])!!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Field::date('fecha_de_emision_certificado_estudiante',now(), ['class'=>'form-control'])!!}
                </div>
            </div>
            <div class=" form-group mx-auto">
                {!! Form::reset(' Limpiar datos',['class'=>'btn btn-danger btn-lg'])!!}
                <button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Guardar</button>
            </div>
        </div><br>
        <div id="docente" name="docente" style="display: none;">
            <div class="col-md-12 text-center" >
                <h4 id="hdocente" style="display: none;">DOCENTE</h4>
                <h4 id="hpau" style="display: none;">PAU</h4>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    {!! Field::text('lugar_de_trabajo',null, ['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Field::text('legajo',null, ['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="recibo_sueldo">¿Presentó recibo de sueldo? *</label>
                    <select name="recibo_sueldo" class="form-control" required>
                            <option value=1 {{ old('recibo_sueldo') == 1 ? 'selected' : '' }}>SI</option>
                            <option value=0 {{ old('recibo_sueldo') == 0 ? 'selected' : '' }}>NO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Field::text('nro_recibo',['class'=>'form-control', 'name'=>'nro_recibo', 'value'=>'old(nro_recibo)'])!!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="certificado_profesional">¿Presentó certificado médico? *</label>
                    <select name="certificado_profesional" class="form-control" required>
                            <option value=1 {{ old('certificado_profesional') == 1 ? 'selected' : '' }}>SI</option>
                            <option value=0 {{ old('certificado_profesional') == 0 ? 'selected' : '' }}>NO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    {!! Field::text('certificado_medico_profesional',['class'=>'form-control', 'name'=>'certificado_medico_profesional','placeholder'=>'Ingrese informacion necesaria...', 'value'=>'old(certificado_medico_profesional)'])!!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Field::date('fecha_de_emision_certificado_profesional',now(), ['class'=>'form-control'])!!}
                </div>
            </div>
            <div class=" form-group mx-auto">
                {!! Form::reset(' Limpiar datos',['class'=>'btn btn-danger btn-lg'])!!}
                <button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Guardar</button>
            </div>
        </div><br>

        <div id="familiar" name="familiar" style="display: none;">
            <div class="col-md-12 text-center" >
                <h4>FAMILIAR</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="documentacion_probatoria">¿Presentó documentación probatoria? *</label>
                    <select name="documentacion_probatoria" class="form-control" required>
                            <option value=1>SI</option>
                            <option value=0 selected>NO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Field::text('nombre_documentacion',['class'=>'form-control', 'name'=>'nombre_documentacion','placeholder'=>'Ingrese informacion necesaria...', 'value'=>'old(nombre_documentacion)'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Field::text('nombre_familiar',['class'=>'form-control', 'name'=>'nombre_familiar', 'value'=>'old(nombre_familiar)'])!!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Field::text('legajo_familiar',null, ['class'=>'form-control'])!!}
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="certificado_familiar">¿Presentó certificado médico? *</label>
                    <select name="certificado_familiar" class="form-control" required>
                            <option value=1>SI</option>
                            <option value=0 selected>NO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    {!! Field::text('certificado_medico_familiar',['class'=>'form-control', 'name'=>'certificado_medico_familiar','placeholder'=>'Ingrese informacion necesaria...', 'value'=>'old(certificado_medico_familiar)'])!!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {!! Field::date('fecha_de_emision_certificado_familiar',now(), ['class'=>'form-control'])!!}
                </div>
            </div>
            <div class=" form-group mx-auto">
                {!! Form::reset(' Limpiar datos',['class'=>'btn btn-danger btn-lg'])!!}
                <button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Guardar</button>
            </div>
        </div><br>
            
        
        <input id="categoria" name="categoria" type="hidden" value="{{old('categoria')}}">
        <br>
        
    </div>
    {!!Form::close()!!}
    
    <script type="text/javascript">
        function obtener_id(valor){
            document.getElementById('categoria').value = valor.value;
            var id = valor.value;
            if (id == 1){
                $('#docente').attr({"style":"display: none","class":" "});
                $('#familiar').attr({"style":"display: none","class":" "});
                $('#estudiante').attr({"style":"display: block","class":"row d-flex justify-content-start"});
            }
            if (id == 2 || id ==3){
                if (id == 2) {
                    $('#hpau').attr("style","display: none");
                    $('#hdocente').attr("style","display: block");
                } else {
                    $('#hdocente').attr("style","display: none");
                    $('#hpau').attr("style","display: block");
                }
                $('#estudiante').attr({"style":"display: none","class":" "});
                $('#familiar').attr({"style":"display: none","class":" "});
                $('#docente').attr({"style":"display: block","class":"row d-flex justify-content-start"});
            }
            if (id == 4){
                $('#estudiante').attr({"style":"display: none","class":" "});
                $('#docente').attr({"style":"display: none","class":" "});
                $('#familiar').attr({"style":"display: block","class":"row d-flex justify-content-start"});
            }
            
        }
    </script>
</div>
@endsection
@push('scripts')
<script >
    $(function(){ 
        var id = $('#categoria').val();
        console.log(id);
        if (id == 1){
                $('#docente').attr({"style":"display: none","class":" "});
                $('#familiar').attr({"style":"display: none","class":" "});
                $('#estudiante').attr({"style":"display: block","class":"row d-flex justify-content-start"});
            }
            if (id == 2 || id ==3){
                if (id == 2) {
                    $('#hpau').attr("style","display: none");
                    $('#hdocente').attr("style","display: block");
                } else {
                    $('#hdocente').attr("style","display: none");
                    $('#hpau').attr("style","display: block");
                }
                $('#estudiante').attr({"style":"display: none","class":" "});
                $('#familiar').attr({"style":"display: none","class":" "});
                $('#docente').attr({"style":"display: block","class":"row d-flex justify-content-start"});
            }
            if (id == 4){
                $('#estudiante').attr({"style":"display: none","class":" "});
                $('#docente').attr({"style":"display: none","class":" "});
                $('#familiar').attr({"style":"display: block","class":"row d-flex justify-content-start"});
            }
    });

</script>
@endpush