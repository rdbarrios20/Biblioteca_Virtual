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
    <link rel="stylesheet" href="Estilos/loader.css">

    <script src="Scripts/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="Scripts/busqueda.js"></script>
    <script src="popper/popper.min.js"></script>

    <script type="text/javascript">
        //validamos los campos que solo deban contener numeros usamos keyup para cuando se presiona una tecla se valide tanto para solo numeros o solo letras
        $(document).ready(function() {
            $('.loading2').fadeOut(1000).html();
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

            //Creamos nuestro script que nos va a guardar la informacion de nuestros campos en la BD
            $("#formulario").on('submit', function(event) {
                debugger;
                if (parseInt($('#precio_publico').val()) <= parseInt($('#precio_interno').val())) {
                    MENSAJE = "El precio publico no puede ser menor al precio interno verifique los datos";
                    $("#cost").html(MENSAJE);
                    $("#cost_message").modal('show');
                } else if (parseInt($('#precio_publico').val()) > 1000000) { //Validamos que no se exceda el precio en ambos valores publico e interno
                    alert("Esta excediendo el precio que es de 1.000.000");
                } else if ((parseInt($('#precio_interno').val()) > 1000000)) {
                    alert("Esta excediendo el precio que es de 1.000.000");
                } else {
                    //Enviamos los datos a la basde de Datos
                    $.ajax({
                        url: 'php/insertar.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            codigo: $('#codigo').val(),
                            autor: $('#autor').val(),
                            nombre_libro: $('#nombre_libro').val(),
                            fecha_expedicion: $('#fecha_expedicion').val(),
                            disponibilidad: $('#disponibilidad').val(),
                            precio_publico: $('#precio_publico').val(),
                            precio_interno: $('#precio_interno').val(),
                            reservado: $('#reservado').val(),
                            cantidad: $('#cantidad').val(),
                        },
                        //Traemos la respuesta de retorno en caso de que los datos se guarden correctamente en formato json
                        success: function(response) {
                            if (response.success == true) {
                                MENSAJE = response.message;
                                $("#message").html(MENSAJE);
                                $("#success_message").modal('show');
                                //Invocar funcion limpiar
                                limpiar();
                            }
                        },
                        error: function(response) {
                            debugger;
                            alert("Verifique el codigo del libro e intente de nuevo");
                        }
                    });
                }
                // return false;
                event.preventDefault();


                function limpiar() {

                    $('#codigo').val('');
                    $('#autor').val('');
                    $('#nombre_libro').val('');
                    $('#fecha_expedicion').val('');
                    $('#disponibilidad').prop('selectedIndex', 0);
                    $('#precio_publico').val('');
                    $('#precio_interno').val('');
                    $('#reservado').val('');
                    $('#cantidad').val('');
                }

            });
        });
    </script>
</head>

<body>
    <div class="container">
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
        <div class="container">
            <!-- <form onsubmit="enviar(this);" class="background" id="formulario"> -->
            <form class="background" id="formulario">
                <div class="form-group error">
                    <label for="">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control" required>
                </div>
                <div class="form-group error">
                    <label for="">Autor</label>
                    <input type="text" name="autor" id="autor" class="form-control" required>
                </div>
                <div class="form-group error">
                    <label for="">Nombre del libro</label>
                    <input type="text" name="nombre_libro" id="nombre_libro" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Fecha de Expedición</label>
                    <input type="date" name="fecha_expedicion" id="fecha_expedicion">
                </div>
                <div class="form-group">
                    <label for="">Disponibilidad</label>
                    <select name="disponibilidad" id="disponibilidad">
                        <option value="En existencia">En existencia</option>
                        <option value="Agotado">Agotado</option>
                    </select>
                </div>
                <div class="form-group error">
                    <label for="">Precio Publico</label>
                    <input type="text" name="precio_publico" id="precio_publico" class="form-control" placeholder="$" required>
                </div>
                <div class="form-group error">
                    <label for="">Precio Interno</label>
                    <input type="text" name="precio_interno" id="precio_interno" class="form-control" placeholder="$" required>
                </div>
                <div class="form-group">
                    <label for="">Reservado</label>
                    <input type="checkbox" name="reservado" id="reservado" value="1">
                </div>
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="text" name="cantidad" id="cantidad" class="form-control" required>
                </div>
                <br>
                <div class="form-group cold-md3">
                    <input type="submit" id="btenviar" class="btn btn-lg btn-success" value="Guardar">
                </div>
            </form>
        </div>

        <!--Modal para el mensaje de datos guardados satisfactoriamente -->
        <div>
            <div class="modal" tabindex="-1" role="dialog" id="success_message">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Mensaje Datos Guardados</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p id="message"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para el validar los precios-->
        <div class="modal" tabindex="-1" role="dialog" id="Cost_message">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Validacion Precios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="Cost"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer></footer>
</body>

</html>