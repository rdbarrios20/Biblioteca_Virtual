$(document).on('submit','#login-form', function (event) {
    debugger
    event.preventDefault();
    $.ajax({
        url: 'php/login.php',
        type: 'POST',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend:function(){
            $('.login').val('Validando....');
        }
    })
    .done(function(response){
        console.log(response);
        if(!response.validation){
            if(response.tipo=='Administrador'){
                location.href='inicio.php';
            }else{
                $('.error').slideDown('slow');
                setTimeout(function(){
                    $('.error').slideUp('slow');
                },3000);
                $('.login').val('Iniciar sesión');
            }
        }
    })
    .fail(function(error){
        console.log(error.responseText);
    })
    .always(function(){
        console.log("complete");
    });
});