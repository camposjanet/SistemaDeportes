@extends('layouts.home')

@section('content')
<div class="container">
    @include('ficha.show_familiar')
    @include('ficha.show_estudiante')
    @include('ficha.show_profesional')

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
                <a class="btn btn-info" href="{{url('usuarios/')}}" name="regresar"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Regresar</a>
                <a href="{{URL::action('FichaController@create',$usuario->id)}}"><button class="btn  btn-primary"><i class="fa fa-file"></i> Agregar</button></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-2">
            @if(Session::has('error_en_pago_arancel'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error_en_pago_arancel')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
			@endif
        </div>
    </div>
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
                                <button title="Ver Ficha" name="visualizar" class="btn " style="background-color:#45B39D;" id="showFicha" onclick='obtener_id({{$ficha->id}});'><i class="fa fa-eye text-dark"></i></button>
                                @if($ficha->categoria=='Estudiante')
                                    <a href="{{URL::action('FichaController@editFichaEstudiante',$ficha->id)}}"><button title="Modificar Ficha" name="modificar" class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                                @elseif ($ficha->categoria=='Familiar')
                                    <a href="{{URL::action('FichaController@editFichaFamiliar',$ficha->id)}}"><button title="Modificar Ficha" name="modificar" class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                                @else
                                    <a href="{{URL::action('FichaController@editFichaProfesional',$ficha->id)}}"><button title="Modificar Ficha" name="modificar" class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                                @endif
                                @if($ficha->estado=='ACTIVO')
                                    <button title="Registrar Pago" name="arancel" class="btn btn-success" data-toggle="modal" id="arancel-ficha-{{$ficha->id}}" data-target="#modal-pago-arancel-{{$ficha->id}}"><i class="fa fa-usd text-dark"></i></button>
                                @endif 
                                @if($ficha->documentacion=='COMPLETA')
                                    @if($ficha->categoria=='Estudiante')
                                        <a href="{{URL::action('CarnetController@generarCarnetEstudiante',$ficha->id)}}" target="_blank"><button title="Generar Carnet" name="carnet" type="submit" class="btn" style="background-color:#5C6BC0;"><i class="fa fa-credit-card text-dark"></i></button></a>
                                    @elseif ($ficha->categoria=='Familiar')
                                        <a href="{{URL::action('CarnetController@generarCarnetFamiliar',$ficha->id)}}" target="_blank"><button title="Generar Carnet" name="carnet" type="submit" class="btn" style="background-color:#5C6BC0;"><i class="fa fa-credit-card text-dark"></i></button></a>
                                    @else
                                        <a href="{{URL::action('CarnetController@generarCarnetProfesional',$ficha->id)}}" target="_blank"><button title="Generar Carnet" name="carnet" type="submit" class="btn" style="background-color:#5C6BC0;"><i class="fa fa-credit-card text-dark"></i></button></a>
                                    @endif
                                    
                                @endif
                                
                            </td>
                        </tr>
                        @include('arancel.create')
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function obtener_id(valor){
            console.log(valor);
            var id=valor;
            
            $.ajax({
                type: "get",
                url: "show/"+id,
                success: function(respuesta) {
                    //console.log(respuesta);
                    if (respuesta.ficha.categoria == 'Estudiante'){
                        document.getElementById('num_ficha_estudiante').value=respuesta.ficha.idficha;
                        document.getElementById('categoria_ficha_estudiante').value=respuesta.ficha.categoria;
                        document.getElementById('nombre_apellido_estudiante').value=respuesta.ficha.nombre_usuario;
                        document.getElementById('fecha_de_nacimiento_estudiante').value=respuesta.fecha_de_nacimiento;
                        document.getElementById('dni_estudiante').value=respuesta.ficha.dni;
                        document.getElementById('lu_estudiante').value=respuesta.ficha.lu_legajo;
                        document.getElementById('domicilio_estudiante').value=respuesta.ficha.domicilio;
                        document.getElementById('email_usuario_estudiante').value=respuesta.ficha.email;
                        document.getElementById('facultad_estudiante').value=respuesta.unidad;
                        document.getElementById('vencimiento_car_estudiante').value=respuesta.vencimientoCertificadoAR;
                        document.getElementById('vencimiento_cm_estudiante').value=respuesta.vencimientoCertificadoM;
                        document.getElementById('vencimiento_arancel_estudiante').value=respuesta.ultimo_arancel;
                        for(i = 0; i < respuesta.lineas.length; i++){
                                if (respuesta.lineas[i].tipo_telefono == 'TELEFONO'){
                                    document.getElementById('telefono_estudiante').value=respuesta.lineas[i].numero;
                                    document.getElementById('linea_estudiante').value=respuesta.lineas[i].linea;
                                }
                                if (respuesta.lineas[i].tipo_telefono == 'CONTACTO DE EMERGENCIA'){
                                    document.getElementById('telefono_emergencia_estudiante').value=respuesta.lineas[i].numero;
                                    document.getElementById('linea_emergencia_estudiante').value=respuesta.lineas[i].linea;
                                }
                        }
                        $('#verModalEstudiante').modal('show'); 
                    }
                    if (respuesta.ficha.categoria == 'Familiar'){
                        document.getElementById('num_ficha_familiar').value=respuesta.ficha.idficha;
                        document.getElementById('categoria_ficha_familiar').value=respuesta.ficha.categoria;
                        document.getElementById('nombre_apellido_familiar').value=respuesta.ficha.nombre_usuario;
                        document.getElementById('fecha_de_nacimiento_familiar').value=respuesta.fecha_de_nacimiento;
                        document.getElementById('dni_familiar').value=respuesta.ficha.dni;
                        document.getElementById('domicilio_familiar').value=respuesta.ficha.domicilio;
                        document.getElementById('email_usuario_familiar').value=respuesta.ficha.email;
                        document.getElementById('vencimiento_cm_familiar').value=respuesta.vencimientoCertificadoM;
                        document.getElementById('vencimiento_arancel_familiar').value=respuesta.ultimo_arancel;
                        for(i = 0; i < respuesta.lineas.length; i++){
                                if (respuesta.lineas[i].tipo_telefono == 'TELEFONO'){
                                    document.getElementById('telefono_familiar').value=respuesta.lineas[i].numero;
                                    document.getElementById('linea_familiar').value=respuesta.lineas[i].linea;
                                }
                                if (respuesta.lineas[i].tipo_telefono == 'CONTACTO DE EMERGENCIA'){
                                    document.getElementById('telefono_emergencia_familiar').value=respuesta.lineas[i].numero;
                                    document.getElementById('linea_emergencia_familiar').value=respuesta.lineas[i].linea;
                                }
                        }
                        $("#verModalFamiliar").modal('show'); 
                    }
                    if ((respuesta.ficha.categoria == 'Docente')  || (respuesta.ficha.categoria == 'PAU')){
                        document.getElementById('num_ficha').value=respuesta.ficha.idficha;
                        document.getElementById('categoria_ficha').value=respuesta.ficha.categoria;
                        document.getElementById('nombre_apellido').value=respuesta.ficha.nombre_usuario;
                        document.getElementById('fecha_de_nacimiento').value=respuesta.fecha_de_nacimiento;
                        document.getElementById('dni').value=respuesta.ficha.dni;
                        document.getElementById('lu_legajo').value=respuesta.ficha.lu_legajo;
                        document.getElementById('domicilio').value=respuesta.ficha.domicilio;
                        document.getElementById('email_usuario').value=respuesta.ficha.email;
                        document.getElementById('lugar_de_trabajo').value=respuesta.ficha.lugar_de_trabajo;
                        document.getElementById('vencimiento_cm').value=respuesta.vencimientoCertificadoM;
                        document.getElementById('vencimiento_arancel').value=respuesta.ultimo_arancel;
                        for(i = 0; i < respuesta.lineas.length; i++){
                                if (respuesta.lineas[i].tipo_telefono == 'TELEFONO'){
                                    document.getElementById('telefono').value=respuesta.lineas[i].numero;
                                    document.getElementById('linea_telefono').value=respuesta.lineas[i].linea;
                                }
                                if (respuesta.lineas[i].tipo_telefono == 'CONTACTO DE EMERGENCIA'){
                                    document.getElementById('telefono_emergencia').value=respuesta.lineas[i].numero;
                                    document.getElementById('linea_emergencia').value=respuesta.lineas[i].linea;
                                }
                        }
                        $('#verModal').modal('show'); 
                    }
                }, fail: function(){
                    console.log("error");
                }
            });
            
        }
    </script>
</div>
@endsection
@push('scripts')
<script >
    $(function(){ 
        $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
            });
    });
    
</script>


@endpush

