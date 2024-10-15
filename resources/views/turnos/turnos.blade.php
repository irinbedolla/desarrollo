@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Turnos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-turnos')
                                <a class="btn btn-warning" href="{{ route('turnos.create') }}"  onclick=crear_turnos();> Nuevo</a>
                                <a class="btn btn-info"    href="{{ route('turnos') }}" onclick=crear_turnos();> Auxiliares</a>
                            @endcan

                            @can('ver-turno')
                                <div class="table-responsive">
                                    <table id="tabla_usuarios" class="table table-striped">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Auxiliar</th>
                                            <th style="color: #fff;">Solicitante</th>
                                            <th style="color: #fff;">Estatus</th>
                                            <th style="color: #fff;">Hora</th>
                                        </thead>
                                        <tbody>
                                            @foreach($turnos as $turno)
                                                <tr>
                                                    <td style="display: none;">{{$turno->id}}</td>
                                                    <td>{{$turno->name}}</td>
                                                    <td>{{$turno->solicitante}}</td>
                                                    <td>{{$turno->estatus}}</td>
                                                    <td>{{$turno->fecha}}:{{$turno->hora}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<div id="nuevo_turno" style ="display: none;">
    <div>.</div>
    <div class="loader"></div>
</div>


@section('scripts')
    <script src="../public/js/turnos/turnos.js"></script>
@endsection