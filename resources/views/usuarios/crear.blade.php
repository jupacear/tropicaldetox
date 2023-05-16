@extends('layouts.app')

@section('content')

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Alta de Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif
                        
                            <!-- ... -->
                            <div>
                                <label for="rol">Rol:</label>
                                <select id="rol" name="rol">
                                    <option value="">Elige una opcion</option>
                                    <option value="administrador">Administrador</option>
                                    <option value="cliente">Cliente</option>
                                </select>
                            </div>
                            
                            {!! Form::open(array('route' => 'usuarios.store','method'=>'POST')) !!}
                            <div id="nombreDiv" style="display: none;" >
                                <label for="name"  >Nombre:</label>
                                {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            </div>
                            <div id="apellidosDiv" style="display: none;" >
                                <label for="apellidos">Apellidos:</label>
                                {!! Form::text('apellidos', null, array('class' => 'form-control')) !!}
                            </div>
                            <div id="estadoDiv" style="display: none;" >
                                <label for="estado">Estado:</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option value="1" {{ isset($usuario) && $usuario->estado ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ isset($usuario) && !$usuario->estado ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                            <div id="documentoDiv" style="display: none;">
                                <label for="documento">Documento:</label>
                                {!! Form::text('documento', null, array('class' => 'form-control')) !!}
                            </div>
                            <div id="telefonoDiv" style="display: none;">
                                <label for="telefono">Teléfono:</label>
                                {!! Form::text('telefono', null, array('class' => 'form-control')) !!}
                            </div>
                            <div id="direccionDiv" style="display: none;">
                                <label for="direccion">Dirección:</label>
                                {!! Form::text('direccion', null, array('class' => 'form-control')) !!}
                            </div>
                            <div id="emailDiv" style="display: none;">
                                <label for="email">E-mail:</label>
                                {!! Form::text('email', null, array('class' => 'form-control')) !!}
                            </div>
                            <div id="passwordDiv" style="display: none;">
                                <label for="password">Password:</label>
                                {!! Form::password('password', array('class' => 'form-control')) !!}
                            </div>
                            <div id="confirmPasswordDiv" style="display: none;">
                                <label for="confirm-password">Confirmar Password:</label>
                                {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                            </div>
                            <div id="rolesDiv" style="visibility: hidden;">
                                <label for="">Roles:</label>
                                {!! Form::select('roles[]', $roles, null, array('class' => 'form-control', 'id' => 'rolesSelect')) !!}
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            {!! Form::close() !!}
                            
                            <script>
                                const rolSelect = document.getElementById('rol');
                                const rolesSelect = document.getElementById('rolesSelect');
                            
                                rolSelect.addEventListener('change', function() {
                                    if (rolSelect.value === 'administrador') {
                                        documentoDiv.style.display = 'none';
                                        telefonoDiv.style.display = 'none';
                                        direccionDiv.style.display = 'none';
                                        emailDiv.style.display  = 'block';
                                        nombreDiv.style.display  = 'block';
                                        apellidosDiv.style.display = 'block';
                                        passwordDiv.style.display = 'block';
                                        confirmPasswordDiv.style.display = 'block';
                                        estadoDiv.style.display = 'block';

                                        // Establecer el valor predeterminado del select de roles a "administrador"
                                        rolesSelect.value = "administrador";
                                    } else {
                                        nombreDiv.style.display  = 'block';
                                        apellidosDiv.style.display = 'block';
                                        documentoDiv.style.display = 'block';
                                        estadoDiv.style.display = 'block';
                                        telefonoDiv.style.display = 'block';
                                        direccionDiv.style.display = 'block';
                                        emailDiv.style.display = 'block';
                                        passwordDiv.style.display = 'block';
                                        confirmPasswordDiv.style.display = 'block';

                                        // Establecer el valor predeterminado del select de roles a "cliente"
                                        rolesSelect.value = "cliente";
        }
    });
</script>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection