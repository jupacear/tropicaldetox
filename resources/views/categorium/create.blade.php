@extends('layouts.app')

@section('title')
    Crear Categoria
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Cear Categoria </h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @includeif('partials.errors')

                        <div class="card-body">
                            <form method="POST" action="{{ route('categoria.store') }}" role="form"
                                enctype="multipart/form-data">
                                @csrf

                                @include('categorium.form')

                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
