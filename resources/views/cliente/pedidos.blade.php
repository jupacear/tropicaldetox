@extends('layouts.auth_app')
@section('title')
    Pedidos
@endsection
@section('content')

<body>
   

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
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Dirección</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido->Estado }}</td>
                                    <td>{{ $pedido->Fecha }}</td>
                                    <td> {{ substr($pedido->created_at, 11, 5) }}</td>
                                   

                                    <td>
                                        @if( $pedido->Direcion)
                                        {{  $pedido->Direcion }}
                                        @else
                                        {{ $pedido->users->direccion }}

                                        @endif
                                    </td>

                                    <td> {{ number_format($pedido->Total, 0, ',', '.') }}
                                    
                                    </td>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

   



</body>


@endsection