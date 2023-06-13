@extends('layouts.app')

@section('title', 'Editar Pedido')
@section('content')

    <section class="" style=" margin: 40px;
    padding: 20px;">
        <div class="section-header">
            <h3 class="page__heading">Crear Pedido</h3>
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
                                                            <img src="{{ asset($Insumos->imagen) }}" alt="Imagen del producto" width="40em">
                                                            <span>{{ $Insumos->id }}:  {{ $Insumos->nombre }} $:  {{ $Insumos->precio_unitario }}</span>
                                                            <button type="button" class="btn btn-success agregar-insumo">Agregar</button>
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
                                                    <button type="button" class="btn btn-primary"
                                                        data-dismiss="modal">crear</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

                                        <!-- Modal productModal-->
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
                                <form action="{{ route('pedidos.store') }}" method="POST">

                                    @csrf

                                    <div class="">

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="Usuario">Usuario:</label>
                                                <select name="Usuario" id="Usuario" class="form-control select2"
                                                    data-live-search="true" required>
                                                    <option value="">Seleccionar Usuario</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <h2>Productos Seleccionados:</h2>
                                            <input type="hidden" name="Productos[]" id="productos-seleccionados-input">

                                            <ul id="selected-products-list">

                                            </ul>
                                            <h4 id="total-section" style="display: none;">Total: $<span
                                                    id="total">0</span></h4>
                                            <input type="hidden" name="Total" id="total-input" value="">
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="Nombre">Descripción:</label>
                                                <input type="text" name="Nombre" id="Nombre"
                                                    class="form-control">
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
                                var totalSection = document.getElementById('total-section');
                                var total = 0; // Inicializar el total en 0

                                function agregarProducto(id, nombre, precio) {
                                    var cantidad = prompt('Ingrese la cantidad del producto "' + nombre + '":');
                                    if (cantidad !== null && cantidad !== '') {
                                        cantidad = parseInt(cantidad);
                                        var subtotal = cantidad * precio;
                                        total += subtotal;

                                        var productosSeleccionados = document.getElementById('selected-products-list');
                                        var inputProductosSeleccionados = document.getElementById('productos-seleccionados-input');

                                        var li = document.createElement('li');
                                        li.setAttribute('data-producto-id', id);
                                        li.setAttribute('data-cantidad', cantidad);
                                        li.setAttribute('data-subtotal', subtotal);
                                        li.innerHTML = `
                                    ${nombre} - Cantidad: ${cantidad} - Subtotal: $${subtotal}
                                    <button class="btn btn-danger btn-sm quitar-btn"
                                        onclick="quitarProducto('${id}')">Quitar</button>
                                `;
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

                                        var productosSeleccionadosArray = Array.from(productosSeleccionados.querySelectorAll('li')).map(function(
                                            li) {
                                            return li.textContent.split(' - Cantidad: ')[0];
                                        });
                                        inputProductosSeleccionados.value = productosSeleccionadosArray.join(', ');

                                        totalElement.textContent = total.toFixed(2);
                                        totalSection.style.display = 'block';

                                        var totalInput = document.getElementById('total-input');
                                        totalInput.value = total.toFixed(2);
                                    }
                                }

                                function quitarProducto(id) {
                                    var producto = document.querySelector(`li[data-producto-id="${id}"]`);
                                    var cantidad = parseInt(producto.getAttribute('data-cantidad'));
                                    var subtotal = parseFloat(producto.getAttribute('data-subtotal'));

                                    producto.remove();

                                    var productosSeleccionados = document.getElementById('selected-products-list');
                                    var inputProductosSeleccionados = document.getElementById('productos-seleccionados-input');
                                    var inputCantidadArray = document.getElementsByName('Cantidad[]');
                                    var inputProductoIDArray = document.getElementsByName('ProductoID[]');

                                    var cantidadIndex, productoIDIndex;

                                    // Buscar el índice del producto a eliminar en los arrays Cantidad[] y ProductoID[]
                                    for (var i = 0; i < inputProductoIDArray.length; i++) {
                                        if (inputProductoIDArray[i].value === id) {
                                            cantidadIndex = i;
                                            productoIDIndex = i;
                                            break;
                                        }
                                    }

                                    // Eliminar el elemento correspondiente del array Cantidad[]
                                    inputCantidadArray[cantidadIndex].remove();

                                    // Eliminar el elemento correspondiente del array ProductoID[]
                                    inputProductoIDArray[productoIDIndex].remove();

                                    var productosSeleccionadosArray = Array.from(productosSeleccionados.querySelectorAll('li')).map(function(li) {
                                        return li.textContent.split(' - Cantidad: ')[0];
                                    });
                                    inputProductosSeleccionados.value = productosSeleccionadosArray.join(', ');

                                    if (productosSeleccionados.querySelectorAll('li').length === 0) {
                                        total = 0; // Si no hay productos restantes, establecer el total en 0
                                        totalSection.style.display = 'none'; // Ocultar la sección de total
                                    } else {
                                        total -= subtotal;
                                    }

                                    totalElement.textContent = total.toFixed(2);

                                    var totalInput = document.getElementById('total-input');
                                    totalInput.value = total.toFixed(2);
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
