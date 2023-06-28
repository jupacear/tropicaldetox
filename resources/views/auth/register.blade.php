@include('cliente.nav')

@extends('layouts.auth_app')
@section('title')
    Registro
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header"><h4>Registro</h4></div>

        <div class="card-body pt-1">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="documento">Documento:</label><span class="text-danger">*</span>
                            <input id="documento" type="text" class="form-control{{ $errors->has('documento') ? ' is-invalid' : '' }}" name="documento" tabindex="2" placeholder="Enter Documento" value="{{ old('documento') }}" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('documento') }}
                            </div>
                        </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">Nombre:</label><span
                                    class="text-danger">*</span>
                            <input id="firstName" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name"
                                   tabindex="1" placeholder="Nombre" value="{{ old('name') }}"
                                   autofocus required>
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label><span class="text-danger">*</span>
                            <input id="apellidos" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" tabindex="2" placeholder="ingrese sus apellidos" value="{{ old('apellidos') }}" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('apellidos') }}
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Telefono:</label><span class="text-danger">*</span>
                            <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" tabindex="2" placeholder="ingrese su telefono" value="{{ old('telefono') }}" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('telefono') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion">Direccion:</label><span class="text-danger">*</span>
                            <input id="direccion" type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" tabindex="2" placeholder="ingrese su direccion" value="{{ old('direccion') }}" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('direccion') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email:</label><span
                                    class="text-danger">*</span>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="ingrese su email" name="email" tabindex="1"
                                   value="{{ old('email') }}"
                                   required autofocus>
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" class="control-label">Contraseña
                                :</label><span
                                    class="text-danger">*</span>
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}"
                                   placeholder="Digite su contraseña" name="password" tabindex="2" required>
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation"
                                   class="control-label">Confirmar contraseña:</label><span
                                    class="text-danger">*</span>
                            <input id="password_confirmation" type="password" placeholder="Confirma la contraseña"
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid': '' }}"
                                   name="password_confirmation" tabindex="2">
                            <div class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                Registrar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        Ya tiene una cuenta ? <a
                href="{{ route('login') }}">Inicia sesion</a>
    </div>
@endsection
