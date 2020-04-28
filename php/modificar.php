<?php
    include("bitacora.php");
    require_once("databaseConnection.php");
    
    $connection = OpenCon();
    if (isset($_POST['codigo']) && ($_POST['nombre_libro'] != "")) {
        $codigo_old = $_POST['codigo_viejo'];
        $codigo_new = $_POST['codigo'];
        $autor = $_POST['autor'];
        $nombre_libro = $_POST['nombre_libro'];
        $fecha_expedicion = $_POST['fecha_expedicion'];
        $disponibilidad = $_POST['disponibilidad'];
        $precio_publico = $_POST['precio_publico'];
        $precio_interno = $_POST['precio_interno'];
        $reservado = $_POST['reservado'];
        $cantidad = $_POST['cantidad'];
    
        $query = $connection->prepare("UPDATE libros SET  CODIGO_LIBRO=?, AUTOR=?,
        NOMBRE_LIBRO=?,FECHA_EXPEDICION=?,DISPONIBILIDAD=?,PRECIO_PUBLICO=?,
        PRECIO_INTERNO=?,RESERVADO=?,CANTIDAD=? WHERE CODIGO_LIBRO=?");
        $query->bind_param("issssiisii",$codigo_new,$autor,$nombre_libro,$fecha_expedicion,$disponibilidad,$precio_publico,$precio_interno,$reservado,$cantidad,$codigo_old);
        $query->execute();
    
        session_start();
        $rol = $_SESSION['usuario']['tipo_usuario'];
        $id_usuario = $_SESSION['usuario']['id_usuario'];
        $accion = "Modificación";
        $detalle = "Modificación libro código:$codigo_new";
        insert_bitacora($rol, $id_usuario, $accion, $detalle);
    
        if ($query == false) {
            die('No se puedo ejecutar la consulta');
        }
    
        $msg = "Datos modificados exitosamente";
        $response = array('success' => true, 'message' => $msg);
        header('content-type: application/json'); // This line makes no difference.
        echo  json_encode($response);
    }

    CloseCon($connection);
?>
