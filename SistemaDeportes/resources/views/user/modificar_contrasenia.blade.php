@extends('layouts.home')

@section('content')
	<h1 align="center">MODIFICAR CONTRASEÑA</h1> 
	<hr sytle="size: 0px; border: none;">
	<div style="display: flex; align-items:center; justify-content: center;">
		<form method="POST" action="{{ route('user.modificarcontrasenia', Auth::user()->id) }}">
			{{csrf_field()}}
			{!! Field::password('oldpassword',['class'=>'form-control','value'=>'old(oldpassword)'])!!}

			{!! Field::password('newpassword',['class'=>'form-control','value'=>'old(newpassword)'])!!}

			{!! Field::password('newpassword_confirmation',['class'=>'form-control','value'=>'old(newpassword_confirmation)'])!!}
						
			
			<div class="form-group d-flex justify-content-center">
				<a class="btn btn-danger m-1" href="{{ route('home') }}"> Cancelar </a>
				{!! Form::submit('Guardar cambios',['class'=>'btn btn-primary m-1'])!!}
			</div>
		</form>
	</div>
@endsection
