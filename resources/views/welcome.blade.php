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
    <style>
        body {
            overflow-x: hidden;
        }

        .no-horizontal-scroll {
            overflow-x: hidden;
        }

        .datos {
            display: flex;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .map-container iframe {
            top: 0;
            left: 1;
            width: 100%;
            height: 450px;
            /* Ajusta la altura según tus preferencias */
        }
    </style>
</head>

@include('cliente.nav')

<body class="no-horizontal-scroll">
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
            <div class="col-lg-12">
                <div class="special-menu text-center">
                    <div class="button-group filter-button-group">
                        <button class="active" data-filter="*">Todos</button>
                        @foreach ($categorias as $categoria)
                        @if ($categoria->nombre != 'Personalizados')
                        <button data-filter=".{{ $categoria->id }}">{{ $categoria->nombre }}</button>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @php
                $contadorProductos = 0; // Inicializa el contador de productos
                @endphp
                @foreach ($productos as $producto)
                @if ($producto->activo && $producto->Categorium->nombre !== 'Personalizado')
                @php
                $contadorProductos++; // Incrementa el contador de productos
                @endphp
                <div class="col-lg-3 col-md-6 col-sm-6 special-grid">
                    <!-- Cartas -->
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <!-- Imagen del producto -->
                            <img src="{{ asset($producto->imagen) }}" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <div class="mask-icon">
                                    <a class="cart" href="#" data-producto-id="{{ $producto->id }}" data-producto-nombre="{{ $producto->nombre }}" data-producto-precio="{{ $producto->precio }}" onclick="agregarAlCarrito(event);actualizarTotalCarrito(true)">
                                        Agregar al carrito
                                    </a>
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
                @if ($contadorProductos >= 3)
                @break; // Detén el bucle después de mostrar 3 productos
                @endif
                @endforeach
            </div>

        </div>
    </div>
    <!-- End Products  -->

    <!-- Mapas -->
    <section class="row m-9">
        <div class="col-lg">
            <div class="title-all text-center">
                <h1>Nuestra ubicación</h1>
                <p class="text-center">Estamos ubicados en el corazón de la ciudad, </p>
                <p>Nuestra tienda ofrece una amplia gama de productos y servicios para satisfacer todas tus necesidades. Ven a visitarnos y descubre todo lo que tenemos para ofrecerte.</p>
            </div>
        </div>
        <div class="col-md-10 offset-md-1">
            <div class="datos">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63458.87684076734!2d-75.62018190544242!3d6.240018059759329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4428dfb80fad05%3A0x42137cfcc7b53b56!2sMedell%C3%ADn%2C%20Antioquia!5e0!3m2!1ses!2sco!4v1667887272639!5m2!1ses!2sco" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- End mapas -->

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

    <script>
        function agregarAlCarrito(event) {
            event.preventDefault();

            // Obtener el carrito del Local Storage
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            // Obtener los datos del producto del enlace
            let productoId = event.target.dataset.productoId;
            let nombreS = event.target.dataset.productoNombre;
            let precioS = event.target.dataset.productoPrecio;

            // Buscar el producto en el carrito
            let productoEnCarrito = carrito.find(item => item.id === productoId);

            if (productoEnCarrito) {
                // Si el producto ya existe en el carrito, actualizar la cantidad
                productoEnCarrito.cantidad += 1;
            } else {
                // Si el producto no existe en el carrito, agregarlo
                let producto = {
                    id: productoId,
                    nombre: nombreS,
                    precio: precioS,
                    cantidad: 1
                };

                carrito.push(producto);
            }

            // Guardar el carrito actualizado en el Local Storage
            localStorage.setItem('carrito', JSON.stringify(carrito));


            // Ejemplo de uso:
            mostrarAlertaExitosa('Producto agregado al carrito exitosamente');
        }
        // Mostrar un mensaje de éxito o redirigir al usuario si deseas
        function mostrarAlertaExitosa(mensaje) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: mensaje,
                timer: 3000, // Tiempo en milisegundos (3 segundos en este caso)
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                customClass: {
                    popup: 'swal2-show-custom', // Clase personalizada para el estilo
                }
            });
        }

        function nosepuedeAgregar(mensaje) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: mensaje,
                timer: 3000, // Tiempo en milisegundos (3 segundos en este caso)
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                background: '#f2dede', // Color de fondo de la alerta (estilo de error)
                color: '#a94442',
                customClass: {
                    icon: 'swal2-error-icon-custom', // Clase personalizada para el estilo
                }
            });
        }
    </script>
    
    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    <script src="js/bootsnav.js"></script>
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>

</html>