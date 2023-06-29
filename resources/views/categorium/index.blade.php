@extends('layouts.app')

@section('title')
Categoria
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Categoria</h3>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ route('categoria.create') }}">Nuevo</a>

                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef" class="thead">
                                    <tr>
                                        <th style="color:#fff;">No</th>

                                        <th style="color:#fff;">Imagen</th>
                                        <th style="color:#fff;">Nombre</th>
                                        <th style="color:#fff;">Descripcion</th>
                                        <th style="color:#fff;">Estado</th>
                                        <th style="color:#fff;">Opciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categoria as $categorium)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            @if ($categorium->imagen)
                                            <img src="{{ asset($categorium->imagen) }}" alt="Imagen del categoria" width="25">
                                            @else
                                            Sin imagen
                                            @endif
                                        </td>

                                        <td class="">{{ $categorium->nombre }}</td>
                                        <td>{{ $categorium->descripcion }}</td>
                                        <td>{{ $categorium->activo ? 'Activo' : 'Inactivo' }}</td>
                                        <td>
                                            <form action="{{ route('categoria.destroy', $categorium->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('categoria.show', $categorium->id) }}"><i class="fa fa-fw fa-eye"></i>Mostrar</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('categoria.edit', $categorium->id) }}"><i class="fa fa-fw fa-edit"></i>Editar</a>
                                                @csrf
                                                @method('DELETE')
                                                @if ($categorium->activo)
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-fw fa-toggle-on"></i> Desactivar
                                                </button>
                                                @else
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-fw fa-toggle-off"></i> Activar
                                                </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Centramos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $categoria->links() !!}
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