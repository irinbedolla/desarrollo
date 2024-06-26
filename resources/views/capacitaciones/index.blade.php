@extends('layouts.app')

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
                            @can('crear-curso')
                                <a class="btn btn-warning" href="{{ route('capacitaciones.create') }}"> Nuevo</a>
                            @endcan
                            @can('aceptar-persona')
                                <a class="btn btn-warning" href="{{ route('capacitaciones.personas') }}"> Personas</a>
                            @endcan

                            @can('ver-curso')
                                <div class="table-responsive">
                                    <table class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Capacitacíon</th>
                                            <th style="color: #fff;">Modulos</th>
                                            <th style="color: #fff;">Agregar Participantes</th>
                                            <th style="color: #fff;">Calificaciones</th>
                                            <th style="color: #fff;">Periodo</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($capacitaciones as $capacitacion)
                                                <tr>
                                                    <td>{{$capacitacion->nombre}}</td>
                                                    <td><a class="btn btn-success" href="{{ route('capacitaciones.modulos', $capacitacion->id)}}">Consultar</a></td>
                                                    <td><a class="btn btn-success" href="{{ route('capacitaciones.addpersonas', $capacitacion->id)}}">Consultar</a></td>
                                                    <td><a class="btn btn-success" href="{{ route('capacitaciones.calificaciones', $capacitacion->id)}}">Consultar</a></td>
                                                    <td>{{$capacitacion->inicio}} : {{$capacitacion->fin}}</td>
                                                    <td>
                                                        {!! Form::open(['method'=>'DELETE', 'route'=> ['capacitaciones.destroy', $capacitacion->id] , 'style'=>'display:inline']) !!}
                                                            {!! Form::submit('Borrar', ['class'=> 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan
                            <!-- Centramos la paginación a la derecha-->
                            <div class="pagination justify-content-end">
                                {!! $capacitaciones->links() !!}
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

