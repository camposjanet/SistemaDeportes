@extends('layouts.home')

@section('content')
<div class="container">
    
    {!! Form::open(['route'=>'usuario.store', 'method'=>'POST','files'=>true])!!}
    {{Form::token()}}
    <div class="row d-flex justify-content-start">
        <div class="media col-md-12" >
            <div class="media-body" align="center">
                <br>
                <h1 class="media-heading">REGISTRAR USUARIO</h1>
                
            </div>
            <div class="media-right" align="center">
                <img id="uploadPreview" width="150" height="150" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Field::text('apellido',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::text('nombre',null, ['class'=>'form-control'])!!}
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
                {!! Field::number('dni',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::email('email',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                 {!! Field::text('domicilio',null, ['class'=>'form-control'])!!}        
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Field::text('telefono_celular',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-3">
            {!! Field::select('id_linea_telefono', $lineas, ['class'=>'select-linea','empty'=>'Seleccione una linea'])!!} 
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Field::text('telefono_de_emergencia',null, ['class'=>'form-control'])!!}
            </div>
        </div>
        <div class="col-md-3">
            {!! Field::select('id_linea_telefono_emergencia', $lineas, ['class'=>'select-linea','empty'=>'Seleccione una linea'])!!} 
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