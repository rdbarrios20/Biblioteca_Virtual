<?php
    function insert_bitacora(){
        require_once('../php/databaseConnection.php');
        $connection->set_charset('utf8');
      
        date_default_timezone_set('America/Bogota');
        $rol="Administrador";
        $id_user="1";
        $accion="modificacion";
        $fecha=date('y-m-d H:i:s'); 
        $detalle="Se modifico el registro 2089 las aventuras de felipe";
      
        $query=$connection->prepare("INSERT INTO bitacora (rol,id_usuario,accion,fecha,detalle) VALUES
        ('".$rol."','".$id_user."','".$accion."','".$fecha."','".$detalle."')");
        
        $query->execute();
      
        $connection->close();
    }
    
    function read_bitacora(){
        require_once('../php/databaseConnection.php');
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