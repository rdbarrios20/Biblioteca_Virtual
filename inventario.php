<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Estilos/dataTables.min.css">
    <link rel="stylesheet" href="Estilos/styles.css">
    <script src="js/busqueda.js"></script>
    <title>Inventario</title>

</head>

<body>
    <div class="container">
        <br>
        <header>
            <nav class="navbar navbar-default">
                <div class="navbar-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapse" data-toggle="collapse" data-target="#navbar-1">
                            <span class="sr-only">Menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <label for="" class="navbar-brand">Biblioteca</label>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-1">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Inicio</a></li>
                            <li><a href="registro_libro.php">Registrar Libro</a></li>
                            <li><a href="inventario.php">Consultar Inventario</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </div>
    <section>
        <div class="container">
            <div class="background">
                <label for="criterio_busqueda">Buscar</label>
                <input type="text" name="criterio_busqueda" id="criterio_busqueda"></input>
                <div id="contenedor">
                        <table class='table table-hover table-condensed table-bordered'>
                            <thead>
                                <tr>
                                    <td>Código Libro</td>
                                    <td>Autor</td>
                                    <td>Nombre Libro</td>
                                    <td>Fecha Expedición</td>
                                    <td>Disponibilidad</td>
                                    <td>Precio Publico</td>
                                    <td>Precio Interno</td>
                                    <td>Reservado</td>
                                    <td>Cantidad</td>
                                    <td>Eliminar</td>
                                    <td>Editar</td>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                            </tbody>
                        </table>
                </div>
                <div>
                    <form action="" id="form">

                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer></footer>
</body>

</html>