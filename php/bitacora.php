<?php
    //funcion para insertar datos a la tabla bitac4ora.
    require("databaseConnection.php");

    //include 'databaseConnection.php';
    
    function insert_bitacora($id_usuario,$rol,$accion,$detalle){
        
        $_connection = abrirCon();
        date_default_timezone_set('America/Bogota');
        $fecha_creacion=date('y-m-d H:i:s');
        $query=$_connection->prepare("INSERT INTO bitacora (rol,id_usuario,accion,fecha,detalle) VALUES
        ('".$rol."','".$id_usuario."','".$accion."','".$fecha_creacion."','".$detalle."')");
        
        $query->execute();
      
        cerrarCon($_connection);
    }
    
 
    //Funcion para leer los datos ubicados en la tabla bitacora.
    function read_bitacora(){
        require_once('php\databaseConnection.php');
        $connection->set_charset('utf8');
    
        $query=$connection->prepare("SELECT * FROM bitacora ORDER BY id");
        $query->execute();
        
        $array=[];
        $success=false;
        $result=$query->get_result();
        if(isset($result->num_rows)&& $result->num_rows>0){
            while($item=$result->fetch_assoc()){
                array_push($array,$item);
            }
            $success=true;
        }
        
       echo json_encode(array('success'=>true,'$response'=>$array));
    
        $connection->close();
    } 
    
?>