// $(busqueda());
// debugger;


$(document).ready(function(){

    //carga inicial de la funcion busqueda
    busqueda(null);

    function busqueda( _criterio){
        debugger;
        $.ajax({
            url:'php/busqueda.php',
            type:'POST',
            datatype:'json',
            data:{
                texto: _criterio
            },
            success:function(response){
                debugger;
                if(response.success==true){
                    $('#contenedor').html(response.result);
                }
            },
            error:function(response){
                debugger;
                alert(JSON.stringify(response));
            }
        });
    }



    $(document).on('keyup','#criterio_busqueda',function(){
        // var valor_busqueda=$(this).val();
        // if(valor_busqueda=!""){
        //     busqueda(valor_busqueda);
        // }
        // else{
        //     busqueda();
        // }
        debugger;
        var valor_busqueda= $(this).val();
        busqueda(valor_busqueda);
    })


});
