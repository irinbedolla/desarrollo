
<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>Sí Conciliación</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- Bootstrap 5.3.3 -->
        <link href="../public/assets_seer/assets/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
       
        <!-- Ionicons -->
        <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        <link href="../public/assets/css/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
        <link href="../public/assets/css/iziToast.min.css" rel="stylesheet">
        <link href="../public/assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="../public/assets/css/select2.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- Agregados para los Select del Formulario Personas-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: Arial, sans-serif;
                padding: 50px;
                background-color: #f4f4f9;
            }
            .chat-box {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                width: 900px;
                max-width: 1000px;
                margin: 0 auto;
            }
            .form-container h2 {
                margin-bottom: 20px;
                text-align: center;
            }
            h2 {
                text-align: center;
                color: #CEA845;
            }
            h1 {
                text-align: center;
                color:  #496163;
            }
            .preg{
                color: #CEA845;
                font-weight:bold;
            }
            .response {
                margin-top: 20px;
                padding: 10px;
                background-color: #f1f1f1;
                border-radius: 5px;
            }
            .btn {
                padding: 10px 20px;
                background-color: #CEA845;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .btn:hover {
                background-color: #CEA845;
            }
            .needs-validation
            {
                background-color: #4A001F;
            }
            
        </style>

    </head>
    <body>
        <!-- Formulario -->
        {!! Form::open(array('route'=>'RespuestasChat.store', 'method'=>'POST', 'files' => true, 'class' => 'needs-validation','novalidate')) !!}
            @csrf
            <div class="chat-box" style="position: relative; top:100px; right:0px; left:0px;">
                <h1>Asistente Centro de Conciliación</h1>
                <p align="center"><b>¿Cómo te podemos ayudar?</b></p>
                <div class="form-container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <p for="nombre_completo" class="preg">Nombre completo</p>
                                <input type="text" class="form-control" placeholder="*Nombre(s)" name="nombre_completo" oninput="this.value = this.value.toUpperCase()" required>
                                <div class="invalid-feedback">
                                    El nombre es obligatorio.
                                </div>
                            </div><br>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p for="ciudad" class="preg">Ciudad</p>
                                    <input type="text" class="form-control" placeholder="*Ciudad" name="ciudad" oninput="this.value = this.value.toUpperCase()" required>
                                    <div class="invalid-feedback">
                                        La ciudad es obligatoria.
                                    </div>
                                </div>
                            </div><br>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <!-- muestra las preguntas guardadas -->
                                    <label class="preg" for="pregunta">Selecciona una pregunta:</label><br>
                                    <select  name="idPregunta" id="preguntasChat" required>
                                        @foreach($preguntasChats as $preguntasChat)
                                            <div>
                                                <option value="{{ $preguntasChat->id }}"> {{ $preguntasChat->pregunta }} </option>
                                            </div>
                                        @endforeach 
                                    </select> 
                                </div>
                            </div>        
                        </div>
                    </div>  
                    @if(isset($id))
                        <p>{{ $ver_res->respuesta }}</p> 
                        <p>{{ $ver_res->pregunta }}        
                    @endif
                    <button type="submit" style="position: relative; top:0px; right:0px; left:750px;"  class="btn">
                        Enviar
                    </button>
                           
                </div>
            </div>
        {!! Form::close() !!}
    </body>
</html>