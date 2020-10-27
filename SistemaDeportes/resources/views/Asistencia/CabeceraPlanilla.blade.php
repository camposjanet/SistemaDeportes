@extends('layouts.home')

@section('content')
	<style>
		label.error{
			color:red;
		}
		input.error{
			border: 2px #FF0000;
		}
	</style>

	<div class="container">
		<div class="row d-flex justify-content-center mt-4">
        	<h1>PLANILLA DE ASISTENCIA DE SALA DE MUSCULACIÓN</h1>            
    	</div>
		<div class="row">
	  		<div class="col-md-3"><p class="text-left"><b>Profesor: </b> {{Auth::user()->name}} </p></div> 
	  		<div class="col-md-3"><p class="text-center"><b>Turno: </b> {{$asistencia->turno}} </p></div>
	  		<div class="col-md-3"><p class="text-right"> <b>Fecha: </b> {{$asistencia->fecha_asistencia}} </p></div>
		</div>
		<div class="container">
			<div id="prueba"></div>
			<form id="registrar_asistencia">
				<div class="row">
					<div class="col-sm">
						<input type="number" name="Nro Carnet" id="Carnet" placeholder="N° DE CARNET">
					</div>
					<div class="col-sm">
						<input type="text" name="Nombre" id="Nombre_apellido" disabled placeholder="NOMBRE Y APELLIDO">
					</div>
					<div class="col-sm">
						<input type="text" name="dni" id="dni" disabled placeholder="DNI">
					</div>
					<div class="col-md-2">
						<input type="time" name="Hora" id="hora_ingreso" disabled>
					</div>
					<div class="col-sm">
						<input type="date" name="pago" id="mes_pagado" disabled>
					</div>
					<div>
						<button type="submit" class="btn btn-primary" id="guardar" style="display: none">
							Registrar 
						</button> 
					</div>
				</div>
			</form> 
			<div id="Contenido_extra">
				
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		$(document).ready(function(){
			$("#Carnet").keypress(function(e) {
				e.preventDefault();
       			if(e.which == 13) {
       				var id= $("#Carnet").val();
       				alert(id);
       				var url= "{{url('buscarcarnet')}}/"+id;
       				$.get(url,id,function(result){
       					$("#Carnet").val(result.id);
       					$("#Nombre_apellido").val(result.nomnre_usuario);
       					$("#dni").val(result.dni);
       					$("#hora_ingreso").val(result.hora_ingreso);
       					$("#mes_pagado").val(result.fecha);
       				});
       			}
    		});
    	});
	</script>
@endpush