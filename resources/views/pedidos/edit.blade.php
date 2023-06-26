@extends('layouts.app')

@section('title', 'Crear Pedido')
@section('content')

    {{-- <section class="section"> --}}
    <section class=""
        style=" 
    padding: 40px;
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  border-radius: 4px;
  margin-bottom: 20px;
    ">
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
                                                            <?php $per = ''; ?>
                                                            @foreach ($personaliza as $personalizas)
                                                                @if (!($personalizas->nombre == $per))
                                                                    <?php $per = $personalizas->nombre; ?>
                                                                    <tr>
                                                                        <td>{{ $personalizas->nombre }}</td>
                                                                        <td>{{ $personalizas->cantidad }}</td>
                                                                        <td>{{ $personalizas->Subtotal }}</td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm quitar-btn"
                                                                                onclick="quitarProductoPersonalizados(${uniqueId})">Quitar</button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach



                                                        </tbody>
                                                        <input type="hidden" name="personalizadosArray"
                                                            id="personalizadosArray">
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
                                // Obtener el elemento del total actual
                                var totalElement = document.getElementById('total');

                                // Obtener el valor actual del total
                                var currentTotal = parseFloat(totalElement.textContent);

                                // Calcular el nuevo total sumando el valor del pedido y el valor total
                                var pedidoTotal = parseFloat("{{ $pedido->Total }}");
                                var nuevoTotal = pedidoTotal + currentTotal;

                                // Actualizar el valor del total en el elemento HTML
                                totalElement.textContent = nuevoTotal.toFixed(2);

                                // Obtener el elemento del input oculto para el total
                                var totalInput = document.getElementById('total-input');

                                // Actualizar el valor del input oculto
                                totalInput.value = nuevoTotal.toFixed(2);



                                // var totalElement = document.getElementById('total');
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

                                    $('#Personalizados').on('hidden.bs.modal', function() {
                                        // Elimina todos los insumos seleccionados
                                        $('.insumos_selecionados').empty();
                                    });

                                });
                            </script>




                            <script>
                                var personalizadosArray = [];

                                document.getElementById('crearPersonalizados').addEventListener('click', function() {
                                    var insumosSeleccionados = Array.from(document.querySelectorAll('.insumos_selecionados li')).map(
                                        function(li) {
                                            return li.textContent.trim();
                                        }
                                    );

                                    var tableBody = document.getElementById('selected-products-list');
                                    var total = 0;

                                    insumosSeleccionados.forEach(function(insumo) {
                                        var data = insumo.split(':');
                                        var precio = parseFloat(data[2].trim());
                                        var id = parseFloat(data[0].trim());
                                        var cantidad = 1;
                                        var subtotal = precio * cantidad;
                                        total += subtotal;
                                    });

                                    var personalizado = {}; // Crear un objeto para almacenar los datos del personalizado

                                    var num = personalizadosArray.length + 1;
                                    personalizado['Nombre'] = "Personalizado " + num;
                                    personalizado['insumos'] = insumosSeleccionados;
                                    personalizado['Subtotal'] = total;

                                    personalizadosArray.push(personalizado);

                                    var row = document.createElement('tr');
                                    var uniqueId = personalizadosArray.length - 1; // Obtener el índice único del personalizado
                                    row.innerHTML = `
                                <td>${personalizado.Nombre}</td>
                                <td>${insumosSeleccionados.length}</td>
                                <td>$${total.toFixed(2)}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm quitar-btn" onclick="quitarProductoPersonalizados(${uniqueId})">Quitar</button>
                                </td>
                                     `;
                                    row.setAttribute('data-id', uniqueId); // Asignar el índice único como el atributo data-id
                                    tableBody.appendChild(row);

                                    var totalElement = document.getElementById('total');
                                    totalElement.textContent = total.toFixed(2);

                                    var totalSection = document.getElementById('total-section');
                                    if (totalSection) {
                                        totalSection.style.display = 'block';
                                    }

                                    console.log('Datos personalizados:', personalizadosArray);

                                    var personalizadosArrayInput = document.getElementById('personalizadosArray');
                                    personalizadosArrayInput.value = JSON.stringify(personalizadosArray);
                                });

                                function quitarProductoPersonalizados(id) {
                                    // Obtener el personalizado correspondiente al ID
                                    var personalizado = personalizadosArray[id];

                                    // Eliminar el personalizado del array
                                    personalizadosArray.splice(id, 1);

                                    // Recalcular el total
                                    var total = 0;
                                    personalizadosArray.forEach(function(personalizado) {
                                        total += personalizado.insumos.length;
                                    });

                                    // Eliminar la fila de la tabla
                                    var row = document.querySelector(`#selected-products-list tr[data-id="${id}"]`);
                                    if (row) {
                                        row.remove();
                                    }

                                    // Actualizar el total mostrado
                                    var totalElement = document.getElementById('total');
                                    totalElement.textContent = total.toFixed(2);

                                    // Actualizar el campo oculto con los datos actualizados
                                    var personalizadosArrayInput = document.getElementById('personalizadosArray');
                                    personalizadosArrayInput.value = JSON.stringify(personalizadosArray);
                                }







                                @foreach ($personaliza as $personalizas)
                                    var personalizado = {};
                                    personalizado['Nombre'] = '{{ $personalizas->nombre }}';

                                    var insumos = [];
                                    @foreach (\App\Models\ProducPerz::where('id', $personalizas->id)->get() as $producPerz)
                                        var insumoObj = {
                                            'id': {{ $producPerz->insumos }},
                                            'cantidad': {{ $producPerz->cantidad }},
                                        };
                                        insumos.push(insumoObj);
                                    @endforeach

                                    personalizado['Insumos'] = insumos;
                                    personalizado['Subtotal'] = '{{ $personalizas->Subtotal }}';

                                    personalizadosArray.push(personalizado);
                                @endforeach

                                var personalizadosArrayJson = JSON.stringify(personalizadosArray);
                                console.log(personalizadosArray);
                            </script>



                            {{-- @foreach ($personaliza as $personalizas)
                                <script>
                                    var personalizado = {};
                                    personalizado['Nombre'] = '{{ $personalizas->nombre }}';
                                    personalizado['insumos'] = {!! $personalizas->insumos !!}; // No es necesario decodificar los datos de los insumos
                                    personalizado['Subtotal'] = '{{ $personalizas->Subtotal }}';

                                    personalizadosArray.push(personalizado);
                                    console.log(personalizado);
                                    console.log(personalizadosArray);
                                </script>
                            @endforeach --}}


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
