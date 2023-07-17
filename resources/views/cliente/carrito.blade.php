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
                        <tbody>
                            @foreach ($carrito as $indice => $producto)
                                <tr>
                                    <td>{{ $producto['nombre'] }}</td>
                                    <td>{{ $producto['precio'] }}</td>
                                    <td>
                                        <!-- Formulario para actualizar la cantidad del producto -->
                                        <form action="{{ route('actualizarCantidadCarrito', $indice) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="cantidad" min="1"
                                                value="{{ $producto['cantidad'] }}">
                                            <button type="submit" class="btn third">Actualizar</button>
                                        </form>
                                    </td>
                                    <td>{{ $producto['subtotal'] }}</td>
                                    <td>
                                        <!-- Formulario para eliminar el producto del carrito -->
                                        <form action="{{ route('eliminarProductoCarrito', $indice) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn thirdd">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-center " > --}}
        @if (empty(\Illuminate\Support\Facades\Auth::user()->name))
            <button type="submit" class="btn btn-primary" onclick="mostrarAlerta()">Guardar Pedido</button>
        @else
            {{-- <form action="{{ route('guardarPedido') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn third">Guardar Pedido</button>

                </form> --}}
            <form id="formulario-guadar-pedido" action="{{ route('guardarPedido') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="Nombre">si vas a utilizar otras dirección ponlo aqui:</label>
                    <input type="text" name="Nombre" id="Nombre" class="form-control">
                </div>
                <button type="button" class="btn third" onclick="confirmarGuardarPedido()">Guardar Pedido</button>
            </form>
        @endif
        {{-- </div> --}}
    </div>
    <!-- Tu código HTML existente del carrito -->


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
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
                    // Si el usuario confirma la eliminación, enviar el formulario
                    var form = document.getElementById('formulario-guadar-pedido');
                    form.submit();
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
    <script>
        function mostrarAlerta() {
            // alert('El nombre de usuario está vacío. Por favor, inicie sesión.');

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

    <script>
        // Validar la entrada del usuario antes de enviar el formulario
        document.querySelector('form').addEventListener('submit', function(event) {
            var cantidadInput = document.getElementById('cantidad');
            var cantidad = parseInt(cantidadInput.value);

            if (cantidad <= 0) {
                alert('La cantidad debe ser mayor que 0.');
                event.preventDefault(); // Evitar que el formulario se envíe
            }
        });
    </script>


    <!-- Continúa con el resto del código HTML del carrito -->

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
</body>
