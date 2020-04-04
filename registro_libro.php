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

    <script type="text/javascript">
        //validamos los campos que no esten vacios usamos length para verificar si hay algun caracter escrito en nuestro campo de texto si es menor a 1 entonces 
        //es falso y por lo tanto el campo es vacio
        /* $(document).ready(function() {
             $('#btenviar').click(function() {
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
             });
         });*/

        //validamos los campos que solo deban contener numeros usamos keyup para cuando se presiona una tecla se valide tanto para solo numeros o solo letras
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

            //Creamos nuestro script que nos va a guardar la informacion de nuestros campos en la BD
            $("#formulario").on('submit', function(event) {
                debugger;
                if (parseInt($('#precio_publico').val()) <= parseInt($('#precio_interno').val())) {
                    alert('El precio publico no puede ser menor al precio interno verifique los datos');
                } else {
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
                                alert(response.message);
                                //Invocar funcion limpiar
                                limpiar();
                            }
                        },
                        error: function(response) {
                            debugger;
                            alert(response);
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
    </div>
    <section>
        <div class="container">
            <!-- <form onsubmit="enviar(this);" class="background" id="formulario"> -->
            <form class="background" id="formulario">
                <div class="form-group error">
                    <label for="">Código</label>
                    <input type="text" name="codigo" id="codigo" class="form-control">
                </div>
                <div class="form-group error">
                    <label for="">Autor</label>
                    <input type="text" name="autor" id="autor" class="form-control">
                </div>
                <div class="form-group error">
                    <label for="">Nombre del libro</label>
                    <input type="text" name="nombre_libro" id="nombre_libro" class="form-control">
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
                    <input type="text" name="precio_publico" id="precio_publico" class="form-control" placeholder="$">
                </div>
                <div class="form-group error">
                    <label for="">Precio Interno</label>
                    <input type="text" name="precio_interno" id="precio_interno" class="form-control"  placeholder="$">
                </div>
                <div class="form-group">
                    <label for="">Reservado</label>
                    <input type="checkbox" name="reservado" id="reservado">
                </div>
                <div class="form-group">
                    <label for="">Cantidad</label>
                    <input type="text" name="cantidad" id="cantidad" class="form-control">
                </div>
                <br>
                <div class="form-group cold-md3">
                    <input type="submit" id="btenviar" class="btn btn-lg btn-success" value="Guardar">
                </div>
            </form>
        </div>
    </section>
    <footer></footer>
</body>

</html>