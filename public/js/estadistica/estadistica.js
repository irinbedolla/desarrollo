(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false ){
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                } else {
                    $('#menu_carga').show();
                }
            }, false);
        });
    }, false);
})();

$(function(){
    $('#estado_solicitante').on('change', onSelectestadoChange);
})

function onSelectestadoChange(){
    //Al detectar el cambio en el select toma el valor del select con el id "estado"
    var municipio_id = $(this).val();
    $('#municipio_solicitante').prop('disabled', false);
    //Se ejecuta la consulta AJAX para buscar con el municipio_id
    $.get('../api/munSolicitante/'+municipio_id, function (data){
        var html_select = '<option value="">--Seleccione un estado --</option>';        
        for(var i=0; i<data.length; ++i)
            html_select += '<option value= "'+data[i].id+'">'+data[i].nombre+'</option>';
            $('#municipio_solicitante').html(html_select);
    });
}

$(function(){
    $('#estado_citado').on('change', onSelectestadoChange1);
})

function onSelectestadoChange1(){
    //Al detectar el cambio en el select toma el valor del select con el id "estado"
    var municipio_id = $(this).val();
    $('#municipio_citado').prop('disabled', false);
    //Se ejecuta la consulta AJAX para buscar con el municipio_id
    $.get('../api/munCitado/'+municipio_id, function (data){
        var html_select = '<option value="">--Seleccione un estado --</option>';        
        for(var i=0; i<data.length; ++i)
            html_select += '<option value= "'+data[i].id+'">'+data[i].nombre+'</option>';
            $('#municipio_citado').html(html_select);
    });
}

function nuevo_estadistica() {
    $('#menu_carga').show();
}

function consultar_estadistica() {
    $('#menu_carga').show();
}

function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}



