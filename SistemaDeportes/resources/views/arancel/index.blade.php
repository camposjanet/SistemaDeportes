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
    
    
</div>
@endsection
@push('scripts')
    
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
                    $.ajax({
                        type: "post",
                        url: "index/create/"+idFicha,
                        data: {
                            importe: importe
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
@endpush

