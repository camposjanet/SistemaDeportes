<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

	<!--
    <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <!-- CSRF Token -->
   <!--  <meta name="csrf-token" content="{{ csrf_token() }}"> -->

	
	<!--
    <title>{{ config('app.name', 'Sistema Deportes U.N.Sa') }}</title> -->
	<title> Sistema Deportes U.N.Sa </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-image: url('/img/Unsa_Entrada_desenfocado.png');
			background-size: cover; 
			background-repeat: no-repeat; 
			height:100%; 
			font-famiily: 'Numans',sans-serif;">
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
