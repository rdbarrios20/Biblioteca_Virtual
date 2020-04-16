<?php require_once("../php/databaseConnection.php") ?>

<?php
sleep(2);
$result = $connection->query("SELECT nombre_apellido,tipo_usuario FROM usuarios WHERE usuario ='" . $_POST['user'] . "' AND pasword='" . $_POST['pasword'] . "'");
if ($result->num_rows == 1) {
    $datos = $result->fetch_assoc();
    echo json_encode(array('validation' => false, 'tipo' => $datos['tipo_usuario']));
} else {
    $message="Usuario o Contraseña errados";
    echo json_encode(array('validation' => true,'message'=>$message));
}
$connection->close();
?>