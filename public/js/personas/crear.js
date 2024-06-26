$(function() {
    //alert('Script de Crear')

    //Se agrega la función para detectar el cambio en el select y toma el valor del select con el id "municipio"
    $('#municipio').on('change', onSelectMunicipioChange);
});


function onSelectMunicipioChange(){
    //Al detectar el cambio en el select toma el valor del select con el id "municipio"
    var municipio_id = $(this).val();
    $('#distrito_local').prop('disabled', false);
    //alert(municipio_id);
    console.log(municipio_id);
    //Se ejecuta la consulta AJAX para buscar con el municipio_id
    $.get('/api/municipio/'+municipio_id+'/niveles', function (data){
        var html_select = '<option value="">--Seleccione un distrito local --</option>';        
        for(var i=0; i<data.length; ++i)
            html_select += '<option value= "'+data[i].distrito_local_id+'">'+data[i].distrito_local_id+'</option>';
            console.log(data);
            $('#distrito_local').html(html_select);
    });
}


$(function() {
    //alert('Script de Crear')

    //Se agrega la función para detectar el cambio en el select y toma el valor del select con el id "municipio"
    $('#distrito_local').on('change', onSelectLocalChange);
});


function onSelectLocalChange(){
    //Al detectar el cambio en el select toma el valor del select con el id "municipio"
    var distrito_federal_id = $(this).val();
    //console.log(distrito_federal_id);
    $('#distrito_federal').prop('disabled', false);
    //alert(municipio_id);
    console.log(distrito_federal_id);
    //Se ejecuta la consulta AJAX para buscar con el municipio_id
    $.get('/api/local/'+distrito_federal_id+'/niveles', function (data){
        var html_select = '<option value="">--Seleccione un distrito federal --</option>';        
        for(var i=0; i<data.length; ++i)
            html_select += '<option value= "'+data[i].distrito_federal_id+'">'+data[i].distrito_federal_id+'</option>';
            console.log(data);
            $('#distrito_federal').html(html_select);
    });
}



$(function() {
    //alert('Script de Crear')

    //Se agrega la función para detectar el cambio en el select y toma el valor del select con el id "municipio"
    $('#municipio').on('change', onSelectSeccionChange);
});


function onSelectSeccionChange(){
    //Al detectar el cambio en el select toma el valor del select con el id "municipio"
    var municipio_id_seccion = $(this).val();
    //console.log(distrito_federal_id);
    $('#seccion').prop('disabled', false);
    //alert(municipio_id);
    console.log(municipio_id_seccion);
    //Se ejecuta la consulta AJAX para buscar con el municipio_id
    $.get('/api/seccion/'+municipio_id_seccion+'/niveles', function (data){
        var html_select = '<option value="">--Seleccione una sección --</option>';        
        for(var i=0; i<data.length; ++i)
            html_select += '<option value= "'+data[i].seccion_id+'">'+data[i].seccion_id+'</option>';
            console.log(data);
            $('#seccion').html(html_select);
    });
}