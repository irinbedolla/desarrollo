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
                                @if($userRole[0] == "Conciliador")
                                    <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                                    {!! Form::open(array('route'=>'seer.conciliador_persona', 'method'=>'POST', 'class' => 'needs-validation','novalidate')) !!}
                                        <div class="row">
                                            <input type="hidden" name="id" value="<?=$general["id"]?>">
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

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <h4 class="text-center">Citado</h4>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="confirm-password">Citado</label>
                                                    <input type="text" class="form-control" name="citado" value="<?=$general["citado"];?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Estado del citado</label>
                                                    <input type="text" class="form-control" value="<?=$estado_citado["nombre"];?>" readonly>   
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Municipio del citado</label>
                                                    <input type="text" class="form-control" value="<?=$mun_citado["nombre"];?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="confirm-password">Sexo</label>
                                                    <input type="text" class="form-control" value="<?=$auxiliar["sexo"];?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="confirm-password">Tipo persona</label>
                                                    <input type="text" class="form-control" value="<?=$auxiliar["tipo_persona"];?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label for="confirm-password">Notificación</label>
                                                    <input type="text" class="form-control" value="<?=$auxiliar["notificacion"];?>" readonly>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <h4 class="text-center">Audiencia</h4>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Actividad economica del citado</label>
                                                    <input type="text" class="form-control" name="actividad_economica" value="<?=$auxiliar["actividad_economica"];?>" >
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Folio de la audiencia</label>
                                                    <input type="text" class="form-control" name="numero_audiencia" required>
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Número de audiencias</label>
                                                    <input type="number" class="form-control" name="numero_audiencias" required>
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="confirm-password">Estatus de audiencias</label>
                                                    <select id="estatus" class="form-control" name="estatus" required>
                                                        <option value="">Seleccione</option>
                                                        <option value="Conciliacion">Conciliacion</option>
                                                        <option value="No conciliacion">No Conciliacion</option>
                                                        <option value="Regenerada">Regenerada</option>
                                                        <option value="Archivada">Archivada</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="Archivadas" style="display:none" class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="confirm-password">Motivo archivardo</label>
                                                    <select class="form-control" name="motivo_archivo">
                                                        <option value="Falta de interes">Falta de interes</option>
                                                        <option value="Incompetencia">Incompetencia</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="Reprogramada" style="display:none" class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="confirm-password">Fecha programación</label>
                                                    <input type="date" name="fecha_reprogracion" class="form-control">
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Monto del convenio</label>
                                                    <input type="number" name="monto" class="form-control"  required>   
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Observaciones</label>
                                                    <input type="text" name="observacion" class="form-control">   
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Multa</label>
                                                    <select class="form-control" name="multa" required>
                                                        <option value="">Seleccione</option>
                                                        <option value="Si">Si</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Tipo de solicitud</label>
                                                    <select class="form-control" name="solicitud" required>
                                                        <option value="">Seleccione</option>
                                                        <option value="Presencial">Presencial</option>
                                                        <option value="Linea">Linea</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-8">
                                                <div class="form-group">
                                                    <label for="password">Cumplimiento de pago</label>
                                                    <input type="text" name="cumplimiento" class="form-control"> 
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>  
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                                
                                        </div>
                                    {!! Form::close() !!}
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
    <script>
        $('#estatus').change(function(){
            var valorCambiado =$(this).val();
            if((valorCambiado == 'Archivada')){
                $('#Archivadas').css('display','block');
                $('#Reprogramada').css('display','none');
            }
            else if((valorCambiado == 'Regenerada')){
                $('#Archivadas').css('display','none');
                $('#Reprogramada').css('display','block');
            }
            else{
                $('#Archivadas').css('display','none');
                $('#Reprogramada').css('display','none');
            }
        });
    </script>
@endsection

