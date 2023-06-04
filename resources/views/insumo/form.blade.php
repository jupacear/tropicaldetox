<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" placeholder="Imagen">
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" placeholder="Nombre">
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-md-6">
                    <label for="cantidad_disponible">Cantidad Disponible</label>
                    <input type="text" name="cantidad_disponible" value="{{ old('cantidad_disponible') }}" class="form-control{{ $errors->has('cantidad_disponible') ? ' is-invalid' : '' }}" placeholder="Cantidad Disponible">
                    {!! $errors->first('cantidad_disponible', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="unidad_medida">Unidad Medida</label>
                    <input type="text" name="unidad_medida" value="{{ old('unidad_medida') }}" class="form-control{{ $errors->has('unidad_medida') ? ' is-invalid' : '' }}" placeholder="Unidad Medida">
                    {!! $errors->first('unidad_medida', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-md-6">
                    <label for="precio_unitario">Precio Unitario</label>
                    <input type="text" name="precio_unitario" value="{{ old('precio_unitario') }}" class="form-control{{ $errors->has('precio_unitario') ? ' is-invalid' : '' }}" placeholder="Precio Unitario">
                    {!! $errors->first('precio_unitario', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="activo">Activo</label>
            <input type="checkbox" name="activo" value="1" {{ old('activo') ? 'checked' : '' }} class="form-control{{ $errors->has('activo') ? ' is-invalid' : '' }}">
            {!! $errors->first('activo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>