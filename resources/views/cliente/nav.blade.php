<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <style>
     .nav-link-user {
  display: flex;
  align-items: center;
}

.user-name {
  font-weight: bold;
  font-size: 1.2em;
  margin-right: 5px;
}

.date {
  font-size: 0.9em;
  color: gray;
}

.navbar-nav {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.nav-item {
    margin-left: 10px;
}

    </style>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav" style="border-bottom: 3px solid rgb(81, 124, 46);">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                    aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('Bienvenido') }}">
                    <img src="images/logo2.png" style="max-width: 5em" class="logo" alt="">
                </a>
            </div>
            <!-- End Header Navigation -->
    
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">

                    <li class="nav-item active"><a class="nav-link" href="{{ route('Bienvenido') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('Productos') }}">Productos</a></li>


                    @if (empty(session('carrito.productos')))
                        <li class="nav-item"><a class="nav-link" href="{{ route('carrito') }}">carrito<i
                                    class="fa fa-shopping-bag nav-link">
                                    <span class="badge">
                                        0
                                    </span>
                                </i></a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('carrito') }}">carrito<i
                                    class="fa fa-shopping-bag nav-link">
                                    <span class="badge">
                                        {{ count(session('carrito.productos', [])) }}
                                    </span>
                                </i></a></li>
                    @endif
                    @if (!empty(\Illuminate\Support\Facades\Auth::user()->name))
                    <li class="nav-item"><a class="nav-link" href="{{ route('verpedido') }}">Pedidos</a></li>
                    @else
                    {{--  --}}
                    @endif
                

                    <script>
                        function mostrarAlerta() {
                            alert("El carrito está vacío");
                            // Redireccionar a otra página
                            window.location.href = "{{ route('carrito') }}";
                        }
                    </script>


                    <!-- End Carrito de compras -->
                    <!-- Código de autenticación -->
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a href="#" class="nav-link dropdown-toggle nav-link-lg nav-link-user"
                                        data-toggle="dropdown">
                                        Hola, {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu">
                                        @can('administrador')
                                            <a href="{{ url('/home') }}" class="nav-link">Panel</a>
                                        @endcan

                                        <a class="dropdown-item" href="{{ route('newperfil') }}">
                                            {{ __('Perfil') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('newcontrasena') }}">
                                            {{ __('Cambio de contraseña') }}
                                        </a>
                                        <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                                            onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Salir
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>

                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Registro</a>
                                </li>
                            @endif
                        @endauth

                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->

</header>


<!-- End Main Top -->
<!-- ALL JS FILES -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- ALL PLUGINS -->
<script src="js/jquery.superslides.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/inewsticker.js"></script>
<script src="js/bootsnav.js."></script>
<script src="js/images-loded.min.js"></script>
<script src="js/isotope.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/baguetteBox.min.js"></script>
<script src="js/form-validator.min.js"></script>
<script src="js/contact-form-script.js"></script>
<script src="js/custom.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById("carrito-link").addEventListener("click", function(event) {
        event.preventDefault(); // Evita que el enlace se comporte como un enlace normal

        var sideDiv = document.querySelector(".side");
        sideDiv.classList.toggle("side-on"); // Agrega o quita la clase "side-on" al <div class="side">
    });
</script>

