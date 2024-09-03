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
                            <h3 class="text-center">Estadistica</h3>
                            
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

                            <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                            {!! Form::open(array('route'=>'seer.mostar', 'method'=>'POST')) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Fecha Inicial</label>
                                            <input type="date" class="form-control" name="fecha_inicial">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Fecha Final</label>
                                            <input type="date" class="form-control" name="fecha_final">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Sede *puedes seleccionar mas de uno.</label>
                                            <select multiple class="form-control" name="sedes[]" style="height: 120%">
                                                <option value="">Seleccione</option>
                                                @foreach($estadisticas as $aKey => $aSport)
                                                    <option value="{{$aKey}}">{{$aSport}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Conciliador *puedes seleccionar mas de uno.</label>
                                            <select multiple class="form-control" name="conciliadores[]" style="height: 120%">
                                                <option value="">Seleccione</option>
                                                @foreach($usuariosconciliador as $user)
                                                    <option value="{{$user['id']}}">{{$user['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label multiple for="name">Auxiliares</label>
                                            <select multiple class="form-control" name="auxiliares[]" style="height: 120%">
                                                <option value="">Seleccione</option>
                                                @foreach($usuariosauxiliares as $user)
                                                    <option value="{{$user['id']}}">{{$user['name']}}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label multiple for="name">Notificadores</label>
                                            <select multiple class="form-control" name="notificadores[]" style="height: 120%">
                                                <option value="">Seleccione</option>
                                                @foreach($usuariosnotificadores as $user)
                                                    <option value="{{$user['id']}}">{{$user['name']}}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <label multiple for="name">Tipo</label>
                                            <select multiple class="form-control" name="notificadores[]" style="height: 120%">
                                                <option value="">Seleccione</option>
                                                <option value="Personas Atendidas">Personas Atendidas</option>
                                                <option value="Asesorias">Asesorias</option>
                                                <option value="Solicitudes para inicio de tramite de conciliación">Solicitudes para inicio de tramite de conciliación</option>
                                                <option value="Audiencias programadas">Audiencias programadas</option>
                                                <option value="Auciencias celebradas">Auciencias celebradas</option>
                                                <option value="Solicitudes declaradas como incopetencia">Solicitudes declaradas como incopetencia</option>
                                                <option value="Convenio en audiencia">Convenio en audiencia</option>
                                                <option value="Ratificación de convenios">Ratificación de convenios</option>
                                                <option value="Monto de convenios">Monto de convenios</option>
                                                <option value="Notificaciones">Notificaciones</option>
                                                <option value="Constancias de no conciliacion por incoparecencia patronal">Constancias de no conciliacion por incoparecencia patronal</option>
                                                <option value="Constancias de no conciliacion por falta de notificaciones">Constancias de no conciliacion por falta de notificaciones</option>
                                                <option value="Solicitudes archivadas por falta de interes">Solicitudes archivadas por falta de interes</option>
                                                <option value="Conciliaciones colectivas">Conciliaciones colectivas</option>
                                                <option value="M">M</option>
                                                <option value="H">H</option>
                                                <option value="Despidos injustificados">Despidos injustificados</option>
                                                <option value="Finiquito por rescicion de contrato">Finiquito por rescicion de contrato</option>
                                                <option value="Derecho de preferencia">Derecho de preferencia</option>
                                                <option value="Pago de prestaciones pendientes">Pago de prestaciones pendientes</option>
                                                <option value="Terminacion voluntaria de la relacion laboral">Terminacion voluntaria de la relacion laboral</option>
                                                <option value="Supuesto de excepcion 685 TER LFT">Supuesto de excepcion 685 TER LFT</option>
                                                <option value="Otros">Otros</option>
                                                <option value="Multas">Multas</option>
                                                <option value="50 UMAS">50 UMAS</option>
                                                <option value="100 UMAS">100 UMAS</option>
                                                <option value="Otro monto">Otro monto</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


