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
                                <a class="btn btn-info" href="{{ route('miscapacitaciones') }}"> Regresar</a>
                            @can('ver-curso')
                                <div class="table-responsive">
                                    <table class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Modulo</th>
                                            <th style="color: #fff;">Estatus</th>
                                            <th style="color: #fff;">Calificacion</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($modulos as $modulo)
                                                <tr>
                                                    <td>{{$modulo->nombre}}</td>
                                                    <td>{{$modulo->estatus}}</td>
                                                    <td>{{$modulo->calificacion}}</td>
                                                    <td>
                                                        @if ($modulo->estatus == "En curso")
                                                            <a class="btn btn-success" href="{{ route('miscapacitaciones.iniciar', ['id' => $capacitacion->id, 'mod' => $modulo->id_modulo] )}}">Iniciar</a>
                                                            <a class="btn btn-primary" href="{{ route('miscapacitaciones.prueba', ['id' => $capacitacion->id, 'mod' => $modulo->id_modulo] )}}">Evaluar</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan
                            <!-- Centramos la paginación a la derecha-->
                            <div class="pagination justify-content-end">
                               
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

