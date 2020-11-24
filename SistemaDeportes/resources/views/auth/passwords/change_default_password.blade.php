

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Modificar contraseña</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="{{asset('bootstrap-4.5.0/css/bootstrap.min.css')}}">

    <style>
      
	  body {
		padding-top: 5rem;
		}
		.starter-template {
		padding: 3rem 1.5rem;

		}
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  		<p class="navbar-brand text-white m-1" style="float: left;">
			DIRECCIÓN DE EDUCACIÓN FÍSICA Y DEPORTES
			<br>
			Universidad Nacional de Salta
		</p>
	</nav>

	<main role="main" class="container">

	<div class="starter-template">
		<div class="row d-flex justify-content-center">

			<div class="col-md-8">
				<h1 class="text-center">MODIFICAR CONTRASEÑA</h1>
				<p class="lead">
				Ud ha realizado una recuperación de contraseña por mail o bien el Administrador le ha
				asignado una. Por favor modifique su contraseña por seguridad.</p>
			
			</div>
		</div>

		<div class="row d-flex justify-content-center">
			<div class="col-md-6">
				@if(Session::has('datos_erroneos'))
					<div class="alert alert-danger" role="alert">
						{{session('datos_erroneos')}}
					</div>
				@endif

				<form method="POST" action="{{ route('user.defaultPassword') }}">
					{{csrf_field()}}
					{!! Field::password('oldpassword',['class'=>'form-control','value'=>'old(oldpassword)'])!!}

					{!! Field::password('newpassword',['class'=>'form-control','value'=>'old(newpassword)'])!!}

					{!! Field::password('newpassword_confirmation',['class'=>'form-control','value'=>'old(newpassword_confirmation)'])!!}
						
			
					<div class="form-group d-flex justify-content-center">
						<a class="btn btn-danger m-1" href="{{ route('login') }}"> Cancelar </a>
						{!! Form::submit('Guardar cambios',['class'=>'btn btn-primary m-1'])!!}
					</div>
				</form>
			</div>
			
		</div>

		 
	</div>
		
	</main><!-- /.container -->
	</body>
</html>


