<?php
    include("bitacora.php");
    require_once("databaseConnection.php");

    $connection = OpenCon();
    $criterio = $_POST['texto'];

    if(isset($criterio) && !empty($criterio)){
        $query = $connection->prepare("SELECT * FROM libros WHERE CODIGO_LIBRO 
        LIKE '%$criterio%' OR NOMBRE_LIBRO LIKE '%$criterio%'");
        $query->execute();
        
        session_start();
        $rol=$_SESSION['usuario']['tipo_usuario'];
        $id_usuario=$_SESSION['usuario']['id_usuario'];
        $accion="Consulta";
        $detalle="Consulta libro";
        insert_bitacora($rol,$id_usuario,$accion,$detalle);

    }else{
        $query = $connection->prepare("SELECT * FROM libros WHERE CODIGO_LIBRO ORDER BY CODIGO_LIBRO DESC");
        $query->execute();
    }

    $success = false;
    $array = [];
    $result = $query->get_result();
    if(isset($result->num_rows) && $result->num_rows > 0){
        while($item = $result->fetch_assoc()){
            array_push($array,$item);
        }
        $success = true;
    }

    CloseCon($connection);

    $response = array('success' => $success, 'result' => $array);
    header('content-type: application/json');
    echo json_encode($response);

?>