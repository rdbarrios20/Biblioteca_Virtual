<?php
session_start();

if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario']['tipo_usuario'] != "") {
    }
} else {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Estilos/styles.css">
    <link rel="stylesheet" href="Estilos/loader.css">

    <script src="Scripts/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="Scripts/busqueda.js"></script>
    <script src="popper/popper.min.js"></script>
    <title>Inicio</title>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.loading2').fadeOut(2000).html();
        });
    </script>
</head>

<body>
    <div class="loading2"></div>
    <div>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Biblioteca</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="inicio.php">Inicio<span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link active" href="registro_libro.php">Registro Libro</a>
                        <a class="nav-item nav-link active" href="inventario.php">Inventario</a>
                        <a class="nav-item nav-link active" href="salir.php">Salir</a>
                    </div>
                </div>
            </nav>
        </header>
    </div>
    <section>
        <br>
        <div class="container">
            <h1 class="bg-dark">Biblioteca Virtual</h1>
            <img src="Images/libros.jpg" alt="">
        </div>
        <div class="container">
            <h4 class="bg-dark"> Bienvenido: <?php echo $_SESSION['usuario']['nombre_apellido'] ?></h4>
        </div>
    </section>
    <footer></footer>
</body>

</html>