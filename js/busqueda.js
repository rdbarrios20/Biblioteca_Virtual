
$(document).ready(function(){

    //carga inicial de la funcion busqueda para utilizarla despues
    busqueda(null);
 
  
    function busqueda( _criterio){
        
        $.ajax({
            url:'php/busqueda.php',
            type:'POST',
            datatype:'json',
            data:{
                texto: _criterio
            },
            success:function(response){
                
                if(response.success==true){
                    construirTable(response.result);
                    registrarEventos();
                }else{
                    $('#tableBody').html('No se encontraron coincidencias');
                }
            },
            error:function(response){
                
                alert(JSON.stringify(response));
            }
        });
    }

    //construimos la tabla por medio de un array concatenado
    function construirTable(_arraylist){
        $('#tableBody').html('');
        
        for (let index = 0; index < _arraylist.length; index++) {
            const item = _arraylist[index];
            let codigo = item['CODIGO_LIBRO'];
            var htmlTRow =  "<tr> "
            +"<td>" + item['CODIGO_LIBRO'] + "</td>"
            +"<td>" + item['AUTOR'] + "</td>"
            +"<td>" + item['NOMBRE_LIBRO'] + "</td>"
            +"<td>" + item['FECHA_EXPEDICION'] + "</td>"
            +"<td>" + item['DISPONIBILIDAD'] + "</td>"
            +"<td>" + '$' + item['PRECIO_PUBLICO'] + "</td>"
            +"<td>" + '$ ' + item['PRECIO_INTERNO'] + "</td>"
            +"<td>" + item['RESERVADO'] + "</td>"
            +"<td>" + item['CANTIDAD'] + "</td>"
            +"<td> <button id='btn_eliminar' class='btn btn-danger clsEliminar' data-codigo='" +codigo+ "' ><i class='glyphicon glyphicon-trash'></i></button></td>"
            +"<td> <button id='btn_modificar' class='btn btn-success clsmodificar' data-codigo='" +codigo+ "'><i class='glyphicon glyphicon-pencil'></i></button></td>"

            //Agregar al html de la tabla
            $('#tableBody').append(htmlTRow)
        }
        
    }
    
    
    function eliminar(ide){
        debugger;
        var opcion = confirm('Realmente desea eliminar el registro');
        if (opcion == true) {
            $.ajax({
                url:'php/eliminar.php',
                type:'POST',
                data:{
                    ide_libro: ide,
                },
                success:function(response){
                    alert(response);
                    location.reload();
                },
                error:function(response){

                }
            });  

        } 
        else {
            return false;
        }
    }
    function modificar(ide){
        debugger;
        var opcion = confirm('Realmente desea modificar el registro');
        if (opcion == true) {
            $.ajax({
                url:'',
                type:'POST',
                data:{
                    ide_libro: ide,
                },
                success:function(response){
                    alert(response);
                    location.reload();
                },
                error:function(response){

                }
            });  

        } 
        else {
            return false;
        }
    }

    function registrarEventos(){
        $('.clsEliminar').on('click',function(){
            let codigo = $(this).attr('data-codigo');
            eliminar(codigo);
        });
    }

    /*Realizamos el filtro de la bsuqueda por el input criterio busqueda*/
    $('#criterio_busqueda').on('keyup',function(){
        var valor_busqueda= $(this).val();
        busqueda(valor_busqueda);
    });
    
  
  
}); //Fin del doc ready

