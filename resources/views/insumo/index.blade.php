@extends('layouts.app')

@section('title')
    Insumos
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Insumos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('insumo.create') }}">Nuevo</a>

                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead style="background-color:#6777ef" class="thead">
                                        <tr>
                                            <th style="color:#fff;">No</th>
                                            <th style="color:#fff;">Imagen</th>
                                            <th style="color:#fff;">Nombre</th>
                                            <th style="color:#fff;">Estado</th>
                                            <th style="color:#fff;">Cantidad Disponible</th>
                                            <th style="color:#fff;">Unidad Medida</th>
                                            <th style="color:#fff;">Precio Unitario</th>
                                            <th style="color:#fff;">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($insumos as $key => $insumo)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    @if ($insumo['imagen'])
                                                        <img src="{{ asset($insumo['imagen']) }}" alt="Imagen del insumo"
                                                            width="25">
                                                    @else
                                                        Sin imagen
                                                    @endif
                                                </td>
                                                <td>{{ $insumo['nombre'] }}</td>
                                                <td>
                                                    @if ($insumo['activo'] == 1)
                                                        Activo
                                                    @else
                                                        Desactivado
                                                    @endif
                                                </td>
                                                <td>{{ $insumo['cantidad_disponible'] }}</td>
                                                <td>{{ $insumo['unidad_medida'] }}</td>
                                                <td>{{ $insumo['precio_unitario'] }}</td>
                                                <td>
                                                    <form action="{{ route('insumo.destroy', $insumo['id']) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('insumo.show', $insumo['id']) }}"><i
                                                                class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('insumo.edit', $insumo['id']) }}"><i
                                                                class="fa fa-fw fa-edit"></i>Editar</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        @if ($insumo['activo'])
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-fw fa-trash"></i> Desactivar
                                                            </button>
                                                        @else
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                <i class="fa fa-fw fa-check"></i> Activar
                                                            </button>
                                                        @endif
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                responsive: true
            });

            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
@endsection

{{-- 

@foreach ($insumos as $insumo)
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <img src="{{ $insumo['imagen'] }}" class="card-img-top"
                                                alt="{{ $insumo['nombre'] }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $insumo['nombre'] }}</h5>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Cantidad disponible:
                                                        {{ $insumo['cantidad_disponible'] }}, {{ $insumo['unidad_medida'] }}
                                                    </li>
                                                    <li class="list-group-item">Estado del insumo:
                                                        @if ($insumo['activo'] == 1)
                                                            Activo
                                                        @else
                                                            Desactivado
                                                        @endif
                                                    </li>
                                                    <li class="list-group-item">Precio unitario:
                                                        {{ $insumo['precio_unitario'] }}</li>
                                                </ul>
                                                <form action="{{ route('insumo.destroy', $insumo['id']) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('insumo.show', $insumo['id']) }}" <i
                                                        class="fa fa-fw fa-eye"></i>
                                                        Mostrar
                                                    </a>
                                                    <a class="btn
                                                        btn-sm btn-success"
                                                        href="{{ route('insumo.edit', $insumo['id']) }}"><i
                                                            class="fa fa-fw fa-edit"></i>Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    @if ($insumo['activo'])
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-fw fa-trash"></i> Desactivar
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="fa fa-fw fa-check"></i> Activar
                                                        </button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach --}}
