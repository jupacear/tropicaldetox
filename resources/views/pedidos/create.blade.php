@extends('layouts.app')

@section('title', 'Pedidos')
@section('content')

    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Pedidos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">


                            @if ($errors->any())
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif




                            <form action="{{ url('pedidos') }}" method="POST">
                                @csrf
                                

                                <div class="form-group">
                                    <label for="Estado">Estado</label>
                                    <select name="Estado" id="Estado"  class="form-control select2"  data-live-search="true" required>
                                        <option value="">Selecionar Estado</option>
                                        <option value="En_proceso">En proceso</option>
                                        <option value="Finalizado">Finalizado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Fecha">Fecha</label>
                                    <input required value="{{ old('Fecha') }}" name="Fecha" type="date"
                                        class="form-control" id="Fecha" aria-describedby="FechaHelp"
                                        placeholder="Fecha">

                                </div>

                                <div class="form-group">
                                    <label for="Usuario">Usuario:</label>
                                    <select name="Usuario" id="Usuario" class="form-control select2"  data-live-search="true" required>
                                        <option value="">Selecionar Usuario</option>
                                        @foreach ($users as $Users)
                                            <option value="{{ $Users->id }}">{{ $Users->name }}</option>
                                        @endforeach

                                        
                                    </select>

                                </div>

                           
                                


                               
                                
{{--                                
                                <div class="form-group">
                                    <label for="Productos">Productos:</label>
                                    @foreach ($productos as $producto)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="Productos[]" value="{{ $producto->id }}" id="producto-{{ $producto->id }}">
                                            <label  class="form-check-label" for="producto-{{ $producto->id }}" >
                                                {{ $producto->nombre }}
                                            </label>
                                            <input style="width:  3em;" type="number" name="Cantidad[]" value="0">
                                        </div>
                                    @endforeach
                                </div> --}}
                                
                                
                                

                                <div class="form-group">
                                    <label for="Productos">Productos:</label>
                                    @foreach ($productos as $producto)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="Productos[]" value="{{ $producto->id }}" id="producto-{{ $producto->id }}">
                                            <label class="form-check-label" for="producto-{{ $producto->id }}">
                                                {{ $producto->nombre }}
                                            </label>
                                            <input style="width:  3em;" type="number" name="Cantidad[]" value="0">
                                        </div>
                                    @endforeach
                                </div>

                                
                                                                
                                
                                
                                




                                <button type="submit" class="btn btn-primary" onclick="eliminarCantidadesCero()" >Guarda</button>
                                <a class="btn btn-dark" href="{{ route('pedidos.index') }} ">Regresar</a>
                            </form>









                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
