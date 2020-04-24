<?php
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
?>