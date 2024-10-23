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
                                {!! Form::open(array('route'=>'seer.store_conciliador', 'method'=>'POST')) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="name">Número unico de expediente</label>
                                                <input type="text" class="form-control" name="nue" minlength="18" maxlength="18" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="email">Solicitante</label>
                                                <input type="text" class="form-control" name="solicitante" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="password">Municipio</label>
                                                <select class="form-control" name="municipio" required>
                                                <option value="">Seleccione</option>
                                                    @foreach($municipios as $mun)
                                                        <option value="{{$mun['id']}}">{{$mun['municipio']}}</option>
                                                    @endforeach
                                            </select>
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



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

