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

                            @can('aceptar-persona')
                                <div class="table-responsive">
                                    <table class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Capacitacíon</th>
                                            <th style="color: #fff;">Cargo</th>
                                            <th style="color: #fff;">Área</th>
                                            <th style="color: #fff;">Título</th>
                                            <th style="color: #fff;">Estudio</th>
                                            <th style="color: #fff;">Especialidades</th>
                                            <th style="color: #fff;">Diplomados</th>
                                            <th style="color: #fff;">Seminarios</th>
                                            <th style="color: #fff;">Cursos</th>
                                            <th style="color: #fff;">A. Desarrollo</th>
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
                                                    <td>{{$persona->especialidades}}</td>
                                                    <td>{{$persona->diplomados}}</td>
                                                    <td>{{$persona->seminarios}}</td>
                                                    <td>{{$persona->cursos}}</td>
                                                    <td>{{$persona->acciones_desarrollo}}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn btn-info"    href="{{ route('personas.documentos', $persona->id_usuario)}}">Documentos</a>
                                                            <a class="btn btn-success" href="{{ route('capacitaciones.edit', $persona->id_usuario)}}">Validar</a>
                                                        </div>
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

