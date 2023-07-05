<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <title>Productos</title>

</head>

<body>
    @include('cliente.nav')


    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Productos & Categorias</h1>
                        <p>Descubre nuestra amplia selección de jugos frescos y deliciosos,
                            junto con una variedad de categorías que se adaptan a tus preferencias.
                            Disfruta de sabores únicos y opciones personalizadas para satisfacer tu sed de jugos naturales y saludables.
                            ¡Explora nuestras categorías y encuentra tu jugo favorito!.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">Todos</button>
                            @foreach ($categorias as $categoria)
                            <button data-filter=".{{ $categoria->id }}">{{ $categoria->nombre }}</button>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center special-list">
                @foreach ($productos as $producto)
                @if ($producto->activo)
                <div class="col-lg-3 col-md-6 col-sm-6 special-grid {{ $producto->categorias_id}}">
                    <!-- Cartas -->
                    <div class="products-single fix ">
                        <div class="box-img-hover">
                            <!-- Imagen del producto -->
                            <img src="{{ asset($producto->imagen) }}" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <a class="cart" href="{{ route('agregarCarrito', ['productoId' => $producto->id, 'cantidad' => 1]) }}">Agregar al carrito</a>
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