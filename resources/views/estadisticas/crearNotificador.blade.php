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

                            @if($userRole[0] == "Notificador")
                                <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                                {!! Form::open(array('route'=>'seer.store_notificador', 'method'=>'POST', 'class' => 'needs-validation','novalidate')) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="name">Citatorios</label>
                                                <input type="int" class="form-control" name="citatorios" maxlength="10" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="email">Asesorías</label>
                                                <input type="number" class="form-control" name="asesorias_notificador" maxlength="10" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="password">Solicitudes Levantadas</label>
                                                <input type="number" class="form-control" name="solicitudes_levantadas" maxlength="10" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Ratificaciones</label>
                                                <input type="number" class="form-control" name="ratificaciones_notificador" maxlength="10" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Multas Notificadas</label>
                                                <input type="number" class="form-control" name="multas_notificador" maxlength="10" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Informe Diario</label>
                                                <input type="number" class="form-control" name="informe_diario" maxlength="10" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Informes Foráneos</label>
                                                <input type="number" class="form-control" name="informe_foraneo" maxlength="10" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Integrar Expediente</label>
                                                <input type="number" class="form-control" name="integrar_expediente" maxlength="10" pattern="[0-9]+" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Escaneo de Documentos</label>
                                                <input type="number" class="form-control" name="escaneo_documentos" maxlength="10" pattern="[0-9]+" required>
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

<div id="menu_carga" style ="display: none;">
    <div>.</div>
    <div class="loader"></div>
</div>


@section('scripts')
    <script src="../public/js/estadistica/estadistica.js"></script>
@endsection
