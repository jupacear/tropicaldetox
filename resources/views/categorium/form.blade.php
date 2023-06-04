<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('imagen') }}
            {{ Form::file('imagen', ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''), 'placeholder' => 'Imagen']) }}
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('nombre') }}
                    {{ Form::text('nombre', $categorium->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="col-md-6">
                    {{ Form::label('descripcion') }}
                    {{ Form::text('descripcion', $categorium->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                    {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="activo">Activo</label>
            <input type="checkbox" name="activo" value="1" {{ old('activo') ? 'checked' : '' }}
                class="form-control{{ $errors->has('activo') ? ' is-invalid' : '' }}">
            {!! $errors->first('activo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
