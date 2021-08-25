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
    <!--<link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">-->
    <script src="https://kit.fontawesome.com/53e0ed4112.js" crossorigin="anonymous"></script>

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
                                <li class="dropdown-item" ><a href="{{ route('user.irmodificarcontrasenia') }}"><i class="fa fa-btn fa-pencil"></i>  Modificar Contraseña</a></li>
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
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="albergue" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-hotel"></i>
                                Albergue
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#"><i class="fas fa-bed"></i> Albergue </a>
                                    <a class="dropdown-item" href="#"> <i class="fas fa-couch"></i> Bienes Patrimoniales </a>
                            </div>
                        </li> -->

                        <!--<a href="#demo4" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu">Item 4  <i class="fa fa-caret-down"></i></a>
                            <div class="collapse" id="demo4">
                                <a href="" class="list-group-item">Subitem 1</a>
                                <a href="" class="list-group-item">Subitem 2</a>
                                <a href="" class="list-group-item">Subitem 3</a>
                            </div> -->

                        <!--<a href="#demo3" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu"><i class="fas fa-hotel"></i> Albergue</a>
                        <div class="collapse" id="albergue">
                            <a href="#Submenu1" class="list-group-item" data-toggle="collapse" data-parent="#Submenu1">
                            <div class="collapse list-group-submenu" id="albergue">
                                <a href="#" class="list-group-item" data-parent="#SubMenu1"><i class="fas fa-bed"></i> Albergue</a>
                                <a href="#" class="list-group-item" data-parent="#SubMenu1"></i> Bienes Patrimoniales </a>
                            </div>
                        </div> -->
                        <li class="treeview">
                            <a href="#MenuAlbergue" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white" aria-controls="collapseExample"> <i class="fas fa-hotel"> </i><span> Albergue </span></a>
                            <ul class="collapse"id="MenuAlbergue">
                                <li>
                                    <a class="text-white" href="#"><i class="fas fa-bed"></i> <span> Albergue </span> </a>
                                </li>
                                <li>
                                   <a class="text-white" href="#"> <i class="fas fa-couch"></i><span> Bienes Patrimoniales </span></a> 
                                </li>
                            </ul>
                        </li> 
                    @endif  
                    
                    @if(Auth::user()->roles->first()->nombre_rol=="Administrador" || Auth::user()->roles->first()->nombre_rol=="Operario" || Auth::user()->roles->first()->nombre_rol== "Profesor")
                        <!--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="salamusculacion" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-dumbbell"></i>

                                Sala de Musculación
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->roles()->first()->nombre_rol=="Administrador" || Auth::user()->roles()->first()->nombre_rol=="Operario")
                                    <a class="dropdown-item" href="usuarios"><i class="fa fa-users"></i> Usuarios</a>
                                    @endif
                                    @if(Auth::user()->roles()->first()->nombre_rol=="Administrador" || Auth::user()->roles()->first()->nombre_rol=="Profesor")
                                    <a class="dropdown-item" href="{{url('asistencia/menuasistencia')}}"><i class="fa fa-calendar"></i>Control Asistencia</a>
                                    @endif
                                    @if(Auth::user()->roles()->first()->nombre_rol=="Administrador" || Auth::user()->roles()->first()->nombre_rol=="Operario")
                                    <a class="dropdown-item" href="{{url('arancel/index')}}"> <i class="fa fa-usd"></i> Pagos</a>
                                    @endif
                            </div>
                        </li> -->
                        <li class="treeview">
                            <a href="#MenuSalamusculacion" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white"> <i class="fas fa-dumbbell"></i><span> Sala de Musculación </span></a>
                            <ul class="collapse" id="MenuSalamusculacion">
                                @if(Auth::user()->roles()->first()->nombre_rol=="Administrador" || Auth::user()->roles()->first()->nombre_rol=="Operario")
                                    <li>
                                        <a class="text-white" href="usuarios"><i class="fa fa-users"></i><span> Usuarios </span></a>
                                    </li>
                                @endif
                                @if(Auth::user()->roles()->first()->nombre_rol=="Administrador" || Auth::user()->roles()->first()->nombre_rol=="Profesor")
                                    <li>
                                        <a class="text-white" href="{{url('asistencia/menuasistencia')}}"><i class="fa fa-calendar"></i><span> Control Asistencia </span></a>
                                    </li>
                                @endif
                                @if(Auth::user()->roles()->first()->nombre_rol=="Administrador" || Auth::user()->roles()->first()->nombre_rol=="Operario")
                                    <li>
                                        <a class="text-white" href="{{url('arancel/index')}}"> <i class="fa fa-usd"></i><span> Pagos </span></a>
                                    </li>
                                @endif
                            </ul>
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

                    @if(Auth::user()->roles->first()->nombre_rol=="Administrador" || Auth::user()->roles->first()->nombre_rol=="Operario")
                        <li class="treeview" >
                            <a href="notificaciones"  class="text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                                </svg>
                                <span> Notificaciones</span>
                            </a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->roles->first()->nombre_rol=="Administrador")   
                        <li class="treeview">
                            <a href="{{url('configuracion/')}}"  class="text-white">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span>Configuración</span>
                            </a>
                        </li>
                    @endif 
                                
                </ul>
            </section>
        </aside>
      <div class="content-wrapper  bg-white">
        <section class="content bg-white" >
            @if(Session::has('mod_password'))
                <div class="alert alert-success">
                    <p  class="text-center"> {{ session('mod_password') }} </p>
                </div>
            @endif
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
