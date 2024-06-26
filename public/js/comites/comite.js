$( document ).ready(function() {
    // agregar registro
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';


            //NOMBRE
            html += '<div class="col-xs-12 col-sm-12 col-md-12">';
            html += '<div class="form-group">';
            html += ' <label for="">Nombre Completo</label>';
            html += '<input type="text" name="nombres[]" class="form-control" autocomplete="off">';
            html += '</div> </div>';
            //DIRECCION
            html += '<div class="col-xs-12 col-sm-12 col-md-12">';
            html += '<div class="form-group">';
            html += ' <label for="">Dirección</label>';
            html += '<input type="text" name="direccion[]" class="form-control" autocomplete="off">';
            html += '</div> </div>';
            //TELEFONO
            html += '<div class="col-xs-12 col-sm-12 col-md-12">';
            html += '<div class="form-group">';
            html += ' <label for="">Telefono°</label>';
            html += '<input type="number" maxlength="10" name="telefono[]" class="form-control" autocomplete="off">';
            html += '</div> </div>';
            //INE
            html += '<div class="col-xs-12 col-sm-12 col-md-12">';
            html += '<div class="form-group">';
            html += ' <label for="">INE</label>';
            html += '<input type="text" name="ines[]" class="form-control" autocomplete="off">';
            html += '</div> </div>';


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

$("#municipio").change(function(){
    var municipio_id = $(this).val();
    onSelectFederalChange(municipio_id);
    onSelectLocalChange(municipio_id);
  });


function onSelectFederalChange(variable){
    //Al detectar el cambio en el select toma el valor del select con el id "municipio"
    var municipio_id = variable;
    $('#distrito_federal').prop('disabled', false);
    //Se ejecuta la consulta AJAX para buscar con el municipio_id
    $.get('../api/federal/'+municipio_id+'/niveles', function (data){ 
        var html_select = '<option value="">--Seleccione un distrito federal --</option>';     
        for(var i=0; i<data.length; ++i){
            console.log(data[i]);
            html_select += '<option value= "'+data[i].distrito_federal_id+'">'+data[i].distrito_federal_id+'</option>';
        }
        $('#distrito_federal').html(html_select);
    });
}



function onSelectLocalChange(municipio){
    //console.log(distrito_federal_id);
    $('#distrito_local').prop('disabled', false);
    //Se ejecuta la consulta AJAX para buscar con el municipio_id
    $.get('../api/local/'+municipio+'/niveles', function (data){
        var html_select = '<option value="">--Seleccione un distrito local --</option>';         
        for(var i=0; i<data.length; ++i){
            html_select += '<option value= "'+data[i].distrito_local_id+'">'+data[i].distrito_local_id+'</option>';
        }
        $('#distrito_local').html(html_select);
    });
}


function onSelectSeccionChange(){
    //Al detectar el cambio en el select toma el valor del select con el id "municipio"
    var municipio_id_seccion = $(this).val();
    //console.log(distrito_federal_id);
    $('#seccion').prop('disabled', false);
    //alert(municipio_id);
    console.log(municipio_id_seccion);
    //Se ejecuta la consulta AJAX para buscar con el municipio_id
    $.get('../api/seccion/'+municipio_id_seccion+'/niveles', function (data){
        var html_select = '<option value="">--Seleccione una sección --</option>';        
        for(var i=0; i<data.length; ++i)
            html_select += '<option value= "'+data[i].seccion_id+'">'+data[i].seccion_id+'</option>';
        //    console.log(data);
            $('#seccion').html(html_select);
    });
}


