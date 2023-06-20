@extends('layouts.app')

@section('title', 'Crear Pedido')
@section('content')

    {{-- <section class="section"> --}}
    <section class="" style=" margin: 40px;
    padding: 20px;">
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

                            <div class="container">
                                <ul class="product-list">
                                    <li>
                                        <h2>Productos</h2>
                                    </li>
                                    <div class="form-group">
                                        <label for="busqueda">Buscar producto:</label>
                                        <input type="text" id="busqueda" class="form-control"
                                            placeholder="Ingrese el nombre del producto">
                                    </div>
                                    <button class="btn btn-info btn-sm " data-toggle="modal"
                                        data-target="#Personalizados">Personalizados</button>
                                    <!-- Modal Personalizados-->
                                    <div class="modal fade my-modal" id="Personalizados" tabindex="-1" role="dialog"
                                        aria-labelledby="Personalizados" aria-hidden="true"
                                        style="position: absolute; z-index: 1050;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="Personalizados">
                                                        Producto Personalizados</h5>


                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>


                                                <div class="modal-body">
                                                    <div class="insumos">
                                                        <h5>Insumo</h5>
                                                        @foreach ($Insumo as $Insumos)
                                                            <div class="insumo" data-id="{{ $Insumos->id }}">
                                                                <img src="{{ asset($Insumos->imagen) }}"
                                                                    alt="Imagen del producto" width="40em">
                                                                <span>{{ $Insumos->id }}: {{ $Insumos->nombre }} $:
                                                                    {{ $Insumos->precio_unitario }}</span>
                                                                <button type="button"
                                                                    class="btn btn-success agregar-insumo">Agregar</button>
                                                                <br>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                    <div class="insumos_selecionados">
                                                        <h5>Insumo selecionados</h5>

                                                    </div>
                                                </div>
                                                <!-- Agrega aquí más detalles del producto Personalizados si es necesario -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="crearPersonalizados"
                                                        data-dismiss="modal">Crear</button>

                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Personalizados-->
                                    @foreach ($productos as $producto)
                                        <li>

                                            <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto"
                                                width="40em">
                                            <span>{{ $producto->id }}:{{ $producto->nombre }}
                                                <br>$:{{ $producto->precio }}</span>
                                            <button class="btn btn-primary btn-sm float-right"
                                                onclick="agregarProducto('{{ $producto->id }}', '{{ $producto->nombre }}','{{ $producto->precio }}')">Agregar</button>
                                            <button class="btn btn-info btn-sm float-right" data-toggle="modal"
                                                data-target="#productModal_{{ $producto->id }}">Detalles</button>
                                        </li>

                                        <!-- Modal -->
                                        <div class="modal fade my-modal" id="productModal_{{ $producto->id }}"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="productModalLabel_{{ $producto->id }}" aria-hidden="true"
                                            style="position: absolute; z-index: 1050;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="productModalLabel_{{ $producto->id }}">
                                                            Detalles del producto</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>ID: {{ $producto->id }}</p>
                                                        <p>Nombre: {{ $producto->nombre }}</p>
                                                        <p>Precio: ${{ $producto->precio }}</p>
                                                        <!-- Agrega aquí más detalles del producto si es necesario -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>


                            <div class="selected-products-container">
                                <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="">
                                        <div class="col-md-6">

                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Usuario">Usuario:</label>
                                                        <select name="Usuario" id="Usuario"
                                                            class="form-control select2" data-live-search="true" required>
                                                            @foreach ($users as $user)
                                                                @if ($pedido->id_users == $user->id)
                                                                    <option value="{{ $user->id }}" selected>
                                                                        {{ $user->name }}</option>
                                                                @else
                                                                    <option value="{{ $user->id }}">
                                                                        {{ $user->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Estado">Estado</label>
                                                        <select name="Estado" id="Estado"
                                                            class="form-control select2" data-live-search="true" required>

                                                            <option value="">Seleccionar Estado</option>
                                                            <option value="En_proceso"
                                                                {{ $pedido->Estado == 'En_proceso' ? 'selected' : '' }}>En
                                                                proceso</option>
                                                            <option value="Finalizado"
                                                                {{ $pedido->Estado == 'Finalizado' ? 'selected' : '' }}>
                                                                Finalizado
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <h2>Productos Seleccionados:</h2>
                                                <input type="hidden" name="Productos[]"
                                                    id="productos-seleccionados-input">
                                                <div class="table">

                                                    <table id="selected-products-table" class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Producto</th>
                                                                <th>Cantidad</th>
                                                                <th>Subtotal</th>
                                                                <th>Opciones</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="selected-products-list">
                                                            @foreach ($pedido->productos as $producto)
                                                                <tr data-producto-id="{{ $producto->id }}"
                                                                    data-cantidad="{{ $producto->pivot->cantidad }}"
                                                                    data-subtotal="{{ $producto->precio * $producto->pivot->cantidad }}">
                                                                    <td>{{ $producto->id }}</td>
                                                                    <td>{{ $producto->nombre }}</td>
                                                                    <td>{{ $producto->pivot->cantidad }}</td>
                                                                    <td>${{ $producto->precio * $producto->pivot->cantidad }}
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-danger btn-sm quitar-btn"
                                                                            onclick="quitarProducto('{{ $producto->id }}')">Quitar</button>
                                                                    </td>
                                                                    <input type="hidden" name="Cantidad[]"
                                                                        value="{{ $producto->pivot->cantidad }}">
                                                                    <input type="hidden" name="ProductoID[]"
                                                                        value="{{ $producto->id }}">
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>


                                                <h4>Total: $<span id="total">{{ $pedido->Total }}</span></h4>
                                                <input type="hidden" name="Total" id="total-input"
                                                    value="{{ $pedido->Total + $pedido->total }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="Nombre">Descripción:</label>
                                                <input type="text" value="{{ $pedido->Nombre }}" name="Nombre"
                                                    id="Nombre" class="form-control">
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

                                        var tr = document.createElement('tr');
                                        tr.setAttribute('data-producto-id', id);
                                        tr.setAttribute('data-cantidad', cantidad);
                                        tr.setAttribute('data-subtotal', subtotal);
                                        tr.innerHTML = `
                                            <td>${id}</td>
                                            <td>${nombre}</td>
                                            <td>${cantidad}</td>
                                            <td>$${subtotal}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm quitar-btn"
                                                    onclick="quitarProducto('${id}')">Quitar</button>
                                            </td>
                                        `;
                                        productosSeleccionados.appendChild(tr);

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

                                        var productosSeleccionadosArray = Array.from(productosSeleccionados.querySelectorAll('tr')).map(function(
                                            tr) {
                                            return tr.textContent.split('\t');
                                        });
                                        inputProductosSeleccionados.value = JSON.stringify(productosSeleccionadosArray);

                                        totalElement.textContent = total.toFixed(2);

                                        var totalInput = document.getElementById('total-input');
                                        totalInput.value = total.toFixed(2);
                                    }
                                }

                                function quitarProducto(id) {
                                    var producto = document.querySelector(`tr[data-producto-id="${id}"]`);
                                    var cantidad = parseInt(producto.getAttribute('data-cantidad'));
                                    var subtotal = parseInt(producto.getAttribute('data-subtotal'));

                                    producto.remove();

                                    total -= subtotal;

                                    totalElement.textContent = total.toFixed(2);

                                    var totalInput = document.getElementById('total-input');
                                    totalInput.value = total.toFixed(2);

                                    var inputProductosSeleccionados = document.getElementById('productos-seleccionados-input');
                                    var productosSeleccionados = Array.from(document.querySelectorAll('#selected-products-list tr')).map(function(
                                        tr) {
                                        return tr.textContent.split('\t');
                                    });

                                    inputProductosSeleccionados.value = JSON.stringify(productosSeleccionados);

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
                                }
                            </script>
                            <script>
                                const busquedaInput = document.getElementById('busqueda');
                                const productItems = document.querySelectorAll('.product-list li');

                                busquedaInput.addEventListener('input', function() {
                                    const searchTerm = busquedaInput.value.toLowerCase();

                                    productItems.forEach(function(item) {
                                        const nombreProducto = item.textContent.toLowerCase();

                                        if (nombreProducto.includes(searchTerm)) {
                                            item.style.display = 'block';
                                        } else {
                                            item.style.display = 'none';
                                        }
                                    });
                                });
                            </script>



                            <script>
                                $(document).ready(function() {
                                    var maxSeleccionados = 3; // Cantidad máxima de productos seleccionados

                                    $('.agregar-insumo').click(function() {
                                        if ($('.insumos_selecionados li').length < maxSeleccionados) {
                                            var insumoId = $(this).closest('.insumo').data('id');
                                            var insumoNombre = $(this).siblings('span').text();

                                            // Crea un elemento de lista con el nombre del insumo seleccionado
                                            var listItem = $('<li>').text(insumoNombre);

                                            // Agrega el insumo seleccionado a la lista de insumos seleccionados
                                            $('.insumos_selecionados').append(listItem);
                                        } else {
                                            alert('Ya has seleccionado la cantidad máxima de productos.');
                                        }
                                    });
                                });
                            </script>
                            <script>
                                document.getElementById('crearPersonalizados').addEventListener('click', function() {
                                    var insumosSeleccionados = Array.from(document.querySelectorAll('.insumos_selecionados li')).map(
                                        function(li) {
                                            return li.textContent.trim();
                                        });

                                    var idInsumoArray = [];
                                    var nombreInsumoArray = [];
                                    var precioInsumoArray = [];

                                    // Imprimir los datos en la tabla
                                    var tableBody = document.getElementById('selected-products-list');
                                    var total = 0;

                                    // Limpiar la tabla
                                    tableBody.innerHTML = '';

                                    insumosSeleccionados.forEach(function(insumo) {
                                        var data = insumo.split(':');
                                        var id = data[0].trim();
                                        var nombre = data[1].trim();
                                        var precio = parseFloat(data[2].trim());
                                        var cantidad = 1; // Puedes establecer la cantidad como desees
                                        var subtotal = precio * cantidad;
                                        total += subtotal;

                                        idInsumoArray.push(id);
                                        nombreInsumoArray.push(nombre);
                                        precioInsumoArray.push(precio);

                                        var row = document.createElement('tr');
                                        row.innerHTML = `
                                        <td>${id}</td>
                                        <td>${nombre}</td>
                                        <td>${cantidad}</td>
                                        <td>$${subtotal.toFixed(2)}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm quitar-btn" onclick="quitarProductoo('${id}')">Quitar</button>
                                        </td>
                                        `;
                                        row.setAttribute('data-id', id); // Agrega este atributo con el ID del producto
                                        tableBody.appendChild(row);
                                    });

                                    // Actualizar el total
                                    var totalElement = document.getElementById('total');
                                    totalElement.textContent = total.toFixed(2);
                                    var totalSection = document.getElementById('total-section');
                                    totalSection.style.display = 'block';

                                    // Aquí puedes hacer uso de los arrays idInsumoArray, nombreInsumoArray y precioInsumoArray
                                    console.log('ID de los insumos:', idInsumoArray);
                                    console.log('Nombres de los insumos:', nombreInsumoArray);
                                    console.log('Precios de los insumos:', precioInsumoArray);
                                });
                            </script>

                            <script>
                                function quitarProductoo(id) {
                                    // Obtener la fila correspondiente al ID del producto
                                    var row = document.querySelector(`#selected-products-list tr[data-id="${id}"]`);

                                    // Eliminar la fila de la tabla
                                    if (row) {
                                        row.remove();
                                    }

                                    // Recalcular el total
                                    var total = 0;
                                    var subtotalElements = document.querySelectorAll('#selected-products-list td:nth-child(4)');
                                    subtotalElements.forEach(function(element) {
                                        total += parseFloat(element.textContent.replace('$', ''));
                                    });

                                    // Actualizar el total mostrado
                                    var totalElement = document.getElementById('total');
                                    totalElement.textContent = total.toFixed(2);
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .container {
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
