@extends('layouts.home')

@section('content')
			<h1 align="center">ACTUALIZAR DATOS DE PERSONAL DE DEFyD</h1> 
			<hr sytle="size: 0px; border: none;">
			<div style="display: flex; align-items:center; justify-content: center;"> 
				<div class="card" style="height: 320px;margin-top: auto;margin-bottom:auto;width: 350px; !important;"> 
					<div class="card-body">
						{!! Form::open(['route'=>'user.actualizar','method'=>'POST', 'files'=>true])!!}
						{{Form::token()}}
							<div class="form-group">
								<label for="name"> Nombre Usuario </label>
								<input type="text" class="form-control" id="name" value="{{ $user->name }}">
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

											<!--<from method="post">
														<a class="btn btn-danger btn-lg" href="{{ route('user.index') }}" role="button"> 
																<i class="fa fa-ban" aria-hidden="true"></i> Cancelar </a>
														<button type="button " class="btn btn-primary btn-lg" type="submit"> <i class="fa fa-save"></i> Actualizar</button>
											</from> -->
										</div>
								</div>
						</div>
@endsection


