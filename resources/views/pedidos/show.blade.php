@extends('layouts.app')

@section('content')
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








@endsection
