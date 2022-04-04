<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="crsf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRODATOSBC</title>
    <!-- Fontawesome icons-->
    <script src="https://kit.fontawesome.com/4d9cd3b44e.js" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/Estilos.css?v=').time()}}">
    @livewireStyles
</head>

<body style="background:#F3F3F3;">
    <!--Inicio NavBar-->
    <header class="navbar-white sticky-top bg-white p-0  shadow-sm">
        <div class="container-fluid d-flex align-items-center">
            <img src="{{ asset('/images/logo_PRODATOS.fw.png') }}" width="300" height="150" alt="Bootstrap">
            <p class="h1 ms-auto" style="font-family: Inter; color:#BD3284;">Pizarra de avances</p>

            <button class="btn btn-light dropdown-toggle ms-auto" data-toggle="tooltip" title="Cerrar sesión" style="color: #059B97" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false"></button>
            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownMenuButton2">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>

        </div>
        </div>
    </header>
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
                                    <h6>Sujeto Obligado</h6>
                                </label>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-content mt-3">
                    <a href="{{ route('compromiso.index') }}">
                        <span><i class="far fa-file-alt"></i>R. Compromisos</span>
                    </a>
                    <a href="{{ route('evidencias') }}"><span><i class="fas fa-file-medical"></i>R. Evidencias</span></a>

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
        @yield('script_select')


        <script>var x, i, j, selElmnt, a, b, c;
        /*look for any elements with the class "custom-select":*/
        x = document.getElementsByClassName("custom-select");
        for (i = 0; i < x.length; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 0; j < selElmnt.length; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    for (k = 0; k < y.length; k++) {
                    y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
            });
        }
        function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
            arrNo.push(i)
            } else {
            y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
            }
        }
        }
        /*if the user clicks anywhere outside the select box,
        then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);
    </script>
        <script type="text/javascript">
        $(document).ready(function() {

            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 5000);

        });
    </script>
     @yield('content_script')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/feather.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/Chart.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    @livewireScripts
</body>

</html>
