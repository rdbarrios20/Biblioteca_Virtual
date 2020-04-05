<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Estilos/styles.css">

    <script src="Scripts/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="Scripts/busqueda.js"></script>
    <script src="popper/popper.min.js"></script>
    <title>Inventario</title>

</head>

<body>
    <div class="container">
        <br>
        <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="index.php">Inicio<span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link active" href="registro_libro.php">Registro Libro</a>
                        <a class="nav-item nav-link active" href="inventario.php">Inventario</a>
                    </div>
                </div>
            </nav>
        </header>
        <br>
        <br>
    </div>
    <section>
        <div class="container-fluid">
            <div class="background">
                <br>
                <label for="criterio_busqueda">Buscar</label>
                <input type="text" name="criterio_busqueda" id="criterio_busqueda"></input>
                <div class="contenedor">
                    <table class="table table-bordered">
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

                <!-- Modal modificar registro libro-->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Modificar el libro seleccionado</h4>
                            </div>
                            <div class="modal-body" class="form-control input-sm">
                                <label for="">Codígo Libro</label>
                                <input type="text" name="" id="codigo" class="form-control input-sm">
                                <label for="">Autor</label>
                                <input type="text" name="" id="autor" class="form-control input-sm">
                                <label for="">Nombre Libro</label>
                                <input type="text" name="" id="nombre_libro" class="form-control input-sm">
                                <label for="">Fecha Expedición</label>
                                <input type="text" name="" id="fecha_expedicion" class="form-control input-sm">
                                <label for="">Disponibilidad</label>
                                <input type="text" name="" id="disponibilidad" class="form-control input-sm">
                                <label for="">Precio Publico</label>
                                <input type="text" name="" id="precio_publico" class="form-control input-sm">
                                <label for="">Precio Interno</label>
                                <input type="text" name="" id="precio_interno" class="form-control input-sm">
                                <label for="">Reservado</label>
                                <input type="text" name="" id="reservado" class="form-control input-sm">
                                <label for="">Cantidad</label>
                                <input type="text" name="" id="cantidad" class="form-control input-sm">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Modificar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <footer></footer>
</body>

</html>