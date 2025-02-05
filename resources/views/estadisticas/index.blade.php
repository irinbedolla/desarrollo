@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">SEER</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-seer')
                                @if($userRole[0] == "Auxiliar")
                                    <a class="btn btn-warning" href="{{ route('create_persona_solicitud') }}"    onclick=nuevo_estadistica();>Solicitud</a>
                                    <a class="btn btn-warning" href="{{ route('create_persona_ratificacion') }}" onclick=nuevo_estadistica();>Ratificación</a>
                                    @if($estadisticas == null)
                                        <a class="btn btn-warning" href="{{ route('create_consentrado_aux') }}" onclick=nuevo_estadistica();> Consentrado</a>
                                    @else
                                        <a class="btn btn-warning" href="{{ route('create_consentrado_ver') }}" onclick=nuevo_estadistica();> Ver</a>
                                    @endif
                                @endif
                                @if($userRole[0] == "Conciliador")
                                    <a class="btn btn-warning" href="{{ route('index_convenios') }}"    onclick=nuevo_estadistica();>Convenios</a>
                                    <a class="btn btn-warning" href="{{ route('index_colectivas') }}"    onclick=nuevo_estadistica();>Colectivas</a>
                                    @if($estadisticas == null)
                                        <a class="btn btn-warning" href="{{ route('create_consentrado_con') }}" onclick=nuevo_estadistica();> Consentrado</a>
                                    @else
                                        <a class="btn btn-warning" href="{{ route('ver_consentrado_con') }}" onclick=nuevo_estadistica();> Ver</a>
                                    @endif
                                @endif
                            @endcan
                            
                            @can('ver-seer')
                                @if($userRole[0] == "Auxiliar")
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped mt-1">
                                            <thead style="background-color: #4A001F;">
                                                <th style="display: none;">ID</th>
                                                <th style="color: #fff;">Fecha</th>
                                                <th style="color: #fff;">Número unico de identificación</th>
                                                <th style="color: #fff;">Solicitante</th>
                                                <th style="color: #fff;">Citado</th>
                                                <th style="color: #fff;">Detalles</th>
                                            </thead>
                                            <tbody>
                                                @foreach($personas as $persona)
                                                    <tr>
                                                        <td style="display: none;">{{$persona->id}}</td>
                                                        <td>{{$persona->fecha}}</td>
                                                        <td>{{$persona->NUE}}</td>
                                                        <td>{{$persona->solicitante}}</td>
                                                        <td><a class="btn btn-primary" href="{{ route('seer.VerCitados', $persona->id) }}" onclick=consultar_estadistica();>Ver</a></td>
                                                        <td><a class="btn btn-primary" href="{{ route('seer.estadistica_consultar', $persona->id) }}" onclick=consultar_estadistica();>Consultar</a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if($userRole[0] == "Conciliador")
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped mt-1">
                                            <thead style="background-color: #4A001F;">
                                                <th style="display: none;">ID</th>
                                                <th style="color: #fff;">Fecha</th>
                                                <th style="color: #fff;">Número unico de identificación</th>
                                                <th style="color: #fff;">Solicitante</th>
                                                <th style="color: #fff;">Citado</th>
                                                <th style="color: #fff;">Estatus</th>
                                                <th style="color: #fff;">Detalles</th>
                                            </thead>
                                            <tbody>
                                                @foreach($personas as $persona)
                                                    <tr>
                                                        <td style="display: none;">{{$persona->id}}</td>
                                                        <td>{{$persona->fecha}}</td>
                                                        <td>{{$persona->NUE}}</td>
                                                        <td>{{$persona->solicitante}}</td>
                                                        <td>{{$persona->citado}}</td>
                                                        <td>{{$persona->validado_conciliador}}</td>
                                                        @if($persona->validado_conciliador == "Pendiente")
                                                            <td><a class="btn btn-primary" href="{{ route('create_persona_con', $persona->id) }}" onclick=consultar_estadistica();>Audiencia</a></td>
                                                        @else
                                                            <td><a class="btn btn-primary" href="{{ route('persona_ver', $persona->id) }}" onclick=consultar_estadistica();>Ver</a></td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if($userRole[0] == "Notificador")
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped mt-1">
                                            <thead style="background-color: #4A001F;">
                                                <th style="display: none;">ID</th>
                                                <th style="color: #fff;">Fecha</th>
                                                <th style="color: #fff;">Solicitudes atendidas</th>
                                                <th style="color: #fff;">Audiencias programadas</th>
                                                <th style="color: #fff;">Audiencias celebradas</th>
                                                <th style="color: #fff;">Convenios conciliatorios</th>
                                                <th style="color: #fff;">Ratificaciones de convenios</th>
                                                <th style="color: #fff;">Constancia de no conciliación</th>
                                                <th style="color: #fff;">Cuantificaciones</th>
                                                <th style="color: #fff;">Asesorías</th>
                                                <th style="color: #fff;">Integración de expediente</th>
                                                <th style="color: #fff;">Audiencia colectiva</th>
                                            </thead>
                                            <tbody>
                                                @foreach($estadisticas as $estadistica)
                                                    <tr>
                                                        <td style="display: none;">{{$estadistica->id}}</td>
                                                        <td>{{$estadistica->fecha}}</td>
                                                        <td>{{$estadistica->solicitues_atendidas}}</td>
                                                        <td>{{$estadistica->audiencia_programada}}</td>
                                                        <td>{{$estadistica->audiencia_celebradas}}</td>
                                                        <td>{{$estadistica->convenios_conciliatorios}}</td>
                                                        <td>{{$estadistica->ratificaciones_convenio}}</td>
                                                        <td>{{$estadistica->contancias_no_conciliacion}}</td>
                                                        <td>{{$estadistica->cuantificaciones}}</td>
                                                        <td>{{$estadistica->asesorias}}</td>
                                                        <td>{{$estadistica->integracion_expediente}}</td>
                                                        <td>{{$estadistica->colectivas}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if($userRole[0] == "Delegado")
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped mt-1">
                                            <thead style="background-color: #4A001F;">
                                                <th style="display: none;">ID</th>
                                                <th style="color: #fff;">Fecha</th>
                                                <th style="color: #fff;">Personas atendidas</th>
                                                <th style="color: #fff;">Asesorías</th>
                                                <th style="color: #fff;">Solicitudes para inicio de tramite de conciliación</th>
                                                <th style="color: #fff;">Audiencias programadas</th>
                                                <th style="color: #fff;">Audiencias celebradas</th>
                                                <th style="color: #fff;">Solicitudes declaradas como incopetencia</th>
                                                <th style="color: #fff;">Convenios de audiencia</th>
                                                <th style="color: #fff;">Ratificación de convenios</th>
                                                <th style="color: #fff;">Monto de convenios</th>
                                                <th style="color: #fff;">Noitificaciones</th>

                                                <th style="color: #fff;">Constancia por no conciliacion en audiencias</th>
                                                <th style="color: #fff;">Constancia por no conciliacion por falta de noitificación</th>
                                                <th style="color: #fff;">Solicitudes archivadas por falta de interes</th>
                                                <th style="color: #fff;">Conciliaciones colectivas</th>
                                                <th style="color: #fff;">M</th>
                                                <th style="color: #fff;">H</th>
                                                <th style="color: #fff;">Despido injustificado</th>
                                                <th style="color: #fff;">Finiquito por resccisión de contrato</th>
                                                <th style="color: #fff;">Derecho de preferencia</th>

                                                <th style="color: #fff;">Pago de prestaciones pendientes</th>
                                                <th style="color: #fff;">Terminación voluntaria de la relacion laboral</th>
                                                <th style="color: #fff;">Supuestos de excepcion 685 TER LFT</th>
                                                <th style="color: #fff;">Otros</th>
                                                <th style="color: #fff;">Multas</th>
                                                <th style="color: #fff;">50 UMAS</th>
                                                <th style="color: #fff;">100 UMAS</th>
                                                <th style="color: #fff;">Otro monto</th>
                                            </thead>
                                            <tbody>
                                                @foreach($estadisticas as $estadistica)
                                                    <tr>
                                                        <td style="display: none;">{{$estadistica->id}}</td>
                                                        <td>{{$estadistica->fecha}}</td>
                                                        <td>{{$estadistica->personas_atendidas}}</td>
                                                        <td>{{$estadistica->asesorias}}</td>
                                                        <td>{{$estadistica->solicitudes_inicio}}</td>
                                                        <td>{{$estadistica->audiencias_programadas}}</td>
                                                        <td>{{$estadistica->audiencias_celebradas}}</td>
                                                        <td>{{$estadistica->solicitudes_incopetencia}}</td>
                                                        <td>{{$estadistica->convenio_audiencia}}</td>
                                                        <td>{{$estadistica->ratificacion_convenios}}</td>
                                                        <td>{{$estadistica->monto_convenios}}</td>
                                                        <td>{{$estadistica->notificaciones}}</td>

                                                        <td>{{$estadistica->contancia_no_conciliacion}}</td>
                                                        <td>{{$estadistica->contancia_no_conciliacion_notificacion}}</td>
                                                        <td>{{$estadistica->contancia_no_conciliacion_patron}}</td>
                                                        <td>{{$estadistica->colectivas}}</td>
                                                        <td>{{$estadistica->mujeres}}</td>
                                                        <td>{{$estadistica->hombres}}</td>
                                                        <td>{{$estadistica->despido_injitificado}}</td>
                                                        <td>{{$estadistica->finiquito}}</td>
                                                        <td>{{$estadistica->derecho_preferencia}}</td>

                                                        <td>{{$estadistica->pago_prestaciones}}</td>
                                                        <td>{{$estadistica->terminacion_volintaria}}</td>
                                                        <td>{{$estadistica->supuesto_excepciones}}</td>
                                                        <td>{{$estadistica->otros}}</td>
                                                        <td>{{$estadistica->multas}}</td>
                                                        <td>{{$estadistica->cincuenta_umas}}</td>
                                                        <td>{{$estadistica->cien_umas}}</td>
                                                        <td>{{$estadistica->otro_monto}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
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


<div id="menu_carga" style ="display: none;">
    <div>.</div>
    <div class="loader"></div>
</div>


@section('scripts')
    <script src="../public/js/estadistica/estadistica.js"></script>
@endsection