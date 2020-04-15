<?php require_once("../php/databaseConnection.php") ?>

<?php
if (isset($_POST['usser']) && ($_POST['pasword'] != '')) {
    $result =$mysqli->query("SELECT nombre_apellido, tipo_usuario FROM usuarios WHERE nombre_apellido ='" . $_POST['usser'] . "' AND pasword='" . $_POST['pasword'] . "'");

    if ($result->num_rows == 1) {
        $datos = $result->fetch_assoc();
        echo json_encode(array('error' => false, 'tipo' => $datos['tipo_usuario']));
    } else {
        echo json_encode(array('error' => true));
    }
}

$connection->close();
?>