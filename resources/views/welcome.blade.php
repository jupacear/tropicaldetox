<!DOCTYPE html>
<html lang="es">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Tropical Detox</title>
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

@include('cliente.nav')

<body>
    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            @foreach ($productos as $producto)
            @if ($producto->activo)
            <li class="text-center">
                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Bienvenido a <br> Tropical Detox</strong></h1>
                            <p class="m-b-40">¡Disfrute de una pagina de jugos <br> de todo tipo de sabores junto con personalizados!</p>
                            <p><a class="btn hvr-hover" href="{{ route('Productos') }}">Productos</a></p>
                        </div>
                    </div>
                </div>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
    <!-- End Slider -->


    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-all text-center">
                            <h1>Categorias</h1>
                            <p>Descubre una amplia variedad de jugos frescos y deliciosos en nuestras categorías.
                                Desde jugos cítricos y refrescantes, hasta mezclas exóticas y nutritivas,
                                encontrarás opciones para satisfacer todos los gustos y necesidades.</p>
                        </div>
                    </div>
                </div>
                @foreach ($categorias as $categoria)
                @if ($categoria->activo)
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        @if ($categoria->imagen)
                        <img src="{{ asset($categoria->imagen) }}" alt="Imagen de la categoría" />
                        @else
                        <img class="img-fluid" src="images/logo.png" alt="Imagen por defecto" />
                        @endif
                        <a class="btn hvr-hover" href="#">{{ $categoria->nombre }}</a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Categories -->

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Frutas & Vegetales</h1>
                        <p>Explora nuestra amplia gama de frutas y vegetales.</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach ($productos as $producto)
                @if ($producto->activo)
                <div class="col-lg-3 col-md-6 col-sm-6 special-grid">
                    <!-- Cartas -->
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <!-- Imagen del producto -->
                            <img src="{{ asset($producto->imagen) }}" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Mostrar"><i class="fas fa-eye"></i></a></li>
                                </ul>
                                <a class="cart" href="#">Agregar al carrito</a>
                            </div>
                        </div>
                        <div class="why-text">
                            <!-- Nombre del producto -->
                            <h4>{{ $producto->nombre }}</h4>
                            <!-- Precio del producto -->
                            <h5>{{ $producto->precio }}</h5>
                            <!-- Descripción del producto -->
                            <p>{{ $producto->descripcion }}</p>
                        </div>
                    </div>
                    <!-- End Cartas -->
                </div>
                @endif
                @endforeach
            </div>

        </div>
    </div>
    <!-- End Products  -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            @foreach ($productos as $producto)
            @if ($producto->activo)
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset($producto->imagen) }}" alt="No hay imagen disponible" width="100" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    <!-- End Instagram Feed -->

    @include('cliente.footer')
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

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