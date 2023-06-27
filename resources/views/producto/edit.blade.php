@extends('layouts.app')

@section('title')
Actualizar Producto
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Editar Producto</h3>
    </div>
    <div class="section-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                @includeif('partials.errors')

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('productos.update', $producto->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('producto.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection