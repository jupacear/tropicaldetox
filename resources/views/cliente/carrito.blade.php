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
    <title>Carrito</title>
</head>

<body>
    @include('cliente.nav')

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Carrito de Compras</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="carrito-body">
                            <!-- Filas de productos en el carrito -->
                        </tbody>
                        <tr>

                            <th colspan="3">
                                Total del Pedido:
                            </th>
                            <th>
                                <span id="totalPedido">0.00</span>
                            </th>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

        @if (empty(\Illuminate\Support\Facades\Auth::user()->name))
            <button type="submit" class="btn third" onclick="mostrarAlerta()">Guardar Pedido</button>
        @else
            <form id="formulario-guadar-pedido" action="{{ route('guardarPedido') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="Nombre">si vas a utilizar otras dirección ponlo aqui:</label>
                    <input type="text" name="Direcion" id="Direcion" class="form-control">
                </div>
                <Script>
                    let direccionInput = document.getElementById('Direcion');

                    // Add event listener for 'blur' event to trim the input value
                    direccionInput.addEventListener('blur', function() {
                        direccionInput.value = direccionInput.value.trim();
                    });
                </Script>
                <input type="hidden" name="carrito" id="carrito" value="">
                <input type="hidden" name="productosPersonalizados" id="productosPersonalizados" value="">
                <button type="submit" class="btn third">Guardar Pedido</button>
            </form>
        @endif
    </div>
    @if (session('script'))
        {!! session('script') !!}
    @endif

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function calcularTotalPedido() {
            let totalPedido = 0;

            // Cálculo del total de productos personalizados
            var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
            if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                productosPersonalizadosGuardados.forEach(function(productoPersonalizado) {
                    productoPersonalizado.insumos.forEach(function(insumo) {
                        let insumoData = insumo.split(':');
                        totalPedido += parseFloat(insumoData[3].trim());
                    });
                });
            }

            // Cálculo del total del carrito
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            carrito.forEach(function(producto) {
                totalPedido += producto.subtotal;
            });

            return totalPedido; // Asegurarse de que el total tenga solo 2 decimales
        }

        // Función para mostrar los productos personalizados en la tabla
        function mostrarProductosPersonalizados() {
            var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
            var carritoBody = $('.carrito-body');

            if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                productosPersonalizadosGuardados.forEach(function(productoPersonalizado, index) {
                    // Crea una nueva fila en la tabla con los datos del producto personalizado
                    var row = $('<tr>');
                    row.append($('<td>').text(productoPersonalizado.Nombre));

                    // Calcular el subtotal a partir del array "insumos"
                    let subtotal = 0;
                    productoPersonalizado.insumos.forEach(function(insumo) {
                        let insumoData = insumo.split(':');
                        subtotal += parseFloat(insumoData[3].trim());
                    });
                    row.append($('<td>').text(subtotal));

                    // La cantidad en productos personalizados siempre será 1, ya que es un producto único
                    row.append($('<td>').text('1'));

                    // El subtotal en productos personalizados será el mismo que el total, ya que solo hay un producto
                    row.append($('<td>').text(subtotal));

                    // Agrega la fila a la tabla
                    carritoBody.append(row);

                    // Agregar botón de eliminar para productos personalizados
                    let columnaAcciones = document.createElement('td');
                    let botonEliminar = document.createElement('button');
                    botonEliminar.textContent = 'Eliminar';
                    botonEliminar.className = 'btn thirdd';
                    botonEliminar.addEventListener('click', function() {
                        eliminarProductoPersonalizado(index);
                    });
                    columnaAcciones.appendChild(botonEliminar);
                    row.append(columnaAcciones);
                });
            }
        }

        // Función para actualizar el total en el DOM
        function actualizarTotalEnDOM() {
            let totalPedido = calcularTotalPedido();
            document.getElementById('totalPedido').textContent = totalPedido;
        }

        // Resto de funciones existentes (sin cambios)

        // Al cargar la página, mostrar los productos personalizados en la tabla y calcular el total
        $(document).ready(function() {
            // Código existente para mostrar los productos no personalizados (sin cambios)

            // Mostrar los productos personalizados en la tabla y calcular el total
            mostrarProductosPersonalizados();

            // Calcular el total y actualizarlo en el DOM
            actualizarTotalEnDOM();
        });

        // Al cargar la página, mostrar los productos personalizados en la tabla y calcular el total
        // Al cargar la página, mostrar los productos personalizados en la tabla y calcular el total
        $(document).ready(function() {
            var productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados'));
            var carritoBody = $('.carrito-body');

            var total = 0; // Variable para almacenar el total del pedido

            if (productosPersonalizadosGuardados && productosPersonalizadosGuardados.length > 0) {
                productosPersonalizadosGuardados.forEach(function(productoPersonalizado, index) {
                    // // Crea una nueva fila en la tabla con los datos del producto personalizado
                    // var row = $('<tr>');
                    // row.append($('<td>').text(productoPersonalizado.Nombre));
                    // row.append($('<td>').text(productoPersonalizado.Subtotal));

                    // // La cantidad en productos personalizados siempre será 1, ya que es un producto único
                    // row.append($('<td>').text('1'));

                    // // El subtotal en productos personalizados será el mismo que el total, ya que solo hay un producto
                    // row.append($('<td>').text(productoPersonalizado.Subtotal));

                    // // Agrega la fila a la tabla
                    // carritoBody.append(row);


                    // Agregar botón de eliminar para productos personalizados
                    let columnaAcciones = document.createElement('td');
                    let botonEliminar = document.createElement('button');
                    botonEliminar.textContent = 'Eliminar';
                    botonEliminar.className = 'btn thirdd';
                    botonEliminar.addEventListener('click', function() {
                        eliminarProductoPersonalizado(index);
                    });
                    columnaAcciones.appendChild(botonEliminar);
                    row.append(columnaAcciones);


                });


            }

        });



        function eliminarProductoPersonalizado(index) {
            let productosPersonalizadosGuardados = JSON.parse(localStorage.getItem('productosPersonalizados')) || [];
            productosPersonalizadosGuardados.splice(index, 1);
            localStorage.setItem('productosPersonalizados', JSON.stringify(productosPersonalizadosGuardados));
            location.reload();
        }

        function actualizarCantidadCarrito(indice, cantidad) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            carrito[indice].cantidad = cantidad;
            carrito[indice].subtotal = carrito[indice].precio * cantidad; // Actualizar el subtotal
            localStorage.setItem('carrito', JSON.stringify(carrito));
            actualizarSubtotalEnDOM(indice, carrito[indice].subtotal); // Actualizar el subtotal en el DOM
            actualizarTotalEnDOM(); // Actualizar el total en el DOM
        }

        document.addEventListener("DOMContentLoaded", function() {
            let productosPersonalizados = JSON.parse(localStorage.getItem('productosPersonalizados')) || [];

            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            let tablaCarrito = document.querySelector('.carrito-body');
            tablaCarrito.innerHTML = '';
            let total = 0; // Variable para almacenar el total del pedido

            carrito.forEach(function(producto) {
                let fila = document.createElement('tr');

                let columnaProducto = document.createElement('td');
                columnaProducto.textContent = producto.nombre; // Nombre del producto
                fila.appendChild(columnaProducto);

                let columnaPrecio = document.createElement('td');
                columnaPrecio.textContent = producto.precio; // Precio del producto
                fila.appendChild(columnaPrecio);

                let columnaCantidad = document.createElement('td');
                let inputCantidad = document.createElement('input');
                inputCantidad.type = 'number';
                inputCantidad.min = 1;
                inputCantidad.value = producto.cantidad;

                // Add event listener for 'input' event to validate the input
                inputCantidad.addEventListener('input', function() {
                    const inputValue = inputCantidad.value.trim();
                    const validNumberRegex = /^\d+$/;

                    if (!validNumberRegex.test(inputValue)) {
                        // If the input doesn't match the regular expression (contains 'e' or non-numeric characters)
                        // Set the value to the previous valid value (producto.cantidad)
                        inputCantidad.value = producto.cantidad;
                    } else {
                        // If the input is valid, update the cantidad in the carrito
                        actualizarCantidadCarrito(carrito.indexOf(producto), parseInt(inputValue));
                    }
                });
                columnaCantidad.appendChild(inputCantidad);
                fila.appendChild(columnaCantidad);

                let columnaSubtotal = document.createElement('td');
                producto.subtotal = producto.precio * producto.cantidad; // Calcular el subtotal
                columnaSubtotal.textContent = producto.subtotal;
                fila.appendChild(columnaSubtotal);

                let columnaAcciones = document.createElement('td');
                let botonEliminar = document.createElement('button');
                botonEliminar.textContent = 'Eliminar';
                botonEliminar.className = 'btn thirdd';
                botonEliminar.addEventListener('click', function() {
                    eliminarProductoCarrito(carrito.indexOf(producto));
                });
                columnaAcciones.appendChild(botonEliminar);
                fila.appendChild(columnaAcciones);

                tablaCarrito.appendChild(fila);

            });


            let totalPedido = calcularTotalPedido();
            document.getElementById('totalPedido').textContent = totalPedido;


            // Actualizar el valor del campo oculto con los productos personalizados
            document.getElementById('productosPersonalizados').value = JSON.stringify(productosPersonalizados);
        });



        function actualizarSubtotalEnDOM(indice, subtotal) {
            let tablaCarrito = document.querySelector('.carrito-body');
            let fila = tablaCarrito.children[indice];
            let columnaSubtotal = fila.querySelector('td:nth-child(4)');
            columnaSubtotal.textContent = subtotal;
        }






        document.getElementById('formulario-guadar-pedido').addEventListener('submit', function(event) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            document.getElementById('carrito').value = JSON.stringify(carrito);
        });



        function eliminarProductoCarrito(indice) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            carrito.splice(indice, 1);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            location.reload();
        }

        document.getElementById('formulario-guadar-pedido').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe de inmediato

            // Aquí puedes realizar las operaciones que desees antes de enviar el formulario
            // Por ejemplo, si necesitas validar algo antes de enviar el pedido, puedes hacerlo aquí

            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            document.getElementById('carrito').value = JSON.stringify(carrito);

            // Mostrar el mensaje de confirmación para guardar el pedido
            confirmarGuardarPedido();
        });

        function confirmarGuardarPedido() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción guardará el pedido.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Cancelar',
                cancelButtonText: 'Guardar'
            }).then((result) => {
                if (!result.isConfirmed) {
                    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                    let carritoInput = document.getElementById('carrito');
                    carritoInput.value = JSON.stringify(carrito);
                    var form = document.getElementById('formulario-guadar-pedido');
                    form.submit();
                    localStorage.removeItem('carrito'); // Borra el carrito del Local Storage
                    localStorage.removeItem('productosPersonalizados'); // Borra el carrito del Local Storage
                }
            });
        }


        function mostrarAlerta() {
            Swal.fire({
                title: 'Usted no está registrado',
                text: 'Para tener acceso a este servicio debes iniciar sesión. ¿Desea iniciar sesión?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Ok',
                confirmButtonText: 'Iniciar sesión'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        }
    </script>





    <style>
        .third {
            border-color: #0069D9;
            color: #ffffff;
            box-shadow: 0 0 40px 40px #007bff inset, 0 0 0 0 #037bfc;
            -webkit-transition: all 150ms ease-in-out;
            transition: all 150ms ease-in-out;
        }

        .third:hover {
            box-shadow: 0 0 10px 0 #3498db inset, 0 0 10px 4px #3498db;
            color: #000000;

        }

        .thirdd {
            border-color: #ae0017;
            color: #ffffff;
            box-shadow: 0 0 40px 40px #ae0017 inset, 0 0 0 0 #ae0017;
            -webkit-transition: all 150ms ease-in-out;
            transition: all 150ms ease-in-out;
        }

        .thirdd:hover {
            box-shadow: 0 0 10px 0 #eb0221 inset, 0 0 10px 4px #ff0022;
            color: #000000;

        }
    </style>
    <!-- ALL JS FILES -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/inewsticker.js"></script>
    {{-- <script src="js/bootsnav.js"></script> --}}
    <script src="js/images-loded.min.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script>
    <script src="js/custom.js"></script>


</body>

</html>
