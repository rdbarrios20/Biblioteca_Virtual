<?php require_once("../php/databaseConnection.php")?>

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

    $modificar = ("UPDATE libros SET AUTOR=('" . $autor . "'),
    NOMBRE_LIBRO=('" . $nombre_libro . "'),FECHA_EXPEDICION=('" . $fecha_expedicion . "'),
    DISPONIBILIDAD=('" . $disponibilidad . "'),PRECIO_PUBLICO=('" . $precio_publico . "'),
    PRECIO_INTERNO=('" . $precio_interno . "'),RESERVADO=('" . $reservado . "'),
    CANTIDAD=('" . $cantidad . "') WHERE CODIGO_LIBRO='" . $codigo . "'");

    $consulta = mysqli_query($connection, $modificar, $resultmode = MYSQLI_STORE_RESULT);
    mysqli_select_db($connection,$database);

    if ($consulta == false) {
        die('No se puedo ejecutar la consulta');
    }

    $msg = "Datos modificados exitosamente";
    $response = array('success' => true, 'message' => $msg);
    header('content-type: application/json'); // This line makes no difference.
    echo  json_encode($response);

}
