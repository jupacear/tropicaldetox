@extends('layouts.app')

@section('title')
Detalle
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Detalle de Categoria</h3>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('categoria.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <div class="form-group">
                            <strong>Imagen:</strong>
                            <img src="{{ asset($categorium->imagen) }}" class="img-thumbnail" alt="Imagen del categoria" width="115px">
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $categorium->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $categorium->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $categorium->activo }}
                        </div>
                        <div class="float-center">
                            <a class="btn btn-primary" href="{{ route('categoria.index') }}"> Volver</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection