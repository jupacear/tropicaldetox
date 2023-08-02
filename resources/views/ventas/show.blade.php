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
                                    <p><strong>Total:</strong> {{ number_format( $pedido->Total , 0, ',', '.') }}</p>

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
                                                        <td>
                                                            <button class="btn btn-info btn-sm float-right"
                                                                data-toggle="modal"
                                                                data-target="#productModal_{{ $personalizas->id }}">Detalles</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
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


@foreach ($personaliza as $personalizas)
    <div style="" class="modal fade my-modal"
        id="productModal_{{ $personalizas->id }}" tabindex="-1" role="dialog"
        aria-labelledby="productModalLabel_{{ $personalizas->id }}" aria-hidden="true"
        style="position: absolute; z-index: 1050;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel_{{ $personalizas->id }}">
                        Detalles del producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Nombre: {{ $personalizas->nombre }}</p>
                    @foreach ($personalizas as $q)
                        @if ($insumo = App\Models\Insumo::find($q))
                            <ul>
                                <li>
                                    Insumo: ${{ $insumo->nombre }}
                            </ul>
                        @else
                        @endif
                    @endforeach

                    <!-- Agrega aquí más detalles del producto si es necesario -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endforeach






@endsection
