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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ route('productos.create') }}">Nuevo</a>
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
                                        <td>{{ $producto->precio }}</td>
                                        <td>{{ $producto->descripcion }}</td>
                                        <td>{{ $producto->activo }}</td>
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
                                                <a class="btn btn-sm btn-primary" href="{{ route('productos.show', $producto->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('productos.edit', $producto->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal" data-form-id="deleteProductForm-{{ $producto->id }}"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
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

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que quieres eliminar este producto?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form id="deleteProductForm" action="#" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: true
        });

        new $.fn.dataTable.FixedHeader(table);
    });

    $(document).ready(function() {
        var deleteFormId;

        // Captura el evento click del botón de eliminar y guarda el ID del formulario
        $(document).on('click', '[data-toggle="modal"][data-target="#confirmDeleteModal"]', function() {
            deleteFormId = $(this).data('form-id');
        });

        // Captura el evento submit del formulario del modal y envía la solicitud de eliminación
        $('#confirmDeleteModal').on('submit', '#deleteProductForm', function(e) {
            e.preventDefault(); // Evita el envío del formulario
            $('#' + deleteFormId).submit(); // Envía la solicitud de eliminación
            $('#confirmDeleteModal').modal('hide'); // Cierra el modal
        });
    });
</script>
@endsection