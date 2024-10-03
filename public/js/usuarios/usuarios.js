const myForm = document.getElementById('form_usuarios');
myForm.addEventListener('submit', (event) => {
    $('#menu_carga').show();
});

const borrar = document.getElementById('borrar_usuarios');
borrar.addEventListener('submit', (event) => {
    $('#menu_carga').show();
});
