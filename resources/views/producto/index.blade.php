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
                                {{-- <table class="table table-striped table-hover"> --}}
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead style="background-color:#6777ef" class="thead">
                                        <tr>
                                            <th style="color:#fff;">No</th>

                                            <th style="color:#fff;">Imagen</th>
                                            <th style="color:#fff;">Nombre</th>
                                            <th style="color:#fff;">Precio</th>
                                            <th style="color:#fff;">Descripcion</th>
                                            <th style="color:#fff;">Nombre de categoria</th>
                                            <th style="color:#fff;">Opciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td>{{ ++$i }}</td>

                                                <td>{{ $producto->imagen }}</td>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>{{ $producto->precio }}</td>
                                                <td>{{ $producto->descripcion }}</td>
                                                <td>{{ $producto->categorium->nombre }}</td>

                                                <td>
                                                    <form action="{{ route('productos.destroy', $producto->id) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('productos.show', $producto->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i>Mostrar</a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('productos.edit', $producto->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i>Editar</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-fw fa-trash"></i>Eliminar
                                                        </button>
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
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                responsive: true
            });
    
            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection