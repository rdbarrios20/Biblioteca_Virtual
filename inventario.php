<?php
session_start();

if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario']['tipo_usuario'] != "Administrador") {
        header('location: index.php');
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
    <link rel="stylesheet" href="fonts/style.css">

    <script src="Scripts/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="Scripts/busqueda.js"></script>
    <script src="popper/popper.min.js"></script>
    <title>Inventario</title>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#codigo").keyup(function() {
                this.value = (this.value + '').replace(/[^0-9]/g, '');
            });
            $("#autor").keyup(function() {
                this.value = (this.value + '').replace(/[^ a-záéíóúüñ]+/ig, '');
            });
            $("#nombre_libro").keyup(function() {
                this.value = (this.value + '').replace(/[^ a-záéíóúüñ]+/ig, '');
            });
            $("#precio_publico").keyup(function() {
                this.value = (this.value + '').replace(/[^0-9]/g, '');
            });
            $("#precio_interno").keyup(function() {
                this.value = (this.value + '').replace(/[^0-9]/g, '');
            });

            $('#modificar').click(function() {
                //validamos los campos que no esten vacios usamos length para verificar si hay algun caracter escrito en nuestro campo de texto si es menor a 1 entonces 
                //es falso y por lo tanto el campo es vacio
                if ($("#codigo").val().length < 1) {
                    alert("El campo codigo no puede ser vacio")
                    return false;
                } else if ($("#autor").val().length < 1) {
                    alert("El campo Autor no puede ser vacio")
                    return false;
                } else if ($("#nombre_libro").val().length < 1) {
                    alert("El campo Nombre del libro no puede ser vacio")
                    return false;
                } else if ($("#precio_publico").val().length < 1) {
                    alert("El campo Precio publico no puede ser vacio")
                    return false;
                } else if ($("#precio_interno").val().length < 1) {
                    alert("El campo Precio interno  no puede ser vacio")
                    return false;
                }
                var opcion = confirm('Realmente desea modificar el registro');
                if (parseInt($('#precio_publico').val()) <= parseInt($('#precio_interno').val())) {
                    alert('El precio publico no puede ser menor al precio interno verifique los datos');
                } else if (parseInt($('#precio_publico').val()) > 1000000) { //Validamos que no se exceda el precio en ambos valores publico e interno
                    alert("Esta excediendo el precio que es de 1.000.000");
                } else if ((parseInt($('#precio_interno').val()) > 1000000)) {
                    alert("Esta excediendo el precio que es de 1.000.000");
                } else if (opcion == true) {

                    let cViejo = $('#codigo_old').val();
                    let cNuevo = $('#codigo').val();

                    $.ajax({
                        url: 'php/modificar.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            codigo_viejo: cViejo,
                            codigo: cNuevo,
                            autor: $('#autor').val(),
                            nombre_libro: $('#nombre_libro').val(),
                            fecha_expedicion: $('#fecha_expedicion').val(),
                            disponibilidad: $('#disponibilidad').val(),
                            precio_publico: $('#precio_publico').val(),
                            precio_interno: $('#precio_interno').val(),
                            reservado: $('#reservado').val(),
                            cantidad: $('#cantidad').val(),
                        },
                        //Traemos la respuesta de retorno en caso de que los datos se modifiquen correctamente en formato json
                        success: function(response) {
                            if (response.success == true) {
                                alert(response.message);
                                //Actualizar html de la fila con los nuevos registros
                                var htmlTRow = "<td>" + cNuevo + "</td>" +
                                    "<td>" + $('#autor').val() + "</td>" +
                                    "<td>" + $('#nombre_libro').val() + "</td>" +
                                    "<td>" + $('#fecha_expedicion').val() + "</td>" +
                                    "<td>" + $('#disponibilidad').val() + "</td>" +
                                    "<td>" + $('#precio_publico').val() + "</td>" +
                                    "<td>" + $('#precio_interno').val() + "</td>" +
                                    "<td>" + $('#reservado').val() + "</td>" +
                                    "<td>" + $('#cantidad').val() + "</td>" +
                                    "<td> <button id='btn_eliminar' class='btn btn-danger clsEliminar' data-codigo='" + cNuevo + "'><span class='icon-trash'></span></button></td>" +
                                    "<td> <button id='btn_modificar' class='btn btn-warning clsModificar' data-codigo='" + cNuevo + "' data-toggle='modal' data-target='#myModal'><span class='icon-pencil'></span></button></td>" +
                                    "</tr>";

                                //Limpiar el registro
                                $('#idLibroTr_' + cViejo).html('');
                                //Agregar al html del registro
                                $('#idLibroTr_' + cViejo).append(htmlTRow)

                                // Reemplazo del id con codigo viejo por codigo nuevo en el atributo id 
                                let nuevo_id = 'idLibroTr_' + cNuevo;
                                $('#idLibroTr_' + cViejo).attr('id', nuevo_id);
                                //ACtulizar los valores que tenieamos en nuestro modal, tanto el visible como el oculto, tanto el vis
                                $('#codigo').attr('value', cNuevo);
                                $('#codigo_old').attr('value', cNuevo);
                                $('#myInput').trigger('focus')
                                //alert(response.message);
                            }
                        },
                        error: function(response) {
                            debugger;
                            alert("Verifique el codigo del libro e intente de nuevo");
                        }
                    });

                } else {
                    return false;
                }
            })
        });
    </script>
</head>

<body>
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
                    </div>
                </div>
            </nav>
        </header>
        <br>
    </div>
    <section>
        <div>
            <div class="background">
                <br>
                <div class="busqueda">
                    <label for="criterio_busqueda">Buscar</label>
                    <input type="text" name="criterio_busqueda" class="fs fas-search" id="criterio_busqueda"></input>
                </div>
                <div class="contenedor">
                    <div class="table_responsive">
                        <table class="table table-bordered table">
                            <thead>
                                <tr>
                                    <td scope="col">Código Libro</td>
                                    <td scope="col">Autor</td>
                                    <td scope="col">Nombre Libro</td>
                                    <td scope="col">Fecha Expedición</td>
                                    <td scope="col">Disponibilidad</td>
                                    <td scope="col">Precio Publico</td>
                                    <td scope="col">Precio Interno</td>
                                    <td scope="col">Reservado</td>
                                    <td scope="col">Cantidad</td>
                                    <td scope="col">Eliminar</td>
                                    <td scope="col">Editar</td>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal modificar registro libro-->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-registro">
                                <h4 id="myModalLabel">Modificar el libro seleccionado</h4>
                            </div>
                            <div class="modal-body" class="form-control input-sm">
                                <label for="">Codígo Libro</label>
                                <input type="text" name="" id="codigo" class="form-control input-sm">
                                <input type="hidden" name="" id="codigo_old">
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
                                <button type="submit" id="modificar" class="btn btn-success" data-dismiss="modal">Modificar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal para los mensajes success -->
                <div class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Modal body text goes here.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
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