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

	<div class="con tainer">
		<div class="row d-flex justify-content-center mt-4">
        	<h1>PLANILLA DE ASISTENCIA DE SALA DE MUSCULACIÓN</h1>            
    	</div>
		<div class="row">
	  		<div class="col-md-3"><p class="text-left"><b>Profesor: </b> {{Auth::user()->name}} </p></div> 
	  		<div class="col-md-3"><p class="text-center"><b>Turno: </b> {{$asistencia->turno}} </p></div>
	  		<div class="col-md-3"><p class="text-right"> <b>Fecha: </b> {{$asistencia->fecha_asistencia}} </p></div>
		</div>
		<div class="container">
			<!--<form id="registrar_asistencia" method="get" action="buscarcarnet"> -->
				{{Form::open['route'=>'asistencia.create', 'method'=>'POST']}}
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
							Registrar <!-- onclick="javascript.alert('Falta comprobar')" style="display: none"-->
						</button>
					</div>
				</div>
			<!--</form> -->
				{{Form::close()}}
			<div id="Contenido_extra">
				
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		$(document).ready(funtion(e)){
			$("#registrar_asistencia").validate({

				rules:{
					Carnet: {
						required:true,
						number: true,
						range:[1,1000]

					}
				},
				messages:{
					carnet:{
						required:"Campo Obligatorio",
						number:"Debe ser númerico",
						range:"Debe ser un número entero entre [1-1000]"
					}
				}
			});
			var input=document.getElementId('Carnet');
			var nro_carnet;
			input.addEventListener("keyup", function(event){
				if(event.keyCode === 13){
					event.preventDefault();
					document.getElementById("guardar").click();
					nro_carnet={
						ficha_id:$("#Carnet").val();
					}
					$.get("buscarcarnet",nro_carnet,procesarDatos);
					return false;
				}
			}); 
			/*$("#registrar_asistencia").ready(function(){
				var datosFormulario= {
					nro_carnet:document.getElementId('Carnet');
				}
				$.get("buscarcarnet",datosFormulario, procesarDatos);
			});*/

			function procesarDatos(datos_recibidos){
				if(datos_recibidos== "exito"){
					$("#Contenido_extra").html(<p> Registrar usuario </p>);
				}else{
					$("#Contenido_extra").html(<p> No se Encontro Usuario </p>);
				}
			}
		}
	</script>
@endpush