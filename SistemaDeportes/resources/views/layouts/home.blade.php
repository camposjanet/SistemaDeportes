<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Deportes</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('bootstrap-4.5.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{asset('DataTables-1.10.21/css/jquery.dataTables.min.css')}}">
 </head>
  <body class="hold-transition  sidebar-mini">
    <div class="wrapper bg-dark" >
        
        <header class="main-header" >
            <a href="#" class="sidebar-toggle text-white" data-toggle="offcanvas" role="button">
                <span class="sr-only">Navegación</span> 
            </a>
            <a href="/inicio" class="logo logo-lg" style=" padding-left: 7px; padding-right: 3px; max-width: 240px">
                <!-- <span class="logo-mini text-white" ><b>SD</b></span> ; min-width: 40px-->
                <span class="logo-lg text-white" style="font-size: 18px; ">Sistema de Deportes</span>
            
            </a>
            

            <nav class="navbar navbar-static-top navbar-dark bg-dark" role="navigation" >
                <!-- <a href="#" class="sidebar-toggle text-white" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Navegación</span>
                </a> -->
                <p class="t text-white mt-2" style="float: left;">
                    DIRECCIÓN DE EDUCACIÓN FÍSICA Y DEPORTES
                    <br>
                    Universidad Nacional de Salta
                </p>
                
                <div class="navbar-custom-menu  ">
                    <div class="nav navbar-nav">
                        <li class="dropdown">
                            <button class="btn bg-dark dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->name }}   <i class="fa fa-user"></i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuButton">
                                <li><h6 class="dropdown-header">{{ Auth::user()->roles->first()->nombre_rol }}</h6></li>
                                <div class="dropdown-divider"></div>
                                <li class="dropdown-item" ><a href="#"><i class="fa fa-btn fa-pencil"></i>  Modificar Contraseña</a></li>
                                <li class="dropdown-item"><a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-btn fa-power-off"></i>  Cerrar Sesión </a>  
															<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            					{{ csrf_field() }}
                                        					</form>
                                 </li>
                            </ul>
                        </li>
                    </div>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar  bg-dark" style=" width: 230px;">
            <section class="sidebar" style="padding-top: 15px">
                <ul class="sidebar-menu">
                    <li class="header text-white" style="font-size: 15px; ">
                        Menú del Sistema
                    </li>

                    <li class="treeview">
                        <a href="{{url('inicio/')}}" class="text-white">
                            <i class="fa fa-home fa-fw"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    
                    @if(Auth::user()->roles->first()->nombre_rol=="Administrador" || Auth::user()->roles->first()->nombre_rol=="Operario")
                        <li class="treeview">
                            <a href="{{url('usuarios/')}}" class="text-white">
                                <i class="fa fa-users"></i>
                                <span>Usuarios</span>
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->roles->first()->nombre_rol=="Administrador" || Auth::user()->roles->first()->nombre_rol=="Profesor")
                        <li class="treeview">
                            <a href="menuasistencia" class="text-white">
                                <i class="fa fa-calendar"></i>
                                <span>Control de Asistencia</span>
                            </a>
                        </li>
                    @endif

                    @if(Auth::user()->roles->first()->nombre_rol=="Administrador" || Auth::user()->roles->first()->nombre_rol=="Operario")
                        <li class="treeview" >
                            <a href="#"  class="text-white">
                                <i class="fa fa-usd"></i>
                                <span>Pagos</span>
                            </a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->roles->first()->nombre_rol=="Administrador")   
                        <li class="treeview">
                            <a href="{{url('users/')}}"  class="text-white">
                                <i class="fa fa-user"></i>
                                <span>Personal DEFyD</span>
                            </a>
                        </li>
                    @endif   
                                
                </ul>
            </section>
        </aside>
      <div class="content-wrapper  bg-white">
        <section class="content bg-white" >
          <div class="row">
            <div class="col-lg-12">
                @yield('content')
            </div>
          </div>
        </section>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery-3.5.1.slim.min.js')}}"></script>

    
    <!-- jQuery DataTables-1.10.21-->
    <script src="{{asset('js/jquery.js')}}"></script>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/datatables.min.js"></script> -->
    <!-- DataTables DataTables-1.10.21-->
    <script src="{{asset('DataTables-1.10.21/js/jquery.dataTables.min.js')}}"></script>
    @stack('scripts')
    <script src="{{asset('bootstrap-4.5.0/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/app.min.js')}}"></script>
  </body>
</html>
