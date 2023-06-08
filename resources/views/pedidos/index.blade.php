@extends('layouts.app')

@section('content')
@section('title', 'Pedidos')


<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Pedidos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ url('pedidos/create') }}">Nuevo</a>
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">ID</th>
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
                                            <td>{{ $pedido->id }}</td>
                                            <td>{{ $pedido->users ? $pedido->users->name : 'Null' }}</td>
                                            <td>{{ $pedido->users ? $pedido->users->telefono : 'Null' }}</td>
                                            <td>{{ $pedido->users ? $pedido->users->direccion : 'Null' }}</td>
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
                                            <td>{{ $pedido->Total }}</td>
                                            <td class="text-center">
                                                <form action="{{ url('pedidos/' . $pedido->id) }}" method="post">
                                                    <a href="{{ route('pedidos.show', $pedido->id) }}"
                                                        class="btn btn-sm btn-primary"><i
                                                            class="fa fa-fw fa-eye"></i>Mostrar</a></a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ url('pedidos/' . $pedido->id . '/edit') }}">
                                                        <i class="fa fa-fw fa-edit"></i>
                                                        Editar
                                                    </a>
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-fw fa-trash"></i>
                                                        Eliminar
                                                    </button>
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
