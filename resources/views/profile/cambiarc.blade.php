@extends('layouts.app')

@section('content')

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@if (Session::has('sweet-alert'))
    <script>
        Swal.fire({
            icon: '{{ Session::get("sweet-alert.type") }}',
            title: '{{ Session::get("sweet-alert.title") }}',
            text: '{{ Session::get("sweet-alert.text") }}',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif
<div class="container mb-5" style="background-color: #fff;">
    <!--- Mensajes -->
    
    <h2 class="text-center">Cambiar contraseña <hr></h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('changePassword2') }}" method="POST" class="needs-validation" novalidate>
                @csrf 

                <div class="row mb-3">
                    <div class="form-group mt-3">
                        <label for="password_actual">Clave Actual</label>
                        <input type="password" name="password_actual" class="form-control @error('password_actual') is-invalid @enderror" required>
                        @error('password_actual')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="form-group mt-3">
                        <label for="new_password">Nueva Clave</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="form-group mt-3">
                        <label for="confirm_password">Confirmar nueva Clave</label>
                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" required>
                        @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row text-center mb-4 mt-5">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" id="formSubmit">Guardar Cambios</button>
                        <a href="/home" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('form');
        
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                return;
            }
            
            event.preventDefault();
            
            Swal.fire({
                title: 'Cambio de contraseña exitoso',
                text: 'La contraseña se ha cambiado correctamente.',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/home';
                }
            });
        });
    });
</script>

@if (Session::has('sweet-alert'))
    <script>
        Swal.fire({
            icon: '{{ Session::get("sweet-alert.type") }}',
            title: '{{ Session::get("sweet-alert.title") }}',
            text: '{{ Session::get("sweet-alert.text") }}',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif

@endsection
