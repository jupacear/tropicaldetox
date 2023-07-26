@extends('layouts.app')

@section('content')
@section('title', 'Ventas')


<section class="section">


    <div class="section-header">
        <h3 class="page__heading">Ventas</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Detalles del Ventas</h1>

                                    @if (!empty($pedido->Nombre))
                                        <p><strong>Nombre:</strong> {{ $pedido->Nombre }}</p>
                                    @endif

                                    @if (!empty($pedido->Telefono))
                                        <p><strong>Teléfono:</strong> {{ $pedido->Telefono }}</p>
                                    @endif

                                    <a href="{{ route('pdf', ['id' => $pedido->id]) }}"
                                        class="btn btn-primary">Descargar PDF</a>

                                    <p><strong>Usuario:</strong> {{ $pedido->users->name }}</p>
                                    <p><strong>Estado:</strong> {{ $pedido->Estado }}</p>
                                    <p><strong>Fecha:</strong> {{ $pedido->Fecha }}</p>
                                    <p><strong>Total:</strong> {{ $pedido->Total }}</p>

                                    <h2>Detalles del Ventas</h2>

                                    <table class="table">
                                        @if (!empty($pedido->Nombre))
                                            <p style="font-size: 1.5em"><strong>descripción:</strong>
                                                {{ $pedido->Nombre }}</p>
                                        @endif
                                        @if ($pedido->Direcion)
                                            <p style="font-size: 1.5em"><strong style="font-size: 1em">direccion:
                                                    {{ $pedido->Direcion }}</strong></p>
                                        @else
                                            <p style="font-size: 1.5em"><strong style="font-size: 1em">direccion:
                                                    {{ $pedido->users->direccion }}</strong></p>
                                        @endif
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio unitario</th>
                                                <th>sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detalles_pedidos as $detalle)
                                                <tr>
                                                    <td>{{ $detalle->Prductos }}</td>
                                                    {{-- <td>{{ $detalle->Prductos->nombre }}</td> --}}
                                                    <td>{{ $detalle->cantidad }}</td>
                                                    <td>{{ $detalle->precio_unitario }}</td>
                                                    <td>{{ $detalle->cantidad * $detalle->precio_unitario }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th>Total:</th>
                                                <th> {{ $detalles_pedidos->id_pedidos = $pedido->Total }}</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <a class="btn btn-dark" href="{{ route('ventas.index') }} ">Regresar</a>
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
