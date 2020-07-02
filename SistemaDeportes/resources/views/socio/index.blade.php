@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-4">
        <h1 >SOCIOS</h1>            
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div align="left">
                <a href='socio/create'><button class="btn  btn-primary"><i class="fa fa-user-plus"></i> Agregar</button></a>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-socio" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>E-mail</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Documentación</th>
                        <th>Acciones</th>
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
        $('#data-table-socio').DataTable({
            processing: true,
            serverSide: true,
            info: false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            ajax: {
                url: "socios",
                type: 'GET',
            },
            columns: [
                    { data: 'id', name: 'id', 'visible': true},
                    
                    { data: 'nombre_apellido', name: 'nombre_apellido' },
                    { data: 'dni', name: 'dni', orderable: false},
                    { data: 'email', name: 'email', orderable: false},
                    { data: 'telefono_celular', name: 'telefono_celular', orderable: false },
                    {data: 'estado', name: 'estado'},
                    {data: 'estado_documentacion', name: 'estado_documentacion', orderable: false},
                    {data: 'action', name: 'action', orderable: false}
                ],
            order: [[0, 'asc']]
        });
    });
</script>
@endpush