@extends('layouts.home')

@section('content')
<!-- <nav aria-label="breadcrumb ">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registrar socio</li>
            </ol>
        </nav>
<div class="jumbotron bg-primary text-white" style=" padding-left:10px;">
    <div class="container p-1">
        
      <h1 class="display-3">Socios</h1>
    </div>
  </div> -->
<div class="container">
    
    {!! Form::open(['route'=>'socio.store', 'method'=>'POST','files'=>true])!!}
    {{Form::token()}}
    <div class="row d-flex justify-content-start">
        <div class="media col-md-12" >
            <div class="media-body" align="center">
                <br>
                <h1 class="media-heading">REGISTRAR SOCIO</h1>
                
            </div>
            <div class="media-right" align="center">
                <img id="uploadPreview" width="150" height="150" />
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                {!! Field::text('nombre_apellido',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-5">
            <!-- {!! Field::file('foto',['class'=>'form-control'])!!} -->
            
            <label>Foto *</label><br>
            <input id="uploadImage" type="file" name="foto" onchange="previewImage();" required/>

        </div>
        
        
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::date('fecha_de_nacimiento',now(), ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::text('dni',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::text('lu_legajo',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                 {!! Field::text('domicilio',null, ['class'=>'form-control'])!!}        
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::email('email',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::text('telefono_celular',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::text('telefono_de_emergencia',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-4">
            {!! Field::select('id_tipo_socio', $tipos, ['class'=>'select-tipo','empty'=>'Seleccione un tipo'])!!} 
            <!--  -->
        </div>
        <div class="col-md-4">
            <div class= "form-group">
                {!! Form::label('certificado_de_alumno','¿Presentó cert. de alumno regular?')!!}
                {!! Form::select('certificado_de_alumno', ['NO'=>'NO','SI'=>'SI'],null,['class'=>'form-control'])!!} 
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="id_tipo_socio">Facultad</label>
                <select name="id_facultad" class="form-control">
                    <option value=0>Seleccione facultad</option>
                    @foreach ($facultades as $facultad)
                        <option value="{{$facultad->id}}">{{$facultad->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                {!! Field::text('lugar_de_trabajo',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-4">
            <div class= "form-group">
                {!! Form::label('estado_documentacion','Estado de la documentación')!!}
                {!! Form::select('estado_documentacion', ['INCOMPLETA'=>'INCOMPLETA','COMPLETA'=>'COMPLETA','VENCIDA'=>'VENCIDA'],null,['class'=>'form-control'])!!} 
            </div>
        </div>
        
        <div class="form-group mx-auto">
            
            {!! Form::reset(' Limpiar datos',['class'=>'btn btn-danger btn-lg'])!!}
            <button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Guardar</button>
        </div>
    </div>
    {!!Form::close()!!}
    <script type="text/javascript">
        function previewImage() {        
            var reader = new FileReader();         
            reader.readAsDataURL(document.getElementById('uploadImage').files[0]);         
            reader.onload = function (e) {             
                document.getElementById('uploadPreview').src = e.target.result;         
            };     
        }
    </script>
</div>
@endsection