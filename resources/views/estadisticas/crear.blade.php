@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Estadisticas</h3>
        </div>
        <div class="section-body">
            <?php $fecha_actual = date('d-m-Y');?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Estadistica <?=$fecha_actual?></h3>
                            
                            <!--Se realiza la validación de campos para ver si dejó alguno vacío-->
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            <!--<span class="badge badge-danger">{{ $error }}</span>-->
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            @endif

                            @if($userRole[0] == "Auxiliar")
                                <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                                {!! Form::open(array('route'=>'seer.store_auxiliar', 'method'=>'POST')) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="name">Solicitudes</label>
                                                <input type="number" class="form-control" name="solicitudes" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="email">Ratificaciones</label>
                                                <input type="number" class="form-control" name="ratificaciones" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="password">Asesorias</label>
                                                <input type="number" class="form-control" name="asesorias" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Consulta Expediente</label>
                                                <input type="number" class="form-control" name="expediente_consulta" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Escanear Expediente</label>
                                                <input type="number" class="form-control" name="expediente_escaneo" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Foliar Expediente</label>
                                                <input type="number" class="form-control" name="expediente_foliar" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Cuentificación Total($)</label>
                                                <input type="number" class="form-control" name="cuantificacion" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Exhortos</label>
                                                <input type="number" class="form-control" name="exhortos" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Audiencias Celebradas</label>
                                                <input type="number" class="form-control" name="audiencias_celebradas"  required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Registro Cumplimiento</label>
                                                <input type="number" class="form-control" name="cumplimientos" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                        
                                    </div>
                                {!! Form::close() !!}
                            @endif

                            @if($userRole[0] == "Conciliador")
                                <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                                {!! Form::open(array('route'=>'seer.store_conciliador', 'method'=>'POST')) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="name">Solicitudes Atendidas</label>
                                                <input type="number" class="form-control" name="solicitues_atendidas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="email">Audiencias Programadas</label>
                                                <input type="number" class="form-control" name="audiencia_programada" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="password">Audiencias Celebradas</label>
                                                <input type="number" class="form-control" name="audiencia_celebradas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Convenios Conciliatorios</label>
                                                <input type="number" class="form-control" name="convenios_conciliatorios" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Ratificaciones de convenio</label>
                                                <input type="number" class="form-control" name="ratificaciones_convenio" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Constancias de no conciliación</label>
                                                <input type="number" class="form-control" name="contancias_no_conciliacion" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Cuentificación Total($)</label>
                                                <input type="number" class="form-control" name="cuantificaciones" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Asesorias</label>
                                                <input type="number" class="form-control" name="asesorias" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Integración de Expediente</label>
                                                <input type="number" class="form-control" name="integracion_expediente" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Conciliaciones Colectivas</label>
                                                <input type="number" class="form-control" name="colectivas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                        
                                    </div>
                                {!! Form::close() !!}
                            @endif

                            @if($userRole[0] == "Notificador")
                                <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                                {!! Form::open(array('route'=>'seer.store_notificador', 'method'=>'POST')) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="name">Citatorios</label>
                                                <input type="number" class="form-control" name="citatorios" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="email">Asesorias</label>
                                                <input type="number" class="form-control" name="asesorias_notificador" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="password">Solicitudes Levantadas</label>
                                                <input type="number" class="form-control" name="solicitudes_levantadas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Ratificaciones</label>
                                                <input type="number" class="form-control" name="ratificaciones_notificador" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Multas Notificadas</label>
                                                <input type="number" class="form-control" name="multas_notificador" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Informe Diario</label>
                                                <input type="number" class="form-control" name="informe_diario" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Informes Foraneos</label>
                                                <input type="number" class="form-control" name="informe_foraneo" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Integrar Expediente</label>
                                                <input type="number" class="form-control" name="integrar_expediente" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Escaneo de Documentos</label>
                                                <input type="number" class="form-control" name="escaneo_documentos" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                        
                                    </div>
                                {!! Form::close() !!}
                            @endif

                            @if($userRole[0] == "Delegado")
                                <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                                {!! Form::open(array('route'=>'seer.store_delegado', 'method'=>'POST')) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="name">Personas Atendidas</label>
                                                <input type="number" class="form-control" name="personas_atendidas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="email">Asesorias</label>
                                                <input type="number" class="form-control" name="asesorias" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="password">Solicitudes para inicio de tramite</label>
                                                <input type="number" class="form-control" name="solicitudes_inicio" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Audiencia Programada</label>
                                                <input type="number" class="form-control" name="audiencias_programadas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Audiencia Celebrada</label>
                                                <input type="number" class="form-control" name="audiencias_celebradas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Solicitudes declaradas como incopetencia</label>
                                                <input type="number" class="form-control" name="solicitudes_incopetencia" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Convenio en Audiencia</label>
                                                <input type="number" class="form-control" name="convenio_audiencia"  required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Ratificaciones de Convenios</label>
                                                <input type="number" class="form-control" name="ratificacion_convenios"  required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Monto de Convenios</label>
                                                <input type="number" class="form-control" name="monto_convenios"  required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Notificiones</label>
                                                <input type="number" class="form-control" name="notificaciones"  required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="name">Constancia de no conciliacion por audiencia</label>
                                                <input type="int" class="form-control" name="contancia_no_conciliacion"  required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="email">contancia de no conciliacion por incoparecencia del patron</label>
                                                <input type="number" class="form-control" name="contancia_no_conciliacion_patron"  required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="password">Constancias de no conciliacion por falta de interes</label>
                                                <input type="number" class="form-control" name="contancia_no_conciliacion_notificacion" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Solicituides archivadas por falta de interes</label>
                                                <input type="number" class="form-control" name="solicitudes_archivadas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Conciliaciones Colectivas</label>
                                                <input type="number" class="form-control" name="colectivas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">N° Mujeres</label>
                                                <input type="number" class="form-control" name="mujeres" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">N° Hombres</label>
                                                <input type="number" class="form-control" name="hombres" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Despidos inhustificados</label>
                                                <input type="number" class="form-control" name="despido_injitificado" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Finiquito por recesion de contrato</label>
                                                <input type="number" class="form-control" name="finiquito" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Derecho de preferencia </label>
                                                <input type="number" class="form-control" name="derecho_preferencia" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Pago prestaciones pedientes</label>
                                                <input type="number" class="form-control" name="pago_prestaciones" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Terminacion volintaria de la relacion laboral</label>
                                                <input type="number" class="form-control" name="terminacion_volintaria" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Supuestos de exepcion 685 TER LFT</label>
                                                <input type="number" class="form-control" name="supuesto_excepciones" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Otros</label>
                                                <input type="number" class="form-control" name="otros" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Multas</label>
                                                <input type="number" class="form-control" name="multas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">50 Umas</label>
                                                <input type="number" class="form-control" name="cincuenta_umas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">100 Umas</label>
                                                <input type="number" class="form-control" name="cien_umas" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Otros montos</label>
                                                <input type="number" class="form-control" name="otro_monto" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                        
                                    </div>
                                {!! Form::close() !!}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

