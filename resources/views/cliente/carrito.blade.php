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
                    </table>
                </div>
            </div>
        </div>

        @if (empty(\Illuminate\Support\Facades\Auth::user()->name))
            <button type="submit" class="btn btn-primary" onclick="mostrarAlerta()">Guardar Pedido</button>
        @else
            <form id="formulario-guadar-pedido" action="{{ route('guardarPedido') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="Nombre">si vas a utilizar otras dirección ponlo aqui:</label>
                    <input type="text" name="Nombre" id="Nombre" class="form-control">
                </div>
                <input type="hidden" name="carrito" id="carrito" value="">
                <button type="submit" class="btn btn-primary">Guardar Pedido</button>
            </form>
        @endif
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                inputCantidad.addEventListener('change', function() {
                    actualizarCantidadCarrito(carrito.indexOf(producto), parseInt(inputCantidad
                        .value));
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
                botonEliminar.className = 'btn btn-danger';
                botonEliminar.addEventListener('click', function() {
                    eliminarProductoCarrito(carrito.indexOf(producto));
                });
                columnaAcciones.appendChild(botonEliminar);
                fila.appendChild(columnaAcciones);

                tablaCarrito.appendChild(fila);

                total += producto.subtotal; // Actualizar el total del pedido
            });

            // Mostrar el total en el carrito
            let filaTotal = document.createElement('tr');
            let columnaTotalEtiqueta = document.createElement('td');
            columnaTotalEtiqueta.textContent = 'Total:';
            columnaTotalEtiqueta.setAttribute('colspan', 3);
            filaTotal.appendChild(columnaTotalEtiqueta);

            let columnaTotal = document.createElement('td');
            columnaTotal.textContent = total;
            filaTotal.appendChild(columnaTotal);

            tablaCarrito.appendChild(filaTotal);
        });

        function actualizarCantidadCarrito(indice, cantidad) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            carrito[indice].cantidad = cantidad;
            carrito[indice].subtotal = carrito[indice].precio * cantidad; // Actualizar el subtotal
            localStorage.setItem('carrito', JSON.stringify(carrito));
            actualizarSubtotalEnDOM(indice, carrito[indice].subtotal); // Actualizar el subtotal en el DOM
            actualizarTotalEnDOM(); // Actualizar el total en el DOM
        }

        function actualizarSubtotalEnDOM(indice, subtotal) {
            let tablaCarrito = document.querySelector('.carrito-body');
            let fila = tablaCarrito.children[indice];
            let columnaSubtotal = fila.querySelector('td:nth-child(4)');
            columnaSubtotal.textContent = subtotal;
        }

        function actualizarTotalEnDOM() {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            let total = 0;
            carrito.forEach(function(producto) {
                total += producto.subtotal;
            });
            let columnaTotal = document.querySelector('.carrito-body tr:last-child td:last-child');
            columnaTotal.textContent = total;
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
