<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Sí Conciliación</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    
    <!-- Agregados para los Select del Formulario Personas-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    @livewireStyles


    @yield('page_css')
    <!-- Template CSS -->
    @yield('page_css')

    @yield('css')
</head>

<div id="app">  

        <section class="section">
            <div class="section-header">
                <h3 style="text-align: center;">Sí Conciliación registra tu poder.</h3>
            </div>
            <div class="section-body">

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Modal header</h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>



                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if(session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>¡Registro correcto!</strong>
                                        {{ session()->get('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

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
                                <h3 class="text-center">Agregar Poder</h3>

                                <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                                {!! Form::open(array('route'=>'poderes.publico', 'method'=>'POST', 'files' => true)) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="name">Nombres</label>
                                                <input type="text" class="form-control" placeholder="*Nombre(s)" name="nombresAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Primer Apellido</label>
                                                <input type="text" class="form-control" placeholder="*Apellidos" name="primer_apellido" id="apellidosAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Segundo Apellido</label>
                                                <input type="text" class="form-control" placeholder="*Apellidos" name="segundo_apellido" id="apellidosAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Teléfono</label>
                                                <input type="number" class="form-control" placeholder="*Telefono"  name="telefonoAbogadoAlta" maxlength="10" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Correo</label>
                                                <input type="email" class="form-control" placeholder="*Correo" name="correoAbogadoAlta" id="correoAbogadoAlta" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Empresa</label>
                                                <input type="text" class="form-control" placeholder="*Empresa representación" name="empresaAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">CURP</label>
                                                <input type="text" class="form-control" placeholder="*CURP" aria-label="CURP" name="curpAbogadoAlta" minlength="18" maxlength="18" oninput="this.value = this.value.toUpperCase()" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Domicilio</label>
                                                <input type="text" class="form-control" placeholder="*Domicilio" name="domicilioAbogadoAlta" id="domicilioAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">RFC</label>
                                                <input type="text" class="form-control" placeholder="RFC Empresa" name="RFCAbogadoAlta" minlength="13" maxlength="13" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Fecha vigencia</label>
                                                <input type="date" class="form-control" aria-describedby="basic-addon1" name="fechaVigenciaAlta" id="fechaVigenciaAlta" min="<?= date("Y-m-d") ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Industria</label>
                                                <input type="text" class="form-control" placeholder="Giro Comercial" name="industriaAlta" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-3">
                                            <div class="form-group">
                                                <span class="" id="basic-addon1">*Seleccione la region(nes).</i></i></span>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="moreliaSucursal" value="Si">
                                                    <label class="form-check-label" for="flexCheckDefault">Morelia</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="uruapanSucursal" value="Si" >
                                                    <label class="form-check-label" for="flexCheckChecked">Uruapan</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="zamoraSucursal" value="Si">
                                                    <label class="form-check-label" for="flexCheckDefault">Zamora</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-9">
                                            <div class="form-group">
                                                <label for="">Descripción del poder</label>
                                                <textarea class="form-control" aria-describedby="basic-addon1" name="descripcionpoderAlta" required></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>*Identificación oficial</label><br>
                                                {!! Form::file('documentoIne', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>*Documento que acredite la representación</label><br>
                                                {!! Form::file('documentoRepresentacion', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Anexos</label><br>
                                                {!! Form::file('documentoAnexo', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label>Anexos 2</label><br>
                                                {!! Form::file('documentoPoder', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                            </div>
                                        </div>

                                               
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            <a href="{{ route('publico') }}" class="btn btn-primary">Regresar</a>
                                        
                                {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
