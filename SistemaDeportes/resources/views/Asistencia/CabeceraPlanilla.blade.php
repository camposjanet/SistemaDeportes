@extends('layouts.home')

@section('content')

	<div class="container">
		<div class="row d-flex justify-content-center mt-4">
        	<h1>PLANILLA DE ASISTENCIA DE SALA DE MUSCULACIÓN</h1>            
    	</div>
		<div class="row">
	  		<div class="col-md-3"><p class="text-left"><b>Profesor: </b> {{Auth::user()->name}} </p></div> 
	  		<div class="col-md-3"><p class="text-center"><b>Turno: </b> {{$asistencia->turno}} </p></div>
	  		<div class="col-md-3"><p class="text-right"> <b>Fecha: </b> <?php $fv = new DateTime($asistencia->fecha_asistencia); echo $fv->format('d-m-Y');?> </p></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<input type="hidden" name="idAsistencia" id="idAsistencia" value="{{$asistencia->id}}">
				</div>
			</div>
		</div>
		<div class="alert alert-success" role="alert" name="mensaje" id="mensaje" style="display: none;">
  			<p class="text-center">Se ha registrado la asistencia ¡¡existosamente!!. </p>
		</div>
		@if(Session::has('error_ficha'))
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error_ficha')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
		@endif
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<input type="number" name="Carnet_asistencia" id="Carnet_asistencia" placeholder="N° DE CARNET">
				</div>
				<div class="col-sm">
					<input type="text" name="Nombre_apellido_asistencia" id="Nombre_apellido_asistencia" disabled placeholder="NOMBRE Y APELLIDO">
				</div>
				<div class="col-sm">
					<input type="text" name="dni_asistencia" id="dni_asistencia" disabled placeholder="DNI">
				</div>
				<div class="col-md-2">
					<input type="time" name="hora_ingreso_asistencia" id="hora_ingreso_asistencia" disabled>					
				</div>
				<div class="col-sm">
					<input type="date" name="mes_pagado_asistencia" id="mes_pagado_asistencia" disabled>
				</div>
				<div>
					<button class="btn  btn-primary" name="registrar" id="registrar" disabled onclick="registrar_asistencia_planilla()"> 
					Registrar </button>
				</div>
			</div>
			<div id="modalDetalle" name="modalDetalle" style="display: none;" class="alert alert-danger" role="alert">
				<p class="text-center"> No se puede registrar asistencia. <a href="#" data-toggle="modal" data-target="#ModalDetalles"> VER DETALLE>> </a> </p>
			</div>
			<div id="modalRegistrar" name="modalRegistrar" style="display: none;" class="alert alert-warning" role="alert">
				<p class="text-center"> Debe verificar arancel. <a href="#" data-toggle="modal" data-target="#ModalDetalles"> VER DETALLE>> </a> </p>
			</div>
		</div>
	</div>
	<br> <br>
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-asistencia" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th> # </th>
                        <th> N° de Carnet </th>
                        <th> Nombre y Apellido </th>
                        <th> DNI </th>
                       	<th> Hora de Ingreso </th> 
						<th> Vencimiento de Arancel </th>
						<th> Estado Asistencia </th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
	@include('Asistencia.modal_detalle')
@endsection

@push('scripts')
	<script type="text/javascript">
		$(function(){
			$("#Carnet_asistencia").keypress(function(e){
				if(e.keyCode==13){
					var id=$("#Carnet_asistencia").val();
					if(id==" "){
							console.log("espacio en blanco");
					}
					if(!isNaN(id)){
						$.ajax({
							type: "get",
							url: "buscarcarnet/"+id,
							success: function(result){
								if(result.ficha_valida== true){
									if(result.UsuarioValido==true && result.esArancelValido== true){
										document.getElementById('Nombre_apellido_asistencia').value=result.fichas.nombre_usuario;
										document.getElementById('dni_asistencia').value=result.fichas.dni;
										document.getElementById('hora_ingreso_asistencia').value=result.hora_ingreso;
										document.getElementById('mes_pagado_asistencia').value=result.fichas.ultimo_arancel;
										document.getElementById('registrar').disabled=false;
									}else{
										if(result.UsuarioValido==false && result.esArancelValido==false){
											$("#modalDetalle").click(function(){
												var id=$("#Carnet_asistencia").val(); 
												var chequeo="detalle";
												$.ajax({
													type:"get",
													url:"estado_documentacion/"+id,
													success:function(resultado){
														document.getElementById('chequear').value="detalle";
														$("label[for='Carnet_modal']").text(id);
														$("label[for='tipo_documento']").text(resultado.categoria);
														document.getElementById('fecha_tipo').value=resultado.documentacion;
														document.getElementById('fecha_tipo').style.color=resultado.color_documentacion;
														document.getElementById('fecha_certificado_medico').value=resultado.certificado_medico;
														document.getElementById('fecha_certificado_medico').style.color=resultado.color_certmed;
														document.getElementById('fecha_ultimo_arancel').value=resultado.ultimo_arancel;
														document.getElementById('fecha_ultimo_arancel').style.color=resultado.color_arancel;
													}, fail: function(){
													console.log("error");
													}
												});
											});
											//$("#modal").show();
											$("#modalDetalle").show();
										}else{
											if(result.UsuarioValido==true && result.esArancelValido==false){
												$("#modalRegistrar").click(function(){
													var id=$("#Carnet_asistencia").val(); 
													var idAsistencia=$("#idAsistencia").val();
													$.ajax({
														type:"get",
														url:"estado_documentacion_sinarancel/"+id,
														success:function(resultado){
															document.getElementById('chequear').value="registrar";
															document.getElementById('idficha').value=id;
															document.getElementById('idasistencia').value=idAsistencia;
															document.getElementById('fecha_ultimo_arancel_registrar').value=resultado.ultimo_arancel;
														}, fail: function(){
														console.log("error");
														}
													});
												});
												$("#modalRegistrar").show();
											}
										}
										//$("#modal").show();
									}	
								}else{
									setInterval(location.reload(true),40000);
								}	
							}, fail: function(){
								console.log("error");
							}	
						});
					}
				}
			});
		});
	</script>
	<script type="text/javascript">
		function registrar_asistencia_planilla(){
			var idAsistencia= $("#idAsistencia").val();
			var idficha= $("#Carnet_asistencia").val();
			$.ajax({
				type: "get",
				url: "crear_asistencia/"+idAsistencia+"/"+idficha,
				success: function(){
					console.log("se cargo con exito");
					$("#mensaje").fadeIn();
					setInterval(location.reload(true),40000);
				}, fail: function(){
					console.log("error");
				}
			});
		}

	</script>

	<script type="text/javascript">
		$(function(){
			$("#data-table-asistencia").DataTable({
				processing: true,
				serverSide: true,
				info: false,
				"language": {
                	"url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                },
                ajax:{
                	url:"mostrar_asistencia_turno",
                	type:"GET",
                },
                columns:[
				{data: 'id',name: 'id'},
				{data: 'ficha_id', name:'ficha_id'},
				{data: 'nombre_usuario', name:'nombre_usuario'},
				{data: 'dni', name:'dni'},
				{data: 'hora_ingreso', nane:'hora_ingreso'},
				{data: 'ultimo_arancel', name: 'ultimo_arancel'},
				{data: 'estado_asistencia', name: 'estado_asistencia'}
				],
				order: [[0, 'des']]
			});
		});
	</script>
@endpush