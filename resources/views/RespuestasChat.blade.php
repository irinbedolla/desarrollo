<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Ing. ISBM">
        <title>Si Conciliación</title>
        
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
        
        {!! Form::open(array('route'=>'RespuestasChat.storeUno', 'method'=>'POST', 'files' => true, 'class' => 'needs-validation','novalidate')) !!}
            @csrf
            <div class="chat-box" style="position: relative; top:100px; right:0px; left:0px;">
                <h1>Asistente Centro de Conciliación</h1>
                <p align="center"><b>¿Cómo te podemos ayudar?</b></p>
                <div class="form-container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            @if($registro)
                                <h2 >Hola {{ $registro->nombre_completo }}</h2>
                                @if(isset($idPregunta))
                                    @foreach($res as $re)
                                        <p><b>{{ $re->pregunta }}</b></p>                   
                                        <p>{{ $re->respuesta }}</p>      
                                        <br>
                                    @endforeach  
                                @endif
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="preg" for="pregunta">Selecciona una pregunta:</label>
                                <select class="form-control" name="idPregunta" id="preguntasChat" required>
                                    @foreach($preguntasChats as $preguntasChat)
                                        <div>
                                            <option value="{{ $preguntasChat->id }}"> {{ $preguntasChat->pregunta }} </option>
                                        </div>
                                    @endforeach 
                                </select>  
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <input type="hidden" class="form-control" name="id" value="{{ $id }}">
                        </div>          
                    </div>
                </div> 
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <button type="submit" style="position: relative; top:0px; right:0px; left:500px;" class="btn">Enviar</button>
                <a href="{{ url('/'); }}" class="btn btn-primary" style="position: relative; top:0px; right:0px; left:540px;">Salir</a>    
            </div>       
        {!! Form::close() !!}         
    </body>

</html>