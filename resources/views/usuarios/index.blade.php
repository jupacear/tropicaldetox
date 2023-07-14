@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
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
                                                <a class="btn btn-sm btn-primary" href="{{ route('usuarios.show', $usuario->id) }}"><i class="fa fa-fw fa-eye"></i>Mostrar</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('usuarios.edit', $usuario->id) }}"><i class="fa fa-fw fa-edit"></i>Editar</a>
                                                
                                              
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['usuarios.destroy', $usuario->id],
                                                    'style' => 'display:inline',
                                                    'class' => 'delete-form'
                                                ]) !!}
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)"><i class="fa fa-fw fa-trash"></i>Eliminar</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(button) {
    Swal.fire({
      title: '¿Estás seguro?',
      text: 'Esta acción eliminará al usuario. No podrás deshacer esta acción.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        button.parentNode.submit();
      }
    });
  }
</script>

@endsection
