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
                                    <option value="">Elige una opción</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol }}">{{ $rol }}</option>
                                    @endforeach
                                </select>
                            </div>


                            {!! Form::open(['route' => 'usuarios.store', 'method' => 'POST']) !!}
                            <div class="row">
                                <div id="nombreDiv" style="display: none;" class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Nombre:</label>
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div id="apellidosDiv" style="display: none;" class="col-sm-6">
                                    <div class="form-group">
                                        <label for="apellidos" class="col-form-label">Apellidos:</label>
                                        {!! Form::text('apellidos', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div id="estadoDiv" style="display: none;" class="col-sm-6">
                                    <div class="form-group">
                                        <label for="estado" class="col-form-label">Estado:</label>
                                        <select class="form-control" id="estado" name="estado">
                                            <option value="1"
                                                {{ isset($usuario) && $usuario->estado ? 'selected' : '' }}>Activo</option>
                                            <option value="0"
                                                {{ isset($usuario) && !$usuario->estado ? 'selected' : '' }}>Inactivo
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div id="documentoDiv" style="display: none;" class="col-sm-4">
                                        <label for="documento" class="col-form-label">Documento:</label>
                                        {!! Form::text('documento', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div id="telefonoDiv" style="display: none;" class="col-sm-4">
                                        <label for="telefono" class="col-form-label">Teléfono:</label>
                                        {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div id="direccionDiv" style="display: none;" class="col-sm-4">
                                        <label for="direccion" class="col-form-label">Dirección:</label>
                                        {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div id="emailDiv" style="display: none;" class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">E-mail:</label>
                                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div id="passwordDiv" style="display: none;" class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password" class="col-form-label">Password:</label>
                                        {!! Form::password('password', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div id="confirmPasswordDiv" style="display: none;" class="col-sm-6">
                                    <div class="form-group">
                                        <label for="confirm-password" class="col-form-label">Confirmar Password:</label>
                                        {!! Form::password('confirm-password', ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div id="rolesDiv" style="visibility:
hidden;" class="col-sm-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Roles:</label>
                                        {!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'id' => 'rolesSelect']) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                            {!! Form::close() !!}


                            <script>
                                const rolSelect = document.getElementById('rol');
                                const rolesSelect = document.getElementById('rolesSelect');

                                rolSelect.addEventListener('change', function() {
                                    const selectedRol = rolSelect.value;

                                    if (selectedRol === 'administrador') {
                                        documentoDiv.style.display = 'none';
                                        telefonoDiv.style.display = 'none';
                                        direccionDiv.style.display = 'none';
                                        emailDiv.style.display = 'block';
                                        nombreDiv.style.display = 'block';
                                        apellidosDiv.style.display = 'block';
                                        passwordDiv.style.display = 'block';
                                        confirmPasswordDiv.style.display = 'block';
                                        estadoDiv.style.display = 'none';

                                        // Establecer el valor predeterminado del select de roles a "administrador"
                                        rolesSelect.value = "administrador";
                                    } else if (selectedRol === 'cliente') {
                                        nombreDiv.style.display = 'block';
                                        apellidosDiv.style.display = 'block';
                                        documentoDiv.style.display = 'block';
                                        estadoDiv.style.display = 'none';
                                        telefonoDiv.style.display = 'block';
                                        direccionDiv.style.display = 'block';
                                        emailDiv.style.display = 'block';
                                        passwordDiv.style.display = 'block';
                                        confirmPasswordDiv.style.display = 'block';

                                        // Establecer el valor predeterminado del select de roles a "cliente"
                                        rolesSelect.value = "cliente";
                                    } else {
                                        // Mostrar todo el formulario si se selecciona otro rol
                                        nombreDiv.style.display = 'block';
                                        apellidosDiv.style.display = 'block';
                                        documentoDiv.style.display = 'block';
                                        estadoDiv.style.display = 'none';
                                        telefonoDiv.style.display = 'block';
                                        direccionDiv.style.display = 'block';
                                        emailDiv.style.display = 'block';
                                        passwordDiv.style.display = 'block';
                                        confirmPasswordDiv.style.display = 'block';

                                        // Establecer el valor predeterminado del select de roles a "cliente"
                                        rolesSelect.value = selectedRol;
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
