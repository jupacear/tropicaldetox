





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
                    
                                    <p><strong>Nombre:</strong> {{ $pedido->Nombre }}</p>
                                    <p><strong>Teléfono:</strong> {{ $pedido->Telefono }}</p>
                                    <p><strong>Estado:</strong> {{ $pedido->Estado }}</p>
                                    <p><strong>Fecha:</strong> {{ $pedido->Fecha }}</p>
                                    <p><strong>Total:</strong> {{ $pedido->Total }}</p>
                                    <p><strong>Usuario:</strong> {{ $pedido->users->name }}</p>
                    
                                    <h2>Detalles del pedido</h2>
                    
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio unitario</th>
                                                <th>Total</th>
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
                                    </table>
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
