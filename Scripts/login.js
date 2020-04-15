$(document).on('submit','#login-form', function (event) {
    debugger
    $.ajax({
        url: 'php/login.php',
        type: 'POST',
        dataType: 'json',
        data: {
            user: $('usser').val(),
            pasword: $('pasword').val()
        },

        success: function (response) {
            if (response == true) {
                console.log(response);
            }
        },

        error: function (response) {
            console.log(response);
        }
    })
    event.preventDefault();
});