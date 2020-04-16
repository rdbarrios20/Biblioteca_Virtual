$(document).on('submit', '#login-form', function(event) {
    debugger
    event.preventDefault();
    $.ajax({
            url: 'php/login.php',
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function() {
                $('.login').val('Validando....');
            }
        })
        .done(function(respuesta) {
            if (!respuesta.validation) {
                if (respuesta.tipo == 'Administrador') {
                    location.href = 'inicio.php';
                } else {
                    if (respuesta.tipo == '');
                    location.href = 'index.php';
                }
            } else {
                $('.error').slideDown('slow');
                setTimeout(function() {
                    $('.error').slideUp('slow');
                }, 3000);
                $('.login').val('Iniciar sesión');
            }
        })
        .fail(function(resp) {
            console.log(resp.responseText);
        })
        .always(function() {
            console.log("complete");
        });
});