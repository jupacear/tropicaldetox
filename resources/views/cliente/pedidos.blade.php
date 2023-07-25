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
    <title>detalles de pedido</title>
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
                <h1>Lista de Pedidos</h1>

                @if (count($pedidos) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nueva Direccion</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Dirección</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->Nombre }}</td>
                                    <td>{{ $pedido->Estado }}</td>
                                    <td>{{ $pedido->Fecha }}</td>
                                    <td>{{ $userDirecion }}</td>
                                    <td>{{ $pedido->Total }}</td>
                                    <td>
                                        <!-- Enlace para ver el detalle del pedido -->
                                        <a href="{{ route('Detalle', $pedido->id) }}" class="btn btn-info">Ver Detalle</a>
                                    </td>



                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay pedidos disponibles.</p>
                @endif
            </div>
        </div>
    </div>
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

</html>
