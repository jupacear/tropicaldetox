<!DOCTYPE html>
<html lang="es">
<!-- Basic -->

<head>
    <meta charset="utf-8">

    <!-- Mobile Metas -->

    <!-- Site Metas -->
    <title>Tropical Detox</title>

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
    <style>
        .carousel-inner .item {
            display: none;
        }

        .carousel-inner .item img {
            max-width: 100%;
            height: auto;
        }

        .carousel-inner .item .d-flex {
            display: flex;
            justify-content: center;
            align-items: center;
            /* Centrar verticalmente */
            height: 100%;
            /* Asegura que el contenedor ocupe todo el espacio verticalmente */
        }

        .datos {
            display: flex;

        }
    </style>
</head>

@include('cliente.nav')

<body>
    <!-- Slider -->
    <div id="mi_carousel" class="carousel slide" data-ride="carousel">
        <div id="myCarouselCustom" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @foreach ($productos as $producto)
                @if ($producto->activo)
                <div class="item @if ($loop->first) active @endif">
                    <div class="d-flex">
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }} " class="text-center img-fluid w-50">
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
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
                                <div class="mask-icon">
                                    <a class="cart" href="{{ route('Productos') }}">Ir a productos</a>
                                </div>
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

    <!-- Mapas -->
    <section class="row m-9">
        <div class="col-lg-12">
            <div class="title-all text-center">
                <h1>Nuestra ubicación</h1>
                <p class="text-center">Estamos ubicados en el corazón de la ciudad, </p>
                <p>Nuestra tienda ofrece una amplia gama de productos y servicios para satisfacer todas tus necesidades. Ven a visitarnos y descubre todo lo que tenemos para ofrecerte.</p>
            </div>
        </div>
        <div class="col-md-9 offset-md-3">
            <div class="datos">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63458.87684076734!2d-75.62018190544242!3d6.240018059759329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4428dfb80fad05%3A0x42137cfcc7b53b56!2sMedell%C3%ADn%2C%20Antioquia!5e0!3m2!1ses!2sco!4v1667887272639!5m2!1ses!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- End mapas -->
    @include('cliente.footer')
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>


    <script>
        // Cuando el documento esté listo
        $(document).ready(function() {
            // Obtener todos los elementos con la clase .item dentro de .carousel-inner
            var items = $('.carousel-inner .item');
            // Mostrar el primer elemento
            items.first().addClass('active').show();

            // Función para manejar el cambio de las imágenes del carousel
            function nextSlide() {
                // Encontrar el elemento activo
                var activeItem = $('.carousel-inner .item.active');
                // Obtener el siguiente elemento
                var nextItem = activeItem.next();

                // Si no hay siguiente elemento, volver al inicio
                if (nextItem.length === 0) {
                    nextItem = items.first();
                }

                // Mostrar el siguiente elemento y ocultar el actual
                activeItem.removeClass('active').fadeOut('slow');
                nextItem.addClass('active').fadeIn('slow');
            }

            // Llamar a la función nextSlide cada cierto tiempo (por ejemplo, cada 3 segundos)
            setInterval(nextSlide, 3000);
        });
    </script>
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

</html>