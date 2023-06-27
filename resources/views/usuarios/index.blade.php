@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo</a>




                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Apellidos</th>
                                    <th style="color:#fff;">estado</th>
                                    <th style="color:#fff;">E-mail</th>
                                    <th style="color:#fff;">Rol</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->apellidos }}</td>

                                            <td>
                                                @if ($usuario->estado)
                                                    Activo
                                                @else
                                                    Inactivo
                                                @endif
                                            </td>

                                            <td>{{ $usuario->email }}</td>




                                            <td>
                                                @if (!empty($usuario->getRoleNames()))
                                                    @foreach ($usuario->getRoleNames() as $rolNombre)
                                                        <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td>
                                              <a class="btn btn-sm btn-success" href="{{ route('usuarios.edit', $usuario->id) }}"><i class="fa fa-fw fa-edit"></i>Editar</a>
                                              <a class="btn btn-sm btn-primary" href="{{ route('usuarios.show', $usuario->id) }}"><i class="fa fa-fw fa-eye"></i>Mostrar</a>

                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['usuarios.destroy', $usuario->id],
                                                    'style' => 'display:inline',
                                                ]) !!}
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fa fa-fw fa-trash"></i>Eliminar</button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Centramos la paginacion a la derecha -->


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
