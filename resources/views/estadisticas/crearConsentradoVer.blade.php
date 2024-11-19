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
                                                <input type="number" class="form-control" name="solicitudes" value="<?=$estadisticas["solicitudes"];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="email">Ratificaciones</label>
                                                <input type="number" class="form-control" name="ratificaciones" value="<?=$estadisticas["ratificaciones"];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="password">Asesorias</label>
                                                <input type="number" class="form-control" name="asesorias" value="<?=$estadisticas["asesorias"];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Consulta Expediente</label>
                                                <input type="number" class="form-control" name="expediente_consulta" value="<?=$estadisticas["expediente_consulta"];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Escanear Expediente</label>
                                                <input type="number" class="form-control" name="expediente_escaneo" value="<?=$estadisticas["expediente_escaneo"];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Foliar Expediente</label>
                                                <input type="number" class="form-control" name="expediente_foliar" value="<?=$estadisticas["expediente_foliar"];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Exhortos</label>
                                                <input type="number" class="form-control" name="exhortos" value="<?=$estadisticas["exhortos"];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Audiencias Celebradas</label>
                                                <input type="number" class="form-control" name="audiencias_celebradas"  value="<?=$estadisticas["audiencias_celebradas"];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Registro Cumplimiento</label>
                                                <input type="number" class="form-control" name="cumplimientos" value="<?=$estadisticas["cumplimientos"];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label for="confirm-password">Cuentificación Total($)</label>
                                                <input type="number" class="form-control" name="cuantificacion" value="<?=$estadisticas["cuantificacion"];?>" readonly>
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

