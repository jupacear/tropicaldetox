@extends('layouts.app')

@section('title')
    Insumo
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Insumos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
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
                                                <td>
                                                    @if ($insumo->activo == 1)
                                                        Activo
                                                    @else
                                                        Inactivo
                                                    @endif
                                                </td>
                                                <td>{{ $insumo->cantidad_disponible }}</td>
                                                <td>{{ $insumo->unidad_medida }}</td>
                                                <td>{{ number_format($insumo->precio_unitario, 0, '.','.') }}</td>


                                                <td>
                                                    <form action="{{ route('insumo.destroy', $insumo->id) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('insumo.show', $insumo->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> </a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('insumo.edit', $insumo->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        @if ($insumo->activo)
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-fw fa-toggle-off"></i>
                                                            </button>
                                                        @else
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fa fa-fw fa-toggle-on"></i>

                                                            </button>
                                                        @endif
                                                    </form>
                                                </td>
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
    </section>
    <script>
        function confirmDesactivateInsumo(event) {
            event.preventDefault();
            var form = $(event.target).closest('form');
            Swal.fire({
                icon: 'warning',
                title: '¿Estás seguro?',
                text: 'Esta acción desactivará la categoría',
                showCancelButton: true,
                confirmButtonText: 'Sí, desactivar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function confirmActivateInsumo(event) {
            event.preventDefault();
            var form = $(event.target).closest('form');
            Swal.fire({
                icon: 'warning',
                title: '¿Estás seguro?',
                text: 'Esta acción activará la categoría',
                showCancelButton: true,
                confirmButtonText: 'Sí, activar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                responsive: true
            });

            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection
