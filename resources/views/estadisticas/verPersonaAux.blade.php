@extends('layouts.app_editar')

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
                            <h3 class="text-center">Solicitud</h3>
                            
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

                            @can('crear-seer')
                                @if($userRole[0] == "Auxiliar")
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="name">Número unico de identificación</label>
                                                <input type="text" class="form-control" value="<?=$general["NUE"];?>" readonly >
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="email">Solicitante</label>
                                                <input type="text" class="form-control" value="<?=$general["solicitante"];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="password">Estado del solicitante</label>
                                                <input type="text" class="form-control" value="<?=$estado_citado["nombre"];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="password">Municipio del solicitante</label>
                                                <input type="text" class="form-control" value="<?=$mun_citado["nombre"];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="confirm-password">Motivo de Solicitud</label>
                                                <input type="text" class="form-control" value="<?=$auxiliar["motivo"];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label for="confirm-password">Notificación</label>
                                                <input type="text" class="form-control" value="<?=$auxiliar["notificacion"];?>" readonly>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                            <div class="form-group">
                                                <label for="password">Conciliador</label>
                                                <input type="text" class="form-control" value="<?=$conciliador["name"];?>" readonly>   
                                            </div>
                                        </div>

                                        @if($auxiliar["tipo_solicitud"] == "Ratificación")
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Monto</label>
                                                    <input type="text" class="form-control" value="<?=number_format($auxiliar["monto"],2);?>" readonly>   
                                                </div>
                                            </div><div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Estatus</label>
                                                    <input type="text" class="form-control" value="<?=$auxiliar["estatus"];?>" readonly>   
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <a class="btn btn-primary" href="{{ route('seer') }}">Regresar</a>
                                        </div>
                                            
                                    </div>
                                @endif
                            @endcan


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
    <script src="../../public/js/estadistica/estadistica.js"></script>
@endsection

