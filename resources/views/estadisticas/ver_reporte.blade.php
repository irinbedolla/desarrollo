@extends('layouts.app')

<style>
    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }
    
    /* Style the buttons that are used to open the tab content */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }
    
    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }
    
    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }
    
    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
    
</style>

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Estadisticas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Reporte</h3>
                            <a class="btn btn-primary" href="{{ route('seer.estadistica') }}">Regresar</a>
                            <div class="tab">
                                <button class="tablinks" onclick="openCity(event, 'solicitud')">Solicitudes</button>
                                <button class="tablinks" onclick="openCity(event, 'ratificacion')">Ratificaciones</button>
                                <button class="tablinks" onclick="openCity(event, 'audiencia')">Audiencia</button>
                                <button class="tablinks" onclick="openCity(event, 'convenios')">Convenios</button>
                                <button class="tablinks" onclick="openCity(event, 'colectiva')">Colectiva</button>
                            </div>
                            <div id="solicitud" class="tabcontent">
                                <div class="table-responsive">
                                    <table id="tabla_seer_auxiliares" class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Fecha de registro</th>
                                            <th style="color: #fff;">Fecha confirmacíon</th>
                                            <th style="color: #fff;">Número unico de identificación</th>
                                            <th style="color: #fff;">Solicitante</th>
                                            <th style="color: #fff;">Sexo del solicitante</th>
                                            <th style="color: #fff;">Estado del solicitante</th>
                                            <th style="color: #fff;">Municipio del solicitante</th>
                                            <th style="color: #fff;">Citados</th>
                                            <th style="color: #fff;">Motivo</th>
                                            <th style="color: #fff;">Notificación</th>
                                            <th style="color: #fff;">Usuario</th>
                                            <th style="color: #fff;">Dias Transcurridos</th>
                                            <th style="color: #fff;">Audiencias</th>
                                        </thead>
                                        <tbody name="m_solicitud" id="m_solicitud">
                                            @foreach($solicitudes as $solicitud)
                                                <tr>
                                                    <td style="display: none;">{{$solicitud->id}}</td>
                                                    <td>{{$solicitud->fecha}}</td>
                                                    <td>{{$solicitud->fecha_confirmacion}}</td>
                                                    <td>{{$solicitud->NUE}}</td>
                                                    <td>{{$solicitud->solicitante}}</td>
                                                    <td>{{$solicitud->sexo}}</td>
                                                    <td>{{$solicitud->estado}}</td>
                                                    <td>{{$solicitud->municipio}}</td>
                                                    <td>{{$solicitud->citado}}</td>
                                                    <td>{{$solicitud->motivo}}</td>
                                                    <td>{{$solicitud->notificacion}}</td>
                                                    <td>{{$solicitud->usuario}}</td>
                                                    @php 
                                                        $datetime1 = date_create($solicitud->fecha);
                                                        $datetime2 = date_create($solicitud->fecha_confirmacion);  
                                                        $interval = date_diff($datetime1, $datetime2);
                                                    @endphp
                                                    <td>{{$interval->format('%R%a días')}}</td>
                                                    <td>
                                                       <button type="button" data-toggle="modal" onclick="visualizaAudiencias()" class="btn btn-primary">Ver</button>   
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div id="ratificacion" class="tabcontent">
                                <div class="table-responsive">
                                    <table id="tabla_seer_conciliadores" class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Fecha de registro</th>
                                            <th style="color: #fff;">Fecha confirmacíon</th>
                                            <th style="color: #fff;">Número unico de identificación</th>
                                            <th style="color: #fff;">Solicitante</th>
                                            <th style="color: #fff;">Sexo del solicitante</th>
                                            <th style="color: #fff;">Estado del solicitante</th>
                                            <th style="color: #fff;">Municipio del solicitante</th>
                                            <th style="color: #fff;">Citado</th>
                                            <th style="color: #fff;">Actividad Economica</th>
                                            <th style="color: #fff;">Estado del citado</th>
                                            <th style="color: #fff;">Municipio del citado</th>
                                            <th style="color: #fff;">Motivo</th>
                                            <th style="color: #fff;">Notificación</th>
                                            <th style="color: #fff;">Monto</th>
                                            <th style="color: #fff;">Estatus</th>
                                            <th style="color: #fff;">Usuario</th>
                                            <th style="color: #fff;">Dias Transcurridos</th>
                                        </thead>
                                        <tbody>
                                            @foreach($ratificaciones as $ratificacion)
                                                <tr>
                                                    <td style="display: none;">{{$ratificacion->id}}</td>
                                                    <td>{{$ratificacion->fecha}}</td>
                                                    <td>{{$ratificacion->fecha_confirmacion}}</td>
                                                    <td>{{$ratificacion->NUE}}</td>
                                                    <td>{{$ratificacion->solicitante}}</td>
                                                    <td>{{$ratificacion->sexo}}</td>
                                                    <td>{{$ratificacion->actividad_economica}}</td>
                                                    <td>{{$ratificacion->estado}}</td>
                                                    <td>{{$ratificacion->municipio}}</td>
                                                    <td>{{$ratificacion->citado}}</td>
                                                    <td>{{$ratificacion->estado_citado}}</td>
                                                    <td>{{$ratificacion->municipio_citado}}</td>
                                                    <td>{{$ratificacion->tipo_persona}}</td>
                                                    <td>{{$ratificacion->motivo}}</td>
                                                    <td>${{number_format($ratificacion->monto,2)}}</td>
                                                    <td>{{$ratificacion->estatus}}</td>
                                                    <td>{{$ratificacion->usuario}}</td>
                                                    @php 
                                                        $datetime1 = date_create($solicitud->fecha);
                                                        $datetime2 = date_create($solicitud->fecha_confirmacion);  
                                                        $interval = date_diff($datetime1, $datetime2);
                                                    @endphp
                                                    <td>{{$interval->format('%R%a días')}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div id="convenios" class="tabcontent">
                                <div class="table-responsive">
                                    <table id="tabla_seer_convenios" class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Fecha</th>
                                            <th style="color: #fff;">Número unico de identificación</th>
                                            <th style="color: #fff;">Solicitante</th>
                                            <th style="color: #fff;">Citado</th>
                                            <th style="color: #fff;">Monto</th>
                                            <th style="color: #fff;">Tipo pago</th>
                                            <th style="color: #fff;">Estatus</th>
                                            <th style="color: #fff;">Usuario</th>
                                        </thead>
                                        <tbody>
                                            @foreach($convenios as $convenio)
                                                <tr>
                                                    <td style="display: none;">{{$convenio->id}}</td>
                                                    <td>{{$convenio->fecha}}</td>
                                                    <td>{{$convenio->NUE}}</td>
                                                    <td>{{$convenio->solicitante}}</td>
                                                    <td>{{$convenio->citado}}</td>
                                                    <td>${{number_format($convenio->monto,2)}}</td>
                                                    <td>{{$convenio->tipo_pago}}</td>
                                                    <td>{{$convenio->estatus}}</td>
                                                    <td>{{$convenio->usuario}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="colectiva" class="tabcontent">
                                <div class="table-responsive">
                                    <table id="tabla_seer_colectivas" class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Fecha</th>
                                            <th style="color: #fff;">Número unico de identificación</th>
                                            <th style="color: #fff;">Solicitante</th>
                                            <th style="color: #fff;">Citado</th>
                                            <th style="color: #fff;">Juzgado</th>
                                            <th style="color: #fff;">Estado de exp.</th>
                                            <th style="color: #fff;">Usuario</th>
                                        </thead>
                                        <tbody>
                                            @foreach($colectivas as $colectiva)
                                                <tr>
                                                    <td style="display: none;">{{$colectiva->id}}</td>
                                                    <td>{{$colectiva->fecha}}</td>
                                                    <td>{{$colectiva->NUE}}</td>
                                                    <td>{{$colectiva->solicitante}}</td>
                                                    <td>{{$colectiva->juzgado}}</td>
                                                    <td>{{$colectiva->citado}}</td>
                                                    <td>{{$colectiva->estado}}</td>
                                                    <td>{{$colectiva->usuario}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Modal -->
    <div class="modal fade" id="modal_audiencia" tabindex="-1" role="dialog" aria-labelledby="AudienciaModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">AUDIENCIAS</h5>
            </div>
            <div class="modal-body">  
                <div id="audiencia"> 
                    <div class="table-responsive">
                        <table id="tabla_seer_audienicias" class="table table-striped mt-1">
                            <thead style="background-color: #4A001F;">
                                <th style="display: none;">ID</th>
                                <th style="color: #fff;">Fecha</th>
                                <th style="color: #fff;">Número único de identificación</th>
                                <th style="color: #fff;">Solicitante</th>
                                <th style="color: #fff;">Estado</th>
                                <th style="color: #fff;">Municipio</th>
                                <th style="color: #fff;">Actividad Económica</th>
                                <th style="color: #fff;">Citado</th>
                                <th style="color: #fff;">Número de audiencia</th>
                                <th style="color: #fff;">Estatus</th>
                                <th style="color: #fff;">Monto</th>
                                <th style="color: #fff;">Cumplimiento</th>
                                <th style="color: #fff;">Observación</th>
                                <th style="color: #fff;">Multa</th>
                                <th style="color: #fff;">Tipo solicitud</th>
                                <th style="color: #fff;">Usuario</th>
                            </thead>
                            <tbody name="m_audiencia" id="m_audiencia">
                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
    </div>
    <!-- Fin Modal -->
@endsection


<div id="menu_carga" style ="display: none;">
    <div>.</div>
    <div class="loader"></div>
</div>


@section('scripts')
    <script src="../public/js/estadistica/estadistica.js"></script>
    <script>
        var audiencias=@json($audiencia);
        console.log(typeof(audiencias));
        function visualizaAudiencias(){
            let tbody=$("#m_audiencia");
            tbody.empty();
            audiencias.forEach(audiencia => {
                tbody.append(`<tr> 
                                <td>${audiencia.fecha}</td>
                                <td>${audiencia.NUE}</td>
                                <td>${audiencia.solicitante}</td>
                                <td>${audiencia.estado}</td>
                                <td>${audiencia.municipio}</td>
                                <td>${audiencia.actividad_economica}</td>
                                <td>${audiencia.citado}</td>
                                <td>${audiencia.numero_audiencia}</td>
                                <td>${audiencia.estatus_conciliacion}</td>
                                <td>${audiencia.monto}</td>
                                <td>${audiencia.cumplimiento_pago}</td>
                                <td>${audiencia.observaciones}</td>
                                <td>${audiencia.multa}</td>
                                <td>${audiencia.tipo}</td>
                                <td>${audiencia.usuario}</td>
                            </tr>`);
            });
            $("#modal_audiencia").modal('show');
        }
        
    </script>
@endsection

