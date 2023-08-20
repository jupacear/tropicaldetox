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
                    <h1 style="margin-top: 1em; text-align: center;">Mis Pedidos</h1>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {{-- <h1>Lista de Pedidos</h1> --}}

                @if (count($pedidos) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Dirección</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                                <tr>

                                    <td>{{ $pedido->Fecha }}</td>
                                    <td> {{ substr($pedido->created_at, 11, 5) }}</td>


                                    <td>
                                        @if( $pedido->Direcion)
                                        {{  $pedido->Direcion }}
                                        @else
                                        {{ $pedido->users->direccion }}

                                        @endif
                                    </td>
                                    <td style="color:#000;">
                                        <div style="background: rgba(52, 120, 187, 0.753);border-radius:1em ; display:flex;
                                        align-content: center;justify-content: center;font-size: 1.1em;width: 6em;">
                                            @if ($pedido->Estado=="En_proceso")
                                                En proceso
                                            @else
                                           {{ $pedido->Estado}}
                                            @endif

                                        </div>
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
                <p style=" font-size: 16px; font-weight: bold;">No hay pedidos disponibles.</p>

                @endif
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div style="padding-top: 25%">

    </div>
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

   



</body>


@endsection