@extends('layouts.home')

@section('content')
<div class="container">
    <h1 align="center"> PLANILLAS DE ASISTENCIAS </h1>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item active" aria-current="page"></li>
    </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div align="left">
                <a class="btn btn-info" href="{{route ('asistencia.index')}}" name="regresar"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Regresar</a>
            </div>
        </div>
    </div>
    <br>
	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-planilla" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th> # </th>
                        <th> Profesor </th>
                        <th> Turno </th>
                        <th> Fecha </th>
                       	<th> Accionese </th> 
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		$(function(){
			$("#data-table-planilla").DataTable({
				processing: true,
				serverSide: true,
				info: false,
				"language": {
                	"url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                },
                ajax:{
                	url:"mostrar_planilla",
                	type:"GET",
                },
                columns:[
				{data: 'id',name: 'id'},
				{data: 'name', name:'name'},
				{data: 'turno', name:'turno'},
				{data: 'fecha_asistencia', name:'fecha_asistencia'},
				{data: 'action', nane:'action'},
				],
				order: [[0, 'des']]
			});
		});
	</script>
@endpush