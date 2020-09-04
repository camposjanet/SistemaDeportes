@extends('layouts.app')

@section('content')
<div class="container" style="height:100%; align-content:center;"> 
				@if(Session::has('no_valido'))
					<div style="display: flex; align-items:center; justify-content: center;"> <!-- display: flex; -->
						<div class="card" style="height: 100px; width: 900px;background-color: rgba(63,146,81,0.5) !important;">
							<div class="card-body">
								<p 	class="text-white text-center"> {{session('no_valido')}} </p>
							</div>
						</div>
					</div>
				@endif
				<div style="display: flex; align-items:center; justify-content: center; min-height: 100vh;">
				    	<div class="card" style="height: 370px;margin-top: auto;margin-bottom:auto;width: 400px;background-color: rgba(0,0,0,0.5) !important;">
				        	<div class="card-header"> <h3 align="center" style="color:white"> {{ __('Dirección de Educación Física y Deportes') }}</h3> </div>

				       		 	<div class="card-body">

				            		<form method="POST" action="{{ route('login')}}"> 
											{{csrf_field()}}
										<div class="form-group {{ $errors->has('name')? 'has-error': ''}} ">
											<font color="red">{!! $errors->first('name','<span class="help-block">:message </span>') !!} </font>
											<input class="form-control"
													name="name"
													value="{{ old('name')}}" 
													placeholder="Ingrese su Usuario">
										</div>
						
										<div class="form-group {{ $errors->has('password')? 'has-error': ''}}">
											<font color="red"> {!! $errors->first('password','<span class="help-block">:message </span>') !!} </font>
											<input class="form-control" 
													type="password" 
													name="password" 
													placeholder="Ingrese su contraseña">
									
										</div>
										<div>
											<button class="btn btn-primary btn-block"> Acceder </button>
										</div>
									</form>

				        	</div>
							<div class="card-footer">
								<div class="d-flex justify-content-center">
									<a href="#"> ¿Ha olvidado su contraseña?</a> 
								</div>
							</div>
				</div>
    	</div>
</div>
@endsection
