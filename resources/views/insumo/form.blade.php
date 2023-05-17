<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('imagen') }}
            {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''), 'placeholder' => 'Imagen']) }}
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $insumo->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cantidad_disponible') }}
            {{ Form::text('cantidad_disponible', $insumo->cantidad_disponible, ['class' => 'form-control' . ($errors->has('cantidad_disponible') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad Disponible']) }}
            {!! $errors->first('cantidad_disponible', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('unidad_medida') }}
            {{ Form::text('unidad_medida', $insumo->unidad_medida, ['class' => 'form-control' . ($errors->has('unidad_medida') ? ' is-invalid' : ''), 'placeholder' => 'Unidad Medida']) }}
            {!! $errors->first('unidad_medida', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio_unitario') }}
            {{ Form::text('precio_unitario', $insumo->precio_unitario, ['class' => 'form-control' . ($errors->has('precio_unitario') ? ' is-invalid' : ''), 'placeholder' => 'Precio Unitario']) }}
            {!! $errors->first('precio_unitario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('activo') }}
            {{ Form::checkbox('activo', 1, $insumo->activo ?? true, ['class' => 'form-control' . ($errors->has('activo') ? ' is-invalid' : '')]) }}
            {!! $errors->first('activo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
