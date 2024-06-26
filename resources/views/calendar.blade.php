
<?php
    use App\Models\CrudEvents;
    $hoy = date("Y-m-d");  
    $events = CrudEvents::where('event_start', '>=', $hoy)->get();
?>

    <!-- Bootstrap Core CSS -->
    <link href="css_calendario/bootstrap.min.css" rel="stylesheet">
    <!-- FullCalendar -->
    <link href='css_calendario/fullcalendar.css' rel='stylesheet' />
    <!-- Custom CSS -->
    <style>
        #calendar {
            max-width: 100%;
        }
        .col-centered{
            float: none;
            margin: 0px 0px 100px 7.6%;
        }
        .colores-izquierda{
            width: 10%;
            height: 18px;
            margin: 0px 0px 0px 7.5%;
            display: inline-block;
            text-align: center;
        }
        .colores-medio{
            width: 64.5%;
            height: 18px;
            margin: 0px 0px 0px 0px;
            display: inline-block;
        }
        .colores-derecha{
            width: 10%;
            height: 18px;
            margin: 0px 0px 0px 0px;
            display: inline-block;
            text-align: center;
        }
        
    </style>


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


    <!-- Page Content -->
    <div class="container" id="contenedor">
        <div>
            <a class="btn btn-primary" href="{{ url('/') }}" style="text-decoration: none;">Regresar</a>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" id="calendar"></div>
        </div>
    </div>




        <!-- Modal -->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="modal" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div style="color:#D3D4D3; font-size:10px;">.</div>
                <div style="color:#D3D4D3; font-size:10px;">.</div>
                <div class="modal-content" id="editar_dia_calendario">
                    
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {!! Form::open(array('route'=>'capacitaciones.store', 'method'=>'POST')) !!}
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agendar Cita</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">*Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Escribe tu nombre" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Fecha y hora</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start">
                                    <select name="hora" class="form-control" id="hora">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Descricion de la visita</label>
                                <div class="col-sm-10">
                                    <textarea name="actividad" class="form-control" id="actividad"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- <label for="end" class="col-sm-2 control-label">Fecha Final</label> -->
                                <div class="col-sm-10">
                                    <input type="hidden" name="end" class="form-control" id="end" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        
    </div>
        <!-- /.container -->


        <!-- jQuery Version 1.11.1 -->
        <script src="jsCalendar/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="jsCalendar/bootstrap.min.js"></script>

        <!-- FullCalendar -->
        <script src='jsCalendar/moment.min.js'></script>
        <script src='jsCalendar/fullcalendar/fullcalendar.min.js'></script>
        <script src='jsCalendar/fullcalendar/fullcalendar.js'></script>
        <script src='jsCalendar/fullcalendar/locale/es.js'></script>

        <script>
            $(document).ready(function() {

                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

                $('#calendar').fullCalendar({
                    header: {
                        language: 'es',
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay',

                    },
                    defaultDate: yyyy+"-"+mm+"-"+dd,
                    editable: true,
                    eventLimit: false, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end) {
                        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
                        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                        var datos_enviados = moment(start).format('YYYY-MM-DD');
                        var ruta = "lstComisFilt/" + datos_enviados + "/" + e.target.value

                        var request = $.ajax({
                            url: ruta,
                            method: "POST",
                            data: datos_enviados,
                            dataType: "json"
                        });


                        $('#ModalAdd').modal('show');
                    },
                    eventRender: function(event, element) {
                        element.bind('click', function() {
                            var url="vistas/view_calendario_editar.php"; 
                            var id_mandar = event.id;
                            $.post(url,{id:id_mandar},
                            function(data){
                                $("#ModalEdit").modal("show");
                                $('#editar_dia_calendario').html(data);
                            });
                        });
                    },
                    eventDrop: function(event, delta, revertFunc) { // si changement de position

                        edit(event);

                    },
                    eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                    },
                    events: [
                        <?php
                         function parseString($string) {
                            $string = str_replace("\\", "\\\\", $string);
                            $string = str_replace('/', "\\/", $string);
                            $string = str_replace('"', "\\".'"', $string);
                            $string = str_replace("\b", "\\b", $string);
                            $string = str_replace("\t", "\\t", $string);
                            $string = str_replace("\n", "\\n", $string);
                            $string = str_replace("\f", "\\f", $string);
                            $string = str_replace("\r", "\\r", $string);
                            $string = str_replace("\u", "\\u", $string);
                            return ''.$string.''; 
                        }

                        foreach($events as $event):

                        $start = explode(" ", $event['event_start']);
                        $end = explode(" ", $event['event_end']);
                        
                        ?>
                        {
                            id: '<?php echo $event['id']; ?>',
                            title: '<?php echo $event['title']; ?>',
                            start: '<?php echo $event['event_start'];; ?>',
                            end: '<?php echo $event['event_end'];; ?>',
                        },
                        <?php endforeach; ?>
                    ]
                });

                function edit(event){
                    start = event.start.format('YYYY-MM-DD HH:mm:ss');
                    if(event.end){
                        end = event.end.format('YYYY-MM-DD HH:mm:ss');
                    }else{
                        end = start;
                    }

                    id =  event.id;
                    Event = [];
                    Event[0] = id;
                    Event[1] = start;
                    Event[2] = end;
                    $.ajax({
                        url: 'editEventDate.php',
                        type: "POST",
                        data: {Event:Event},
                        success: function(rep) {
                            if(rep == 'OK'){
                                alert('Evento se ha guardado correctamente');
                            }else{
                                alert('No se pudo guardar. Inténtalo de nuevo.');
                            }
                        }
                    });
                }

                var elemts = document.getElementsByTagName('a');
                var i;
                for (var i = 0; i < elemts.length; i++) {
                    if (elemts[i].style.backgroundColor === '#000') {
                        elemts[i].style.color = '#FFFFFF';
                    }
                }

            });
    </script>
    