<?php
    $title = "SICCL";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="author" content="CCLMichoacan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title><?=$title?></title>
    <link rel="icon" href="../assets_seer/images/ser.png">
    <link rel="stylesheet" href="../assets_seer/css/bootstrap.css">
    <link rel="stylesheet" href="../assets_seer/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="../assets_seer/js/jquery-3.6.0.min.js"></script>
    <script src="../assets_seer/js/jquery-ui.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <!-- Se adjuntan los CDNS para la tabla paginada de resultados -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- ========================================================= -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="../assets_seer/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- <script src="assets/dist/js/bootstrap.bundle.min.js"></script> -->
    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
        }

        .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
        }

        .bi {
        vertical-align: -.125em;
        fill: currentColor;
        }

        .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
        }

        .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
        }
        .bd-mode-toggle {
        z-index: 1500;
        }

        /* .mapaCcls {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        } */

    </style>

</head>
<body>
    <script src="../assets_seer/assets/dist/js/bootstrap.bundle.min.js"></script>

    <nav class="navbar navbar-expand-md bg-dark sticky-top border-bottom" data-bs-theme="dark">
        <div class="container">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
                <div class="offcanvas-body">
                    <ul class="navbar-nav flex-grow-1 justify-content-center">
                        <li class="nav-item text-center">
                            <img src="../assets_seer/images/ccl.png" alt="" style="max-width: 10%; height: auto;">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    @if ($errors->any())
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <strong>¡Revise los campos!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    <!--<span class="badge badge-danger">{{ $error }}</span>-->
                @endforeach
            </ul>
            <div type="button" onclick="recargarPagina();" class="close"><span aria-hidden="true">Cerrar</span></div>
        </div>
    @endif

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
            <div type="button" onclick="recargarPagina();" class="close"><span aria-hidden="true">Cerrar</span></div>
        </div>
    @endif

    <div class="modal fade" id="altaAbogados" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <!--Se realiza la validación de campos para ver si dejó alguno vacío-->
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {!! Form::open(array('route'=>'poder', 'method'=>'POST', 'files' => true)) !!}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Alta de Representantes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class='bx bxs-edit-alt'></i></span>
                                        <input type="text" class="form-control" placeholder="*Nombre(s)" name="nombresAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class='bx bxs-edit-alt'></i></span>
                                        <input type="text" class="form-control" placeholder="*Apellidos" name="apellidosAbogadoAlta" id="apellidosAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">  
                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-phone'></i></span>
                                        <input type="text" class="form-control" placeholder="*Telefono"  name="telefonoAbogadoAlta" maxlength="10" pattern="[0-9]+" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-envelope'></i></span>
                                        <input type="email" class="form-control" placeholder="*Correo" name="correoAbogadoAlta" id="correoAbogadoAlta" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-buildings'></i></span>
                                        <input type="text" class="form-control" placeholder="*Empresa representación" name="empresaAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-buildings'></i></span>
                                        <input type="text" class="form-control" placeholder="*CURP" aria-label="CURP" name="curpAbogadoAlta"maxlength="18" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-buildings'></i></span>
                                        <input type="text" class="form-control" placeholder="*Domicilio" name="domicilioAbogadoAlta" id="domicilioAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-buildings'></i></span>
                                        <input type="text" class="form-control" placeholder="RFC Empresa" name="RFCAbogadoAlta" maxlength="10" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">*Fecha vigencia</i></i></span>
                                        <input type="date" class="form-control" aria-describedby="basic-addon1" name="fechaVigenciaAlta" id="fechaVigenciaAlta" min="<?= date("Y-m-d") ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">*Industria</i></i></span>
                                        <input type="text" class="form-control" placeholder="Giro Comercial" name="industriaAlta" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">*Descripción del poder</i></i></span>
                                        <textarea class="form-control" aria-describedby="basic-addon1" name="descripcionpoderAlta" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="col-sm-12 boxFile">
                                            <div>
                                                <label>*Identificación oficial</label><br>
                                                {!! Form::file('documentoIne', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="col-sm-12 boxFile">
                                            <div>
                                                <label>*Documento que acredite la representación</label><br>
                                                {!! Form::file('documentoRepresentacion', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="col-sm-12 boxFile">
                                            <div>
                                                <label>Anexos</label><br>
                                                {!! Form::file('documentoAnexo', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="col-sm-12 boxFile">
                                            <div>
                                                <label>Anexos 2</label><br>
                                                {!! Form::file('documentoPoder', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-check" required>
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Acepto Aviso de privacidad <a href="#">Consultar</a>  
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        <div class="row">
                            *Si requiere comprimir un archivo puedes ingresar a <a href="https://www.ilovepdf.com/es/comprimir_pdf" tarjet="_black">https://www.ilovepdf.com/es/comprimir_pdf</a>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        Los campos (*) son obligatorios.
                        <button type="button" class="popupBtnCancelar cerrarUsuario" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class=" popupBtnContinuar">Guardar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <main>
        <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
            <div class="col-md-6 p-lg-5 mx-auto my-5">
                <h1 class=" fw-bold">CENTRO DE CONCILIACIÓN LABORAL DEL ESTADO DE MICHOACÁN</h1>
                <h4 class="fw-normal text-muted mb-3">Transformando la Justicia Laboral</h4>
                <div class="d-flex gap-3 justify-content-center lead fw-normal">
                    <a class="btn btn-primary" href="#" onclick="abrirPopupAltaAbogado();" style="text-decoration: none;">
                    Registrar poder <i class='bx bx-chevron-right'></i>
                    </a>
                    <a class="btn btn-primary" href="{{ route('calendario') }}" style="text-decoration: none;">
                    Agendar cita
                    <i class='bx bx-chevron-right'></i>
                    </a>
                    <a class="btn btn-primary" href="{{ route('login') }}" style="text-decoration: none;">
                    Inicia Seccion
                    <i class='bx bx-chevron-right'></i>
                    </a>
                </div>
            </div>
            <div class="product-device shadow-sm d-none d-md-block"></div>
            <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
        </div>
    </main>
    <footer class="container py-5">
        <div class="row">
            <div class="col-12 col-md text-center">
                <img src="../assets_seer/images/logos.png" height="100" alt="" loading="lazy" />
                <br><br>
                <small class="d-block mb-3 text-body-secondary">CCLMICHOACÁN &copy; 2021 – 2027</small>
            </div>
            <div class="col-6 col-md enlacesCcl">
                <h5>Morelia</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary text-decoration-none" href="#" onclick="mostrarMapaCentro(0)"><i class='bx bx-map'></i> UBICADO EN BLVD. GARCÍA DE LEÓN 1575, CHAPULTEPEC ORIENTE, C.P. 58260 MORELIA, MICH.</a></li>
                </ul>
            </div>
            <div class="col-6 col-md enlacesCcl">
                <h5>Uruapan</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary text-decoration-none" href="#" onclick="mostrarMapaCentro(1)"><i class='bx bx-map'></i> UBICADO EN NUEVO PARICUTÍN NO 308, COL. JARDINES DE SAN RAFAEL, C.P. 30136 URUAPAN MICHOACÁN.</a></li>
                </ul>
            </div>
            <div class="col-6 col-md enlacesCcl">
                <h5>Zamora</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary text-decoration-none" href="#" onclick="mostrarMapaCentro(2)"><i class='bx bx-map'></i> UBICADO EN JUSTO SIERRA PONIENTE NO 290, CP. COL. JARDINES DE CATEDRAL, C.P. 59600 ZAMORA, MICHOACÁN.</a></li>
                </ul>
            </div>
            <div class="col-12 col-md text-center mapaCcls"></div>
        </div>
    </footer>



</body>
</html>
<script>
    function mostrarMapaCentro(operacion){
        if (operacion == 0) {
            var htmlMapaMorelia = 
            "<h5>Mapa</h5>"+
            "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3756.562176538719!2d-101.16616018471558!3d19.688675786739346!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842d0df8d04ea13f%3A0x164b3b337d316d68!2sBlvd.%20Garc%C3%ADa%20de%20Le%C3%B3n%201575%2C%20Chapultepec%20Oriente%2C%2058260%20Morelia%2C%20Mich.!5e0!3m2!1ses-419!2smx!4v1677528472320!5m2!1ses-419!2smx' width='250' height='110' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
            $(".mapaCcls").html(htmlMapaMorelia);
        }
        else if (operacion == 1){
            var htmlMapaUruapan = 
            "<h5>Mapa</h5>"+
            "<iframe src='https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3762.876860633628!2d-102.00787025417362!3d19.41772575263618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTnCsDI1JzAzLjYiTiAxMDLCsDAwJzE5LjkiVw!5e0!3m2!1ses-419!2smx!4v1695318246690!5m2!1ses-419!2smx width=600 height=450 style=border:0; allowfullscreen= loading=lazy referrerpolicy=no-referrer-when-downgrade'></iframe>";
            $(".mapaCcls").html(htmlMapaUruapan);
        }
        else if (operacion == 2){
            var htmlMapaZamora = 
            "<h5>Mapa</h5>"+
            "<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d937.4035977997082!2d-102.28177407078772!3d19.98271265952557!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842e88c64d2b7799%3A0x89565d90138cb0ca!2sJusto%20Sierra%20Ote.%20306%2C%20Jardines%20de%20Catedral%2C%2059670%20Zamora%20de%20Hidalgo%2C%20Mich.!5e0!3m2!1ses-419!2smx!4v1677539741033!5m2!1ses-419!2smx' width='250' height='110' style='border:0;'' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
            $(".mapaCcls").html(htmlMapaZamora);
        }

    }

    function recargarPagina(){
        location.reload();
    }

    function abrirPopupAltaAbogado(idUsuario){
        $("#nombresAbogadoAlta").val("");
        $("#apellidosAbogadoAlta").val("");
        $("#telefonoAbogadoAlta").val("");
        $("#correoAbogadoAlta").val("");
        $("#fechaVigenciaAlta").val("");
        $("#empresaAbogadoAlta").val("");
        $("#curpAbogadoAlta").val("");
        $("#domicilioAbogadoAlta").val("");
        $("#rfcAbogadoAlta").val("");
        $("#industriaAlta").val("");
        $("#descripcionpoderAlta").val("");
        $("#moreliaSucursal").val("");
        $("#uruapanSucursal").val("");
        $("#zamoraSucursal").val("");
        $("#documentoIne").val("");
        $("#documentoPoder").val("");
        $("#documentoRepresentacion").val("");
        $("#documentoAnexo").val("");
        $(".cargarArchivo").html("Archivo<span class='btnCargar'></span>");
        $("#altaAbogados").modal("toggle");
    }
    
</script>
