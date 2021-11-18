@extends('layouts.home')

@section('content')

	<div class="container">
		<div class="row d-flex justify-content-center mt-4">
        	<h1> ALBERGUE UNIVERSITARIO</h1>         
        </div>
    </div>
    <hr sytle="size: 0px; border: none;">
		<div class="row">
        	<div class="col-lg-12">
            	<div align="left">
                	<a href="#" class="btn btn-primary btn-lg"> <i class="far fa-plus-square"></i> Agregar </a>
            	</div>
            </div>
        </div>
    <br>
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-albergue" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th> # </th>
                        <th> Nombre de Albergue </th>
                        <th> Total </th>
                        <th> Disponible </th>
                        <th> Estado </th>
                        <th> Acciones </th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
	<script type="text/javascript">
		$(function(){
			$("#data-table-albergue").DataTable({
				proccesing: true,
				serverSide:true,
				info:false,
				"language":{
					"url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
				},
				ajax:{
					url: "albergues",
					type:"GET",
				},
				columns:[
					{data:'id', name:'id'},
					{data: 'nombre_albergue', name: 'nombre_albergue'},
					{data: 'cupo_total', name: 'cupo_total'},
					{data: 'cupo_disponible', name: 'cupo_disponible'},
					{data: 'estado' , name:'estado'},
					{data: 'action', name:'action'},
				],
				order: [[0, 'asc']]
			});
		});
	</script>
@endpush