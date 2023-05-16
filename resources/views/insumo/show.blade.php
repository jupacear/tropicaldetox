@extends('layouts.app')

@section('title')
    Mostrar
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Detalle de insumo</h3>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <strong>Imagen:</strong>
                                <img src="{{ asset($insumo->imagen) }}" class="img-thumbnail" alt="Imagen del insumo"
                                    width="115px">
                            </div>
                            <br>
                            <div class="form-group">
                                <strong>Nombre:</strong>
                                {{ $insumo->nombre }}
                            </div>
                            <div class="form-group">
                                <strong>Estado:</strong>
                                {{ $insumo->activo }}
                            </div>
                            <div class="form-group">
                                <strong>Cantidad Disponible:</strong>
                                {{ $insumo->cantidad_disponible }}
                            </div>
                            <div class="form-group">
                                <strong>Unidad Medida:</strong>
                                {{ $insumo->unidad_medida }}
                            </div>
                            <div class="form-group">
                                <strong>Precio Unitario:</strong>
                                {{ $insumo->precio_unitario }}
                            </div>
                            <div class="float-center">
                                <a class="btn btn-primary" href="{{ route('insumo.index') }}"> Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
