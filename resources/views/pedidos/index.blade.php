@extends('layouts.app')

@section('content')
@section('title', 'Pedidos')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Pedidos</h3>
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
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ url('pedidos/create') }}">Nuevo</a>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">Telefono</th>
                                <th style="color:#fff;">Direcion</th>
                                <th style="color:#fff;">Estado</th>
                                <th style="color:#fff;">Fecha</th>
                                <th style="color:#fff;">Total</th>
                                <th style="color:#fff;">Opciones</th>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                    @if ($pedido->Estado == 'En_proceso')
                                        <tr>
                                            <td>{{ $pedido->users ? $pedido->users->name : 'Null' }}</td>
                                            <td>{{ $pedido->users ? $pedido->users->telefono : 'Null' }}</td>
                                            <td>
                                                @if( $pedido->Direcion)
                                                {{  $pedido->Direcion }}
                                                @else
                                                {{ $pedido->users->direccion }}

                                                @endif
                                            </td>



                                            <td>
                                                <form action="{{ route('pedidos.updateEstado', $pedido->id) }}"
                                                    method="POST" id="form-estado-{{ $pedido->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="Estado"
                                                        value="{{ $pedido->Estado }}">
                                                    <button type="button"
                                                        class="btn btn-sm btn-{{ $pedido->Estado == 'En_proceso' ? 'primary' : 'success' }}"
                                                        onclick="cambiarEstado({{ $pedido->id }}) ">
                                                        {{ $pedido->Estado }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $pedido->Fecha }}</td>
                                            <td> {{ number_format($pedido->Total, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <form action="{{ url('pedidos/' . $pedido->id) }}" method="post">
                                                    <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                        class="btn btn-sm btn-primary"><i
                                                        class="fa fa-fw fa-eye"></i></a></a>
                                                        <a class="btn btn-sm btn-success"
                                                        href="{{ url('pedidos/' . $pedido->id . '/edit') }}">
                                                        <i class="fa fa-fw fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmarEliminacion({{ $pedido->id }})">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                    </button>
                                                    {{-- @method('DELETE')
                                                    @csrf --}}
                                                    {{-- <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                        Eliminar
                                                    </button> --}}
                                                </form>
                                                <form id="form-eliminar-{{ $pedido->id }}" action="{{ url('pedidos/' . $pedido->id) }}" method="post" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function confirmarEliminacion(pedidoId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el pedido.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma la eliminación, enviar el formulario
                var form = document.getElementById('form-eliminar-' + pedidoId);
                form.submit();
            }
        });
    }
</script>

<script>
    function cambiarEstado(pedidoId) {
        var form = document.getElementById('form-estado-' + pedidoId);
        var estadoInput = form.querySelector('input[name="Estado"]');
        var estado = estadoInput.value;

        // Cambiar el estado
        if (estado === 'En_proceso') {
            estado = 'Finalizado';
        } else {
            estado = 'En_proceso';
        }
        estadoInput.value = estado;

        // Cambiar el color del botón y mostrar el mensaje
        var button = form.querySelector('button');
        if (estado === 'En_proceso') {
            button.classList.remove('btn-success');
            button.classList.add('btn-primary');
            button.innerText = 'En proceso';
        } else {
            button.classList.remove('btn-primary');
            button.classList.add('btn-success');
            button.innerText = 'Finalizado';
        }

        // Enviar el formulario
        form.submit();
    }
</script>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: true
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script>
@endsection
