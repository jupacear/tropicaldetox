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
                        <p>Descubre nuestra amplia selección de jugos frescos y deliciosos, junto con una variedad de
                            categorías que se adaptan a tus preferencias. Disfruta de sabores únicos y opciones
                            personalizadas para satisfacer tu sed de jugos naturales y saludables. ¡Explora nuestras
                            categorías y encuentra tu jugo favorito!.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">Todos</button>
                            <button class="active" data-toggle="modal"
                                data-target="#Personalizados">Personalizado</button>
                            @foreach ($categorias as $categoria)
                                @if ($categoria->nombre != 'Personalizados')
                                    <button data-filter=".{{ $categoria->id }}">{{ $categoria->nombre }}</button>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Modal Personalizados-->

                <div class="modal fade my-modal" id="Personalizados" tabindex="-1" role="dialog"
                    aria-labelledby="Personalizados" aria-hidden="true" style="position: absolute; z-index: 1050;">

                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Personalizados">
                                    Producto Personalizados</h5>


                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>


                            <div class="modal-body">
                                <div class="insumos">
                                    <h5>Insumo</h5>
                                    @foreach ($Insumo as $Insumos)
                                        <div class="insumo" data-id="{{ $Insumos->id }}">
                                            <img src="{{ asset($Insumos->imagen) }}" alt="Imagen del producto"
                                                width="40em">
                                            <span>{{ $Insumos->id }} : {{ $Insumos->nombre }} $:
                                                {{ $Insumos->precio_unitario }}</span>
                                            <button type="button"
                                                class="btn btn-success agregar-insumo">Agregar</button>
                                            <br>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="insumos_selecionados">
                                    <h5>Insumo selecionados</h5>

                                </div>
                            </div>
                            <!-- Agrega aquí más detalles del producto Personalizados si es necesario -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="crearPersonalizados"
                                    data-dismiss="modal">Crear</button>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Personalizados-->
            </div>
            <div class="row justify-content-center special-list">
                @foreach ($productos as $producto)
                    @if ($producto->activo)
                        <div class="col-lg-3 col-md-6 col-sm-6 special-grid {{ $producto->categorias_id }}">
                            <!-- Cartas -->
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <!-- Imagen del producto -->
                                    <img src="{{ asset($producto->imagen) }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <!-- ... -->
                                        <a class="cart" href="#" data-producto-id="{{ $producto->id }}"
                                            data-producto-nombre="{{ $producto->nombre }}"
                                            data-producto-precio="{{ $producto->precio }}"
                                            onclick="agregarAlCarrito(event)">Agregar al carrito</a>
                                        <!-- ... -->

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

            // Mostrar un mensaje de éxito o redirigir al usuario si deseas
            // alert('Producto agregado al carrito exitosamente');
        }


        $(document).ready(function() {
            var maxSeleccionados = 3; // Cantidad máxima de productos seleccionados
            var numeroPersonalizado = 1; // Variable para el número autoincrementable

            Evento al hacer clic en el botón "Agregar" de un insumo
            $('.agregar-insumo').click(function() {
                if ($('.insumos_selecionados li').length < maxSeleccionados) {
                    var insumoId = $(this).closest('.insumo').data('id');
                    var insumoNombre = $(this).siblings('span').text();
                    var insumoPrecio = parseFloat(insumoNombre.split('$')[1].trim()); // Extraer el precio del texto
                    // alert(insumoPrecio);
                    // Crea un elemento de lista con el nombre y precio del insumo seleccionado
                    var listItem = $('<li>').text(`${insumoId} : ${insumoNombre} $: ${insumoPrecio}`);
                    $('.insumos_selecionados').append(listItem);
                } else {
                    alert('Ya has seleccionado la cantidad máxima de productos.');
                }
            });
            // $('.agregar-insumo').click(function() {
            //     if ($('.insumos_selecionados li').length < maxSeleccionados) {
            //         var insumoDetalles = $(this).siblings('span').text().trim();
            //         var precioRegex = /\$\s*(\d+(\.\d+)?)\s*$/;
            //         var match = insumoDetalles.match(precioRegex);

            //         if (true) {
            //             var insumoNombre = insumoDetalles.split('$')[0].trim();
            //             var insumoPrecio = parseFloat(match[1]);

            //             // Crea un elemento de lista con el nombre y precio del insumo seleccionado
            //             var listItem = $('<li>').text(`${insumoNombre} $: ${insumoPrecio}`);
            //             $('.insumos_selecionados').append(listItem);
            //         } else {
            //             alert('No se pudo encontrar el precio del insumo.');
            //         }
            //     } else {
            //         alert('Ya has seleccionado la cantidad máxima de productos.');
            //     }
            // });

            // Evento al hacer clic en el botón "Crear" del modal
            $('#crearPersonalizados').click(function() {
                var personalizado = {
                    Nombre: `Personalizado ${numeroPersonalizado}`, // Nombre con número autoincrementable
                    Subtotal: 0,
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
                var productosPersonalizados = JSON.parse(localStorage.getItem('productosPersonalizados')) ||
                    [];

                // Agregar el producto personalizado actual al arreglo
                productosPersonalizados.push(personalizado);

                // Guardar el arreglo actualizado en el Local Storage con la clave "productosPersonalizados"
                localStorage.setItem('productosPersonalizados', JSON.stringify(productosPersonalizados));

                // Elimina todos los insumos seleccionados de la lista
                $('.insumos_selecionados').empty();

                alert('Producto personalizado creado exitosamente.');
            });

            // Al cargar la página, verifica si hay datos guardados en el Local Storage y muestra los insumos seleccionados previamente
            var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
            // if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
            //     productosPersonalizadosGuardados.forEach(function(productoPersonalizado) {
            //         var listItem = $('<li>').text(`Nombre: ${productoPersonalizado.Nombre}, Subtotal: ${productoPersonalizado.Subtotal}`);
            //         $('.insumos_selecionados').append(listItem);
            //     });
            // }
        });
    </script>
</body>

</html>
