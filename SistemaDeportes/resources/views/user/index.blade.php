@extends('layouts.home')

@section('content')
 <div class="container">
    <div class="row d-flex justify-content-center mt-4">
        <h1>USUARIO</h1>            
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div align="left">
                <a href='user/create'><button class="btn  btn-primary"><i class="fa fa-user-plus"></i> Agregar</button></a>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-users" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th> # </th>
                        <th> Nombre Usuario </th>
                        <th> E-mail </th>
                       	<th> Rol </th> 
						<th> Estado </th>
                        <th> Acciones </th>
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
        $('#data-table-users').DataTable({
            processing: true,
            serverSide: true,
            info: false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            ajax: {
                url: "users",
                type: 'GET',
            },
            columns: [
                    {data: 'id', name: 'id', 'visible': true},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email', orderable: false},
                    {data: 'nombre_rol', name: 'nombre_rol'},
                    {data: 'estado', name: 'estado'},
                    {data: 'action', name: 'action', orderable: false}
                ],
            order: [[0, 'asc']]
        });
    });
</script>
@endpush 

