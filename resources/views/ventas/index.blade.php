@extends('layouts.app')

@section('content')
@section('title', 'Ventas')


<section class="section">


    <div class="section-header">
        <h3 class="page__heading">venta</h3>
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
                    {{-- <a class="btn btn-sm btn-success" href="{{ route('ventas.graficatop10') }}"><i class="fa fa-fw fa-edit"></i> Top 10</a> --}}
                    <div class="card-body">


                        {{-- <a class="btn btn-sm btn-success" href="{{ route('ventas.graficatop10') }}"><i class="fa fa-fw fa-edit"></i>Top 10</a>
                        <a class="btn btn-sm btn-success" href="{{ route('ventas.informe') }}"><i class="fa fa-fw fa-edit"></i>grafica</a>
                       
                         --}}
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
                                @foreach ($ventas as $venta)
                                    @if ($venta->Estado == 'Finalizado')
                                        <tr>
                                            <td>{{ $venta->id }}</td>
                                            <td>{{ $venta->users ? $venta->users->name : 'Null' }}</td>
                                            <td>{{ $venta->users ? $venta->users->telefono : 'Null' }}</td>
                                            <td>{{ $venta->users ? $venta->users->direccion : 'Null' }}</td>
                                            <td>{{ $venta->Estado }}</td>
                                            <td>{{ $venta->Fecha }}</td>
                                            <td>{{ $venta->Total }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary" href="{{ route('ventas.show',$venta->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i>Detalles</a>

                                                 
                                           

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
    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: true
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script>





@endsection
