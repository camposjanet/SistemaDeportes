@extends('layouts.home')

@section('content')
			<h1 align="center">ACTUALIZAR DATOS DE PERSONAL DE DEFyD</h1> 
			<hr sytle="size: 0px; border: none;">
			<div style="display: flex; align-items:center; justify-content: center;">
				
				{!! Form::model($user, ['route'=>['user.update',$user->id], 'method'=>'PUT']) !!}
				{{Form::token()}}
					<div class="form-group">
						{!! Form::label('name','Nombre de Usuario') !!}
						{!! Form::text('name',null,['class'=> 'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('email','Correo electrónico') !!}
						{!! Form::email('email',null, ['class'=> 'form-control']) !!}
					</div>
					<div class="form-group mx-auto">
						<a class="btn btn-danger btn-lg" href="{{ route('user.index') }}" role="button"> 
							<i class="fa fa-ban" aria-hidden="true"></i> Cancelar </a>
						<button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Actualizar</button>
					</div>
				{!!Form::close()!!} 
			</div> 
			
@endsection


