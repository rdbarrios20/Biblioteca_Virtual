$(document).ready(function(){
    function busqueda_fecha(_fecha){
        $.ajax({
            url:'php/bitacora.php',
            type:'POST',
            datatype:'json',
            data:{fecha:_fecha},
            success: function(){

            },
            error: function(){
                
            }
        });
    }
});