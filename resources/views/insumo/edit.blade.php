@extends('layouts.app')

@section('title')
    Actualizar Insumo
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Insumo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    @includeif('partials.errors')

                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('insumo.update', $insumo['id']) }}" role="form"
                                enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                @csrf

                                @include('insumo.form')

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
