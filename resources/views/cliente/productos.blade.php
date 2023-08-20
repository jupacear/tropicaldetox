@extends('layouts.auth_app')
@section('title')
    Perfil
@endsection
@section('content')

    <body>


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
                                <button class="" data-filter="*">Todos</button>
                                <button class="" data-toggle="modal"
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
                        aria-labelledby="Personalizados" aria-hidden="true"
                        style="position: absolute; z-index: 1050;right: 10em;">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content" style="width:70em !important;height: 35em;">

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
                                        <div class="insumos"
                                            style="flex: 1; margin-right: 20px; overflow-y: scroll; max-height: 20em;">
                                            <div class="form-group">
                                                <input style="border-top: none; border-right: none; border-left: none;"
                                                    type="text" class="form-control" id="buscarInsumo"
                                                    placeholder="Ingresa el nombre del insumo">
                                            </div>

                                            <table class="table">
                                                <tbody>
                                                    @foreach ($Insumo as $Insumos)
                                                        <tr class="insumo" data-id="{{ $Insumos->id }}">
                                                            <td><img src="{{ asset($Insumos->imagen) }}"
                                                                    alt="Imagen del producto" width="40em"></td>
                                                            <td>{{ $Insumos->id }}</td>
                                                            <td>{{ $Insumos->nombre }}</td>
                                                            <td>${{ $Insumos->precio_unitario }}</td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-success agregar-insumo"
                                                                    style="max-width: 1em; max-height: 1.5em;">
                                                                    <i class="fas fa-plus fa-xs"
                                                                        style="position: relative; bottom: 8.5px;right: 5px"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="insumos_selecionados"
                                            style="flex: 1; margin-top: 10px; overflow-y: scroll; max-height: 20em;">
                                            <h3>Insumo seleccionados</h3>
                                            <div id="totalInsumosSeleccionados">
                                                Total: $0.00
                                            </div>
                                            <ul class="lista-insumos-seleccionados"></ul>
                                            <!-- Agrega esta tabla en el modal donde deseas mostrar los insumos seleccionados -->
                                            <div class="insumos_selecionados"
                                                style="flex: 1; margin-top: 10px; overflow-y: scroll; max-height: 20em;">
                                                <table class="table tabla-insumos-seleccionados">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Nombre</th>
                                                            <th>Precio</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Los insumos seleccionados se agregarán aquí dinámicamente -->
                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div
                                    style="display: flex;align-items: center ;justify-content: center;padding: 0em; position: relative;bottom: 1.5em;">

                                    <div class="form-group"
                                        style="margin: 0em;padding: 0em;width: 75%;;position: relative;bottom: 1em">
                                        <label for="descripcion">Descripción:</label>
                                        <textarea class="form-control" maxlength="200"
                                            style="width: 100%; height: 3em !important; resize: none; position: relative; right: 1em !important;"
                                            id="descripcion"></textarea>
                                    </div>


                                    <!-- Agrega aquí más detalles del producto Personalizados si es necesario -->
                                    <div class="modal-footer" style="margin: 0em;padding: 0em;">
                                        <button type="button" class="btn btn-primary" id="crearPersonalizados"
                                            data-dismiss="modal"
                                            onclick=" mostrarAlertaExitosa('Producto agregado al carrito exitosamente');">
                                            Crear
                                        </button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
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
                                    const textoInsumo = filaInsumo.querySelector('td:nth-child(3)').textContent
                                        .toLowerCase();
                                    if (textoInsumo.includes(terminoBusqueda)) {
                                        filaInsumo.style.display = 'table-row';
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
                        @if ($producto->activo)
                            <div class="col-lg-3 col-md-6 col-sm-6 special-grid {{ $producto->categorias_id }}">
                                <!-- Cartas -->
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <!-- Imagen del producto -->
                                        <img src="{{ asset($producto->imagen) }}" class="img-fluid" alt="Image">
                                        <div class="mask-icon">
                                            <a class="cart" href="#" data-producto-id="{{ $producto->id }}"
                                                data-producto-nombre="{{ $producto->nombre }}"
                                                data-producto-precio="{{ $producto->precio }}"
                                                onclick="agregarAlCarrito(event);actualizarTotalCarrito(true)">
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
        <!-- End Products  -->

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
                $('#Personalizados').on('hidden.bs.modal', function() {
                    $('#descripcion').val(''); // Borrar el contenido del textarea al cerrar el modal
                });

            
                var maxSeleccionados = 3;
                var insumosSeleccionadosSet = new Set();
                var numeroPersonalizado = 1;

                var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
                if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                    var ultimoNumeroPersonalizado = productosPersonalizadosGuardados[productosPersonalizadosGuardados
                        .length - 1].NumeroPersonalizado;
                    numeroPersonalizado = ultimoNumeroPersonalizado + 1;
                }

                $(document).on('click', '.agregar-insumo', function() {
                    let insumoNombre = $(this).closest('tr').find('td:nth-child(3)').text();
                    let arrayDeNombres = insumoNombre.split(' ');

                    if ($('.tabla-insumos-seleccionados tbody tr').length < maxSeleccionados) {
                        var insumoId = $(this).closest('tr').data('id');

                        var insumoPrecio = parseFloat($(this).closest('tr').find('td:nth-child(4)').text()
                            .match(/\d+/)[0]);

                        insumosSeleccionadosSet.add(insumoId);

                        var newRow = $('<tr>').attr('data-id', insumoId);
                        newRow.append($('<td>').text(insumoId));
                        newRow.append($('<td>').text(insumoNombre));
                        newRow.append($('<td>').text(`$${insumoPrecio}`));

                        var removeButton = $('<button>').addClass('btn btn-danger quitar-insumo');
                        var removeIcon = $('<i>').addClass('fas fa-trash');
                        removeButton.append(removeIcon);
                        newRow.append($('<td>').append(removeButton));

                        $('.tabla-insumos-seleccionados tbody').append(newRow);

                        recalcularTotalInsumosSeleccionados();
                    } else {
                        nosepuedeAgregar('Ya has seleccionado la cantidad máxima de productos.');
                    }
                });

                $(document).on('click', '.quitar-insumo', function() {
                    var insumoId = $(this).closest('tr').data('id');

                    insumosSeleccionadosSet.delete(insumoId);
                    $(this).closest('tr').remove();

                    recalcularTotalInsumosSeleccionados();
                });

                $('#crearPersonalizados').click(function() {
                    var insumosSeleccionados = $('.tabla-insumos-seleccionados tbody tr');

                    if (insumosSeleccionados.length < 3) {
                        nosepuedeAgregar(
                            'Debes seleccionar al menos un insumo para crear un producto personalizado.');
                        return; // Salir de la función si no hay insumos seleccionados
                    }
                    actualizarTotalCarrito(true);
                    // Obtener la descripción del campo de entrada de texto
                    var descripcion = $('#descripcion').val();
                    var personalizado = {
                        NumeroPersonalizado: numeroPersonalizado,
                        Nombre: `Personalizado ${numeroPersonalizado}`,
                        Subtotal: 0,
                        Cantidad: 1,
                        Descripcion: descripcion || 'Sin descripción',

                        insumos: []
                    };

                    insumosSeleccionados.each(function() {
                        var insumoId = $(this).data('id');
                        var insumoNombre = $(this).find('td:nth-child(2)').text();
                       
                        var insumoPrecio = parseFloat($(this).find('td:nth-child(3)').text().match(
                            /\$(\d+(\.\d{1,2})?)/)[1]);

                        var insumoDetalles = `${insumoId} : ${insumoNombre} $: ${insumoPrecio}`;
                        personalizado.insumos.push(insumoDetalles);
                        personalizado.Subtotal += insumoPrecio;
                    });

                    numeroPersonalizado++;

                    var productosPersonalizados = JSON.parse(localStorage.getItem('productosPersonalizados')) ||
                        [];
                    productosPersonalizados.push(personalizado);
                    localStorage.setItem('productosPersonalizados', JSON.stringify(productosPersonalizados));

                    insumosSeleccionadosSet.clear();
                    $('.tabla-insumos-seleccionados tbody').empty();
                    $('#descripcion').val(''); // Borrar el contenido del textarea después de crear

                });

                // Función para recalcular el total de insumos seleccionados
                function recalcularTotalInsumosSeleccionados() {
                    var total = 0;
                    $('.tabla-insumos-seleccionados tbody tr').each(function() {
                        var insumoPrecioSeleccionado = parseFloat($(this).find('td:nth-child(3)').text().match(
                            /\$(\d+(\.\d{1,2})?)/)[1]);
                        total += insumoPrecioSeleccionado;
                    });

                    // Actualizar el contenido del elemento HTML del total
                    $('#totalInsumosSeleccionados').text(`Total: $${total.toFixed(2)}`);
                }
            });



            // Función para recalcular el total de insumos seleccionados
            function recalcularTotalInsumosSeleccionados() {
                var totall = 0;
                $('.tabla-insumos-seleccionados tbody tr').each(function() {
                    var insumoPrecioSeleccionado = parseFloat($(this).find('td:nth-child(3)').text().match(
                        /\$(\d+(\.\d{1,2})?)/)[1]);
                    totall += insumoPrecioSeleccionado;
                });

                $('#totalInsumosSeleccionados').text(`Total: $${totall.toFixed(2)}`);
            }
        </script>

    </body>
@endsection
