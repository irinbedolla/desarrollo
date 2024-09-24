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
                                <a class="btn btn-warning" href="{{ route('seer.create') }}"> Nuevo</a>
                            @endcan
                            

                            @can('ver-seer')
                                @if($userRole[0] == "Auxiliar")
                                    <div class="table-responsive">
                                        <table id="tabla_seer_auxiliar" class="table table-striped mt-1">
                                            <thead style="background-color: #4A001F;">
                                                <th style="display: none;">ID</th>
                                                <th style="color: #fff;">Fecha</th>
                                                <th style="color: #fff;">Solicitudes</th>
                                                <th style="color: #fff;">Ratificaciones</th>
                                                <th style="color: #fff;">Asesorías</th>
                                                <th style="color: #fff;">Consulta Expediente</th>
                                                <th style="color: #fff;">Escanear Expediente</th>
                                                <th style="color: #fff;">Folear Expediente</th>
                                                <th style="color: #fff;">Cuantificaciones</th>
                                                <th style="color: #fff;">Exhortos</th>
                                                <th style="color: #fff;">Audiencias Celebradas</th>
                                                <th style="color: #fff;">Registrar cumplimiento</th>
                                            </thead>
                                            <tbody>
                                                @foreach($estadisticas as $estadistica)
                                                    <tr>
                                                        <td style="display: none;">{{$estadistica->id}}</td>
                                                        <td>{{$estadistica->fecha}}</td>
                                                        <td>{{$estadistica->solicitudes}}</td>
                                                        <td>{{$estadistica->ratificaciones}}</td>
                                                        <td>{{$estadistica->asesorias}}</td>
                                                        <td>{{$estadistica->expediente_consulta}}</td>
                                                        <td>{{$estadistica->expediente_escaneo}}</td>
                                                        <td>{{$estadistica->expediente_foliar}}</td>
                                                        <td>{{$estadistica->cuantificacion}}</td>
                                                        <td>{{$estadistica->exhortos}}</td>
                                                        <td>{{$estadistica->audiencias_celebradas}}</td>
                                                        <td>{{$estadistica->cumplimientos}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if($userRole[0] == "Notificador")
                                    <div class="table-responsive">
                                        <table id="tabla_seer_auxiliar" class="table table-striped mt-1">
                                            <thead style="background-color: #4A001F;">
                                                <th style="display: none;">ID</th>
                                                <th style="color: #fff;">Fecha</th>
                                                <th style="color: #fff;">Citatorios</th>
                                                <th style="color: #fff;">Asesorías</th>
                                                <th style="color: #fff;">Solicitudes levantadas</th>
                                                <th style="color: #fff;">Ratificaciones</th>
                                                <th style="color: #fff;">Razones registradas</th>
                                                <th style="color: #fff;">Multas Notificadas</th>
                                                <th style="color: #fff;">Informes diarios</th>
                                                <th style="color: #fff;">Informes foraneos</th>
                                                <th style="color: #fff;">Expediente integrado</th>
                                                <th style="color: #fff;">Escaneo de documentos</th>
                                            </thead>
                                            <tbody>
                                                @foreach($estadisticas as $estadistica)
                                                    <tr>
                                                        <td style="display: none;">{{$estadistica->id}}</td>
                                                        <td>{{$estadistica->fecha}}</td>
                                                        <td>{{$estadistica->citatorios}}</td>
                                                        <td>{{$estadistica->asesorias_notificador}}</td>
                                                        <td>{{$estadistica->solicitudes_levantadas}}</td>
                                                        <td>{{$estadistica->ratificaciones_notificador}}</td>
                                                        <td>{{$estadistica->razon_registrada}}</td>
                                                        <td>{{$estadistica->multas_notificador}}</td>
                                                        <td>{{$estadistica->informe_diario}}</td>
                                                        <td>{{$estadistica->informe_foraneo}}</td>
                                                        <td>{{$estadistica->integrar_expediente}}</td>
                                                        <td>{{$estadistica->escaneo_documentos}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if($userRole[0] == "Conciliador")
                                    <div class="table-responsive">
                                        <table id="tabla_seer_auxiliar" class="table table-striped mt-1">
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
                                        <table id="tabla_seer_auxiliar" class="table table-striped mt-1">
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

