@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group d-flex align-items-center">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <h3 class="page__heading ml-3 mb-0" style="margin-top: 5px;">Editar Usuario</h3>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                     
                        @if ($errors->any())                                                
                            <div class="alert alert-danger" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                <li>{{ $error }}</li>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                        {!! Form::model($user, ['method' => 'PATCH','route' => ['usuarios.update', $user->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                <label for="documento">Documento</label>
                                {!! Form::text('documento', null, array('class' => 'form-control')) !!}
                                @if ($errors->has('documento'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('documento') }}
                                        </div>
                                    @endif
                                </div>
                                </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                        <label for="name">Nombre</label>
                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        {!! Form::text('apellidos', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('apellidos'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('apellidos') }}
                                        </div>
                                    @endif
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado">
                        <option value="1" {{ isset($usuario) && $usuario->estado ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ isset($usuario) && !$usuario->estado ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        {!! Form::text('telefono', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('telefono'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('telefono') }}
                                        </div>
                                    @endif
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                        <label for="direccion">Dirección</label>
                        {!! Form::text('direccion', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('direccion'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('direccion') }}
                                        </div>
                                    @endif
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                        <label for="email">E-mail</label>
                        {!! Form::text('email', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                        <label for="password">Password</label>
                        {!! Form::password('password', array('class' => 'form-control')) !!}
                        @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                        <label for="confirm-password">Confirmar Password</label>
                        {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                        @if ($errors->has('confirm-password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('confirm-password') }}
                                        </div>
                                    @endif
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            
                            
                            <div class="form-group">
                                <label for="roles">Rol:</label>
                                {!! Form::select('roles', $roles, $userRole, array('class' => 'form-control')) !!}
                            </div>
                            
                            
                            
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md 12">
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


