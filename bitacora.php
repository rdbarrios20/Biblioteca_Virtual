<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Estilos/styles.css">
    <link rel="stylesheet" href="fonts/style.css">

    <script src="Scripts/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="Scripts/bitacora.js"></script>
    <title>Bitacora</title>
</head>

<body>
    <div>
        <div class="loading2"></div>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="inicio.php">Inicio<span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link active" href="registro_libro.php">Registro Libro</a>
                        <a class="nav-item nav-link active" href="inventario.php">Inventario</a>
                    </div>
                </div>
            </nav>
        </header>
    </div>

    <section>
        <div class="background">
            <br>
            <div class="busqueda">
                <label for="fecha">Limpiar por fecha</label>
                <input type="date" name="fecha" id="fecha" class="">
                <button type="button" class="btn btn-primary" id="limpiar" value="limpiar">Limpiar</button>
            </div>
            <div class="contenedor">
                <div class="table-responsive">
                    <table class="table table-bordered table">
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>Rol</td>
                                <td>Id_usuario</td>
                                <td>Accion</td>
                                <td>Fecha_Creacion</td>
                                <td>Detalle</td>
                            </tr>
                        </thead>
                        <tbody id="tBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>

</html>