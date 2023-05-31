@extends('layouts.app')

@section('title', 'Editar Pedido')
@section('content')

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Pedido</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="containeer">
                                <ul class="product-list">
                                    <li>
                                        <h2>Productos</h2>
                                    </li>
                                    @foreach ($productos as $producto)
                                        <li>
                                            <span>{{ $producto->id }}:{{ $producto->nombre }}
                                                <br>$:{{ $producto->precio }}</span>
                                            <button class="btn btn-primary btn-sm float-right"
                                                onclick="agregarProducto('{{ $producto->id }}', '{{ $producto->nombre }} ','{{$producto->precio }}')">Agregar</button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="selected-products-container">
                                <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2>Productos Seleccionados:</h2>
                                            <input type="hidden" name="Productos[]" id="productos-seleccionados-input">

                                            <ul id="selected-products-list">
                                                @foreach ($pedido->productos as $producto)
                                                    <li>{{ $producto->nombre }} - Cantidad: {{ $producto->pivot->cantidad }} - Subtotal: ${{ $producto->precio * $producto->pivot->cantidad }}</li>
                                                    <input type="hidden" name="Cantidad[]" value="{{ $producto->pivot->cantidad }}">
                                                    <input type="hidden" name="ProductoID[]" value="{{ $producto->id }}">
                                                @endforeach
                                            </ul>
                                            <h4>Total: $<span id="total">{{ $pedido->Total }}</span></h4>
                                            <input type="hidden" name="Total" id="total-input" value="{{ $pedido->total }}">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Estado">Estado</label>
                                                <select name="Estado" id="Estado" class="form-control select2" data-live-search="true" required>
                                                    <option value="">Seleccionar Estado</option>
                                                    <option value="En_proceso" {{ $pedido->Estado == 'En_proceso' ? 'selected' : '' }}>En proceso</option>
                                                    <option value="Finalizado" {{ $pedido->Estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="Usuario">Usuario:</label>
                                                <select name="Usuario" id="Usuario" class="form-control select2" data-live-search="true" required>
                                                    <option value="">Seleccionar Usuario</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ $pedido->Usuario == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="Fecha">Fecha</label>
                                                <input required value="{{ $pedido->Fecha }}" name="Fecha" type="date" class="form-control" id="Fecha" aria-describedby="FechaHelp" placeholder="Fecha">
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <button type="submit" class="btn btn-primary">Actualizar Pedido</button>
                                                <a class="btn btn-dark" href="{{ route('pedidos.index') }}">Regresar</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <script>
                                var totalElement = document.getElementById('total');
                                var total = parseFloat(totalElement.textContent);

                                function agregarProducto(id, nombre, precio) {
                                    var cantidad = prompt('Ingrese la cantidad del producto "' + nombre + '":');
                                    if (cantidad !== null && cantidad !== '') {
                                        cantidad = parseInt(cantidad);
                                        var subtotal = cantidad * precio;
                                        total += subtotal;

                                        var productosSeleccionados = document.getElementById('selected-products-list');
                                        var inputProductosSeleccionados = document.getElementById('productos-seleccionados-input');

                                        var li = document.createElement('li');
                                        li.textContent = nombre + ' - Cantidad: ' + cantidad + ' - Subtotal: $' + subtotal;
                                        productosSeleccionados.appendChild(li);

                                        var inputCantidad = document.createElement('input');
                                        inputCantidad.type = 'hidden';
                                        inputCantidad.name = 'Cantidad[]';
                                        inputCantidad.value = cantidad;
                                        productosSeleccionados.appendChild(inputCantidad);

                                        var inputProductoID = document.createElement('input');
                                        inputProductoID.type = 'hidden';
                                        inputProductoID.name = 'ProductoID[]';
                                        inputProductoID.value = id;
                                        productosSeleccionados.appendChild(inputProductoID);

                                        var productosSeleccionadosArray = Array.from(productosSeleccionados.querySelectorAll('li')).map(function(li) {
                                            return li.textContent.split(' - Cantidad: ')[0];
                                        });
                                        inputProductosSeleccionados.value = productosSeleccionadosArray.join(', ');

                                        totalElement.textContent = total.toFixed(2);

                                        var totalInput = document.getElementById('total-input');
                                        totalInput.value = total.toFixed(2);
                                    }
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .containeer {
            width: 20em;
            height: 100vh;
            overflow-y: scroll;
            float: right;
        }

        .product-list {
            list-style-type: none;
            padding: 0;
        }

        .product-list li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
    </style>
@endsection
