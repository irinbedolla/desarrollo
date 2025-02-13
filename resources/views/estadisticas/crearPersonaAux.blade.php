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
                                    <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                                    {!! Form::open(array('route'=>'seer.auxiliar_persona', 'method'=>'POST', 'class' => 'needs-validation','novalidate')) !!}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Número unico de identificación</label>
                                                    <input type="text" class="form-control" name="NUE" minlength="18" maxlength="18"  oninput="this.value = this.value.toUpperCase()" required>
                                                    <div class="invalid-feedback">
                                                        El Número unico de identificación es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="confirm-password">Fecha de confirmación de la solicitud</label>
                                                    <input type="date" class="form-control" name="fecha_confirmacion" required>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Solicitante</label>
                                                    <input type="text" class="form-control" name="solicitante"  oninput="this.value = this.value.toUpperCase()" required>
                                                    <div class="invalid-feedback">
                                                        El Solicitante es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Actividad economica</label>
                                                    <input type="text" class="form-control" name="actividad_economica"  oninput="this.value = this.value.toUpperCase()" required>
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="confirm-password">Sexo</label>
                                                    <select class="form-control" name="sexo" required>
                                                        <option value="">Seleccione</option>
                                                        <option value="H">Hombre</option>
                                                        <option value="M">Mujer</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Debes seleccionar al menos un Sexo.
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Estado del solicitante</label>
                                                    <select id="estado_solicitante" class="form-control" name="estado_solicitante" required>
                                                        <option value="">Seleccione</option>
                                                        @foreach($estados as $est)
                                                            <option value="{{$est['id']}}">{{$est['nombre']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        El Estado es obligatorio.
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Municipio del solicitante</label>
                                                    <select id="municipio_solicitante" name="mun_solicitante" class="form-control" disabled>
                                                        <option value=""> --Primero selecciona un estado --</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        El Municipio es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                        <!-- Comienzo de citados -->                                        
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <h4 class="text-center">Citado</h4>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-2"><BR>
                                                <button id="addRow" type="button" class="btn btn-info">Agregar Citado</button>
                                            </div>
                                           

                                            <div id="newRow" ></div>

                                            
                                            
                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <h4 class="text-center">Motivo de Solicitud</h4>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label for="confirm-password">Motivo Solicitud</label>
                                                    <select class="form-control" name="motivo" required>
                                                        <option value="">Seleccione</option>
                                                        <option value="Despido">Despido</option>
                                                        <option value="Pago de prestaciones">Pago de prestaciones</option>
                                                        <option value="Recision de la relación laboral">Recision de la relación laboral</option>
                                                        <option value="Derecho de preferencia">Derecho de preferencia</option>
                                                        <option value="Derecho de antiguedad">Derecho de antiguedad</option>
                                                        <option value="Derecho de ascesnso">Derecho de ascesnso</option>
                                                        <option value="Terminación voluntaria de relación laboral">Terminación voluntaria de relación laboral</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        El motivo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <div class="form-group">
                                                    <label for="confirm-password">Notificación</label>
                                                    <select class="form-control" name="notificacion" required>
                                                        <option value="">Seleccione</option>
                                                        <option value="Trabajador">Por el trabajador</option>
                                                        <option value="Centro">Por el centro</option>
                                                        <option value="Ambos">Ambos</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        El campo es obligatorio.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Conciliador</label>
                                                    <select class="form-control" name="conciliador_id" required>
                                                        <option value="">Seleccione</option>
                                                        @foreach($conciliadores as $con)
                                                            <option value="{{$con['id']}}">{{$con['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        El conciliador es obligatorio.
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
<script>
    $( document ).ready(function() {
        // agregar registro
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';

                //NOMBRE CITADO
                html +='<div class="col-xs-12 col-sm-6 col-md-6">';
                html +='<div class="form-group">';
                html +='<label for="confirm-password">Citado</label>';
                html +='<input type="text" class="form-control" name="citado[]"  oninput="this.value = this.value.toUpperCase()" required>';
                html +='</div> </div>';                                
                                            
                //ESTADO
                html += '<div class="col-xs-12 col-sm-12 col-md-6">';
                html += '<div class="form-group">';
                html += '<label for="password">Estado del citado</label>';
                html += '<select id="estado_citado" class="form-control" name="estado_citado[]" required>';
                html += '<option value="">Seleccione</option>';
                html += '@foreach($estados as $est)';
                html += '<option value="{{$est['id']}}">{{$est['nombre']}} </option>';
                html += '@endforeach';
                html += '</select>';
                html += '<div class="invalid-feedback">';
                html += 'El Estado es obligatorio.';
                html += '</div> </div> </div>';                            
                
                //MUNICIPIO
                html += '<div class="col-xs-12 col-sm-12 col-md-6">';
                html += '<div class="form-group">';
                html += '<label for="password">Municipio del citado</label>';
                html += '<select id="municipio_citado" name="municipio_citado[]" class="form-control" disable>';
                html += '<option value="">Seleccione</option>';
                html += '@foreach($municipios as $mun)';
                html += '<option value="{{$mun['id']}}">{{$mun['nombre']}} </option>';
                html += '@endforeach';
                html += '</select>';
                html += '<div class="invalid-feedback">';
                html += 'El Municipio es obligatorio.';
                html += '</div> </div> </div>';

                //DIRECCION
                html += '<div class="col-xs-12 col-sm-12 col-md-6">';
                html += '<div class="form-group">';
                html += '<label for="password">Dirección del citado</label>';
                html +='<input type="text" class="form-control" name="direccion[]"  oninput="this.value = this.value.toUpperCase()" required>';
                html += '<div class="invalid-feedback">';
                html += 'La Dirección es obligatoria.';
                html += '</div> </div> </div>';
                
                //TIPO DE PERSONA
                html +='<div class="col-xs-12 col-sm-6 col-md-6">';
                html +='<div class="form-group">';
                html +='<label for="confirm-password">Tipo persona</label>';
                html +='<select class="form-control" name="tipo_persona[]" required>';
                html +='<option value="">Seleccione</option>';
                html +='<option value="Fisica">Fisica</option>';
                html +='<option value="Moral">Moral</option>';
                html +='</select>';
                html +='<div class="invalid-feedback">';
                html +='El tipo de persona es obligatorio.';
                html += '</div> </div> </div>';                                    
                
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Borrar</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });
        
        // borrar registro
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    });
</script>
    <script src="../public/js/estadistica/estadistica.js"></script>
@endsection

