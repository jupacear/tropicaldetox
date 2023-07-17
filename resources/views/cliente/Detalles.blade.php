<!DOCTYPE html>
<html lang="es">

<head>
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
</head>

<body>
    @include('cliente.nav')

    <div class="container">
      
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Tus pedidos</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="section">


                    <div class="section-header">
                        <h3 class="page__heading">Pedidos</h3>
                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                               @section('title', 'Pedidos')


<section class="section">


    <div class="section-header">
        <h3 class="page__heading">Pedidos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Detalles del pedido</h1>

                                    <p><strong>Usuario:</strong> {{ $pedido->users->name }}</p>


                                    @if (!empty($pedido->Telefono))
                                        <p><strong>Teléfono:</strong> {{ $pedido->Telefono }}</p>
                                    @endif
                                    <p><strong>Estado:</strong> {{ $pedido->Estado }}</p>
                                    <p><strong>Fecha:</strong> {{ $pedido->Fecha }}</p>
                                    <p><strong>Total:</strong> {{ $pedido->Total }}</p>



                                    <h2>Detalles del pedido</h2>
                                    @if (!empty($pedido->Nombre))
                                        <p><strong>descripción:</strong> {{ $pedido->Nombre }}</p>
                                    @endif
                                    <table class="table">


                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio unitario</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach ($detalles_pedidos as $detalle)
                                                <tr>
                                                    <td>{{ $detalle->Nombre }}</td>

                                                    {{-- <td>{{ $detalle->Prductos->nombre }}</td> --}}

                                                    <td>{{ $detalle->cantidad }}</td>

                                                    <td>{{ $detalle->precio_unitario }}</td>
                                                </tr>
                                            @endforeach


                                            <?php $per = ''; ?>
                                            @foreach ($personaliza as $personalizas)
                                                @if (!($personalizas->nombre == $per))
                                                    <?php $per = $personalizas->nombre; ?>
                                                    <tr>
                                                        <td>{{ $personalizas->nombre }}</td>
                                                        <td>{{ $personalizas->cantidad }}</td>
                                                        <td>{{ $personalizas->Subtotal }}</td>
                                                        <td>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            <thead>
                                                <tr>
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th> {{ $detalles_pedidos->id_pedidos = $pedido->Total }}</th>
                                                </tr>
                                            </thead>

                                            {{-- <tr> {{ $detalle->id_pedidos = $pedido->Total }}</tr> --}}
                                            {{-- <td>{{ $detalle->id_pedidos = $pedido->Total }}</td> --}}
                                        </tbody>
                                    </table>
                                    <a class="btn btn-dark" href="{{ route('pedidos.index') }} ">Regresar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>








                                            </div>
                                        </div>
                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>
    <!-- Tu código HTML existente del carrito -->


    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>



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
