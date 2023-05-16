@extends('layouts.app')

@section('title')
    Insumo
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">insumo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('insumo.create') }}">Nuevo</a>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">

                                    <thead style="background-color:#6777ef" class="thead">
                                        <tr>
                                            <th style="color:#fff;">No</th>
                                            <th style="color:#fff;">Imagen</th>
                                            <th style="color:#fff;">Nombre</th>
                                            <th style="color:#fff;">Estado</th>
                                            <th style="color:#fff;">Cantidad Disponible</th>
                                            <th style="color:#fff;">Unidad Medida</th>
                                            <th style="color:#fff;">Precio Unitario</th>
                                            <th style="color:#fff;">Opciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($insumos as $insumo)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>
                                                    @if ($insumo->imagen)
                                                        <img src="{{ asset($insumo->imagen) }}" alt="Imagen del insumo"
                                                            width="25">
                                                    @else
                                                        Sin imagen
                                                    @endif
                                                </td>
                                                <td>{{ $insumo->nombre }}</td>
                                                <td>{{ $insumo->activo }}</td>
                                                <td>{{ $insumo->cantidad_disponible }}</td>
                                                <td>{{ $insumo->unidad_medida }}</td>
                                                <td>{{ $insumo->precio_unitario }}</td>

                                                <td>
                                                    <form action="{{ route('insumo.destroy', $insumo->id) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('insumo.show', $insumo->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('insumo.edit', $insumo->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i>Editar</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-fw fa-trash"></i>Desactivar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Centramos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $insumos->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                responsive: true
            });

            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection
