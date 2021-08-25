@extends('layouts.home')
@section('content')
<div class="container">
    @include('arancel.create-desde-modulo')
    <div class="row d-flex justify-content-center mt-4">
        <h1 >ARANCELES</h1>            
    </div>
    <div class="row d-flex justify-content-start ">
        <div class="col-lg-6">
            <div class="form-group">
                <label >Ingrese Nº de Carnet:</label>
                <div class="input-group">
                    <input type="number"  class="form-control" name="nro_carnet_arancel" id="nro_carnet_arancel" value="{{old('nro_carnet_arancel')}}" placeholder="Ingrese un nro de carnet para registrar arancel...">
                    <span class="input-group-btn">
                        <button class="btn  btn-primary" name="buscar" id="buscar" onclick="buscar_nro_carnet()"> <i class="fa fa-search"></i> Buscar </button>
                    </span>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-1">
            @if(Session::has('exito_en_pago_arancel'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('exito_en_pago_arancel')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
			@endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-1">
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
                <table class="table table-borderless table-hover text-center" id="data-table-aranceles" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th>Nº Pago</th>
                        <th>Nº de Carnet</th>
                        <th>DNI</th>
                        <th>Fecha de Pago</th>
                        <th>Importe</th>
                        <th>Vencimiento</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
    
</div>
@endsection
@push('scripts')
<script >
    $(function () {
        console.log("datatable");
        $('#data-table-aranceles').DataTable({
            processing: true,
            serverSide: true,
            info: false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            ajax: {
                url: "index",
                type: 'GET',
            },
            columns: [
                    {  data: 'id', name: 'id', 'visible': true},
                    {  data: 'id_ficha', name: 'id_ficha'},
                    {  data: 'dni', name: 'dni', orderable: false},
                    {  data: 'fecha_de_pago', name: 'fecha_de_pago'},
                    {  data: 'importe', name: 'importe', orderable: false},
                    {  data: 'fecha_de_vencimiento', name: 'fecha_de_vencimiento'}
                ],
            order: [[0, 'desc']]
        });
    });
</script>
    
    <script type="text/javascript">
    	function buscar_nro_carnet(){
            var nro_carnet=$("#nro_carnet_arancel").val();
            if (nro_carnet!="") {
                $.ajax({
                    type: "get",
                    url: "index/"+nro_carnet,
                    success: function(respuesta){
                        console.log(respuesta);
                        if (respuesta.nroValido==true){
                            document.getElementById('num_ficha_arancel').value=respuesta.ficha.idficha;
                            document.getElementById('nombre_apellido_arancel').value=respuesta.ficha.nombre_usuario;
                            document.getElementById('dni_arancel').value=respuesta.ficha.dni;
                            document.getElementById('importe_arancel').value=respuesta.importe;
                            document.getElementById('importe_arancel_hidden').value=respuesta.importe;
                            let arrayDeMensajes = respuesta.mensaje.split('.');
                            let mensaje = '';
                            for (var i=0; i < arrayDeMensajes.length-1; i++) {
                                mensaje = mensaje+'<li>'+arrayDeMensajes[i]+'</li>';
                            }
                            document.getElementById('mensaje').innerHTML=mensaje;
                            $('#verModalRegistrarArancel').modal('show');
                        } else $(location).attr('href',"/arancel/index");
                        
                    }, fail: function(){
                        console.log("error en buscar nro de carnet");
                    }
                });
            }
		}
    </script>
    <script>
            $(function(){ 
                $.ajaxSetup({
                    headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
                });
            });
            $(function(){ 
                $("#btnRegistrarArancel").click(function (e) {
                    var importe = $('#importe_arancel').val();
                    var idFicha = $('#num_ficha_arancel').val();
                    var fecha_de_inicio = $('#fecha_de_inicio').val();
                    var fecha_de_vencimiento = $('#fecha_de_vencimiento').val();
                    var cantidad_meses = $('#cantidad_meses').val();
                    var nro_recibo = $('#nro_recibo').val();
                    console.log(importe, idFicha, fecha_de_inicio, fecha_de_vencimiento, cantidad_meses, nro_recibo);
                    $.ajax({
                        type: "post",
                        url: "index/create/"+idFicha,
                        data: {
                            importe: importe,
                            fecha_de_inicio: fecha_de_inicio,
                            fecha_de_vencimiento: fecha_de_vencimiento,
                            cantidad_meses: cantidad_meses,
                            nro_recibo: nro_recibo,
                        }, success: function (result) {
                            console.log(result);
                            $('#verModalRegistrarArancel').modal('hide');
                            $(location).attr('href',"/arancel/index");
                        }, fail: function(){
                            console.log("error en registrar arancel");
                        }
                    });   
                });
            });
        </script>
    <script type="text/javascript">
    	function calcular_importe(){
            var importe = $('#importe_arancel_hidden').val();
            var meses = $('#cantidad_meses').val();
            var importe_total = importe * meses;
            document.getElementById('importe_arancel').value=importe_total;
		}
    </script>
@endpush

