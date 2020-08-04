@extends('layouts.home')

@section('content')
			<h1 align="center">ACTUALIZAR DATOS DE PERSONAL DE DEFyD</h1> 
			<hr sytle="size: 0px; border: none;">
			<div style="display: flex; align-items:center; justify-content: center;"> 
				{!! Form::model($user, ['method' => 'POST','action'=> ['UserController@update',$user->id]]) !!}
				{{Form::token()}}
					<div class="form-group">
						<label for="name"> Nombre Usuario </label>
						<input type="text" class="form-control" id="name" value="{{ $user->name }}">
						<input type="hidden" name="_method" value="PUT">
					</div>
					<div class="form-group">
						<label for="email"> Correo </label>
						<input type="email" class="form-control" id="email" value="{{ $user->email }}">
					</div>
					<div class="form-group mx-auto">
						<a class="btn btn-danger btn-lg" href="{{ route('user.index') }}" role="button"> 
							<i class="fa fa-ban" aria-hidden="true"></i> Cancelar </a>
						<button type="button" class="btn btn-primary btn-lg" type="submit"> 
							<i class="fa fa-save"></i> Actualizar</button>
						</div>
				{!!Form::close()!!} 
			</div> 
			<!--<h1 align="center">ACTUALIZAR DATOS DE PERSONAL DE DEFyD</h1> 
			<hr sytle="size: 0px; border: none;">
			<div style="display: flex; align-items:center; justify-content: center;"> 
				<form method="post" actcion="/user/{{$user->id}}">
					{{csrf_field()}}
					<div class="form-group">
						<label for="name"> Nombre Usuario </label>
						<input type="text" class="form-control" id="name" value="{{ $user->name }}">
 						<input type="hidden" name="_method" value="PUT">
					</div>
					<div class="form-group">
						<label for="email"> Correo </label>
						<input type="email" class="form-control" id="email" value="{{ $user->email }}">
					</div>
					<div class="form-group mx-auto">
						<a class="btn btn-danger btn-lg" href="{{ route('user.index') }}" role="button"> 
							<i class="fa fa-ban" aria-hidden="true"></i> Cancelar </a>
						<button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Actualizar</button>
					</div>
				</form>
			</div> -->
@endsection


