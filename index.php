<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Estilos/login.css">
    <link rel="stylesheet" href="fonts/style.css">

    <script src="Scripts/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="Scripts/busqueda.js"></script>
    <script src="popper/popper.min.js"></script>

    <title>Login</title>
</head>

<body>
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
                                            <input type="text" class="form-control" placeholder="Usuario" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Contraseña:</label>
                                        <div class="input-group form-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text icon-key"></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="****************" required> 
                                        </div>
                                    </div>
                                    <div class="form-group button">
                                        <input type="submit" name="submit" class="btn btn-info btn-lg" value="Iniciar sesion">
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