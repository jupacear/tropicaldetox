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
                        
        
                        <table class="table table-striped mt-2">
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
                                            @else
                                                <button class="btn btn-primary btn-sm" disabled>
                                                    <i class="fa fa-fw fa-edit"></i>No se puede editar
                                                </button>
                                            @endif
                            
                                            @if ($role->name !== 'administrador')
                                                {!! Form::open([
                                                    'method' => 'PUT',
                                                    'route' => ['roles.updateStatus', $role->id],
                                                    'style' => 'display:inline',
                                                ]) !!}
                                                <button type="submit" class="btn btn-sm btn-info">
                                                    @if ($role->is_active)
                                                        <i class="fa fa-fw fa-toggle-on"></i>Desactivar
                                                    @else
                                                        <i class="fa fa-fw fa-toggle-off"></i>Activar
                                                    @endif
                                                </button>
                                                {!! Form::close() !!}
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>
                                                    No se puede cambiar el estado
                                                </button>
                                            @endif
                            
                                            @if ($role->name !== 'administrador' && $role->name !== 'cliente')
                                                {!! Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['roles.destroy', $role->id],
                                                    'style' => 'display:inline',
                                                    'onsubmit' => 'return confirmDelete(event)'
                                                ]) !!}
                                                <button type="submit" class="btn btn-sm btn-danger" {{ $role->users->isNotEmpty() ? 'disabled' : '' }}>
                                                    <i class="fa fa-fw fa-trash"></i>Eliminar
                                                </button>
                                                {!! Form::close() !!}
                                            @else
                                                <button class="btn btn-danger btn-sm" disabled>
                                                    <i class="fa fa-fw fa-trash"></i>No se puede eliminar
                                                </button>
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
                            function confirmDelete(event) {
                                var hasUsers = event.target.closest('tr').getAttribute('data-has-users');
                                
                                if (hasUsers === 'true') {
                                    alert("No se puede eliminar el rol porque tiene usuarios asociados.");
                                    event.preventDefault();
                                } else {
                                    return confirm("¿Seguro que quieres eliminar este rol?");
                                }
                            }
                        </script>

                            <!-- Centramos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $roles->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection