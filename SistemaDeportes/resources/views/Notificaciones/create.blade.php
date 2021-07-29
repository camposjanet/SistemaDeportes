@extends('layouts.home')

@section('content')

		<h1 align="center">ENVIAR MAIL DE NOTIFICACION DE ARANCEL</h1> 
		<hr sytle="size: 0px; border: none;">
		<h3 align="center">
			¡Atención! <b> {{Auth::user()->name}} </b> ¿Desea notificar a todos los usuarios que al día de la fecha adeudan Aracel?
		</h3>
		<span class="border border-white"></span>

		<div style="display: flex; align-items:center; justify-content: center;">
			{!! Form::open(['route'=>['Notificaciones.store', Auth::user()->id],'method'=>'POST'])!!}
			{{Form::token()}}
				<div class="form-group mx-auto">
					<a class="btn btn-danger btn-lg" href="{{ route('Notificaciones.index') }}" role="button"> 
						<i class="fa fa-ban" aria-hidden="true"></i> Cancelar </a>
					&nbsp;
					<button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Notificar</button>
				</div> 
			{!!Form::close()!!}
		</div>			
			
@endsection
