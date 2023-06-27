@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group d-flex align-items-center">
                    <a href="{{ route('A_clientes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <h3 class="page__heading ml-3 mb-0" style="margin-top: 5px;">Informacion del cliente</h3>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Nombre: {{ $user->name }}</h4>
                            <h4>Apellidos: {{ $user->apellidos }}</h4>
                            <h4>Estado: {{ $user->estado ? 'Activo' : 'Inactivo' }}</h4>
                            <h4>Email: {{ $user->email }}</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
