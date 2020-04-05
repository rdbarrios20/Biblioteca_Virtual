
$(document).ready(function () {

    //carga inicial de la funcion busqueda para utilizarla despues
    busqueda(null);


    function busqueda(_criterio) {

        $.ajax({
            url: 'php/busqueda.php',
            type: 'POST',
            datatype: 'json',
            data: {
                texto: _criterio
            },
            success: function (response) {

                if (response.success == true) {
                    construirTable(response.result);
                    eliminarRegistro();
                    modificarRegistro();
                } else {
                    $('#tableBody').html('No se encontraron coincidencias');
                }
            },
            error: function (response) {

                alert(JSON.stringify(response));
            }
        });
    }

    //construimos la tabla por medio de un array concatenado
    function construirTable(_arraylist) {
        $('#tableBody').html('');

        for (let index = 0; index < _arraylist.length; index++) {
            const item = _arraylist[index];
            //Definimos una variable de tipo local let para guardar el dato que requerimos
            let codigo = item['CODIGO_LIBRO'];
            let autor = item['AUTOR'];
            let nombre_libro = item['NOMBRE_LIBRO'];
            let fecha_expedicion = item['FECHA_EXPEDICION'];
            let disponibilidad = item['DISPONIBILIDAD'];
            let precio_publico = item['PRECIO_PUBLICO'];
            let precio_interno = item['PRECIO_INTERNO'];
            let reservado = item['RESERVADO'];
            let cantidad = item['CANTIDAD'];

            var htmlTRow = "<tr> "
                + "<td>" + item['CODIGO_LIBRO'] + "</td>"
                + "<td>" + item['AUTOR'] + "</td>"
                + "<td>" + item['NOMBRE_LIBRO'] + "</td>"
                + "<td>" + item['FECHA_EXPEDICION'] + "</td>"
                + "<td>" + item['DISPONIBILIDAD'] + "</td>"
                + "<td>" + '$' + item['PRECIO_PUBLICO'] + "</td>"
                + "<td>" + '$ ' + item['PRECIO_INTERNO'] + "</td>"
                + "<td>" + item['RESERVADO'] + "</td>"
                + "<td>" + item['CANTIDAD'] + "</td>"
                + "<td> <button id='btn_eliminar' class='btn btn-danger clsEliminar' data-codigo='" + codigo + "'>Borrar</button></td>"
                + "<td> <button id='btn_modificar' class='btn btn-success clsmodificar' data-codigo='" + codigo + "," + autor + "," + nombre_libro + "," + fecha_expedicion + "," + disponibilidad + "," + precio_publico + "," +precio_interno+ "," +reservado+ "," +cantidad+ "' data-toggle='modal' data-target='#myModal'>Editar</button></td>"

            //Agregar al html de la tabla
            $('#tableBody').append(htmlTRow)
        }

    }


    function eliminar(ide) {
        debugger;
        var opcion = confirm('Realmente desea eliminar el registro');
        if (opcion == true) {
            $.ajax({
                url: 'php/eliminar.php',
                type: 'POST',
                data: {
                    ide_libro: ide,
                },
                success: function (response) {
                    alert(response);
                    location.reload();
                },
                error: function (response) {

                }
            });

        }
        else {
            return false;
        }
    }
    function modificar(ide) {
        debugger;
        var opcion = confirm('Realmente desea modificar el registro');
        if (opcion == true) {
            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    ide_libro: ide,
                },
                success: function (response) {
                    alert(response);
                    location.reload();
                },
                error: function (response) {

                }
            });

        }
        else {
            return false;
        }
    }

    function eliminarRegistro() {
        $('.clsEliminar').on('click', function () {
            let codigo = $(this).attr('data-codigo');
            eliminar(codigo);
        });
    }
    function modificarRegistro() {
        $('.clsmodificar').on('click', function () {
            let codigo = $(this).attr('data-codigo');
            agregardatosform(codigo);
        });
    }
    //Realizamos el filtro de la bsuqueda por el input criterio busqueda
    $('#criterio_busqueda').on('keyup', function () {
        var valor_busqueda = $(this).val();
        busqueda(valor_busqueda);
    });

    //Agregamos los datos al formulario modal para modificarlos despues 
    function agregardatosform(_arraylist) {
        debugger;
        dato = _arraylist.split(',');
        $('#codigo').val(dato[0]);
        $('#autor').val(dato[1]);
        $('#nombre_libro').val(dato[2]);
        $('#fecha_expedicion').val(dato[3]);
        $('#disponibilidad').val(dato[4]);
        $('#precio_publico').val(dato[5]);
        $('#precio_interno').val(dato[6]);
        $('#reservado').val(dato[7]);
        $('#cantidad').val(dato[8]);
    }

}); //Fin del doc ready

