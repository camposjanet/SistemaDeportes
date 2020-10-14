

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
				<p class="lead">Se ha enviado un email a su correo electrónico con la Nueva 
                Contraseña. Por favor ingrese a su correo <b>{{$user->email}}</b>.</p>
			</div>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="col-md-6 text-center" >
                <a class="btn btn-success m-1" href="{{ route('login') }}"> Volver </a>
			</div>
		</div>
	</div>
		
	</main><!-- /.container -->
	</body>
</html>


