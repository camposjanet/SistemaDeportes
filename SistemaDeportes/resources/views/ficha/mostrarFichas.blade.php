@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mt-4">
    <div class="col-md-12" >
            @if (($usuario->foto)!="")
                <div class="media">
                    <div class="media-body" align="center">
                        <br>
                        <h1 class="media-heading"> FICHAS DEL USUARIO</h1>
                    </div>
                    <div class="media-right">
                        <img class="media-object" src="{{asset('img/usuarios/'.$usuario->foto)}}" style="border:1px solid #b0b8b9;" height="90px" width="100px">
                    </div>
                </div>
                <br>
            @else
                <div class="media-body" align="center">
                    <br>
                    <h1 class="media-heading">FICHAS DEL USUARIO</h1>                
                </div>
            @endif
        </div>
        <div class="col-md-5" >
            <h5 name="nombre_usuario"><b>Usuario:</b> {{$usuario->apellido}}, {{$usuario->nombre}} </h5>    
        </div>
        <div class="col-md-3" >
            <h5 name="dni_usuario"><b>DNI:</b> {{$usuario->dni}}</b></h3>
        </div>
        <div class="col-md-4" >
            <h5 name="fecha_nacimiento_usuario"><b>Fecha de Nacimiento:</b> <?php $fv = new DateTime($usuario->fecha_de_nacimiento); echo $fv->format('d-m-Y');?></h5>
        </div>     
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div align="left">
                <a href="{{URL::action('FichaController@create',$usuario->id)}}"><button class="btn  btn-primary"><i class="fa fa-plus"></i> Agregar Ficha</button></a>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-borderless table-hover text-center" id="data-table-fichas" cellspacing="0" width="100%" style="border-bottom:2px solid #D8D8D8; border-top:2px solid #D8D8D8 ">
                    <thead class="thead-dark">
                        <th>Nº</th>
                        <th>Categoría</th>
                        <th>Documentación</th>
                        <th>Estado</th>
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
        $('#data-table-fichas').DataTable({
            processing: true,
            serverSide: true,
            info: false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            ajax: {
                
                url: "{{ route('fichas.mostrar', $usuario->id) }}"
            },
            columns: [
                    {  data: 'id', name: 'id', 'visible': true},
                    
                    {  data: 'categoria', name: 'categoria' },
                    {  data: 'documentacion', name: 'documentacion'},
                    {  data: 'estado', name: 'estado'},
                    
                    {  data: 'action', name: 'action', orderable: false}
                ],
            order: [[0, 'desc']]
        });
    });
</script>
@endpush