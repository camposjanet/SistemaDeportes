@extends('layouts.home')

@section('content')
<div class="container">
    
    
    <!--{!! Form::model($usuario, ['route'=>['usuario.update',$usuario->id], 'method'=>'PUT', 'files'=>'true']) !!} -->
    {!! Form::open(['route'=>['usuario.update',$usuario->id], 'method'=>'PATCH','files'=>true,'autocomplete'=>'off'])!!}
    {{Form::token()}}
    <div class="row d-flex justify-content-start">
        <div class="media col-md-12" >
           
            @if (($usuario->foto)!="")
                <div class="media">
                    <div class="media-body" align="center">
                        <br>
                        <h1 class="media-heading"> MODIFICAR DATOS DEL USUARIO </h1>
                    </div>
                    <div class="media-right">
                        <img class="media-object" id="uploadPreview" src="{{asset('img/usuarios/'.$usuario->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px"> <br>
                        <input id="uploadImage" type="file" name="foto" onchange="previewImage();"> <br> 
                        <label> Foto* </label>
                    </div>
                </div>
            @endif
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
        
        
        <div class="col-md-4">
            <div class="form-group">
                {!! Field::date('fecha_de_nacimiento',null, ['class'=>'form-control'])!!}
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
                <!--{!! Form::label('domicilio','domicilio') !!}
                {!! Form::text('domicilio',null,['class'=>'from-control'])!!}-->
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col"> 
                    <label>Telefono de contacto*</label>
                    <input type="text" name="telefono_celular" value="{{$telefono_celular->numero}}" class="form-control">
                    <input type="hidden" name="id_telcontacto" id="id_telcontacto" value="{{$telefono_celular->id_celular}}">
                </div>
                <div class="col">
                    <label for="id">Linea Telefono*</label>
                    <select name="telcontacto" id="telcontacto" class="form-control">
                        @foreach ($lineas as $l)
                            <option value="{{$l->id}}"> {{$l->linea}}</option>
                        @endforeach
                    </select>    
                </div>
                <div class="col">
                    <label>Telefono de Emergencia*</label>
                    <input type="text" name="telefono_de_emergencia" value="{{$telefono_de_emergencia->numero}}" class="form-control">    
                    <input type="hidden" name="id_emergencia" id="id_emergencia" value="{{$telefono_de_emergencia->id_emergencia}}">
                </div>
                <div class="col">
                   <label for="id">Linea Telefono* </label>
                    <select name="telemergencia" id="telemergencia" class="form-control">
                        @foreach ($lineas as $l)
                            <option value="{{$l->id}}"> {{$l->linea}}</option>
                        @endforeach
                    </select> 
                </div>
            </div>
            <span class="border border-white"></span>
            <div class="row ">
                <div class="form-group mx-auto">
                        <a class="btn btn-danger btn-lg" href="{{ route('usuario.index') }}" role="button"> 
                            <i class="fa fa-ban" aria-hidden="true"></i> Cancelar </a>
                        <button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Actualizar</button>
                </div>
            </div>
        </div>
        
    </div>
    {!!Form::close()!!}
    
    <script type="text/javascript">
        
        function telefono_contacto(){
            var id_contacto= document.getElementById('id_telcontacto').value;
            var linea_contacto= document.getElementById('telcontacto');
            var lineacontacto=[];
            for(var i=0; i<linea_contacto.children.length; i++){
                var child= linea_contacto.children[i];
                if(child.tagName=='OPTION'){
                    lineacontacto.push(child.value);
                }
            }
            for(var i=0; i< lineacontacto.length; i++){
                if(lineacontacto[i]==id_contacto){
                    document.getElementById('telcontacto').options[id_contacto-1].setAttribute('selected','true');
                }
            }
        };
        telefono_contacto();

        function telefono_emergencia(){
            var id_emergencia= document.getElementById('id_emergencia').value;
            var linea_emergencia= document.getElementById('telemergencia');
            var lineaemergencia=[];
            for(var i=0; i<linea_emergencia.children.length; i++){
                var child= linea_emergencia.children[i];
                if(child.tagName=='OPTION'){
                    lineaemergencia.push(child.value);
                }
            }
            for(var i=0; i< lineaemergencia.length; i++){
                if(lineaemergencia[i]==id_emergencia){
                    document.getElementById('telemergencia').options[id_emergencia-1].setAttribute('selected','true');
                }
            }
        }
        telefono_emergencia();

    </script>

    <script type="text/javascript">
        function previewImage() {
            var reader = new FileReader();         
            reader.readAsDataURL(document.getElementById('uploadImage').files[0]);   
            console.log(document.getElementById('uploadImage').files[0])      ;
            reader.onload = function (e) { 
                console.log(e.target.result);
                document.getElementById('uploadPreview').src = e.target.result;         
            };     
        }
    </script>
</div>
@endsection
