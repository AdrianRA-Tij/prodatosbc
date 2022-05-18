<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>PRODATOSBC</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <!-- Fontawesome icons-->
    <script src="https://kit.fontawesome.com/4d9cd3b44e.js" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
function myFunction() {
  alert("Por seguridad, cierre todas las pestañas de PRODATOSBC");
}
</script>
    <meta name="theme-color" content="#7952b3">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <style>
        .active span{
            background-color: #BD3284 !important;
            font-weight: bold !important;
            text-decoration: none !important;
        }

        .nav-new {
  display: block;
  color: #0d6efd;
  text-decoration: none;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}

</style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/Estilos.css?v=').time()}}">
</head>

<body style="background:#F3F3F3;">
    <!--Inicio NavBar-->
    <header class="navbar-white sticky-top bg-white p-0  shadow-sm">
        <div class="container-fluid d-flex align-items-center">
            <img src="{{ asset('/images/logo_PRODATOS.fw.png') }}" width="300" height="150" alt="Bootstrap">
            <p class="h1 ms-auto" style="font-family: Inter; color:#BD3284;">Pizarra de avances</p>
            <button class="btn btn-light dropdown-toggle ms-auto" data-toggle="tooltip" title="Cerrar sesión" style="color: #059B97" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false"></button>
            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownMenuButton2">
                <a class="dropdown-item" href="{{ route('logout.perform') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit(); myFunction();">
                    {{ __('Salir') }}
                </a>
                <form id="logout-form" action="{{ route('logout.perform') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
        </div>
    </header>
    <!--Fin NavBar-->
    <!--Inicio contenido-->
    <div class="container-fluid">
        <div class="row">
            <!--Inicio Siderbar-->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link mt-5 text-center" aria-current="page" href="#">
                                <img src="{{ asset('/images/Avatar2.png') }}">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  mt-0 text-center" aria-current="page" href="#">
                                <label class="text-center col" style=" font-family: Inter; color:white;" for="">
                                    <h5>{{ Auth::user()->username }}</h5>
                                </label>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  mt-0 text-center" aria-current="page" href="#">
                                <label class="text-center col" style=" font-family: Inter; color:white;" for="">
                                    <h6>Administrador</h6>
                                </label>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-content mt-3">
                    <ul class="navbar-nav" style="display: flex;">
                        <li  class=" {{ setActive('user.index') }} " >
                            
                            <a href="{{ route('user.index') }}" class="nav-new">
                                <span> <i class="fas fa-users"></i>Alta SO </span>
                            </a>
                            
                        </li>
                        <li  class=" {{ setActive('ejes.index') }} {{ setActive('problematicas.index') }} {{ setActive('estrategias.index') }}  {{ setActive('acciones.index') }}" >
                            
                            <a href="{{ route('ejes.index') }}" class="nav-new">
                       <span> <i class="fas fa-list"></i>Alta EPEA </span> 
                    </a>
                            
                        
                        </li>
                        <li  class=" {{ setActive('reportes.index') }} " >
                            
                            <a href="{{ route('reportes.index') }}" class="nav-new"> 
                        <span> <i class="fa fa-file-text-o"></i>Reportes </span>
                    </a>
                            
                        
                        </li>
                    </ul>
                    <!-- <a href="{{ route('user.index') }}">
                        <span><i class="fas fa-users"></i>Alta SO</span>
                    </a>
                    <a href="{{ route('ejes.index') }}">
                        <span><i class="fas fa-list"></i>Alta EEA</span>
                    </a>
                    <a href="{{ route('reportes.index') }}">
                        <span><i class="fa fa-file-text-o"></i>Reportes</span>
                    </a> -->
                </div>
            </nav>
            <!--Fin Siderbar-->

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!--Page content-->
                <div class="pages-content-wrapper">
                    <div class="container-fluid">
                        <div class="row mt-5">
                            <div class="col">
                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>




            </main>
        </div>
    </div>
    <script>
        //jQuery listen for checkbox change
        $(document).ready(function() {
            $("#myCheckBoxID").on('change', function() {
                console.log('Si entro');
                var rowCount = $('#myTable tr').length;
                if (this.checked) {
                    for (let i = 0; i < rowCount; i++) {
                        $('#button_eliminar_' + i).prop('disabled', false);

                    }
                } else {
                    for (let i = 0; i < rowCount; i++) {
                        $('#button_eliminar_' + i).prop('disabled', true);

                    }
                }
            });
        });
    </script>s
    <script>
        //jQuery para las etiquetas en los botones
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script type="text/javascript">
           //jQuery los alerts
        $(document).ready(function() {

            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 5000);

        });
    </script>
    <script src="{{ asset('js/feather.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/Chart.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
