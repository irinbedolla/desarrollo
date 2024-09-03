@extends('layouts.app_editar')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Capacitaciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-info" href="{{ route('capacitaciones') }}"> Regresar</a><br>
                            @can('aceptar-persona')
                                <div class="table-responsive">
                                    <h3>Aceptados</h3>
                                    <table class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Nombre</th>
                                            <th style="color: #fff;">Cargo</th>
                                            <th style="color: #fff;">Área</th>
                                            <th style="color: #fff;">Título</th>
                                            <th style="color: #fff;">Estudio</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($personas_aceptadas as $persona)
                                                <tr>
                                                    <td>{{$persona->nombre}}</td>
                                                    <td>{{$persona->cargo}}</td>
                                                    <td>{{$persona->area_adcripcion}}</td>
                                                    <td>{{$persona->tilulo_universitario}}</td>
                                                    <td>{{$persona->estudio_maximo}}</td>
                                                    <td>
                                                        <a class="btn btn-success" href="{{ route('capacitaciones.quitar_persona', ['cap' => $capacitacion, 'per' => $persona->id] )}}">Quitar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <h3>Disponibles</h3>
                                    <table class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Nombre</th>
                                            <th style="color: #fff;">Cargo</th>
                                            <th style="color: #fff;">Área</th>
                                            <th style="color: #fff;">Título</th>
                                            <th style="color: #fff;">Estudio</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($personas as $persona)
                                                <tr>
                                                    <td>{{$persona->nombre}}</td>
                                                    <td>{{$persona->cargo}}</td>
                                                    <td>{{$persona->area_adcripcion}}</td>
                                                    <td>{{$persona->tilulo_universitario}}</td>
                                                    <td>{{$persona->estudio_maximo}}</td>
                                                    <td>
                                                        <a class="btn btn-success" href="{{ route('capacitaciones.agregar_persona', ['cap' => $capacitacion, 'per' => $persona->id] )}}">Agregar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan
                            <!-- Centramos la paginación a la derecha-->
                            <div class="pagination justify-content-end">
                                {!! $personas->links() !!}
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
