<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">
        <title>Si Conciliación</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">

        <!-- Bootstrap core CSS -->
        <link href="public/assets_seer/assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
        </style>

        <!-- Custom styles for this template -->
        <link href="public/assets/css/carousel.css" rel="stylesheet">
    </head>
    <body>
    
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top">
                <div class="container">
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
                        <div class="offcanvas-body">
                            <ul class="navbar-nav flex-grow-1 justify-content-center">
                                <li class="nav-item text-center">
                                    <img src="public/assets_seer/images/ccl.png" alt="" style="max-width: 10%; height: auto;">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main>
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-wrap="true"> 
         <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="5" aria-label="Slide 6"></button>
         </div>
             <div class="carousel-inner">
                    <div class="carousel-item active">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#6A0F49"/></svg>
                        <div class="container">
                            <div class="carousel-caption text-end">
                                <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                            </div>
                            <div class="carousel-caption text-start">
                                <h1>Solicitud en linea.</h1>
                                <p>Puedes realizar tu solicitud en linea.</p>
                                <p><a class="btn btn-lg btn-primary" href="https://michoacan.cencolab.mx/asesoria/seleccion" style="text-decoration: none; background-color: #DEC512;">
                                    Generar Solicitud</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#6A0F49"/></svg>
                        <div class="container">
                            <div class="carousel-caption text-end">
                                <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                            </div>
                            <div class="carousel-caption text-start">
                                <h1>Registrar poder.</h1>
                                <p>Inicia tu registro como apoderado.</p>
                                <p><a class="btn btn-lg btn-primary" href="{{ route('poder-crear') }}" style="text-decoration: none; background-color: #DEC512;">
                                    Generar Registro
                                </a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#6A0F49"/></svg>
                        <div class="container">
                            <div class="carousel-caption text-end">
                                <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                            </div>
                            <div class="carousel-caption text-start">
                                <h1>Audiencias remotas.</h1>
                                <p>Consulta la fecha y hora de tu audiencia remota.</p>
                                <p><a class="btn btn-primary" href="#" style="text-decoration: none; background-color: #DEC512;">
                                    Consultar</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#6A0F49"/></svg>
                        <div class="container">
                            <div class="carousel-caption text-end">
                                <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                            </div>
                            <div class="carousel-caption text-start">
                                <h1>Cursos.</h1>
                                <p>Realiza los cursos en linea.</p>
                                <p><a class="btn btn-lg btn-primary" href="#" style="text-decoration: none; background-color: #DEC512;">
                                    Cursos</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#6A0F49"/></svg>
                        <div class="container">
                            <div class="carousel-caption text-end">
                                <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                            </div>
                            <div class="carousel-caption text-start">
                            <h1>Sí Conciliación.</h1>
                            <p>Sistema integral de Conciliación.</p>
                            <p><a class="btn btn-lg btn-primary" href="{{ route('login') }}" style="text-decoration: none; background-color: #DEC512;">
                                Ingresar</a>
                            </p>
                        </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#6A0F49"/></svg>
                        <div class="container">
                            <div class="carousel-caption text-end">
                                <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                            </div>
                            <div class="carousel-caption text-start">
                                <h1>SEER.</h1>
                                <p> Sistema Estatal de Estadísticas y Evaluación de Conciliadores.</p>
                                <p><a class="btn btn-lg btn-primary" href="{{ route('login') }}" style="text-decoration: none; background-color: #DEC512;">
                                    Ingresar</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
                </div>


                


            <!-- Marketing messaging and featurettes
            ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="container marketing">

                <!-- Three columns of text below the carousel -->
                <div class="row">
                    <div class="col-lg-4">
                        <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                        <h2>Morelia</h2>
                        <p>BLVD. GARCÍA DE LEÓN 1575, CHAPULTEPEC ORIENTE, C.P. 58260 MORELIA, MICH.</p>
                        <p><a class="btn btn-secondary" href="https://www.google.com/maps/place/Centro+de+Conciliaci%C3%B3n+Laboral+del+Estado+de+Michoac%C3%A1n/@19.6886808,-101.1665464,17z/data=!3m1!4b1!4m6!3m5!1s0x86972e4da3b81177:0xb3bdb18efbe90610!8m2!3d19.6886758!4d-101.1639715!16s%2Fg%2F11tjwgnyhz?entry=ttu" target="_blank">
                            Ver Ubicación &raquo;</a></p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                        <h2>Uruapan</h2>
                        <p>NUEVO PARICUTÍN NO 308, COL. JARDINES DE SAN RAFAEL, C.P. 30136 URUAPAN MICHOACÁN.</p>
                        <p><a class="btn btn-secondary" href="https://www.google.com/maps/place/Centro+de+Conciliaci%C3%B3n+Laboral+Uruapan/@19.4183803,-102.0080912,17z/data=!3m1!4b1!4m6!3m5!1s0x842de3549b0e069b:0x5044e26ce5f7e25a!8m2!3d19.4183753!4d-102.0055163!16s%2Fg%2F11ryt409m2?entry=ttu" target="_blank">Ver Ubicación &raquo;</a></p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                        <h2>Zamora</h2>
                        <p>JUSTO SIERRA PONIENTE NO 290, CP. COL. JARDINES DE CATEDRAL, C.P. 59600 ZAMORA, MICHOACÁN.</p>
                        <p><a class="btn btn-secondary" href="https://www.google.com/maps/place/Justo+Sierra+209,+Jardines+de+Catedral,+Zamora+de+Hidalgo,+Mich./@19.9820742,-102.2817188,17z/data=!3m1!4b1!4m5!3m4!1s0x842e88c79f23a3c5:0x70d579455d9255cb!8m2!3d19.9820692!4d-102.2791439?entry=ttu">Ver Ubicación &raquo;</a></p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                        <h2>Zitácuaro</h2>
                        <p>CALLE CUAUHTEMOC ORIENTE 15, ZITÁCUARO, MICHOACÁN.</p>
                        <p><a class="btn btn-secondary" href="https://www.google.com/maps/place/Cuauht%C3%A9moc+Ote.+15,+Cuauhtemoc,+61506+Zit%C3%A1cuaro,+Mich./@19.4385694,-100.3564309,17z/data=!3m1!4b1!4m6!3m5!1s0x85d2a4a1dec711b3:0x68685762f8695d11!8m2!3d19.4385644!4d-100.353856!16s%2Fg%2F11c21h6jl_?entry=ttu">Ver Ubicación &raquo;</a></p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img src="public/assets_seer/images/ccl-r.png" alt="" style="max-width: 30%; height: auto;">
                        <h2>Lázaro Cardenas</h2>
                        <p></p>
                        <p><a class="btn btn-secondary" href="#">Ver Ubicación &raquo;</a></p>
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->


                <!-- START THE FEATURETTES -->

                <hr class="featurette-divider">

                

            </div><!-- /.container -->


            <!-- FOOTER -->
            <footer class="container">
                <p class="float-end"><a href="#">Regresar</a></p>
                <p>&copy; 2023–2027.</p>
            </footer>
        </main>

        <script src="public/assets_seer/assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
