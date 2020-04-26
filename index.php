<?php
session_start();
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario']['tipo_usuario'] == "Administrador") {
        header('location: inicio.php');
    } else {
        header('location: index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Estilos/login.css">
    <link rel="stylesheet" href="fonts/style.css">
    <link rel="stylesheet" href="Estilos/loader.css">

    <script src="Scripts/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="Scripts/login.js"></script>

    <title>Login</title>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.loading2').fadeOut(1000).html();
        });
    </script>
</head>

<body>
    <div class="error">
        <span>Los datos ingresados son errados por favor verifique nuevamente</span>
    </div>
    <div class="loading2">
    </div>
    <div>
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div class="banner-top">
                            <h3>Bilbioteca Virtual</h3>
                            <div id="login-box" class="col-md-12">
                                <form id="login-form" class="form" action="" method="">
                                    <div class="form-group">
                                        <label for="">Usuario:</label>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text icon-users"></span>
                                            </div>
                                            <input type="text" name="user" pattern="[A-Za-z0-9_-]{1,15}" 
                                            class="form-control" placeholder="Usuario" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Contraseña:</label>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text icon-key"></span>
                                            </div>
                                            <input type="password" name="pasword" pattern="[A-Za-z0-9]{1,15}" class="form-control"
                                             placeholder="****************" required>
                                        </div>
                                    </div>
                                    <div class="form-group button">
                                        <input type="submit" name="submit" class="btn btn-info btn-lg" value="Iniciar Sesión">
                                        <div class="loading-gear">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>