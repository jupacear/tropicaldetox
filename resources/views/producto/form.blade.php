<style>
    .custom-checkbox.form-check-input {
        width: 2.25rem;
        /* Aumenta el ancho */
        height: 2.25rem;
        /* Aumenta la altura */
    }

    .custom-checkbox.form-check-input:checked {
        transform: scale(1.2);
        /* Aumenta el tamaño cuando está marcado */
    }
</style>

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-row">
            <div class="form-group col-md-6">
                {{ Form::label('categorias_id', 'Categoria') }}
                {{ Form::select('categorias_id', $categorias, $producto->categorias_id, ['class' => 'form-control' . ($errors->has('categorias_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona una categoría']) }}
                {!! $errors->first('categorias_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('imagen') }}
                @if ($producto->imagen)
                <div>
                    <img src="{{ asset($producto->imagen) }}" alt="Imagen actual" width="200">
                </div>
                @endif
                {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''), 'placeholder' => 'Imagen']) }}
                {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                {{ Form::label('nombre') }}
                {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre', 'onkeyup' => 'validateNombre(this)', 'onblur' => 'removeSpaces(this)']) }}
                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('precio') }}
                {{ Form::text('precio', $producto->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio', 'oninput' => 'validatePrecio(this)']) }}
                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                {{ Form::label('descripcion') }}
                {{ Form::text('descripcion', $producto->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                <div class="d-flex align-items-center">
                    {{ Form::label('insumos', 'Insumos', ['class' => 'mr-2']) }}
                    {{ Form::select('insumos[]', $insumos, $producto->insumos->pluck('id')->toArray(), ['class' => 'form-control' . ($errors->has('insumos') ? ' is-invalid' : ''), 'id' => 'insumos-select']) }}
                    <button type="button" class="btn btn-primary btn-sm ml-2" id="add-insumo">Agregar insumo</button>
                </div>
            </div>
            <!-- <div class="form-group col-md-2">
                {{ Form::label('cantidad_utilizada[]', 'Cantidad a utilizar') }}
                {{ Form::number('cantidad_utilizada[]', null, ['class' => 'form-control' . ($errors->has('cantidad_utilizada') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad a utilizar']) }}
                @error('cantidad_utilizada')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div> -->

        </div>
        @if (Route::currentRouteName() !== 'productos.create')
        <div class="form-group row">
            {{ Form::label('estado:', 'Estado:', ['class' => 'col-1 col-form-label']) }}
            <div class="col-md-4">
                {{ Form::checkbox('activo', 1, $producto->activo ?? true, ['class' => 'custom-checkbox form-check-input' . ($errors->has('activo') ? ' is-invalid' : '')]) }}
            </div>
            {!! $errors->first('activo', '<div class="invalid-feedback col-sm-9 offset-sm-2">:message</div>') !!}
        </div>
        @endif


        <div id="additional-insumos"></div>

    </div>
    <div class="box-footer mt-3">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Evento click para agregar un nuevo selector de insumo
        $("#add-insumo").click(function() {
            var insumosSelect = $("#insumos-select").clone(); // Clonar el selector existente
            insumosSelect.val(''); // Limpiar el valor seleccionado

            // Crear un nuevo div para el selector de insumo y agregarlo al contenedor
            var newInsumoDiv = $("<div></div>").addClass("form-group mt-3").append(insumosSelect);
            $("#additional-insumos").append(newInsumoDiv);

            // Agregar el campo "cantidad a utilizar" al nuevo div
            // var cantidadUtilizadaInput = $("<div class='form-group col-md-2'>" +
            //     "<label for='cantidad_utilizada'>Cantidad a utilizar</label>" +
            //     "<input type='number' name='cantidad_utilizada[]' class='form-control'>" +
            //     "</div>");
            // newInsumoDiv.append(cantidadUtilizadaInput);
        });
    });
    // Función para eliminar espacios en blanco de izquierda y derecha
    function removeSpaces(input) {
        input.value = input.value.trim();
    }
    // Función para validar el campo de nombre
    function validateNombre(input) {
        for (let i = 0; i < input.value.length; i++) {
            const charCode = input.value.charCodeAt(i);

            // Aceptar letras mayúsculas (65-90), letras minúsculas (97-122) y espacio (32)
            if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode !== 32) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El nombre solo puede contener letras y espacios',
                });
                input.value = ''; // Limpia el valor del campo si no es válido
                return;
            }
        }
    }
    // Función para validar el campo de descripción
    function validateDescripcion(input) {
        for (let i = 0; i < input.value.length; i++) {
            const charCode = input.value.charCodeAt(i);

            // Aceptar letras mayúsculas (65-90), letras minúsculas (97-122), espacios (32), comas (44), puntos (46), signo de exclamación (33) y signo de exclamación abierto (161)
            if (
                (charCode < 65 || charCode > 90) &&
                (charCode < 97 || charCode > 122) &&
                charCode !== 32 &&
                charCode !== 44 &&
                charCode !== 46 &&
                charCode !== 33 &&
                charCode !== 161
            ) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La descripción solo puede contener letras, espacios, comas, puntos y signos de exclamación',
                });
                input.value = ''; // Limpia el valor del campo si no es válido
                return;
            }
        }
    }
    // Funcion para evitar el escribir cualquier otro dato que no sea numerico
    function validatePrecio(input) {
        const inputValue = input.value.trim(); // Eliminar espacios al inicio y al final

        // Validar si el valor ingresado contiene caracteres diferentes a números y el punto
        for (let i = 0; i < inputValue.length; i++) {
            const charCode = inputValue.charCodeAt(i);

            // Aceptar solo números (48-57) y el punto (46)
            if ((charCode < 48 || charCode > 57) && charCode !== 46) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El precio debe ser un número válido',
                });
                input.value = ''; // Limpia el valor del campo si no es válido
                return;
            }
        }
    }
</script>