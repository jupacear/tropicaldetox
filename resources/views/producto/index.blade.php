@extends('layouts.app')

@section('title')
Productos
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Productos</h3>
    </div>
    <div class="section-body">
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
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-left m-2">
                        <a class="btn btn-warning" href="{{ route('productos.create') }}">Nuevo</a>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead style="background-color:#6777ef" class="thead">
                                <tr>
                                    <th style="color:#fff;">No</th>
                                    <th style="color:#fff;">Imagen</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Precio</th>
                                    <th style="color:#fff;">Descripcion</th>
                                    <th style="color:#fff;">Estado</th>
                                    <th style="color:#fff;">Nombre de categoria</th>
                                    <th style="color:#fff;">Insumo</th>
                                    <th style="color:#fff;">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        @if ($producto->imagen)
                                        <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto" width="25">
                                        @else
                                        Sin imagen
                                        @endif
                                    </td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ number_format($producto->precio, 0, '.','.') }}</td>
                                    <td>{{ $producto->descripcion }}</td>
                                    <td>{{ $producto->activo ? 'Activo' : 'Inactivo' }}</td>
                                    <td>{{ $producto->categorium->nombre }}</td>
                                    <td>
                                        @foreach ($producto->insumos as $insumo)
                                        {{ $insumo->nombre }}
                                        <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <!-- Formulario de eliminación -->
                                        <form id="deleteProductForm-{{ $producto->id }}" action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                                            <a class="btn btn-sm btn-primary" href="{{ route('productos.show', $producto->id) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                            <a class="btn btn-sm btn-success" href="{{ route('productos.edit', $producto->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-form-id="deleteProductForm-{{ $producto->id }}"><i class="fa fa-fw fa-trash"></i> </button>

                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Centramos la paginacion a la derecha -->
                    <div class="pagination justify-content-end">
                        {!! $productos->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
// Sweet alert
<script>
    $(document).ready(function() {
        var deleteFormId;

        // Captura el evento click del botón de eliminar y muestra la alerta de confirmación
        $(document).on('click', '[data-toggle="modal"][data-target="#confirmDeleteModal"]', function() {
            deleteFormId = $(this).data('form-id');
            Swal.fire({
                title: 'Confirmar Eliminación',
                text: '¿Estás seguro de que quieres eliminar este producto?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + deleteFormId).submit(); // Envía la solicitud de eliminación
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ al _END_ de un total de _TOTAL_ registros.",
                "infoEmpty": "Mostrando 0 al 0 de 0 registros.",
                "infoFiltered": "(Filtrado de _MAX_ registros en total.)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros.",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes.",
                "paginate": {
                    "first": "Primero",
                    "last": "último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de forma ascendente.",
                    "sortDescending": ": Activar para ordenar la columna de forma descendente."
                }
            },
            responsive: true
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script>
@endsection