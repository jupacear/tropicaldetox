@extends('layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group d-flex align-items-center">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <h3 class="page__heading ml-3 mb-0" style="margin-top: 5px;">Crear Usuario</h3>
            </div>
        </div>
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

                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select class="form-control" id="rol" name="rol">
                                <option value="">Elige una opción</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol }}" {{ old('rol') == $rol ? 'selected' : '' }}>{{ $rol }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        {!! Form::open(['route' => 'usuarios.store', 'method' => 'POST']) !!}
                        <div class="row">
                            <div id="documentoDiv" style="{{ old('rol') ? 'display: block;' : 'display: none;' }}" class="col-sm-6">
                                <label for="documento" class="col-form-label">Documento:</label>
                                {!! Form::text('documento', null, ['class' => 'form-control']) !!}
                            </div>
                            <div id="nombreDiv" style="{{ old('rol') ? 'display: block;' : 'display: none;' }}" class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Nombre:</label>
                                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div id="apellidosDiv" style="{{ old('rol') ? 'display: block;' : 'display: none;' }}" class="col-sm-6">
                                <div class="form-group">
                                    <label for="apellidos" class="col-form-label">Apellidos:</label>
                                    {!! Form::text('apellidos', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div id="estadoDiv" style="{{ old('rol') ? 'display: none;' : 'display: none;' }}" class="col-sm-6">
                                <div class="form-group">
                                    <label for="estado" class="col-form-label">Estado:</label>
                                    <select class="form-control" id="estado" name="estado">
                                        <option value="1" {{ old('estado') ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ !old('estado') ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>
                                
                                <div id="telefonoDiv" style="{{ old('rol') ? 'display: block;' : 'display: none;' }}" class="col-sm-6">
                                    <label for="telefono" class="col-form-label">Teléfono:</label>
                                    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                                </div>
                                <div id="direccionDiv" style="{{ old('rol') ? 'display: block;' : 'display: none;' }}" class="col-sm-6">
                                    <label for="direccion" class="col-form-label">Dirección:</label>
                                    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                                </div>
                            
                            <div id="emailDiv" style="{{ old('rol') ? 'display: block;' : 'display: none;' }}" class="col-sm-6">
                                <div class="form-group">
                                    <label for="email" class="col-form-label">E-mail:</label>
                                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div id="passwordDiv" style="{{ old('rol') ? 'display: block;' : 'display: none;' }}" class="col-sm-6">
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password:</label>
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div id="confirmPasswordDiv" style="{{ old('rol') ? 'display: block;' : 'display: none;' }}" class="col-sm-6">
                                <div class="form-group">
                                    <label for="confirm-password" class="col-form-label">Confirmar Password:</label>
                                    {!! Form::password('confirm-password', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div id="rolesDiv" style="visibility: hidden;" class="col-sm-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">Roles:</label>
                                    {!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'id' => 'rolesSelect']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <script>
                            window.addEventListener('DOMContentLoaded', (event) => {
                                const rolSelect = document.getElementById('rol');
                                const rolesSelect = document.getElementById('rolesSelect');
                                const nombreDiv = document.getElementById('nombreDiv');
                                const apellidosDiv = document.getElementById('apellidosDiv');
                                const estadoDiv = document.getElementById('estadoDiv');
                                const documentoDiv = document.getElementById('documentoDiv');
                                const telefonoDiv = document.getElementById('telefonoDiv');
                                const direccionDiv = document.getElementById('direccionDiv');
                                const emailDiv = document.getElementById('emailDiv');
                                const passwordDiv = document.getElementById('passwordDiv');
                                const confirmPasswordDiv = document.getElementById('confirmPasswordDiv');

                                function showHideFields() {
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
                                }

                                rolSelect.addEventListener('change', showHideFields);

                                // Mostrar u ocultar los campos al cargar la página si hay un rol seleccionado
                                if (rolSelect.value) {
                                    showHideFields();
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
