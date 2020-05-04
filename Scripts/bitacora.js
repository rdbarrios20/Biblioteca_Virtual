$(document).ready(function () {
    listar();

    function listar() {
        $.ajax({
            url: "php/bitacora.php",
            type: "POST",
            datatype: "json",
            data: {
                funcion: "listar"
            },


            success: function (response) {
                response = JSON.parse(response);
                if (response.success == true) {
                    construirTable(response.result);
                }
            },
            error: function () {

            }
        });
    }

    function construirTable(_arraylist) {
        $('#tBody').html('');

        for (let index = 0; index < _arraylist.length; index++) {
            const item = _arraylist[index];
            //Definimos una variable de tipo local let para guardar el dato que requerimos
            let codigo = item['id'];
            //camelCaseOtroTexto
            var htmlTRow = "<tr id='idBitacoraTr_" + codigo + "' > "
                + "<td class='clsId'>" + item['id'] + "</td>"
                + "<td class='clsRol'>" + item['rol'] + "</td>"
                + "<td class='clsId_usuario'>" + item['id_usuario'] + "</td>"
                + "<td class='clsAccion'>" + item['accion'] + "</td>"
                + "<td class='clsFecha'>" + item['fecha'] + "</td>"
                + "<td class='clsDetalle'>" + item['detalle'] + "</td>"

            $('#tBody').append(htmlTRow);
        }

    }

    //Funcion para eliminar la bitacora
    $('#limpiar').on('click', function () {
        limpiar();
    });
    
    function limpiar(_fecha) {
        $.ajax({
            url: "php/bitacora.php",
            type: "post",
            datatype: "json",
            data: {
                funcion: 'eliminar',
                _fecha: $('#fecha').val()
            },

            success: function (response) {
                console.log("Datos eliminados correctamente");
                debugger;
                alert(response);
            },
            erorr: function (response) {
                console.log("No se pudo eliminar");
                alert(response);
            }

        });
    }
});