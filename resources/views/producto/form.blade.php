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
                {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''), 'placeholder' => 'Imagen']) }}
                {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                {{ Form::label('nombre') }}
                {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('precio') }}
                {{ Form::text('precio', $producto->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
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
            <div id="additional-insumos"></div>
        </div>
        @if(Route::currentRouteName() !== 'productos.create')
        <div class="form-group">
            {{ Form::label('activo') }}
            {{ Form::checkbox('activo', 1, $producto->activo ?? true, ['class' => 'form-control' . ($errors->has('activo') ? ' is-invalid' : '')]) }}
            {!! $errors->first('activo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        @endif

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
        });
    });
</script>