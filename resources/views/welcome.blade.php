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

        .fixed-size-image {
            width: 200px;
            /* Establece el ancho deseado */
            height: 200px;
            /* Establece la altura deseada */
            object-fit: cover;
            /* Ajusta la imagen para que cubra completamente el área designada */
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
                            @if ($categoria->nombre != 'Personalizados')
                            <button data-filter=".{{ $categoria->id }}">{{ $categoria->nombre }}</button>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center special-list">
                @foreach ($productos as $producto)
                @if ($producto->activo && $producto->categorias_id !== 3)
                <div class="col-lg-3 col-md-6 col-sm-6 special-grid {{ $producto->categorias_id}}">
                    <!-- Cartas -->
                    <div class="products-single fix ">
                        <div class="box-img-hover">
                            <!-- Imagen del producto -->
                            <img src="{{ asset($producto->imagen) }}" class="img-fluid fixed-size-image" alt="Image">
                            <div class="mask-icon">
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

    <!-- Start Products Personalizados -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>¡Crea el jugo de tus sueños hoy mismo!</h1>
                        <p>Personaliza tu experiencia con nuestros jugos personalizados.
                            ¡Tú eres el chef! Elige tus ingredientes y saborea la innovación en cada sorbo.
                            Tu jugo perfecto está a solo un clic de distancia. ¡Hazlo único, hazlo tuyo!
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-toggle="modal" data-target="#Personalizados">Personalizado</button>
                        </div>
                    </div>
                </div>

                <!-- Modal Personalizados-->
                <div class="modal fade my-modal" id="Personalizados" tabindex="-1" role="dialog" aria-labelledby="Personalizados" aria-hidden="true" style="position: absolute; z-index: 1050;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 style="" class="modal-title" id="Personalizados">Producto Personalizados</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="text-center">
                                    <h4>Selecciona 3 insumos para crear un producto personalizado.</h4>
                                </div>
                                <div style="display: flex">
                                    <div class="insumos" style="flex: 1; margin-right: 20px; overflow-y: scroll; max-height: 200px;">
                                        <div class="form-group">
                                            <input style="border-top: none; border-right: none; border-left: none;" type="text" class="form-control" id="buscarInsumo" placeholder="Ingresa el nombre del insumo">
                                        </div>
                                        @foreach ($Insumo as $Insumos)
                                        <div class="insumo" data-id="{{ $Insumos->id }}">
                                            <img src="{{ asset($Insumos->imagen) }}" alt="Imagen del producto" width="40em">
                                            <span>{{ $Insumos->id }} : {{ $Insumos->nombre }} $:
                                                {{ $Insumos->precio_unitario }}</span>
                                            <button type="button" class="btn btn-success agregar-insumo" style="max-width: 2em; max-height: 2em;">
                                                <i class="fas fa-plus fa-xs"></i>
                                                <!-- Icono de Font Awesome para el botón -->
                                            </button>
                                            <br>
                                        </div>
                                        <div style="margin: 1em" class="insumo" data-id="{{ $Insumos->id }}">
                                            <img src="{{ asset($Insumos->imagen) }}" alt="Imagen del producto" width="40em">
                                            <span>{{ $Insumos->id }} : {{ $Insumos->nombre }} $:
                                                {{ $Insumos->precio_unitario }}</span>
                                            <button type="button" class="btn btn-success agregar-insumo" style="max-width: 1em; max-height: 1.5em;">
                                                <i class="fas fa-plus fa-xs" style="position: relative; bottom: 8.5px;right: 5px"></i>
                                                <!-- Icono de Font Awesome para el botón -->
                                            </button>
                                            <br>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="insumos_selecionados" style="flex: 1; margin-top: 10px; overflow-y: scroll; max-height: 200px;">
                                        <h3>Insumo seleccionados</h3>
                                        <ul class="lista-insumos-seleccionados"></ul>
                                        <!-- Usaremos una lista para mostrar los insumos seleccionados -->
                                    </div>
                                </div>
                            </div>

                            <!-- Agrega aquí más detalles del producto Personalizados si es necesario -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="crearPersonalizados" data-dismiss="modal" onclick="actualizarTotalCarrito(true); mostrarAlertaExitosa('Producto agregado al carrito exitosamente');">Crear</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Obtener referencia al campo de búsqueda
                        const inputBuscarInsumo = document.getElementById('buscarInsumo');

                        // Obtener todas las filas de insumos para poder mostrar/ocultar según el filtro
                        const insumosFila = document.querySelectorAll('.insumos .insumo');

                        // Agregar evento de input para el campo de búsqueda
                        inputBuscarInsumo.addEventListener('input', function() {
                            const terminoBusqueda = inputBuscarInsumo.value.trim().toLowerCase();

                            // Mostrar solo los insumos que coinciden con el término de búsqueda
                            insumosFila.forEach(function(filaInsumo) {
                                const textoInsumo = filaInsumo.querySelector('span').textContent.toLowerCase();
                                if (textoInsumo.includes(terminoBusqueda)) {
                                    filaInsumo.style.display = 'block';
                                } else {
                                    filaInsumo.style.display = 'none';
                                }
                            });
                        });
                    });
                </script>
                <!-- Modal Personalizados-->
            </div>
            <div class="row justify-content-center special-list">
                @foreach ($productos as $producto)
                @if ($producto->activo && $producto->categorias_id == 3)
                <div class="col-lg-3 col-md-6 col-sm-6 special-grid {{ $producto->categorias_id }}">
                    <!-- Cartas -->
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <!-- Imagen del producto -->
                            <img src="{{ asset($producto->imagen) }}" class="img-fluid fixed-size-image" alt="Image">
                            <div class="mask-icon">
                                <a class="cart" href="#" data-producto-id="{{ $producto->id }}" data-producto-nombre="{{ $producto->nombre }}" data-producto-precio="{{ $producto->precio }}" onclick="agregarAlCarrito(event);actualizarTotalCarrito(true)">
                                    Agregar al carrito
                                </a>
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
    <!-- End Products Personalizados -->

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

        $(document).ready(function() {
            var maxSeleccionados = 3; // Cantidad máxima de productos seleccionados
            var insumosSeleccionadosSet = new Set(); // Conjunto para almacenar los IDs de los insumos seleccionados
            var numeroPersonalizado = 1; // Variable para el número autoincrementable

            // Al cargar la página, busca el último número personalizado guardado en el Local Storage
            var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
            if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                var ultimoNumeroPersonalizado = productosPersonalizadosGuardados[productosPersonalizadosGuardados.length - 1].NumeroPersonalizado;
                numeroPersonalizado = ultimoNumeroPersonalizado + 1;
            }

            // Evento al hacer clic en el botón "Agregar" de un insumo
            $('.agregar-insumo').click(function() {
                if ($('.insumos_selecionados li').length < maxSeleccionados) {
                    var insumoId = $(this).closest('.insumo').data('id');

                    // Verificar si el insumo ya está en la lista de seleccionados
                    if (insumosSeleccionadosSet.has(insumoId)) {
                        nosepuedeAgregar('El insumo ya ha sido seleccionado anteriormente.');
                        return; // Salir del evento para evitar agregar el insumo repetido
                    }

                    var insumoNombre = $(this).siblings('span').text();
                    var insumoPrecio = parseFloat($(this).siblings('span').text().match(/\d+/)[0]); // Extraer el precio del texto

                    // Agregar el insumo al conjunto de insumos seleccionados
                    insumosSeleccionadosSet.add(insumoId);

                    // Crea un elemento de lista con el nombre y precio del insumo seleccionado
                    var listItem = $('<li>').text(`${insumoId} : ${insumoNombre} $: ${insumoPrecio}`);
                    var removeButton = $('<button>').text('Quitar').addClass('btn btn-danger quitar-insumo');
                    // var removeButton = $('<button>').text('Quitar').addClass(
                    //     'btn btn-danger quitar-insumo');
                    // var removeButton = $('<button>').html('<i class="fas fa-trash"></i>').addClass(
                    //     'btn btn-danger quitar-insumo');

                    var removeButton = $('<button>').html('<i class="fas fa-trash"></i>').addClass(
                        'btn btn-danger quitar-insumo').css({
                        margin: '8px',

                    });

                    // Agrega el botón de "Quitar" junto al insumo seleccionado
                    listItem.append(removeButton);

                    // Agregar el ID del insumo como atributo de datos al elemento <li>
                    listItem.attr('data-id', insumoId);

                    $('.insumos_selecionados').append(listItem);
                } else {
                    nosepuedeAgregar('Ya has seleccionado la cantidad máxima de productos.');
                }
            });

            // Evento para quitar un insumo seleccionado
            $(document).on('click', '.quitar-insumo', function() {
                var insumoId = $(this).closest('li').data('id');

                // Elimina el insumo del conjunto de insumos seleccionados
                insumosSeleccionadosSet.delete(insumoId);

                // Elimina el elemento de la lista de seleccionados
                $(this).closest('li').remove();
            });

            // Evento al hacer clic en el botón "Crear" del modal
            $('#crearPersonalizados').click(function() {
                var personalizado = {
                    NumeroPersonalizado: numeroPersonalizado, // Agregar el número personalizado al objeto
                    Nombre: `Personalizado ${numeroPersonalizado}`, // Nombre con número autoincrementable
                    Subtotal: 0,
                    Cantidad: 1, // Agregar la propiedad Cantidad y establecerla en 1
                    insumos: []
                };

                // Obtener los detalles de cada insumo seleccionado
                $('.insumos_selecionados li').each(function() {
                    var insumoDetalles = $(this).text();
                    personalizado.insumos.push(insumoDetalles);

                    // Sumar el precio del insumo al subtotal
                    var insumoPrecio = parseFloat(insumoDetalles.match(/\d+/)[0]);
                    personalizado.Subtotal += insumoPrecio;
                });

                // Incrementar el número para el siguiente producto personalizado
                numeroPersonalizado++;

                // Obtener el arreglo de productos personalizados almacenados en el Local Storage
                var productosPersonalizados = JSON.parse(localStorage.getItem('productosPersonalizados')) || [];
                // Agregar el producto personalizado actual al arreglo
                productosPersonalizados.push(personalizado);

                // Guardar el arreglo actualizado en el Local Storage con la clave "productosPersonalizados"
                localStorage.setItem('productosPersonalizados', JSON.stringify(productosPersonalizados));

                // Limpiar el conjunto de insumos seleccionados
                insumosSeleccionadosSet.clear();

                // Elimina todos los insumos seleccionados de la lista
                $('.insumos_selecionados').empty();
            });

            var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

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