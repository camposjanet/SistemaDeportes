@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('login')}}"> 
						{{csrf_field()}}
						<div class="form-group {{ $errors->has('nombre_rol')? 'has-error': ''}}">
							{!! $errors->first('nombre_rol','<span class="help-block">:message </span>') !!}
							<input class="form-control" 
									type="string" 
									name="nombre_rol" 
									placeholder="Ingrese Usuario">
									
						</div>
						<div class="form-group {{ $errors->has('password')? 'has-error': ''}}">
							{!! $errors->first('password','<span class="help-block">:message </span>') !!}
							<input class="form-control" 
									type="password" 
									name="password" 
									placeholder="Ingresa tu password">
									
						</div>
						<button class="btn btn-primary btn-block"> Acceder </button>
					</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
