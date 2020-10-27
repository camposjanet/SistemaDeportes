

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recuperar contraseña</title>

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
				<h1 class="text-center">RECUPERACIÓN DE CONTRASEÑA</h1>
				<p class="lead">¡Importante!<br>
				Ingrese su <b>Correo Electrónico</b> o su <b>Nombre de Usuario</b>, luego presione el botón "Enviar". Automáticamente se le enviará una NUEVA CONTRASEÑA con la que podrá ingresar al Sistema.</p>
			
			</div>
		</div>

		<div class="row d-flex justify-content-center">
			<div class="col-md-6">
				@if(Session::has('datos_erroneos'))
					<div class="alert alert-danger" role="alert">
						{{session('datos_erroneos')}}
					</div>
				@endif
				<form method="POST" action="{{ route('recuperar.contraseña') }}">
					{{csrf_field()}}
					<div class="form-group">
						<label for="email">Correo Electrónico</label>
						<input type="email" class="form-control" name="email" value="{{old('email')}}">
					</div>
					<div class="form-group">
						<label for="name">Nombre de usuario</label>
						<input type="text" class="form-control" name="name" value="{{old('name')}}">
					</div>
					<div class="d-flex justify-content-center">
						<a class="btn btn-danger m-1" href="{{ route('login') }}"> Cancelar </a>
						<button class="btn btn-primary m-1"> Enviar </button>
					</div>
				</form>
				
			</div>
			
		</div>
	</div>
		
	</main><!-- /.container -->
	</body>
</html>


