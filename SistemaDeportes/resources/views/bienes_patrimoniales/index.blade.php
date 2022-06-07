@extends('layouts.home')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-4">
        <h1>BIENES PATRIMONIALES</h1>            
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div align="left">
                <a href="{{url('bienespatrimoniales/create')}}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button></a>
            </div>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-bienespatrimoniales" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th>Nº</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection
@push('scripts')
<script>
    $(function () {
        console.log("datatable");
        $('#data-table-bienespatrimoniales').DataTable({
            processing: true,
            serverSide: true,
            info: false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            ajax: {
                url: "bienespatrimoniales",
                type: 'GET',
            },
            columns: [
                    {  data: 'id', name: 'id', 'visible': true},
                    {  data: 'nombre', name: 'nombre'},
                    {  data: 'action', name: 'action', orderable: false}
                ],
            order: [[0, 'desc']]
        });
    });
</script>
@endpush

