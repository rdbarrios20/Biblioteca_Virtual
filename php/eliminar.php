<?php require_once("../php/databaseConnection.php")?>

<?php

    $ide=$_POST['ide_libro'];
    $query="DELETE FROM libros WHERE CODIGO_LIBRO ='$ide'";

    $result = $connection->query($query);

    echo "Registro eliminado con exito";

?>