@extends('layouts.app')

@section('title')
Mostrar Producto
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Detalle de Producto</h3>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Imagen:</strong>
                            <img src="{{ asset($producto->imagen) }}" class="img-thumbnail" alt="Imagen del producto" width="115px">
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $producto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $producto->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $producto->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $producto->activo }}
                        </div>
                        <div class="form-group">
                            <strong>Categorias Id:</strong>
                            {{ $producto->categorias_id }}
                        </div>

                        <div class="form-group">
                            <strong>Insumos:</strong>
                            <ul>
                                @foreach($producto->insumos as $insumo)
                                <li>{{ $insumo->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="float-center">
                            <a class="btn btn-primary" href="{{ route('productos.index') }}"> Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection