@extends('layouts.home')

@section('content')

	<div class="container">
		<div class="row d-flex justify-content-center mt-4">
        	<h1> NOTIFICACIÓN VENCIMIENTO DE ARANCELES</h1>         
        </div>
        <div class="row d-flex justify-content-center mt-4">
        	<h3>LISTADO DE REMITENTES</h3>            
        </div>
    </div>
    <hr sytle="size: 0px; border: none;">
		<div class="row">
        	<div class="col-lg-12">
            	<div align="left">
                	<a href="#" data-toggle="modal" data-target="#ModalNotificar" class="btn btn-primary btn-lg"> <i class="fa fa-user-plus"></i> Notificar </a>
            	</div>
            </div>
        </div>
    <br>
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-remitentes" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th> # </th>
                        <th> Operario </th>
                        <th> fecha </th>
                        <th> hora </th>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@include('Notificaciones.modal_notificacion')
@endsection

@push('scripts')
	<script type="text/javascript">
		$(function(){
			$("#data-table-remitentes").DataTable({
				proccesing: true,
				serverSide:true,
				info:false,
				"language":{
					"url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
				},
				ajax:{
					url: "http://127.0.0.1:8000/notificaciones",
					type:"GET",
				},
				columns:[
					{data:'id', name:'id'},
					{data: 'name', name: 'name'},
					{data: 'fecha_envio', name:'fecha_envio'},
					{data: 'hora_envio', name:'hora_envio'},
				],
				order: [[0, 'desc']]
			});
		});
	</script>
@endpush