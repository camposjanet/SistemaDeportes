@extends('layouts.home')

@section('content')
<div class="container">
    
    {!! Form::open(['route'=>'importe.store', 'method'=>'POST','autocomplete'=>'off'])!!}
    {{Form::token()}}
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
    <div class="d-flex flex-column">
        <div class="col-md-12 text-center" >
            <h1>REGISTRAR IMPORTE </h1>
        </div>
        <div class="bd-highlight d-flex justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Field::text('nro_resolucion',null, ['class'=>'form-control'])!!}
                </div>
            </div>
        </div>
        <div class="bd-highlight d-flex justify-content-center">
            <div class="col-md-6">
                {!! Field::select('id_tipo_de_arancel', $tipos, ['class'=>'select-tipos','empty'=>'Seleccione tipo de arancel'])!!}
            </div>
        </div>
        <div class="bd-highlight d-flex justify-content-center">
            <div class="col-md-6">
                {!! Field::select('id_categoria', $categorias, ['class'=>'select-categorias','empty'=>'Seleccione una categoría'])!!} 
            </div>
        </div>
        <div class="bd-highlight d-flex justify-content-center">
            <div class="col-md-6">
                <label >Importe *</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-importe"><b>$</b></span>
                    </div>
                    <input type="numeric" class="form-control" placeholder="0.00" aria-label="importe" aria-describedby="basic-importe" name="importe" value="{{old('importe')}}">
                </div>
            </div>
        
        </div>
        <!-- <div class="col-md-12 text-center" >
            <h1>REGISTRAR ARANCEL </h1>
        </div>
        
        <div class="col-md-6">
            <div class="form-group">
                {!! Field::text('nro_resolucion',null, ['class'=>'form-control'])!!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="col-md-6">
            {!! Field::select('id_categoria', $categorias, ['class'=>'select-categorias','empty'=>'Seleccione una categoía'])!!} 
        </div>{!! Field::select('id_tipo_de_arancel', $tipos, ['class'=>'select-tipos','empty'=>'Seleccione tipo de arancel'])!!} 
        </div>

        
        
        
        <div class="col-md-6">
            <label >Importe *</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-importe"><b>$</b></span>
                </div>
                <input type="numeric" class="form-control" placeholder="0.00" aria-label="importe" aria-describedby="basic-importe" name="importe" value="{{old('importe')}}">
            </div>
        </div>
         -->
        <div class="form-group mx-auto">
            
            {!! Form::reset(' Limpiar datos',['class'=>'btn btn-danger btn-lg'])!!}
            <button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Guardar</button>
        </div>
    </div>
    {!!Form::close()!!}

</div>
@endsection