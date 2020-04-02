<?php require_once("../php/databaseConnection.php") ?>

<?php
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

    $insert = ("INSERT INTO libros (codigo_libro,autor,nombre_libro,fecha_expedicion,disponibilidad,precio_publico,precio_interno,reservado,cantidad) VALUES ('" . $codigo . "','" . $autor . "','" . $nombre_libro . "','" . $fecha_expedicion . "','" . $disponibilidad . "','" . $precio_publico . "','" . $precio_interno . "','" . $reservado . "','" . $cantidad . "')");

    $consulta = mysqli_query($connection, $insert, $resultmode = MYSQLI_STORE_RESULT);
    mysqli_select_db($connection,$database);

    if ($consulta == false) {
        die('No se puedo ejecutar la consulta');
    }

    $msg = "Datos guardados exitosamente";
    $response = array('success' => true, 'message' => $msg);
    header('content-type: application/json'); // This line makes no difference.
    echo  json_encode($response);

}
?>