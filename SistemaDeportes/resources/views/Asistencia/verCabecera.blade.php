@extends('layouts.home')

@section('content')
	<div class="container">
		<div class="row d-flex justify-content-center mt-4">
        	<h1>PLANILLA DE ASISTENCIA DE SALA DE MUSCULACIÓN</h1>            
    	</div>
		<div class="row">
	  		<div class="col-md-3"><p class="text-left"><b>Profesor: </b> {{$cabecera->name}} </p></div> 
	  		<div class="col-md-3"><p class="text-center"><b>Turno: </b> {{$cabecera->turno}} </p></div>
	  		<div class="col-md-3"><p class="text-right"> <b>Fecha: </b> <?php $fv= new DateTime($cabecera->fecha_asistencia); echo $fv->format('d-m-Y'); ?></p></div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<input type="hidden" name="idAsistencia" id="idAsistencia" value="{{$cabecera->id}}">
				</div>
			</div>
		</div>
	</div>
	<div class="row">
        <div class="col-lg-12">
            <div align="left">
                <a class="btn btn-info" href="{{route ('asistencia.mostrar_planilla')}}" name="regresar"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Regresar</a>
            </div>
        </div>
    </div>
    <br>
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-verasistencia" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th> # </th>
                        <th> N° de Asistencia</th>
                        <th> N° de Carnet </th>
                        <th> Nombre y Apellido </th>
                        <th> DNI </th>
                       	<th> Hora de Ingreso </th> 
						<th> Vencimiento de Arancel </th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
	<script type="text/javascript">
		$(function(){
			var id= $("#idAsistencia").val();
			$("#data-table-verasistencia").DataTable({
				proccesing: true,
				serverSide:true,
				info:false,
				"language":{
					"url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
				},
				ajax:{
					url: "http://127.0.0.1:8000/asistencia/mostrar_asistencia/"+ id,
					type:"GET",
				},
				columns:[
					{data:'asistencia_id', name:'asistencia_id'},
					{data: 'id', name: 'id'},
					{data: 'ficha_id', name:'ficha_id'},
					{data: 'nombre_usuario', name:'nombre_usuario'},
					{data: 'dni', name:'dni'},
					{data: 'hora_ingreso', name:'hora_ingreso'},
					{data: 'ultimo_arancel', name:'ultimo_arancel'}
				],
				order: [[0, 'asc']]
			});
		});
	</script>
@endpush