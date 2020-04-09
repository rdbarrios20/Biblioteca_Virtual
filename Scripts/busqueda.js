
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

            var htmlTRow = "<tr id='idLibroTr_" + codigo+ "' > "
                + "<td class='clsCodigo'>" + item['CODIGO_LIBRO'] + "</td>"
                + "<td class='clsAutor'>" + item['AUTOR'] + "</td>"
                + "<td class='clsNombreL'>" + item['NOMBRE_LIBRO'] + "</td>"
                + "<td class='clsFechaEp'>" + item['FECHA_EXPEDICION'] + "</td>"
                + "<td class='clsDisp'>" + item['DISPONIBILIDAD'] + "</td>"
                + "<td class='clsPrecioP'>" + '$' + item['PRECIO_PUBLICO'] + "</td>"
                + "<td class='clsPrecioI'>" + '$ ' + item['PRECIO_INTERNO'] + "</td>"
                + "<td class='clsReservado'>" + item['RESERVADO'] + "</td>"
                + "<td class='clsCantidad'>" + item['CANTIDAD'] + "</td>"
                + "<td> <button id='btn_eliminar' class='btn btn-danger clsEliminar' data-codigo='" + codigo + "'>Borrar</button></td>"
                + "<td> <button id='btn_modificar' class='btn btn-warning clsmodificar' data-codigo='" + codigo + "' data-toggle='modal' data-target='#myModal'>Editar</button></td>"

            //Agregar al html de la tabla
            $('#tableBody').append(htmlTRow)
        }

    }

    function eliminar(codigo) {
        debugger;
        var opcion = confirm('Realmente desea eliminar el registro');
        if (opcion == true) {
            $.ajax({
                url: 'php/eliminar.php',
                type: 'POST',
                data: {
                    ide_libro: codigo,
                },
                success: function (response) {
                    // location.reload();
                    $('#idLibroTr_'+ codigo).remove();
                    alert(response);
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
    function agregardatosform(codigo_viejo) {
        debugger;
        
        let autor = $('#idLibroTr_'+ codigo_viejo + ' > .clsAutor').text();    
        let nombre = $('#idLibroTr_'+ codigo_viejo + ' > .clsNombreL').text();    
        let fecha_expedicion = $('#idLibroTr_'+ codigo_viejo + ' > .clsFechaEp').text();    
        let disponibilidad = $('#idLibroTr_'+ codigo_viejo + ' > .clsDisp').text();    
        let precio_publico = $('#idLibroTr_'+ codigo_viejo + ' > .clsPrecioP').text();    
        let precio_interno = $('#idLibroTr_'+ codigo_viejo + ' > .clsPrecioI').text();    
        let reservado = $('#idLibroTr_'+ codigo_viejo + ' > .clsReservado').text();    
        let cantidad = $('#idLibroTr_'+ codigo_viejo + ' > .clsCantidad').text();    

        $('#codigo').val(codigo_viejo);
        $('#codigo_old').val(codigo_viejo);

        $('#autor').val(autor);
        $('#nombre_libro').val(nombre);
        $('#fecha_expedicion').val(fecha_expedicion);
        $('#disponibilidad').val(disponibilidad);
        $('#precio_publico').val(precio_publico);
        $('#precio_interno').val(precio_interno);
        $('#reservado').val(reservado);
        $('#cantidad').val(cantidad);
    }

}); //Fin del doc ready

