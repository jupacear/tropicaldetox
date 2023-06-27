<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Freshshop - Ecommerce Bootstrap 4 HTML Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Start Main Top -->
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="../../welcome.blade.php"><img src="images/logo2.png" class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->
    
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item active"><a class="nav-link" href="../../welcome.blade.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">Sobre nosotros</a></li>
                        <li class="dropdown">
                            <ul class="dropdown-menu">
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="gallery.html">Productos</a></li>
                        
                        <!-- Código de autenticación -->
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/home') }}" class="nav-link">Panel</a>
                                    <div class="d-sm-none d-lg-inline-block">
                                        Hola, {{ \Illuminate\Support\Facades\Auth::user()->first_name }}
                                    </div>
                                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                        <div class="d-sm-none d-lg-inline-block">
                                            Hola, {{ \Illuminate\Support\Facades\Auth::user()->first_name }}
                                        </div>
                                    </a>
                                    <div class="dropdown-title">
                                        Bienvenido, {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                    </div>
                                    <a class="dropdown-item has-icon edit-profile" href="#" data-id="{{ \Auth::id() }}">
                                        <i class="fa fa-user"></i> Editar perfil
                                    </a>
                                    <a class="dropdown-item has-icon" data-toggle="modal" data-target="#changePasswordModal"
                                        href="#" data-id="{{ \Auth::id() }}">
                                        <i class="fa fa-lock"></i> Cambiar contraseña
                                    </a>
                                    <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                                        onclick="event.preventDefault(); localStorage.clear(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Salir
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                        {{ csrf_field() }}
                                    </form>
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
                        <!-- Fin del código de autenticación -->
                    </ul>
                </div>
                
                <!-- /.navbar-collapse -->
    
                <!-- Start Atribute Navigation -->
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <!-- End Side Menu -->
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
</body>

</html>