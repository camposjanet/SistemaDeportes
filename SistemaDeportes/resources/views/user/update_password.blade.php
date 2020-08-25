@extends('layouts.home')

@section('content')

		<h1 align="center">REGISTRAR PERSONAL DEFyD</h1> 
		<hr sytle="size: 0px; border: none;"> 
		<div style="display: flex; align-items:center; justify-content: center;"> 
			<!--{!! Form::open(['route'=>['user.newpassword',$user->id],'method'=>'POST','autocomplete'=>'off'])!!} -->
			{!! Form::model($user, ['route'=>['user.newpassword',$user->id], 'method'=>'PUT']) !!}
			{{Form::token()}}
					<div class="form-group">
						{!! Form::label('password','Contraseña') !!}
						{!! Form::password('password',null,['class'=> 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('password_confirmation','Confirmar Contraseña') !!}
						{!! Form::password('password_confirmation',null, ['class'=> 'form-control']) !!}
					</div>
					<div class="form-group mx-auto">
						<a class="btn btn-danger btn-lg" href="{{ route('user.index') }}" role="button"> 
							<i class="fa fa-ban" aria-hidden="true"></i> Cancelar </a>
						<button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Actualizar</button>
					</div>
			{!!Form::close()!!}
		</div>			
			

		<!--
			<table>
						<tr> 
							<td> {!! Field::password('password', ['class'=>'awesone'])!!} </td>
						</tr>

						<tr> 
							<td> {!! Field::password('password_confirmation', ['class'=>'awesone'])!!} </td>
						</tr>
						<tr>
							<td> <div class="form-group mx-auto">
								{!! Form::reset(' Limpiar datos',['class'=>'btn btn-danger btn-lg'])!!}
								<button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Actualizar</button>
								</div> 
							</td>
						</tr>
					</table>
		-->				
@endsection