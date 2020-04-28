
<?php
    include("bitacora.php");
    require_once("databaseConnection.php");
    $connection = OpenCon();

    if (isset($_POST['codigo']) && ($_POST['nombre_libro'] != "")) {
        $codigo = $_POST['codigo'];
        $autor = $_POST['autor'];
        $nombre_libro = $_POST['nombre_libro'];
        $fecha_expedicion = $_POST['fecha_expedicion'];
        $disponibilidad = $_POST['disponibilidad'];
        $precio_publico = $_POST['precio_publico'];
        $precio_interno = $_POST['precio_interno'];
        $reservado = $_POST['reservado'];
        $cantidad = $_POST['cantidad'];
    
        $query = $connection->prepare("INSERT INTO libros (codigo_libro,autor,nombre_libro,fecha_expedicion,disponibilidad,precio_publico,precio_interno,reservado,cantidad)
         VALUES (?,?,?,?,?,?,?,?,?)");
        $query->bind_param("issssiisi",$codigo,$autor,$nombre_libro,$fecha_expedicion,$disponibilidad,$precio_publico,$precio_interno,$disponibilidad,$cantidad);
        $query->execute();

        if ($query == false) {
            die('No se puedo ejecutar la consulta');
        }
        
        session_start();
        $rol=$_SESSION['usuario']['tipo_usuario'];
        $id_usuario=$_SESSION['usuario']['id_usuario'];
        $accion="Inserción";
        $detalle="Inserción libro código:'".$codigo."'";
        insert_bitacora($rol,$id_usuario,$accion,$detalle);

        $msg = "Datos guardados exitosamente";
        $response = array('success' => true, 'message' => $msg);
        header('content-type: application/json'); // This line makes no difference.
        echo  json_encode($response);
    
    }

    CloseCon($connection);
?>