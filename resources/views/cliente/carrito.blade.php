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
                                            <input type="number" name="cantidad" value="{{ $producto['cantidad'] }}">
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </form>
                                    </td>
                                    <td>{{ $producto['subtotal'] }}</td>
                                    <td>
                                        <!-- Formulario para eliminar el producto del carrito -->
                                        <form action="{{ route('eliminarProductoCarrito', $indice) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Tu código HTML existente del carrito -->



    @if (empty(\Illuminate\Support\Facades\Auth::user()->name))
        <button type="submit" class="btn btn-primary" onclick="mostrarAlerta()">Guardar Pedido</button>
    @else
        <form action="{{ route('guardarPedido') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Guardar Pedido</button>
        </form>
    @endif

    <script>
        function mostrarAlerta() {
            alert('El nombre de usuario está vacío. Por favor, inicie sesión.');
        }
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
