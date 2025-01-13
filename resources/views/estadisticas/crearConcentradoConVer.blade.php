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

                            @if($userRole[0] == "Conciliador")
                                <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                                {!! Form::open(array('route'=>'seer.store_auxiliar', 'method'=>'POST')) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="name">Solicitudes Atendidas</label>
                                                <input type="number" class="form-control" name="solicitues_atendidas" value="<?=$estadisticas["solicitues_atendidas"];?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="email">Audiencias Programadas</label>
                                                <input type="number" class="form-control" name="audiencia_programada" value="<?=$estadisticas["audiencia_programada"];?>" >
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="password">Audiencias Celebradas</label>
                                                <input type="number" class="form-control" name="audiencia_celebradas" value="<?=$estadisticas["audiencia_celebradas"];?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Convenios Conciliatorios</label>
                                                <input type="number" class="form-control" name="convenios_conciliatorios" value="<?=$estadisticas["convenios_conciliatorios"];?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Ratificaciones de convenio</label>
                                                <input type="number" class="form-control" name="ratificaciones_convenio" value="<?=$estadisticas["ratificaciones_convenio"];?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Constancias de no conciliación</label>
                                                <input type="number" class="form-control" name="contancias_no_conciliacion" value="<?=$estadisticas["contancias_no_conciliacion"];?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Cuentificación Total($)</label>
                                                <input type="number" class="form-control" name="cuantificaciones"  value="<?=$estadisticas["cuantificaciones"];?>" >
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Asesorias</label>
                                                <input type="number" class="form-control" name="asesorias" value="<?=$estadisticas["asesorias"];?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Integración de Expediente</label>
                                                <input type="number" class="form-control" name="integracion_expediente" value="<?=$estadisticas["integracion_expediente"];?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Conciliaciones Colectivas</label>
                                                <input type="number" class="form-control" name="colectivas" value="<?=$estadisticas["colectivas"];?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <a class="btn btn-primary" href="{{ route('seer') }}">Regresar</a>
                                        </div>
                                    </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

