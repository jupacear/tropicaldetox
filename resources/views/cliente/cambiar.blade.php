@include('cliente.nav')


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
            <form action="{{ route('changecontrasena') }}" method="POST" class="needs-validation" novalidate>
                @csrf 

                <div class="row mb-3">
                    <div class="form-group mt-3">
                        <label for="password_actual">Clave Actual</label>
                        <div class="input-group">
                            <input type="password" name="password_actual" class="form-control @error('password_actual') is-invalid @enderror" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" id="toggle-password-actual">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
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
                        <div class="input-group">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" id="toggle-new-password">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
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
                        <div class="input-group">
                            <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" id="toggle-confirm-password">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                        @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        $(".toggle-password").click(function () {
                            $(this).toggleClass("active");
                            var input = $(this).closest(".input-group").find("input");
                            input.attr("type", input.attr("type") === "password" ? "text" : "password");
                        });
                    });
                </script>

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

@include('cliente.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>