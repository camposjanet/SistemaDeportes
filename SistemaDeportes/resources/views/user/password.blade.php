@extends('layouts.home')

@section('content')
			<h1 align="center">ACTUALIZAR CONTRASEÑA</h1> 
			<h3 align="center"> Está por actualizar la contraseña del personal <b> {{$user->name}} </b> </h3>
			<hr sytle="size: 0px; border: none;">
			<div style="display: flex; align-items:center; justify-content: center;">
				{!! Form::open(['route'=>['user.updatepassword',$user->id],'method'=>'POST','autocomplete'=>'off'])!!}
				{{Form::token()}}
					<table>
						<tr> 
							<td> {!! Field::password('password', ['class'=>'awesone'])!!} </td>
						</tr>
						<tr> 
							<td> {!! Field::password('password_confirmation', ['class'=>'awesone'])!!} </td>
						</tr>
						<tr>
							<td> <div class="form-group mx-auto">
								<a class="btn btn-danger btn-lg" href="{{ route('user.index') }}" role="button"> 
								<i class="fa fa-ban" aria-hidden="true"></i> Cancelar </a>
								<button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Guardar</button>
								</div> 
							</td>
						</tr>
					</table>
				{!!Form::close()!!} 
			</div>
@endsection