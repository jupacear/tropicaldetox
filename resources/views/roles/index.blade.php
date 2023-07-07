@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('roles.create') }}">Nuevo</a>
                            <table class="table table-striped mt-2" id="example">
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">Rol</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @if ($role->name !== 'administrador' && $role->name !== 'cliente')
                                                    <a class="btn btn-sm btn-success" href="{{ route('roles.edit', $role->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i>Editar
                                                    </a>
                                                @endif

                                                <a class="btn btn-sm btn-primary" href="{{ route('roles.show', $role->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i>Mostrar
                                                </a>

                                                @if ($role->name !== 'administrador')
                                                    @if ($role->estado)
                                                        {!! Form::open([
                                                            'method' => 'PUT',
                                                            'route' => ['roles.deactivate', $role->id],
                                                            'style' => 'display:inline',
                                                        ]) !!}
                                                        <button type="submit" class="btn btn-sm btn-info">
                                                            <i class="fa fa-fw fa-toggle-on"></i>Desactivar
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @else
                                                        {!! Form::open([
                                                            'method' => 'PUT',
                                                            'route' => ['roles.activate', $role->id],
                                                            'style' => 'display:inline',
                                                        ]) !!}
                                                        <button type="submit" class="btn btn-sm btn-info">
                                                            <i class="fa fa-fw fa-toggle-off"></i>Activar
                                                        </button>
                                                        {!! Form::close() !!}
                                                    @endif
                                                @endif

                                                @if ($role->name !== 'administrador' && $role->name !== 'cliente')
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['roles.destroy', $role->id],
                                                    'style' => 'display:inline',
                                                    'class' => 'delete-form'
                                                ]) !!}
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)"><i class="fa fa-fw fa-trash"></i>Eliminar</button>
                                                {!! Form::close() !!}
                                                @endif

                                                @if ($role->users->isNotEmpty() && $role->name !== 'administrador' && $role->name !== 'cliente')
                                                    <span class="text-danger">Alerta: Hay usuarios asociados, por lo tanto, no se puede eliminar.</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                            <script>
                                
                            </script>
                            <!-- Centramos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $roles->links() !!} 
                            </div>       

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
      text: 'Esta acción eliminará el rol. No podrás deshacer esta acción.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        button.closest('.delete-form').submit();
      }
    });
  }
</script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
