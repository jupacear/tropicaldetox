@extends('layouts.app')

@section('content')
@section('title', 'Pedidos')


<section class="section">


    <div class="section-header">
        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h3 class="page__heading ml-3 mb-0">Pedido</h3>
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
                                    <p><strong>Total:</strong> {{ number_format( $pedido->Total , 0, ',', '.') }}</p>



                                    <h2>Detalles del pedido</h2>
                                    @if (!empty($pedido->Nombre))
                                        <p style="font-size: 1.5em"><strong>descripción:</strong> {{ $pedido->Nombre }}
                                        </p>
                                    @endif

                                    @if ($pedido->Direcion)
                                        <p style="font-size: 1.5em"><strong style="font-size: 1em">direccion:
                                                {{ $pedido->Direcion }}</strong></p>
                                    @else
                                        <p style="font-size: 1.5em"><strong style="font-size: 1em">direccion:
                                                {{ $pedido->users->direccion }}</strong></p>
                                    @endif

                                    <table class="table">


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
                                                    <td>{{ $detalle->Nombre }}</td>

                                                    {{-- <td>{{ $detalle->Prductos->nombre }}</td> --}}

                                                    <td>{{ $detalle->cantidad }}</td>

                                                    <td>{{ $detalle->precio_unitario }}</td>
                                                    <td>
                                                        {{ number_format($detalle->cantidad * $detalle->precio_unitario , 0, ',', '.') }}
                                                    </td>

                                                </tr>
                                            @endforeach


                                            <?php $per = ''; ?>
                                            @foreach ($personaliza as $personalizas)
                                                @if (!($personalizas->nombre == $per))
                                                    <?php
                                                    $per = $personalizas->nombre;
                                                    $lastSubtotal = null; // Initialize the variable to store the last Subtotal for the current $per
                                                    ?>
                                                    @foreach ($personaliza as $personalizaInner) <!-- Loop through the personaliza array again to find the last Subtotal for the current $per -->
                                                        @if ($personalizaInner->nombre == $per)
                                                            <?php $lastSubtotal = $personalizaInner->Subtotal; ?>
                                                        @endif
                                                    @endforeach
                                                    <tr>
                                                        <td>{{ $personalizas->nombre }}</td>
                                                        <td>{{ $personalizas->cantidad }}</td>
                                                        <td>{{ number_format($lastSubtotal, 0, ',', '.') }}</td> <!-- Print the last Subtotal for the current $per -->
                                                    </tr>
                                                @endif
                                            @endforeach
                                            

                                            <thead>
                                                <tr>
                                                    <th>Total:</th>
                                                    <th>
                                                        {{ number_format( $detalles_pedidos->id_pedidos = $pedido->Total , 0, ',', '.') }}
                                                    
                                                    </th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            {{-- <tr> {{ $detalle->id_pedidos = $pedido->Total }}</tr> --}}
                                            {{-- <td>{{ $detalle->id_pedidos = $pedido->Total }}</td> --}}
                                        </tbody>
                                    </table>
                                    {{-- <a class="btn btn-dark" href="{{ route('pedidos.index') }} ">Regresar</a> --}}
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
