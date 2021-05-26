@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-4">
        <h1 >IMPORTES</h1>            
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div align="left">
                <a href='importes/create'><button class="btn  btn-primary"><i class="fa fa-folder"></i> Agregar</button></a>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 mt-1">
            @if(Session::has('exito_registrar_importe'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('exito_registrar_importe')}}
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
                <table class="table table-borderless table-hover text-center" id="data-table-importes" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th>#</th>
                        <th>Tipo de Arancel</th>
                        <th>Categoría</th>
                        <th>Nº de Resolución</th>
                        <th>Importe</th>
                        <th>Estado</th>
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
        $('#data-table-importes').DataTable({
            processing: true,
            serverSide: true,
            info: false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            ajax: {
                url: "importes",
                type: 'GET',
            },
            columns: [
                    {  data: 'id', name: 'id', 'visible': true},
                    {  data: 'nombre', name: 'nombre' },
                    {  data: 'categoria', name: 'categoria' },
                    {  data: 'resolucion', name: 'resolucion'},
                    {  data: 'importe', name: 'importe' },
                    {  data: 'estado', name: 'estado' }
                ],
            order: [[5, 'desc']]
        });
    });
</script>
@endpush
